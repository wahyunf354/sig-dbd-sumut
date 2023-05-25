<?php

namespace App\Http\Controllers\Admin;

use App\Helper\DateHelper;
use App\Helper\FileHelper;
use App\Http\Controllers\Controller;
use App\Imports\LaporanDbdImport;
use App\Models\KabupatenOrKotaSumut;
use App\Models\LaporanDBD;
use App\Models\LaporanDbdFiles;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon as SupportCarbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

use function PHPUnit\Framework\isEmpty;

class LaporanDBDController extends Controller
{

  public function __construct(private DateHelper $dateHelper, private FileHelper $fileHelper)
  {
  }

  public function index()
  {
    if (Auth::user()->role_user_id == 1) {
      $laporaDbds = LaporanDbdFiles::all();
    } else {
      if (Auth::user()->kabkota_id) {
        $laporaDbds = LaporanDbdFiles::where('kabkota_id', Auth::user()->kabkota_id)->get();
      } else {
        Alert::warning('User tidak diizinkan untuk mengakses halaman');
        return redirect()->route('admin.dashboard');
      }
    }

    return view('admin.pages.laporanDBD.index', compact('laporaDbds'));
  }

  public function showUploadLaporan()
  {

    $yearNow = strftime("%Y", time());
    $years = range($yearNow - 20, $yearNow + 20);

    $mounts = ['Januari', 'Februari', 'Maret', 'April', 'Mai', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

    $kabKotas = KabupatenOrKotaSumut::all();

    return view('admin.pages.laporanDBD.create', compact('years', 'yearNow', 'mounts', 'kabKotas'));
  }

  // public function uploadFileLaporan($file)
  // {
  //   $extention = $file->getClientOriginalExtension();
  //   $filename = SupportCarbon::now()->timestamp . '.' . $extention;
  //   $file->move(public_path('files/laporanDBD/'), $filename);

  //   return $filename;
  // }

  public function uploadLaporan(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'tahun' => ['required'],
      'bulan' => ['required'],
      'laporan_dbd' => ['required'],
      'kabkota_id' => ['required', Rule::exists('kabupaten_or_kota_sumut', 'id')]
    ], [
      'excel_file.mimes' => 'File Excel yang diunggah harus berformat xls atau xlsx.',
    ]);

    if ($validator->fails()) {
      Alert::error('Invalid Input', 'Terdapat masalah pada input yang diberikan');
      return redirect()->back()->withErrors($validator)->withInput($request->all());
    }

    if(Auth::user()->role_user_id != 1) {
      if (Auth::user()->role_user_id != 2){
      } else {
        if ($request->kabkota_id != Auth::user()->kabkota_id){
          Alert::warning('User tidak diizinkan untuk melakukan tindakan ini');
          return redirect()->route('admin.dashboard');
        }
      }
    }

    // Upload excel laporan DBD
    $filenameExcel = "";
    if (!empty($request->file('laporan_dbd'))) {
      $filenameExcel = $this->fileHelper->uploadFile($request->file('laporan_dbd'), public_path('files/laporanDBD/'), "");
    }

    if (empty($filenameExcel)) {
      Alert::error("Terjadi Masalah", 'File laporan DBD gagal diupload');
      return redirect()->back();
    }

    $newReport = new LaporanDbdFiles();

    $newReport->tahun = $request->tahun;
    $newReport->user_id_upload = Auth::id();
    $newReport->bulan = $request->bulan;
    $newReport->kabkota_id = $request->kabkota_id;
    $newReport->laporan_file = $filenameExcel;

    $result = $newReport->save();

      $path = public_path('files/laporanDBD/' . $filenameExcel);

    Excel::import(new LaporanDbdImport($newReport->id), $path);

    if ($result) {
      Alert::success("Berhasil", "Berhasil melakukan upload laporan DBD");
      return redirect()->route('admin.laporandbd.index');
    } else {
      Alert::error("Terjadi Masalah", 'Terjadi masalah pada sistem database');
      return redirect()->back();
    }
  }

  public function showDetailLaporan($id)
  {
    $laporanDbdFile = LaporanDbdFiles::find($id);

    $monthName = $this->dateHelper->numberToMonth($laporanDbdFile->bulan);

    $avg = [
      'ir' => $laporanDbdFile->laporanDbd->avg('ir_dbd'),
      'cfr' => $laporanDbdFile->laporanDbd->avg('cfr_dbd'),
      'abj' => $laporanDbdFile->laporanDbd->avg('abj') 
    ];




    return view('admin.pages.laporanDBD.detail', compact('laporanDbdFile', 'monthName', 'avg'));
  }

  public function showDetailOneLaporan(Request $request)
  {
    $id = $request->input('id');
    
    $laporandbd = LaporanDBD::find($id);
    

    return response()->json($laporandbd);
  }

}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ExcelController;
use App\Imports\LaporanDbdImport;
use App\Models\KabupatenOrKotaSumut;
use App\Models\LaporanDBD;
use App\Models\LaporanDbdFiles;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon as SupportCarbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use PhpParser\Node\Stmt\Label;
use RealRashid\SweetAlert\Facades\Alert;

class LaporanDBDController extends Controller
{

  public function index()
  {
    $laporaDbds = LaporanDbdFiles::all();

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

  public function uploadFileLaporan($file)
  {
    $extention = $file->getClientOriginalExtension();
    $filename = SupportCarbon::now()->timestamp . '.' . $extention;
    $file->move(public_path('files/laporanDBD/'), $filename);

    return $filename;
  }

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

    // Upload excel laporan DBD
    $filenameExcel = "";
    if (!empty($request->file('laporan_dbd'))) {
      $filenameExcel = $this->uploadFileLaporan($request->file('laporan_dbd'));
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
      return redirect()->route('admin.dashboard');
    } else {
      Alert::error("Terjadi Masalah", 'Terjadi masalah pada sistem database');
      return redirect()->back();
    }
  }

}

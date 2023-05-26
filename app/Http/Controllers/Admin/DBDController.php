<?php

namespace App\Http\Controllers\Admin;

use App\Helper\DateHelper;
use App\Helper\FileHelper;
use App\Http\Controllers\Controller;
use App\Imports\DataDbdImport;
use App\Models\DataDBD;
use App\Models\DataDBDFile;
use App\Models\KabupatenOrKotaSumut;
use App\Models\LaporanDBD;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class DBDController extends Controller
{

  public function __construct(private DateHelper $dateHelper, private FileHelper $fileHelper)
  {
  }

  public function petaSebaran()
  {
    $dataKabKota = KabupatenOrKotaSumut::all();


    $bulanNow = date('n');

    $dataDBD = DB::table('kabupaten_or_kota_sumut')
      ->select(DB::raw('kabupaten_or_kota_sumut.id, kabupaten_or_kota_sumut.nama, laporan_dbd_files.bulan, AVG(laporan_dbd.abj) as avg_abj, AVG(laporan_dbd.ir_dbd) as avg_ir, AVG(laporan_dbd.cfr_dbd) as avg_cfr'))
      ->join('laporan_dbd_files', 'kabupaten_or_kota_sumut.id', '=', 'laporan_dbd_files.kabkota_id')
      ->join('laporan_dbd', 'laporan_dbd_files.id', '=', 'laporan_dbd.laporan_dbd_file_id')
      ->where('laporan_dbd_files.bulan', $bulanNow)
      ->groupBy('laporan_dbd_files.id')
      ->get();

    foreach ($dataKabKota as $item) {
      $item->avg_abj = null;
      $item->avg_ir = null;
      $item->avg_cfr = null;

      foreach ($dataDBD as $dbd) {
        if ($dbd->nama == $item->nama) {
          $item->avg_abj = $dbd->avg_abj;
          $item->avg_ir = $dbd->avg_ir;
          $item->avg_cfr = $dbd->avg_cfr;
          break;
        }
      }
    }

    $jsonDataKabKota = json_encode($dataKabKota);

    return view('admin.pages.maps.index', compact('jsonDataKabKota'));
  }

  public function index()
  {

    $dataDbdFiles = DataDBDFile::all();


    return view('admin.pages.dataDBD.index', compact('dataDbdFiles'));
  }

  public function create()
  {
    $yearNow = strftime("%Y", time());
    $years = range($yearNow - 20, $yearNow + 20);

    $mounts = ['Januari', 'Februari', 'Maret', 'April', 'Mai', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

    return view('admin.pages.dataDBD.create', compact('years', 'mounts', 'yearNow'));
  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'tahun' => ['required'],
      'bulan' => ['required'],
      'data_dbd' => ['required'],
    ]);

    if ($validator->fails()) {
      Alert::error('Invalid Input', 'Terdapat masalah pada input yang diberikan');
      return redirect()->back()->withErrors($validator)->withInput($request->all());
    }

    // Upload excel laporan DBD
    $filenameExcel = "";
    if (!empty($request->file('data_dbd'))) {
      $filenameExcel = $this->fileHelper->uploadFile($request->file('data_dbd'), public_path('files/dataDBD/'), "");
    }

    if (empty($filenameExcel)) {
      dd("hai1");
      Alert::error("Terjadi Masalah", 'File laporan DBD gagal diupload');
      return redirect()->back();
    }

    $dataDbdFileNew = new DataDBDFile();

    $dataDbdFileNew->tahun = $request->tahun;
    $dataDbdFileNew->user_id_upload = Auth::id();
    $dataDbdFileNew->bulan = $request->bulan;
    $dataDbdFileNew->file_url = $filenameExcel;

    $result = $dataDbdFileNew->save();

    $path = public_path('files/dataDBD/' . $filenameExcel);

    Excel::import(new DataDbdImport($dataDbdFileNew->id, $dataDbdFileNew->tahun, $dataDbdFileNew->bulan), $path);

    if ($result) {
      return redirect()->route('admin.dataDBD.index')->with('success', 'Berhasil mengunggah data');
    } else {
      return redirect()->back()->with('error', 'Terjadi Masalah input data');
    }
  }

  public function show($id)
  {
    $dataDBD = DataDBD::where('data_dbd_file_id', '=', $id)->get();

    return view('admin.pages.dataDBD.show', compact('dataDBD'));
  }

  public function destroy($id)
  {
    $dataDBDFile = DataDBDFile::find($id);
    if ($this->fileHelper->deleteFile(public_path('files/dataDBD/' . $dataDBDFile->file_url))) {
      DataDBDFile::destroy($id);
      DataDBD::where('data_dbd_file_id', '=', $id)->delete();
    }
    return redirect()->back()->with('success', 'Berhasil menghapus file');
  }
}

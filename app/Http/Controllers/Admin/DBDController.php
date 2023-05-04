<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KabupatenOrKotaSumut;
use App\Models\LaporanDBD;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DBDController extends Controller
{
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

  public function ir()
  {
    return view('admin.pages.');
  }
}

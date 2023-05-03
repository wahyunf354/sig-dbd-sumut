<?php

namespace App\Imports;

use App\Models\LaporanDBD;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithMappedCells;

class LaporanDbdImport implements ToCollection, WithCalculatedFormulas
{

  private int $laporanDbdFileId;

  /**
   * @param int $laporanDbdFileId
   */
  public function __construct(int $laporanDbdFileId)
  {
    $this->laporanDbdFileId = $laporanDbdFileId;
  }


  public function collection(Collection $collection)
  {
    foreach ($collection as $key => $row) {
      if ($key > 11 && $row[1] != null) {
        if ($row[1] == "TOTAL") {
          break;
        }
        LaporanDBD::create([
          'laporan_dbd_file_id' => $this->laporanDbdFileId,
          'kecamatan_dijumpai_dbd' => $row[2],
          'puskesmas_dijumpai_dbd' => $row[3],
          'desa_kelurahan_dijumpai_dbd' => $row[4],
          'jumlah_penduduk_desa_kelurahan' => $row[5],
          'jumlah_kasus_u1_lk_p' => $row[6],
          'jumlah_kasus_u1_lk_m' => $row[7],
          'jumlah_kasus_u1_pr_p' => $row[8],
          'jumlah_kasus_u1_pr_m' => $row[9],
          'jumlah_kasus_u1sd4_lk_p' => $row[10],
          'jumlah_kasus_u1sd4_lk_m' => $row[11],
          'jumlah_kasus_u1sd4_pr_p' => $row[12],
          'jumlah_kasus_u1sd4_pr_m' => $row[13],
          'jumlah_kasus_u5sd9_lk_p' => $row[14],
          'jumlah_kasus_u5sd9_lk_m' => $row[15],
          'jumlah_kasus_u5sd9_pr_p' => $row[16],
          'jumlah_kasus_u5sd9_pr_m' => $row[17],
          'jumlah_kasus_u10sd14_lk_p' => $row[18],
          'jumlah_kasus_u10sd14_lk_m' => $row[19],
          'jumlah_kasus_u10sd14_pr_p' => $row[20],
          'jumlah_kasus_u10sd14_pr_m' => $row[21],
          'jumlah_kasus_u15sd44_lk_p' => $row[22],
          'jumlah_kasus_u15sd44_lk_m' => $row[23],
          'jumlah_kasus_u15sd44_pr_p' => $row[24],
          'jumlah_kasus_u15sd44_pr_m' => $row[25],
          'jumlah_kasus_u44_lk_p' => $row[26],
          'jumlah_kasus_u44_lk_m' => $row[27],
          'jumlah_kasus_u44_pr_p' => $row[28],
          'jumlah_kasus_u44_pr_m' => $row[29],
          'jumlah_kasus_u_tidak_tau' => $row[30],
          'jumlah_kasus_lk' => $row[31],
          'jumlah_kasus_pr' => $row[32],
          'jumlah_kasus_penderita' => $row[33],
          'jumlah_kasus_meninggal' => $row[34],
          'ir_dbd' => $row[35],
          'cfr_dbd' => $row[36],
          'jumlah_desakel_penyelidikan_epidemologi' => $row[37],
          'jumlah_desakel_psn_dbd_3mp_masal' => $row[38],
          'jumlah_rumah_bangunan_larvasidasi' => $row[39],
          'jumlah_desakel_penyuluhan' => $row[40],
          'jumlah_pelaksanaan_fogging' => $row[41],
          'jumlah_rumah_pelaksanaan_fogging' => $row[42],
          'jumlah_bangunan_pelaksanaan_fogging' => $row[43],
          'jumlah_rumah_pelaksanaan_smp_fogging' => $row[44],
          'jumlah_bangunan_pelaksanaan_smp_fogging' => $row[45],
          'jumlah_rumah_bangunan_pjb' => $row[46],
          'jumlah_rumah_bangunan_temu_jentik' => $row[47],
          'abj' => $row[48]
          ,]);
      }
    }
  }

}

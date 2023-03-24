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
        ]);
      }
    }
  }
}

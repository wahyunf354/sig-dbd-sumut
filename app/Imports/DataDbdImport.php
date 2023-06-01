<?php

namespace App\Imports;

use App\Models\DataDBD;
use App\Models\LaporanDBD;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithMappedCells;

class DataDbdImport implements ToCollection, WithCalculatedFormulas
{

  private int $dataDbdFileId;
  private int $tahun;
  private int $bulan;

  /**
   * @param int $laporanDbdFileId
   */
  public function __construct(int $dataDbdFileId, int $tahun, int $bulan)
  {
    $this->dataDbdFileId = $dataDbdFileId;
    $this->tahun = $tahun;
    $this->bulan = $bulan;
  }


  public function collection(Collection $collection)
  {
    foreach ($collection as $key => $row) {
      if ($key > 9 && $key < 43) {
        DataDBD::create([
          'data_dbd_file_id' => $this->dataDbdFileId,
          'tahun' => $this->tahun,
          'bulan' => $this->bulan,
          'kab_or_kota_id' => $row[0],
          'kasus_lk' => $row[24],
          'meninggal_lk' => $row[25],
          'kasus_pr' => $row[26],
          'meninggal_pr' => $row[27],
          'kasus_total' => $row[28],
          'meninggal_total' => $row[29],
          'abj' => $row[33],
        ]);
      }
    }
  }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LaporanDBD extends Model
{
  use HasFactory, SoftDeletes;

  protected $fillable = [
    'laporan_dbd_file_id',
    'kecamatan_dijumpai_dbd',
    'puskesmas_dijumpai_dbd',
    'desa_kelurahan_dijumpai_dbd',
    'jumlah_penduduk_desa_kelurahan'
  ];

  protected $table = 'laporan_dbd';

  protected $primaryKey = 'id';

  public function laporanDbdFile()
  {
    return $this->belongsTo(LaporanDBD::class);
  }
}

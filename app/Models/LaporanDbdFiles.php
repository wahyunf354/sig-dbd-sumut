<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LaporanDbdFiles extends Model
{
  use HasFactory, SoftDeletes;

  protected $table = 'laporan_dbd_files';

  protected $fillable = [
    'bulan',
    'tahun',
    'laporan_file',
    'kabkota_id',
  ];

  protected $primaryKey = 'id';

  public function kabupatenOrKotaSumut()
  {
    return $this->belongsTo(KabupatenOrKotaSumut::class, 'kabkota_id');
  }

  public function laporanDbd()
  {
    return $this->hasMany(LaporanDBD::class, 'laporan_dbd_file_id');
  }

  public function user()
  {
    return $this->belongsTo(User::class, 'user_id_upload');
  }
}

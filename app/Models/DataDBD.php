<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataDBD extends Model
{
  use HasFactory;

  protected $table = 'data_dbd';

  protected $fillable = [
    'data_dbd_file_id',
    'kab_or_kota_id',
    'kasus_lk',
    'meninggal_lk',
    'kasus_pr',
    'meninggal_pr',
    'kasus_total',
    'meninggal_total',
    'abj',
    'tahun',
    'bulan'
  ];
}

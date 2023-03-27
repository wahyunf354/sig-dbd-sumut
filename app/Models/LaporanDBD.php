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
    'jumlah_penduduk_desa_kelurahan',
    'jumlah_kasus_u1_lk_p',
    'jumlah_kasus_u1_lk_m',
    'jumlah_kasus_u1_pr_p',
    'jumlah_kasus_u1_pr_m',
    'jumlah_kasus_u1sd4_lk_p',
    'jumlah_kasus_u1sd4_lk_m',
    'jumlah_kasus_u1sd4_pr_p',
    'jumlah_kasus_u1sd4_pr_m',
    'jumlah_kasus_u5sd9_lk_p',
    'jumlah_kasus_u5sd9_lk_m',
    'jumlah_kasus_u5sd9_pr_p',
    'jumlah_kasus_u5sd9_pr_m',
    'jumlah_kasus_u10sd14_lk_p',
    'jumlah_kasus_u10sd14_lk_m',
    'jumlah_kasus_u10sd14_pr_p',
    'jumlah_kasus_u10sd14_pr_m',
    'jumlah_kasus_u15sd44_lk_p',
    'jumlah_kasus_u15sd44_lk_m',
    'jumlah_kasus_u15sd44_pr_p',
    'jumlah_kasus_u15sd44_pr_m',
    'jumlah_kasus_u44_lk_p',
    'jumlah_kasus_u44_lk_m',
    'jumlah_kasus_u44_pr_p',
    'jumlah_kasus_u44_pr_m',
    'jumlah_kasus_u_tidak_tau',
    'jumlah_kasus_lk',
    'jumlah_kasus_pr',
    'jumlah_kasus_penderita',
    'jumlah_kasus_meninggal',
    'ir_dbd',
    'crf_dbd',
    'jumlah_desakel_penyelidikan_epidemologi',
    'jumlah_desakel_psn_dbd_3mp_masal',
    'jumlah_rumah_bangunan_larvasidasi',
    'jumlah_desakel_penyuluhan',
    'jumlah_pelaksanaan_fogging',
    'jumlah_rumah_pelaksanaan_fogging',
    'jumlah_bangunan_pelaksanaan_fogging',
    'jumlah_rumah_pelaksanaan_smp_fogging',
    'jumlah_bangunan_pelaksanaan_smp_fogging',
    'jumlah_rumah_bangunan_pjb',
    'jumlah_rumah_bangunan_temu_jentik',
    'abj'
  ];

  protected $table = 'laporan_dbd';

  protected $primaryKey = 'id';

  public function laporanDbdFile()
  {
    return $this->belongsTo(LaporanDBD::class);
  }
}

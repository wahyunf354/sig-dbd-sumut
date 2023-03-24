<?php

namespace App\Models;

use App\Http\Controllers\Admin\LaporanDBDController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KabupatenOrKotaSumut extends Model
{
  use HasFactory;

  protected $table = 'kabupaten_or_kota_sumut';

  public function laporanDbdFile()
  {
    return $this->hasMany(LaporanDBDController::class);
  }
}

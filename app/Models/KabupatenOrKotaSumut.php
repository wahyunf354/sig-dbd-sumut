<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Stmt\Label;

class KabupatenOrKotaSumut extends Model
{
  use HasFactory;

  protected $table = 'kabupaten_or_kota_sumut';

  public function laporanDBD()
  {
    return $this->hasMany(LaporanDBD::class);
  }
}

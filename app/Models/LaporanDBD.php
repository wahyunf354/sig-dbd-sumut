<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LaporanDBD extends Model
{
    use HasFactory, SoftDeletes;

    public function kabupatenOrKotaSumut()
    {
      return $this->belongsTo(KabupatenOrKotaSumut::class);
    }
}

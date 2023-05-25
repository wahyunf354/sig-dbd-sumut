<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DataDBDFile extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'data_dbd_file';
}

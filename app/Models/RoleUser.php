<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoleUser extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'role_users';

    protected $fillable = ['name'];

    public function users()
    {
        return $this->hasMany(User::class, 'role_user_id');
    }
}

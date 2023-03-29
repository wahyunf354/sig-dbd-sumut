<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      User::create([
        'name' => 'Admin',
        'username' => 'admin',
        'email' => 'admin@admin.com',
        'password' => bcrypt('123456789'),
        'role_user_id' => 1,
      ]);
    }
}

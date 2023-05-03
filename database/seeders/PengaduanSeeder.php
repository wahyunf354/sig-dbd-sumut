<?php

namespace Database\Seeders;

use App\Models\Pengaduan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PengaduanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pengaduan::factory()->count(10)->create();
    }
}

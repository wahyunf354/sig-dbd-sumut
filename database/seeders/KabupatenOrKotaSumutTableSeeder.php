<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KabupatenOrKotaSumutTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $kabKota = [
            [
                "id" => 1,
                "nama" => "Medan",
                "luas" => 29003,
                "jmlpddk" => 2109339,
                "file_geojson" => "medan.geojson",
            ],
            [
                "id" => 2,
                "nama" => "Pematang Siantar",
                "luas" => 7994,
                "jmlpddk" => 234885,
                "file_geojson" => "pematang_siantar.geojson",
            ],
            [
                "id" => 3,
                "nama" => "Binjai",
                "luas" => 9368,
                "jmlpddk" => 246010,
                "file_geojson" => "binjai.geojson",
            ],
            [
                "id" => 4,
                "nama" => "Tanjung Balai",
                "luas" => 6105,
                "jmlpddk" => 154426,
                "file_geojson" => "tanjung_balai.geojson",
            ],
            [
                "id" => 5,
                "nama" => "Tebing Tinggi",
                "luas" => 3886,
                "jmlpddk" => 145180,
                "file_geojson" => "tebing_tinggi.geojson",
            ],
            [
                "id" => 6,
                "nama" => "Sibolga",
                "luas" => 1120,
                "jmlpddk" => 310962,
                "file_geojson" => "sibolga.geojson",
            ],
            [
                "id" => 7,
                "nama" => "Padang Sidempuan",
                "luas" => 15922,
                "jmlpddk" => 191554,
                "file_geojson" => "padang_sidempuan.geojson",
            ],
            [
                "id" => 8,
                "nama" => "Deli Serdang",
                "luas" => 257521,
                "jmlpddk" => 1789243,
                "file_geojson" => "deli_serdang.geojson",
            ],
            [
                "id" => 9,
                "nama" => "Langkat",
                "luas" => 621940,
                "jmlpddk" => 966133,
                "file_geojson" => "langkat.geojson",
            ],
            [
                "id" => 10,
                "nama" => "Karo",
                "luas" => 217346,
                "jmlpddk" => 350479,
                "file_geojson" => "karo.geojson",
            ],
            [
                "id" => 11,
                "nama" => "Simalungun",
                "luas" => 437137,
                "jmlpddk" => 818104,
                "file_geojson" => "simalungun.geojson",
            ],
            [
                "id" => 12,
                "nama" => "Asahan",
                "luas" => 372059,
                "jmlpddk" => 667563,
                "file_geojson" => "asahan.geojson",
            ],
            [
                "id" => 13,
                "nama" => "Labuhan Batu",
                "luas" => 272634,
                "jmlpddk" => 414417,
                "file_geojson" => "labuhanbatu.geojson",
            ],
            [
                "id" => 14,
                "nama" => "Tapanuli Utara",
                "luas" => 379383,
                "jmlpddk" => 278897,
                "file_geojson" => "tapanuli_utara.geojson",
            ],
            [
                "id" => 15,
                "nama" => "Tapanuli Tengah",
                "luas" => 227974,
                "jmlpddk" => 84444,
                "file_geojson" => "tapanuli_tengah.geojson",
            ],
            [
                "id" => 16,
                "nama" => "Tapanuli Selatan",
                "luas" => 435836,
                "jmlpddk" => 264108,
                "file_geojson" => "tapanuli_selatan.geojson",
            ],
            [
                "id" => 17,
                "nama" => "Nias",
                "luas" => 85297,
                "jmlpddk" => 132329,
                "file_geojson" => "nias.geojson",
            ],
            [
                "id" => 18,
                "nama" => "Dairi",
                "luas" => 200366,
                "jmlpddk" => 269848,
                "file_geojson" => "dairi.geojson",
            ],
            [
                "id" => 19,
                "nama" => "Toba",
                "luas" => 205228,
                "jmlpddk" => 172933,
                "file_geojson" => "toba_samosir.geojson",
            ],
            [
                "id" => 20,
                "nama" => "Mandailing Natal",
                "luas" => 642961,
                "jmlpddk" => 403894,
                "file_geojson" => "mandailing_natal.geojson",
            ],
            [
                "id" => 21,
                "nama" => "Nias Selatan",
                "luas" => 248798,
                "jmlpddk" => 289876,
                "file_geojson" => "nias_selatan.geojson",
            ],
            [
                "id" => 22,
                "nama" => "Pak-Pak Bharat",
                "luas" => 135319,
                "jmlpddk" => 40481,
                "file_geojson" => "pak-pak_bharat.geojson",
            ],
            [
                "id" => 23,
                "nama" => "Humbahas",
                "luas" => 244060,
                "jmlpddk" => 171687,
                "file_geojson" => "humbang_hasundutan.geojson",
            ],
            [
                "id" => 24,
                "nama" => "Samosir",
                "luas" => 127416,
                "jmlpddk" => 119650,
                "file_geojson" => "samosir.geojson",
            ],
            [
                "id" => 25,
                "nama" => "Serdang Bedagai",
                "luas" => 195127,
                "jmlpddk" => 592922,
                "file_geojson" => "serdang_bedagai.geojson",
            ],
            [
                "id" => 26,
                "nama" => "Batubara",
                "luas" => 89458,
                "jmlpddk" => 374535,
                "file_geojson" => "batubara.geojson",
            ],
            [
                "id" => 27,
                "nama" => "Padang Lawas",
                "luas" => 379447,
                "jmlpddk" => 223480,
                "file_geojson" => "padanglawas.geojson",
            ],
            [
                "id" => 28,
                "nama" => "Padang Lawas Utara",
                "luas" => 386566,
                "jmlpddk" => 223049,
                "file_geojson" => "padanglawas_utara.geojson",
            ],
            [
                "id" => 29,
                "nama" => "Labuhan Batu Selatan",
                "luas" => 321461,
                "jmlpddk" => 277549,
                "file_geojson" => "labuhanbatu_selatan.geojson",
            ],
            [
                "id" => 30,
                "nama" => "Labuhan Batu Utara",
                "luas" => 362890,
                "jmlpddk" => 331660,
                "file_geojson" => "labuhanbatu_utara.geojson",
            ],
            [
                "id" => 31,
                "nama" => "Nias Utara",
                "luas" => 122537,
                "jmlpddk" => 127530,
                "file_geojson" => "nias_utara.geojson",
            ],
            [
                "id" => 32,
                "nama" => "Nias Barat",
                "luas" => 47072,
                "jmlpddk" => 81461,
                "file_geojson" => "nias_barat.geojson",
            ],
            [
                "id" => 33,
                "nama" => "Gunungsitoli",
                "luas" => 27720,
                "jmlpddk" => 125566,
                "file_geojson" => "gunung_sitoli.geojson",
            ]
        ];


        DB::table('kabupaten_or_kota_sumut')->insert($kabKota);
    }
}

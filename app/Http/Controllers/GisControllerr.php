<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GisControllerr extends Controller
{
    public function petaSebaran()
    {
        $results = DB::table('data_dbd as d')
            ->selectRaw('kab.nama as name, AVG(abj) as ABJ, (SUM(kasus_total) / kab.jmlpddk * 100000) as IR, (SUM(meninggal_total) / SUM(kasus_total) * 100) as CFR, kab.jmlpddk as jmlpddk, kab.file_geojson as file_geojson')
            ->join('kabupaten_or_kota_sumut as kab', 'kab.id', '=', 'd.kab_or_kota_id')
            ->groupBy('kab_or_kota_id')
            ->get()->toArray();

        $jsonData = json_encode($results);

        return view('admin.pages.maps.peta_pam', compact('jsonData', 'results'));
    }
}

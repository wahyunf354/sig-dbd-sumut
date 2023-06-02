<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DataDBD;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

    public function dataGrafikKasusPerKabKota()
    {
        $minYear = DB::table('data_dbd')
            ->select(DB::raw('MIN(CONCAT(tahun)) as minYear'))
            ->value('minYear');

        $maxYear = DB::table('data_dbd')
            ->select(DB::raw('MAX(CONCAT(tahun)) as maxYear'))
            ->value('maxYear');

        $minYear = $minYear > (date('Y') - 5) ? $minYear : (date('Y') - 5);

        $data = DB::table('data_dbd as d')
            ->selectRaw('SUM(kasus_total) as kasus_total, kab.nama as name')
            ->join('kabupaten_or_kota_sumut as kab', 'kab.id', '=', 'd.kab_or_kota_id')
            ->whereBetween('tahun', [$minYear, $maxYear])
            ->groupBy('name')
            ->get();

        $labels = [];
        $kasus = [];

        // Mengisi array label dan nilai dari data
        foreach ($data as $item) {
            @array_push($labels, $item->name);
            @array_push($kasus, floatval($item->kasus_total));
        }

        return response()->json(compact('kasus', 'labels', 'minYear', 'maxYear'), 200);
    }

    public function dataGrafikIrPerKabKota()
    {
        $minYear = DB::table('data_dbd')
            ->select(DB::raw('MIN(CONCAT(tahun)) as minYear'))
            ->value('minYear');

        $maxYear = DB::table('data_dbd')
            ->select(DB::raw('MAX(CONCAT(tahun)) as maxYear'))
            ->value('maxYear');

        $minYear = $minYear > (date('Y') - 5) ? $minYear : (date('Y') - 5);

        $resutlDB = DB::table('data_dbd as d')
            ->selectRaw('(SUM(kasus_total) / kab.jmlpddk) * 100000 as IR, kab.jmlpddk, SUM(kasus_total), kab.nama as name')
            ->join('kabupaten_or_kota_sumut as kab', 'kab.id', '=', 'd.kab_or_kota_id')
            ->whereBetween('tahun', [$minYear, $maxYear])
            // ->where('tahun', 2022)
            ->groupBy('name', 'kab.jmlpddk')
            ->get();

        // TODO: bandingkan hasil IR denganyang ada di Excel
        // dd($data);
        $labels = [];
        $data = [];

        // Mengisi array label dan nilai dari data
        foreach ($resutlDB as $item) {
            @array_push($labels, $item->name);
            @array_push($data, floatval($item->IR));
        }

        return response()->json(compact('data', 'labels', 'minYear', 'maxYear'), 200);
    }

    public function dataGrafikCfrPerKabKota()
    {
        $minYear = DB::table('data_dbd')
            ->select(DB::raw('MIN(CONCAT(tahun)) as minYear'))
            ->value('minYear');

        $maxYear = DB::table('data_dbd')
            ->select(DB::raw('MAX(CONCAT(tahun)) as maxYear'))
            ->value('maxYear');

        $minYear = $minYear > (date('Y') - 5) ? $minYear : (date('Y') - 5);

        $resutlDB = DB::table('data_dbd as d')
            ->selectRaw('(SUM(meninggal_total) / SUM(kasus_total) * 100) as CFR, SUM(kasus_total), SUM(meninggal_total), kab.nama as name')
            ->join('kabupaten_or_kota_sumut as kab', 'kab.id', '=', 'd.kab_or_kota_id')
            ->whereBetween('tahun', [$minYear, $maxYear])
            // ->where('tahun', 2022)
            ->groupBy('name')
            ->get();

        // TODO: bandingkan hasil IR denganyang ada di Excel
        // dd($data);
        $labels = [];
        $data = [];

        // Mengisi array label dan nilai dari data
        foreach ($resutlDB as $item) {
            @array_push($labels, $item->name);
            @array_push($data, floatval($item->CFR));
        }

        return response()->json(compact('data', 'labels', 'minYear', 'maxYear'), 200);
    }

    public function dataGrafikAbjPerKabKota()
    {
        $minYear = DB::table('data_dbd')
            ->select(DB::raw('MIN(CONCAT(tahun)) as minYear'))
            ->value('minYear');

        $maxYear = DB::table('data_dbd')
            ->select(DB::raw('MAX(CONCAT(tahun)) as maxYear'))
            ->value('maxYear');

        $minYear = $minYear > (date('Y') - 5) ? $minYear : (date('Y') - 5);

        $resutlDB = DB::table('data_dbd as d')
            ->selectRaw('AVG(abj) as ABJ, kab.nama as name')
            ->join('kabupaten_or_kota_sumut as kab', 'kab.id', '=', 'd.kab_or_kota_id')
            ->whereBetween('tahun', [$minYear, $maxYear])
            ->groupBy('name')
            ->get();

        $labels = [];
        $data = [];

        // Mengisi array label dan nilai dari data
        foreach ($resutlDB as $item) {
            @array_push($labels, $item->name);
            @array_push($data, floatval($item->ABJ));
        }

        return response()->json(compact('data', 'labels', 'minYear', 'maxYear'), 200);
    }

    public function index()
    {
        $minYear = DB::table('data_dbd')
            ->select(DB::raw('MIN(CONCAT(tahun)) as minYear'))
            ->value('minYear');

        $maxYear = DB::table('data_dbd')
            ->select(DB::raw('MAX(CONCAT(tahun)) as maxYear'))
            ->value('maxYear');

        $minYear = $minYear > (date('Y') - 5) ? $minYear : (date('Y') - 5);

        $dataCards = DB::table('data_dbd as d')
            ->selectRaw('(SUM(kasus_total) / (SELECT SUM(jmlpddk) FROM kabupaten_or_kota_sumut) * 100000) as IR, (SUM(d.meninggal_total) / SUM(d.kasus_total) * 100) as CFR, SUM(d.kasus_total) as kasus_total, SUM(d.meninggal_total) as meninggal_total, AVG(abj) as ABJ, (SELECT SUM(jmlpddk) FROM kabupaten_or_kota_sumut) as jmlpddk')->whereBetween(
                'tahun',
                [$minYear, $maxYear]
            )
            ->get()[0];

        return view('admin.pages.dashboard', compact('dataCards', 'minYear', 'maxYear'));
    }
}

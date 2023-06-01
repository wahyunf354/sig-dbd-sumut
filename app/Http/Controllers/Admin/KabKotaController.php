<?php

namespace App\Http\Controllers\Admin;

use App\Helper\FileHelper;
use App\Http\Controllers\Controller;
use App\Models\DataDBD;
use App\Models\KabupatenOrKotaSumut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

use function PHPSTORM_META\map;

class KabKotaController extends Controller
{

    public function __construct(private FileHelper $fileHelper)
    {
    }

    public function index()
    {
        $regencyCities = KabupatenOrKotaSumut::all();

        return view('admin.pages.kabupatenkota.index', compact('regencyCities'));
    }

    public function create()
    {
        return view('admin.pages.kabupatenkota.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'luas' => 'required|integer',
            'jmlpddk' => 'required|integer',
            'file_geojson' => 'required|file'
        ]);

        $filename = $this->fileHelper->uploadFile($request->file('file_geojson'), public_path('assets/geojson/'), "");

        $kabupatenKota = new KabupatenOrKotaSumut();
        $kabupatenKota->nama = $request->nama;
        $kabupatenKota->luas = $request->luas;
        $kabupatenKota->jmlpddk = $request->jmlpddk;
        $kabupatenKota->file_geojson = $filename;

        $kabupatenKota->save();

        Alert::success("Data kabupaten/kota berhasil disimpan.");
        return redirect()->route('kabkota.index')->with('success', 'Data kabupaten/kota berhasil disimpan.');
    }


    public function grafikByKabOfMonth(Request $request)
    {
        $id = $request->query('kab_kota_id');
        $tahun = $request->query('year');
        $dataDBD = DB::table('data_dbd as d')
            ->selectRaw('kab.nama as name, abj as ABJ, (kasus_total / kab.jmlpddk * 100000) as IR, (meninggal_total / kasus_total * 100) as CFR, kab.jmlpddk as jmlpddk, kab_or_kota_id, tahun, bulan, kasus_lk, kasus_pr, kasus_total, meninggal_lk, meninggal_pr, meninggal_total')
            ->join('kabupaten_or_kota_sumut as kab', 'kab.id', '=', 'd.kab_or_kota_id')
            ->where('kab_or_kota_id', '=', $id)
            ->where('tahun', '=', $tahun)
            ->get()->toArray();

        // Array untuk label bulan dan tahun
        $labels = [];
        // Array untuk nilai IR atau CFR
        $valuesCfr = [];
        $valuesIr = [];
        $valuesAbj = [];

        // Mengisi array label dan nilai dari data
        foreach ($dataDBD as $item) {
            $bulan = $item->bulan;
            $label = date('F', mktime(0, 0, 0, $bulan, 1));

            @array_push($labels, $label);
            @array_push($valuesCfr, floatval($item->CFR));
            @array_push($valuesIr, floatval($item->IR));
            @array_push($valuesAbj, floatval($item->ABJ));
        }

        return response()->json(["labels" => $labels, "cfr" => $valuesCfr, 'ir' => $valuesIr, 'abj' => $valuesAbj], 200);
    }

    public function grafikByKabOfYear(Request $request)
    {
        $id = $request->query('kab_kota_id');
        $tahun = $request->query('year');
        $dataDBD = DB::table('data_dbd as d')
            ->selectRaw('kab.nama as name, kab.jmlpddk as jmlpddk, kab_or_kota_id, tahun, SUM(kasus_lk) as kasus_lk, SUM(kasus_pr) as kasus_pr, SUM(kasus_total) as kasus_total, SUM(meninggal_lk) as meninggal_lk, SUM(meninggal_pr) as meninggal_pr, SUM(meninggal_total) as meninggal_total, (SUM(kasus_total) / kab.jmlpddk * 100000) as IR, (SUM(meninggal_total) / SUM(kasus_total) * 100) as CFR')
            ->join('kabupaten_or_kota_sumut as kab', 'kab.id', '=', 'd.kab_or_kota_id')
            ->where('kab_or_kota_id', '=', $id)
            ->groupBy('name', 'jmlpddk', 'kab_or_kota_id', 'tahun')
            ->get();

        // Array untuk label bulan dan tahun
        $labels = [];
        // Array untuk nilai IR atau CFR
        $valuesCfr = [];
        $valuesIr = [];
        $valuesKasusMeniggal = [];
        $valuesKasus = [];

        // Mengisi array label dan nilai dari data
        foreach ($dataDBD as $item) {
            @array_push($labels, $item->tahun);
            @array_push($valuesCfr, floatval($item->CFR));
            @array_push($valuesIr, floatval($item->IR));
            @array_push($valuesKasusMeniggal, floatval($item->meninggal_total));
            @array_push($valuesKasus, floatval($item->kasus_total));
        }

        return response()->json(["labels" => $labels, "cfr" => $valuesCfr, 'ir' => $valuesIr, 'meninggal_total' => $valuesKasusMeniggal, 'kasus_total' => $valuesKasus], 200);
    }

    public function show($id)
    {
        $kabKota = KabupatenOrKotaSumut::find($id);

        return view('admin.pages.kabupatenkota.show', compact('kabKota'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kabupatenKota = KabupatenOrKotaSumut::find($id);
        return view('admin.pages.kabupatenkota.edit', compact('kabupatenKota'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'luas' => 'required|numeric',
            'jmlpddk' => 'required|numeric',
            'file_geojson' => 'nullable',
        ]);

        $kabupatenKota = KabupatenOrKotaSumut::find($id);
        $kabupatenKota->nama = $request->nama;
        $kabupatenKota->luas = $request->luas;
        $kabupatenKota->jmlpddk = $request->jmlpddk;

        $filenameNew = $kabupatenKota->file_geojson;
        if ($request->hasFile('file_geojson')) {
            $resultDeleteFile = $this->fileHelper->deleteFile(public_path('assets/geojson/' . $filenameNew));
            if ($resultDeleteFile) {
                $filenameNew = $this->fileHelper->uploadFile($request->file('file_geojson'), public_path('assets/geojson/'), "");
            } else {
                Alert::error('Gagal', 'Gagal mengganti file');
                return redirect()->back();
            }
        }

        $kabupatenKota->file_geojson = $filenameNew;
        $kabupatenKota->save();

        Alert::success('Berhasil', "Berhasil mengubah data Kabupaten/Kota");
        return redirect()->route('kabkota.index');
    }

    public function destroy($id)
    {
        KabupatenOrKotaSumut::destroy($id);
        Alert::warning('Berhasil', 'Berhasil menghapus data');
        return redirect()->route('kabkota.index');
    }
}

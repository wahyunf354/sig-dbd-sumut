<?php

namespace App\Http\Controllers\Admin;

use App\Helper\FileHelper;
use App\Http\Controllers\Controller;
use App\Models\KabupatenOrKotaSumut;
use Carbon\Carbon;
use Illuminate\Http\Request;
use NumberFormatter;
use RealRashid\SweetAlert\Facades\Alert;

use function PHPSTORM_META\map;

class KabKotaController extends Controller
{

    public function __construct(private FileHelper $fileHelper)
    {
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $regencyCities = KabupatenOrKotaSumut::all();

        return view('admin.pages.kabupatenkota.index', compact('regencyCities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.kabupatenkota.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'luas' => 'required|integer',
            'jmlpddk' => 'required|integer',
            'file_geojson' => 'required|file'
        ]);
        $filename = $this->fileHelper->uploadFile($request->file('file_geojson'),public_path('assets/geojson/'), "");

        $kabupatenKota = new KabupatenOrKotaSumut();
        $kabupatenKota->nama = $request->nama;
        $kabupatenKota->luas = $request->luas;
        $kabupatenKota->jmlpddk = $request->jmlpddk;
        $kabupatenKota->file_geojson = $filename;

        $kabupatenKota->save();
        
        Alert::success("Data kabupaten/kota berhasil disimpan.");
        return redirect()->route('kabkota.index')->with('success', 'Data kabupaten/kota berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
            $resultDeleteFile = $this->fileHelper->deleteFile(public_path('assets/geojson/'.$filenameNew));
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        KabupatenOrKotaSumut::destroy($id);
        Alert::warning('Berhasil', 'Berhasil menghapus data');
        return redirect()->route('kabkota.index'); 
    }
}

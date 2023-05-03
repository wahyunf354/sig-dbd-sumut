<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePengaduanRequest;
use App\Http\Requests\UpdatePengaduanRequest;
use App\Models\Pengaduan;

class PengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengaduans = Pengaduan::orderBy('created_at', 'desc')->get();
        return view("admin.pages.pengaduan.index", compact("pengaduans"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePengaduanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePengaduanRequest $request)
    {
        $validated = $request->validated();

        dd($validated);
        
        $pengaduan = new Pengaduan();
        $pengaduan->name = $validated['name'];
        $pengaduan->email = $validated['email'];
        $pengaduan->subject = $validated['subject'];
        $pengaduan->message = $validated['message'];
        $pengaduan->save();

        return redirect('/#contact')->with('success', 'Pesan kamu telah dikirim. Terima Kasih!')->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pengaduan = Pengaduan::find($id);

        return view("admin.pages.pengaduan.show", compact('pengaduan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengaduan $pengaduan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePengaduanRequest  $request
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePengaduanRequest $request, Pengaduan $pengaduan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pengaduan::destroy($id);

        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }
}

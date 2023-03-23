<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon as SupportCarbon;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class LaporanDBDController extends Controller
{
    public function showUploadLaporan()
    {
        return view('admin.pages.laporanDBD.create');
    }

    public function uploadFileLaporan($file)
    {
      $extention = $file->getClientOriginalExtension();
      $filename = SupportCarbon::now()->timestamp.'.'.$extention;
      $file->move(public_path('files/laporanDBD/'), $filename);

      return $filename;
    }

    public function uploadLaporan(Request $request)
    {
      $validator = Validator::make($request->all(), [
        'laporan_dbd' => 'required',
      ], [
        'excel_file.mimes' => 'File Excel yang diunggah harus berformat xls atau xlsx.',
      ]);

      if ($validator->fails()) {
        Alert::error('Invalid Input', 'there is a problem with some input');
        return redirect()->back()->withErrors($validator)->withInput($request->all());
      }

          // Upload excel laporan DBD
          $filenameExcel = "";
      if (!empty($request->file('laporan_dbd'))) {
        $filenameExcel = $this->uploadFileLaporan($request->file('laporan_dbd'));
      }
    }
}

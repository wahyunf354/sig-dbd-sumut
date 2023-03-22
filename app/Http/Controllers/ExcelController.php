<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



class ExcelController extends Controller
{
    public function readExcelData()
    {
        $path = public_path('files/laporanDBD/1678648922.xls'); // path file Excel yang akan di ekstrak datanya

        $data = Excel::load($path, function($reader) {})->get(); // membaca data Excel dan mengembalikan dalam bentuk Collection

        return view('excel-data', compact('data')); // melempar data hasil ekstraksi ke view
    }
}

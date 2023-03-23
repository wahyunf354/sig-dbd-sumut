<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class ExcelController extends Controller
{
  public function readExcelData()
  {
    $path = public_path('files/laporanDBD/1679556610.xls'); // path file Excel yang akan di ekstrak datanya

    $data = Excel::load($path, function ($reader) {
    })->get(); // membaca data Excel dan mengembalikan dalam bentuk Collection

    dd($data);

    return view('excel-data', compact('data')); // melempar data hasil ekstraksi ke view
  }
}

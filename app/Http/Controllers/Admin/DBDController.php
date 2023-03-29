<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KabupatenOrKotaSumut;
use Illuminate\Http\Request;

class DBDController extends Controller
{
  public function petaSebaran()
  {
    $dataKabKota = KabupatenOrKotaSumut::all();

    $jsonDataKabKota = json_encode($dataKabKota);

    return view('admin.pages.maps.index', compact('jsonDataKabKota'));
  }
}

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

    return view('admin.pages.maps.index', compact('dataKabKota'));
  }
}

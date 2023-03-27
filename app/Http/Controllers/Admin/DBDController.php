<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DBDController extends Controller
{
  public function petaSebaran()
  {
    return view('admin.pages.maps.index');
  }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DataDBD;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $dbdData = DataDBD::all();

        return view('admin.pages.dashboard', compact('dbdData'));
    }
}

<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\KabKotaController;
use App\Http\Controllers\GisControllerr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('grafikByKabOfMonth', [KabKotaController::class, 'grafikByKabOfMonth']);
Route::get('grafikByKabOfYear', [KabKotaController::class, 'grafikByKabOfYear']);


Route::get('dataGrafikKasusPerKabKota', [AdminController::class, 'dataGrafikKasusPerKabKota']);
Route::get('dataGrafikIrPerKabKota', [AdminController::class, 'dataGrafikIrPerKabKota']);
Route::get('dataGrafikCfrPerKabKota', [AdminController::class, 'dataGrafikCfrPerKabKota']);
Route::get('dataGrafikAbjPerKabKota', [AdminController::class, 'dataGrafikAbjPerKabKota']);



// Test endpoint
Route::get('testCluster', [GisControllerr::class, 'testCluster']);

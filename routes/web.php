<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DBDController;
use App\Http\Controllers\Admin\InformationController;
use App\Http\Controllers\Admin\KabKotaController;
use App\Http\Controllers\Admin\LaporanDBDController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GisControllerr;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PengaduanController;
use App\Http\Middleware\Authenticate;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('beranda');
Route::get('/peta_sebaran', [HomeController::class, 'peta_sebaran']);
Route::get('/peta_sebaran/{year}', [HomeController::class, 'peta_sebaran'])->name('peta_sebaran');
Route::get('/peta_demo', [HomeController::class, 'peta_demo'])->name('peta_sebaran.demo');

// Route::get('/admin', [AdminController::class, 'index']);

Route::group(['prefix' => 'admin'], function () {
  Route::get('login', [AuthController::class, 'showLogin'])->name("admin.login")->middleware(\App\Http\Middleware\AlreadyAuth::class);
  Route::post('login', [AuthController::class, 'doLogin'])->name("admin.post.login");
  Route::get('register', [AuthController::class, 'showRegister'])->name("admin.register");
  Route::post('register', [AuthController::class, 'doRegister'])->name("admin.post.register");
  Route::get('logout', [AuthController::class, 'logout'])->name('admin.logout');

  Route::middleware(Authenticate::class)->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name("admin.dashboard");

    // User
    Route::middleware(['admin'])->group(function () {
      Route::resource('user', UserController::class)->except(['index']);
    });
    Route::resource('user', UserController::class)->only(['index']);
    Route::get('profile', [UserController::class, 'showProfile'])->name('user.profile');
    Route::put('change-password', [UserController::class, 'changePassword'])->name('user.changePassword');
    Route::put('edit-profile', [UserController::class, 'editProfile'])->name('user.editProfile');
    // Kabupaten Kota Suamtera Utara
    Route::resource('kabkota', KabKotaController::class);

    // Laporan DBD
    Route::get('laporandbd', [LaporanDBDController::class, 'index'])->name('admin.laporandbd.index');
    Route::post('laporandbd/detail', [LaporanDBDController::class, 'showDetailOneLaporan'])->name('admin.laporandbdb.one.detail');
    Route::get('laporandbd/{id}', [LaporanDBDController::class, 'showDetailLaporan'])->name('admin.laporandbd.detail');
    Route::get('uploadLaporanDBD', [LaporanDBDController::class, 'showUploadLaporan'])->name('admin.uploadLaporanDBD');
    Route::post('uploadLaporanDBD', [LaporanDBDController::class, 'uploadLaporan'])->name('admin.post.uploadLaporanDBD');

    // Data DBD File
    Route::get('dataDBD', [DBDController::class, 'index'])->name('admin.dataDBD.index');
    Route::post('dataDBD', [DBDController::class, 'store'])->name('admin.dataDBD.store');
    Route::get('dataDBD/create', [DBDController::class, 'create'])->name('admin.dataDBD.create');
    // Data DBD
    Route::get('dataDBD/{dataDBDFile}', [DBDController::class, 'show'])->name('admin.dataDBD.show');
    Route::delete('dataDBD/{dataDBDFile}', [DBDController::class, 'destroy'])->name('admin.dataDBD.destroy');

    // Peta Sebaran DBD
    Route::get('petasebaran', [GisControllerr::class, 'petaSebaran'])->name('admin.dbd.peta.sebaran');

    // information
    Route::get('about', [InformationController::class, 'about'])->name('admin.about');

    // Pengaduan
    Route::get('pengaduan', [PengaduanController::class, 'index'])->name("admin.pengaduan");
    Route::post('pengaduan', [PengaduanController::class, 'store'])->name("admin.pengaduan.store");
    Route::get('pengaduan/{id}', [PengaduanController::class, 'show'])->name("admin.pengaduan.show");
    Route::delete('pengaduan/{id}', [PengaduanController::class, 'destroy'])->name("admin.pengaduan.destroy");
  });
});

Route::group(['prefix' => 'test'], function () {
  Route::get('testCleanData', [GisControllerr::class, 'testCleanData']);
  Route::get('testDataMining', [GisControllerr::class, 'testCluster']);
  Route::get('testZscore', [GisControllerr::class, 'testZscore']);
  Route::get('testChebyshevDistance', [GisControllerr::class, 'testChebyshevDistance']);
  Route::get('testGetDataDBDFromDB', [GisControllerr::class, 'testGetDataDBDFromDB']);
  Route::get('testGetRangeTimeData', [GisControllerr::class, 'testGetRangeTimeData']);
});

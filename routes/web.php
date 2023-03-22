<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\LaporanDBDController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\Authenticate;
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
Route::get('/peta_sebaran', [HomeController::class, 'peta_sebaran'])->name('peta_sebaran');


Route::group(['prefix' => 'admin'], function () {
  Route::get('login', [AuthController::class, 'showLogin'])->name("admin.login");
  Route::post('login', [AuthController::class, 'doLogin'])->name("admin.post.login");
  Route::get('register', [AuthController::class, 'showRegister'])->name("admin.register");
  Route::post('register', [AuthController::class, 'doRegister'])->name("admin.post.register");
  Route::get('logout', [AuthController::class, 'logout'])->name('admin.logout');

  Route::middleware(Authenticate::class)->group(function () {
    Route::get('dashboard', [AdminController::class, 'index'])->name("admin.dashboard");

    Route::resource('user', UserController::class);

    // Laporan DBD
    Route::get('uploadLaporanDBD', [LaporanDBDController::class, 'showUploadLaporan'])->name('admin.uploadLaporanDBD');
    Route::post('uploadLaporanDBD', [LaporanDBDController::class, 'uploadLaporan'])->name('admin.post.uploadLaporanDBD');
  });
});

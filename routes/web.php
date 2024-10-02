<?php

use App\Http\Controllers\Api\ErdkkPengajuanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/ganti-password', function () {
    return view('auth.new-password');
});

Route::get('/pengajuan', function () {
    return view('modules.pengajuan.index');
});

Route::get('/data-log-hapus', function () {
    return view('modules.dataLogHapus.index');
});

Route::get('/cari-nik', function () {
    return view('modules.cariNik.index');
});

Route::get('/ringkasan', function () {
    return view('ringkasan.index');
});

Route::get('/subsektor', function () {
    return view('modules.master.subsektor.index');
});

Route::get('/komoditas', function () {
    return view('modules.master.komoditas.index');
});

Route::get('/pengecer', function () {
    return view('modules.master.pengecer.index');
});

Route::get('/wilayah', function () {
    return view('modules.master.wilayah.index');
});

Route::get('/poktan', function () {
    return view('modules.master.poktan.index');
});

Route::get('/user', function () {
    return view('modules.master.user.index');
});

Route::get('/cetak', function () {
    return view('modules.cetak.index');
});

Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
// Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

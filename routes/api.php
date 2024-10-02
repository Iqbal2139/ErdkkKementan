<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\ErdkkPengajuanController;
use App\Http\Controllers\Api\AreaController;
use App\Http\Controllers\Api\RetailersController;
use App\Http\Controllers\Api\SubmissionStatusController;
use App\Http\Controllers\Api\PengecerController;
use App\Http\Controllers\Api\PoktanController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Api\FilterInAreaController;
use App\Http\Controllers\Api\RolesController;
use App\Http\Controllers\Api\WilayahController;
use App\Http\Controllers\Api\RingkasanController;
use App\Http\Controllers\Api\CetakController;
use App\Exports\RingkasanExport;
use App\Http\Controllers\Api\CariNikController;
use Maatwebsite\Excel\Facades\Excel;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/check-database', function(){

    // Test database connection
    try {
        DB::connection()->getPdo();
        if(DB::connection()->getDatabaseName()){
            echo "Yes! Successfully connected to the DB: " . DB::connection()->getDatabaseName();
        }else{
            die("Could not find the database. Please check your configuration.");
        }
    } catch (\Exception $e) {
        die("Could not open connection to database server.  Please check your configuration.");
    }

});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', App\Http\Controllers\Api\RegisterController::class)->name('register');
Route::post('/login', App\Http\Controllers\Api\LoginController::class)->name('login');

Route::middleware(['web'])->group(function () {
    Route::post('ganti-pass', [AuthController::class, 'submitGantiPassword'])->name('ganti.pass');
    Route::get('/ringkasan', [RingkasanController::class, 'index'])->name('ringkasan.index');
    Route::get('ringkasan-detail', [RingkasanController::class, 'detail'])->name('ringkasan.detail');
    Route::get('ringkasan-status', [RingkasanController::class, 'status'])->name('ringkasan.status');
    Route::get('/pengajuan', [ErdkkPengajuanController::class, 'index'])->name('pengajuan.import.index');
    Route::post('pengajuan-store', [ErdkkPengajuanController::class, 'store'])->name('pengajuan.import.store');
    Route::get('export-file-failed', [ErdkkPengajuanController::class, 'downloadExcelFailed']);
    Route::post('send-pengajuan', [ErdkkPengajuanController::class, 'kirimPengajuan']);

    Route::get('cetak', [CetakController::class, 'index'])->name('cetak.index');
    Route::get('cetak-pdf', [CetakController::class, 'downloadPDF'])->name('cetak.downloadPDF');
    Route::get('farmer', [CetakController::class, 'farmer'])->name('cetak.farmer');
    Route::get('commodities', [CetakController::class, 'commodities'])->name('cetak.commodities');
    Route::get('subsectors', [CetakController::class, 'subsectors'])->name('cetak.subsectors');
    Route::get('kios', [CetakController::class, 'kios'])->name('cetak.kios');

    Route::get('data-erdkk-get', [CariNikController::class, 'getDataErdkk'])->name('data.erdkk.get');
    Route::get('detail-erdkk-get', [CariNikController::class, 'getDetailDataErdkk'])->name('detail.erdkk.get');

    Route::get('user', [UserController::class, 'index'])->name('user.index');
    Route::post('reset-pass', [UserController::class, 'resetPassword'])->name('user.reset.pass');
    Route::post('user-post', [UserController::class, 'store'])->name('user.store');
    Route::post('user-put/{id}', [UserController::class, 'update'])->name('user.update');
    Route::get('user-getbyid/{id}', [UserController::class, 'getDataById'])->name('user.getbyid');

    Route::get('role-getbyid', [RolesController::class, 'getDataById'])->name('role.getbyid');
    Route::get('role-get', [RolesController::class, 'getData'])->name('role.get');

    Route::get('areas', [AreaController::class, 'index'])->name('areas.index');
    Route::get('areas-province', [AreaController::class, 'filterProvince'])->name('areas.province');
    Route::get('areas-city', [AreaController::class, 'filterCity'])->name('areas.city');
    Route::get('areas-district', [AreaController::class, 'filterDistrict'])->name('areas.district');
    Route::get('areas-sub-district', [AreaController::class, 'filterSubDistrict'])->name('areas.subdistrict');

    Route::get('retailers', [RetailersController::class, 'index'])->name('retailers.index');
    Route::get('status', [SubmissionStatusController::class, 'index'])->name('status.index');

    Route::get('pengecer', [PengecerController::class, 'index'])->name('pengecer.index');
    Route::get('pengecer-show/{id}', [PengecerController::class, 'show'])->name('pengecer.show');
    Route::post('pengecer-post', [PengecerController::class, 'store'])->name('pengecer.store');
    Route::post('pengecer-put/{id}', [PengecerController::class, 'update'])->name('pengecer.update');

    Route::get('wilayah', [WilayahController::class, 'index'])->name('wilayah.index');
    Route::get('/wilayah-show/{id}', [WilayahController::class, 'show'])->name('wilayah.show');;
    Route::post('/wilayah-post', [WilayahController::class, 'store'])->name('wilayah.store');;
    Route::post('/wilayah-put/{id}', [WilayahController::class, 'update'])->name('wilayah.update');

    Route::get('poktan', [PoktanController::class, 'index'])->name('poktan.index');

    Route::get('testExport', [ErdkkPengajuanController::class, 'testExportArrayToExcel']);
    Route::post('/download-ringkasan', function (Illuminate\Http\Request $request) {
        $id_status = $request->input('id_status');
        return Excel::download(new RingkasanExport($id_status), 'ringkasan_data.xlsx');
    });
});

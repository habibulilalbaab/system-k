<?php

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

Route::get('/', function () {
    return redirect('dashboard');
});
Route::group(['middleware' => ['auth']], function() {
    Route::get('dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    
});
Route::group(['middleware' => ['role:super-admin|karyawan']], function () {
    Route::resource('pinjaman', App\Http\Controllers\PinjamanController::class);
    Route::resource('pengajuan', App\Http\Controllers\PengajuanPinjamanController::class);
    Route::resource('dokumen-pengajuan', App\Http\Controllers\DokumenPinjamanController::class);
    Route::resource('topup-pinjaman', App\Http\Controllers\TopUpPinjamanController::class);
});
Route::group(['middleware' => ['role:super-admin']], function () {
    Route::prefix('admin')->group(function () {
        Route::resource('approval-pengajuan-pinjaman', App\Http\Controllers\Admin\ApprovalPengajuanPinjamanController::class);
        Route::resource('list-pengajuan', App\Http\Controllers\Admin\PengajuanPinjamanController::class);
        Route::resource('pembayaran', App\Http\Controllers\Admin\PembayaranController::class);
    });
    Route::prefix('configuration')->group(function () {
        Route::get('users/approved/{id}', [App\Http\Controllers\UsersController::class, 'approvedUser'])->name('approvedUser');
        Route::get('users/reject/{id}', [App\Http\Controllers\UsersController::class, 'rejectUser'])->name('rejectUser');
        Route::resource('users', App\Http\Controllers\UsersController::class);
        Route::resource('roles', App\Http\Controllers\RolesController::class);
        Route::resource('jabatan', App\Http\Controllers\JabatanController::class);
        Route::resource('system', App\Http\Controllers\SystemController::class);
    });
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

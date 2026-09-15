<?php

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\MejaController as AdminMejaController;
use App\Http\Controllers\Admin\ReservasiController as AdminReservasiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReservasiController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/reservasi/create', function () {
    return view('reservasi.create');
})->name('reservasi.create');

Route::post('/reservasi/rekomendasi', [ReservasiController::class, 'rekomendasi'])
    ->name('reservasi.rekomendasi');

Route::match(['get', 'post'], '/reservasi/pilih-meja', [ReservasiController::class, 'pilihMeja'])
    ->name('reservasi.pilih-meja');

Route::get('/reservasi/status-meja', [ReservasiController::class, 'statusMeja'])
    ->name('reservasi.status-meja');

Route::match(['get', 'post'], '/reservasi/konfirmasi', [ReservasiController::class, 'konfirmasi'])
    ->name('reservasi.konfirmasi');

Route::get('/reservasi/cek', [ReservasiController::class, 'cek'])
    ->name('reservasi.cek');

Route::post('/reservasi/simpan', [ReservasiController::class, 'simpan'])
    ->name('reservasi.simpan');

Route::get('/reservasi/{kode}/pembayaran', [ReservasiController::class, 'pembayaran'])
    ->name('reservasi.pembayaran');

Route::post('/reservasi/{kode}/sudah-bayar', [ReservasiController::class, 'sudahBayar'])
    ->name('reservasi.sudah-bayar');

Route::get('/reservasi/{kode}/status-pembayaran', [ReservasiController::class, 'statusPembayaran'])
    ->name('reservasi.status-pembayaran');

Route::post('/reservasi/{kode}/batalkan', [ReservasiController::class, 'batalkan'])
    ->name('reservasi.batalkan');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])
        ->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])
        ->name('login.proses');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AdminAuthController::class, 'logout'])
        ->name('logout');
    Route::get('/admin', [AdminDashboardController::class, 'index'])
        ->name('admin.dashboard');
    Route::get('/admin/reservasi', [AdminReservasiController::class, 'index'])
        ->name('admin.reservasi.index');
    Route::get('/admin/reservasi/histori', [AdminReservasiController::class, 'histori'])
        ->name('admin.reservasi.histori');
    Route::get('/admin/reservasi/histori/pdf', [AdminReservasiController::class, 'cetakPdf'])
        ->name('admin.reservasi.histori.pdf');
    Route::post('/admin/reservasi/{reservasi}/verifikasi', [AdminReservasiController::class, 'verifikasi'])
        ->name('admin.reservasi.verifikasi');
    Route::post('/admin/reservasi/{reservasi}/verifikasi-pembatalan', [AdminReservasiController::class, 'verifikasiPembatalan'])
        ->name('admin.reservasi.verifikasi-pembatalan');
    Route::get('/admin/meja', [AdminMejaController::class, 'index'])
        ->name('admin.meja.index');
    Route::post('/admin/meja', [AdminMejaController::class, 'store'])
        ->name('admin.meja.store');
    Route::post('/admin/meja/{meja}/nonaktifkan', [AdminMejaController::class, 'nonaktifkan'])
        ->name('admin.meja.nonaktifkan');
    Route::post('/admin/meja/{meja}/aktifkan', [AdminMejaController::class, 'aktifkan'])
        ->name('admin.meja.aktifkan');
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\gudang\ProdukController;
use App\Http\Controllers\Kasir\ProdukKasirController;
use App\Http\Controllers\Admin\ProdukAdminController;
use App\Http\Controllers\Gudang\LaporanGudangController;
use App\Http\Controllers\Admin\LaporanGudangAdminController;
use App\Http\Controllers\Admin\LaporanKasirAdminController;
use App\Http\Controllers\Kasir\LaporanKasirController;
use App\Http\Controllers\Kasir\TransaksiController;
use App\Http\Controllers\Gudang\MutasiController;
use App\Http\Controllers\Gudang\DashboardGudangController;
use App\Http\Controllers\Kasir\DashboardKasirController;
use App\Http\Controllers\Admin\DashboardAdminController;


Route::get('/', function () {
    return view('umum.login');
});

Route::get('/layout-gudang', function () {
    return view('gudang.layout-gudang');
});


Route::prefix('gudang')->group(function () {
    Route::get('/data-produk-asli', [ProdukController::class, 'index'])->name('produk.index');
    Route::post('/data-produk-asli', [ProdukController::class, 'store'])->name('produk.store');
    Route::put('/data-produk-asli/{id}', [ProdukController::class, 'update'])->name('produk.update');
    Route::delete('/data-produk-asli/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');
});

Route::get('/gudang/riwayat-mutasi', [App\Http\Controllers\gudang\MutasiController::class, 'index'])->name('mutasi.index');

Route::get('/gudang/laporan-gudang', [LaporanGudangController::class, 'index'])
    ->name('gudang.laporan.index');

// Route khusus JSON untuk fetch AJAX
Route::get('/gudang/api/laporan-gudang', [LaporanGudangController::class, 'json'])
    ->name('gudang.laporan.json');

Route::prefix('gudang')->group(function () {
    Route::get('/riwayat-mutasi', [MutasiController::class, 'index'])->name('mutasi.index');
});


Route::get('/kasir/laporan-kasir', [LaporanKasirController::class, 'index'])
    ->name('kasir.laporan.index');

// Route khusus JSON untuk fetch AJAX
Route::get('/kasir/api/laporan-kasir', [LaporanKasirController::class, 'json'])
    ->name('kasir.laporan.json');

Route::get('/kasir-layout', function () {
    return view('kasir.layout-kasir');
})->name('kasir.layout-kasir');

Route::get('/dashboard-kasir', function () {
    return view('kasir.dashboard-kasir');
})->name('kasir.dashboard-kasir');

Route::prefix('kasir')->group(function () {
    Route::get('/data-produk-kasir', [ProdukKasirController::class, 'index'])->name('kasir.data-produk-kasir.index');
});

Route::prefix('kasir')->group(function () {
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('kasir.transaksi');
    Route::post('/transaksi/store', [TransaksiController::class, 'store'])->name('kasir.transaksi.store');
    Route::post('/struk', [TransaksiController::class, 'cetakStruk'])->name('kasir.struk');
});


Route::get('/layout-admin', function () {
    return view('admin.layout-admin');
})->name('admin.layout-admin');

Route::get('/dashboard-admin', function () {
    return view('admin.dashboard-admin');
})->name('admin.dashboard-admin');

Route::prefix('admin')->group(function () {
    Route::get('/data-produk-admin', [ProdukAdminController::class, 'index'])->name('admin.data-produk-admin.index');
});

Route::get('/laporan-admin', function () {
    return view('admin.laporan-admin');
})->name('admin.laporan-admin');

Route::get('/admin/laporan-gudang-admin', [LaporanGudangAdminController::class, 'index'])
    ->name('admin.laporan-gudang-admin.index');

Route::get('/admin/laporan-kasir-admin', [LaporanKasirAdminController::class, 'index'])
    ->name('admin.laporan-kasir-admin.index');

// 🔐 Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// 🧑‍💼 Admin
Route::get('/dashboard-admin', [DashboardAdminController::class, 'index'])
    ->name('admin.dashboard-admin');

// 📦 Gudang
Route::get('/dashboard-gudang', [DashboardGudangController::class, 'index'])
    ->name('gudang.dashboard-gudang');

// 🧾 Kasir
Route::get('/dashboard-kasir', [DashboardKasirController::class, 'index'])
    ->name('kasir.dashboard-kasir');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('pengguna', UserController::class);
});

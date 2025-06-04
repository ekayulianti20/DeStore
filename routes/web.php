<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('umum.login');
});

Route::get('/kasir-layout', function () {
    return view('kasir.layout-kasir');
})->name('kasir.layout-kasir');

Route::get('/dashboard-kasir', function () {
    return view('kasir.dashboard-kasir');
})->name('kasir.dashboard-kasir');

Route::get('/data-produk-kasir', function () {
    return view('kasir.data-produk-kasir');
})->name('kasir.data-produk-kasir');

Route::get('/transaksi-kasir', function () {
    return view('kasir.transaksi');
})->name('kasir.transaksi');

Route::get('/laporan-kasir', function () {
    return view('kasir.laporan-kasir');
})->name('kasir.laporan-kasir');

Route::post('/login', function (Request $request) {
    $username = $request->input('username');
    $password = $request->input('password');

    // Dummy logic sementara
    if ($username === 'admin' && $password === '1234') {
        return redirect()->route('kasir.dashboard-kasir');
    }

    return back()->with('error', 'Username atau password salah.');
})->name('login');

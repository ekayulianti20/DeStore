<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('umum.login');
});

Route::get('/layout-gudang', function () {
    return view('gudang.layout-gudang');
});

Route::get('/dashboard-gudang', function () {
    return view('gudang.dashboard-gudang');
});

Route::get('/data-produk', function () {
    return view('gudang.data-produk-asli');
});

Route::get('/riwayat-mutasi', function () {
    return view('gudang.riwayat-mutasi');
});

Route::get('/laporan-gudang', function () {
    return view('gudang.laporan-gudang');
});

Route::post('/login', function (Request $request) {
    $username = $request->input('username');
    $password = $request->input('password');

    // Dummy logic sementara
    if ($username === 'admin' && $password === '1234') {
        return redirect('/dashboard');
    }

    return back()->with('error', 'Username atau password salah.');
})->name('login');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

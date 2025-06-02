<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('umum.login');
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

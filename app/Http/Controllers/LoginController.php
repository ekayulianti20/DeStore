<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('umum.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('username', $request->username)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            session([
                'username' => $user->username,
                'role' => $user->role,
            ]);

            // Update jam_login
            $user->update(['jam_login' => now()]);

            switch ($user->role) {
                case 'admin':
                    return redirect()->route('admin.dashboard-admin');
                case 'kasir':
                    return redirect()->route('kasir.dashboard-kasir');
                case 'gudang':
                    return redirect()->route('gudang.dashboard-gudang');
                default:
                    return back()->with('error', 'Role tidak dikenal.');
            }
        }

        return back()->with('error', 'Username atau password salah.');
    }

    public function logout()
    {
        session()->flush();
        return redirect('/login');
    }
}

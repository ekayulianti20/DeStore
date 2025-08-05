<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.pengguna', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,username',
            'password' => 'required',
            'role' => 'required|in:admin,kasir,gudang',
        ]);

        User::create([
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password')),
            'role' => $request->input('role'),
        ]);

        return redirect()->back()->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'username' => 'required|unique:users,username,' . $id,
            'password' => 'nullable',
            'role' => 'required|in:admin,kasir,gudang',
        ]);

        $user->username = $request->input('username');
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }
        $user->role = $request->input('role');

        $user->save();

        return redirect()->back()->with('success', 'Data user berhasil diperbarui');
    }

    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->back()->with('success', 'Pengguna berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;

class ProdukAdminController extends Controller
{
    public function index()
    {
        $produk = Produk::all();
        return view('admin.data-produk-admin', compact('produk'));
    }
}
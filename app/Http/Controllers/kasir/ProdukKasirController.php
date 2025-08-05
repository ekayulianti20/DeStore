<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;

class ProdukKasirController extends Controller
{
    public function index()
    {
        $produk = Produk::all();
        return view('kasir.data-produk-kasir', compact('produk'));
    }
}

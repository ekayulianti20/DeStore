<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\DetailTransaksi;

class DashboardKasirController extends Controller
{
    public function index()
    {
        $stok = Produk::sum('stok');
        $jumlah_beli = DetailTransaksi::sum('jumlah_beli');
        $id_produk = Produk::count('id_produk');

        return view('kasir.dashboard-kasir', compact('stok', 'jumlah_beli', 'id_produk'));
    }
}

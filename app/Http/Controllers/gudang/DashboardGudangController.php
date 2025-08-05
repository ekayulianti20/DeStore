<?php

namespace App\Http\Controllers\Gudang;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\DetailTransaksi;

class DashboardGudangController extends Controller
{
    public function index()
    {
        $stok = Produk::sum('stok');
        $jumlah_beli = DetailTransaksi::sum('jumlah_beli');
        $id_produk = Produk::count('id_produk');

        return view('gudang.dashboard-gudang', compact('stok', 'jumlah_beli', 'id_produk'));
    }
}

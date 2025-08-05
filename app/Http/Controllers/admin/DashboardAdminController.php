<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\DetailTransaksi;

class DashboardAdminController extends Controller
{
    public function index()
    {
        $stok = Produk::sum('stok');
        $jumlah_beli = DetailTransaksi::sum('jumlah_beli');
        $id_produk = Produk::count('id_produk');

        return view('admin.dashboard-admin', compact('stok', 'jumlah_beli', 'id_produk'));
    }
}

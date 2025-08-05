<?php

namespace App\Http\Controllers\Gudang;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mutasi;

class LaporanGudangController extends Controller
{
    public function index()
    {
        return view('gudang.laporan-gudang');
    }

    public function json(Request $request)
    {
        $awal = $request->query('tanggal_awal');
        $akhir = $request->query('tanggal_akhir');

        if (!$awal || !$akhir) {
            return response()->json([]);
        }

        $data = Mutasi::with('produk')
            ->whereBetween('tanggal_mutasi', [$awal . ' 00:00:00', $akhir . ' 23:59:59'])
            ->get();

        return response()->json($data);
    }
}

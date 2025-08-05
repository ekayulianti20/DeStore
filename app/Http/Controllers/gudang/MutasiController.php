<?php

namespace App\Http\Controllers\Gudang;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mutasi;
use App\Models\Produk;

class MutasiController extends Controller
{
    public function index(Request $request)
    {
        $tanggal = $request->query('tanggal');

        $mutasi = Mutasi::with('produk');

        if ($tanggal) {
            $mutasi->whereDate('tanggal_mutasi', $tanggal);
        }

        $mutasi = $mutasi->get();

        return view('gudang.riwayat-mutasi', compact('mutasi'));
    }

    // Di Mutasi.php
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id_produk');
    }

    public function filter(Request $request)
    {
        $tanggalAwal = $request->tanggal_awal;
        $tanggalAkhir = $request->tanggal_akhir;

        $mutasi = Mutasi::with('produk')
            ->whereBetween('tanggal_mutasi', [$tanggalAwal, $tanggalAkhir])
            ->get()
            ->map(function ($item) {
                return [
                    'id_mutasi' => $item->id_mutasi,
                    'tanggal_mutasi' => $item->tanggal_mutasi,
                    'nama_produk' => $item->produk->nama_produk ?? '-',
                    'tipe_mutasi' => $item->tipe_mutasi,
                    'jumlah' => $item->jumlah,
                ];
            });

        return response()->json($mutasi);
    }

}

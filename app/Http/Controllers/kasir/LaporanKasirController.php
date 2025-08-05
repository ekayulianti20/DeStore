<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LaporanKasirController extends Controller
{
    public function index()
    {
        return view('kasir.laporan-kasir');
    }

    public function json(Request $request)
    {
        $awal = $request->query('tanggal_awal');
        $akhir = $request->query('tanggal_akhir');

        if (!$awal || !$akhir) {
            return response()->json([]);
        }

        $data = DB::connection('kasir')
            ->table('detail_transaksi')
            ->join('transaksi', 'detail_transaksi.id_transaksi', '=', 'transaksi.id_transaksi')
            ->whereBetween('transaksi.tanggal_transaksi', [$awal . ' 00:00:00', $akhir . ' 23:59:59'])
            ->select(
                'detail_transaksi.id_detail',
                'transaksi.tanggal_transaksi',
                'detail_transaksi.id_produk',
                'detail_transaksi.jumlah_beli',
                'detail_transaksi.sub_total'
            )
            ->get();

        $produkMap = DB::connection('gudang')->table('produk')
            ->select('id_produk', 'nama_produk', 'harga_satuan', 'harga_modal') // ✅ ambil harga_modal juga
            ->get()
            ->mapWithKeys(function ($item) {
                $normalizedId = str_replace('.', '', $item->id_produk);
                return [$normalizedId => $item];
            });

        $data->transform(function ($item) use ($produkMap) {
            $item->id_produk = str_replace('.', '', $item->id_produk); // Normalisasi ID
            $produk = $produkMap[$item->id_produk] ?? (object) ['nama_produk' => '-', 'harga_satuan' => 0];
            $item->nama_produk = $produk->nama_produk;
            $item->harga_satuan = $produk->harga_satuan;
            $item->harga_modal = $produk->harga_modal ?? 0;

            return $item;
        });

        $jumlah_transaksi = $data->count();
        $total_pendapatan = $data->sum('sub_total');
        $total_modal = $data->sum(function ($item) {
            return (float) $item->jumlah_beli * (float) $item->harga_modal;
        });
        $keuntungan = $total_pendapatan - $total_modal;

        return response()->json([
            'data' => $data,
            'jumlah_transaksi' => $jumlah_transaksi,
            'total_pendapatan' => $total_pendapatan,
            'keuntungan' => $keuntungan,
        ]);
    }
}

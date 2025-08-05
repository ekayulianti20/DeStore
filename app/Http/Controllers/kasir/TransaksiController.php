<?php

// TransaksiController.php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Transaksi;
use App\Models\Produk;
use App\Models\DetailTransaksi;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    public function index()
    {
        // Ambil data produk dari database gudang_destore
        $produk = DB::connection('gudang')->table('produk')->select('id_produk', 'nama_produk', 'harga_satuan')->get();

        return view('kasir.transaksi', compact('produk'));
    }

    public function store(Request $request)
    {
        DB::connection('kasir')->beginTransaction();

        try {
            // Simpan transaksi utama
            $transaksi = Transaksi::on('kasir')->create([
                'tanggal_transaksi' => Carbon::now(),
                'total_harga' => $request->total_harga,
                'nominal_uang' => $request->nominal_uang,
                'kembalian' => $request->kembalian,
            ]);

            // Simpan detail transaksi dan kurangi stok
            foreach ($request->produk as $item) {
                // Cek stok terlebih dahulu
                $produk = Produk::on('gudang')->where('id_produk', $item['id_produk'])->first();
                if ($produk) {
                    if ($produk->stok < $item['jumlah_beli']) {
                        DB::connection('kasir')->rollBack();
                        return response()->json([
                            'success' => false,
                            'error' => 'Stok produk tidak mencukupi untuk ID: ' . $item['id_produk']
                        ]);
                    }

                    // Buat detail transaksi
                    DetailTransaksi::on('kasir')->create([
                        'id_transaksi' => $transaksi->id_transaksi,
                        'id_produk' => $item['id_produk'],
                        'jumlah_beli' => $item['jumlah_beli'],
                        'sub_total' => $item['sub_total'],
                    ]);

                    // Catat juga ke tabel mutasi (di database gudang)
                    DB::connection('gudang')->table('mutasi')->insert([
                        'id_produk' => $item['id_produk'],
                        'jumlah' => $item['jumlah_beli'],
                        'tanggal_mutasi' => now(),
                        'tipe_mutasi' => 'out',
                        'keterangan'    => 'Perubahan stok dari pembelian',
                    ]);

                    // Kurangi stok
                    $produk->stok -= $item['jumlah_beli'];
                    $produk->save();

                }
            }

            DB::connection('kasir')->commit();
            return response()->json(['success' => true, 'id_transaksi' => $transaksi->id_transaksi]);
        } catch (\Exception $e) {
            DB::connection('kasir')->rollBack();
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }


    public function cetakStruk(Request $request)
    {
        try {
            $transaksi = Transaksi::on('kasir')->with('details')->findOrFail($request->id_transaksi);
            return view('kasir.struk', compact('transaksi'));
        } catch (\Exception $e) {
            return 'Gagal memuat struk: ' . $e->getMessage(); // debug error
        }
    }
}

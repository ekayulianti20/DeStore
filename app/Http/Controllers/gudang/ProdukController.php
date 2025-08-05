<?php

namespace App\Http\Controllers\Gudang;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Mutasi;

class ProdukController extends Controller
{
    // Menampilkan semua data produk
    public function index()
    {
        $produk = Produk::all();
        return view('gudang.data-produk-asli', compact('produk'));
    }

    // Menyimpan produk baru
    public function store(Request $request)
    {
        $request->validate([
            'id_produk'     => 'required|unique:produk,id_produk',
            'nama_produk'   => 'required|string',
            'kategori'      => 'required|string',
            'harga_satuan'  => 'required|numeric',
            'harga_modal'   => 'required|numeric',
            'stok'          => 'required|integer',
            'tipe_mutasi'   => 'required|in:in,out',
            'keterangan'    => 'nullable|string',
        ]);

        // Simpan produk
        $produk = Produk::create([
            'id_produk'     => $request->id_produk,
            'nama_produk'   => $request->nama_produk,
            'kategori'      => $request->kategori,
            'harga_satuan'  => $request->harga_satuan,
            'harga_modal'   => $request->harga_modal,
            'stok'          => $request->stok,
        ]);

        // Simpan mutasi awal
        Mutasi::create([
            'id_produk'        => $produk->id_produk,
            'tanggal_mutasi'   => now(),
            'tipe_mutasi'      => $request->tipe_mutasi,
            'jumlah'           => $request->stok,
            'keterangan'       => $request->keterangan ?? 'Mutasi awal saat menambahkan produk',
        ]);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan.');
    }

    // Memperbarui produk
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_produk'   => 'required|string',
            'kategori'      => 'required|string',
            'harga_satuan'  => 'required|numeric',
            'harga_modal'   => 'required|numeric',
            'stok'          => 'required|integer',
        ]);

        $produk = Produk::where('id_produk', $id)->firstOrFail();

        // Cek apakah stok berubah
        if ($request->stok != $produk->stok) {
            $tipeMutasi = $request->stok > $produk->stok ? 'in' : 'out';
            $jumlah = abs($request->stok - $produk->stok);

            Mutasi::create([
                'id_produk'      => $produk->id_produk,
                'tanggal_mutasi' => now(),
                'tipe_mutasi'    => $tipeMutasi,
                'jumlah'         => $jumlah,
                'keterangan'     => 'Perubahan stok dari edit produk',
            ]);
        }

        // Update data produk
        $produk->update([
            'nama_produk'   => $request->nama_produk,
            'kategori'      => $request->kategori,
            'harga_satuan'  => $request->harga_satuan,
            'harga_modal'   => $request->harga_modal,
            'stok'          => $request->stok,
        ]);

        return redirect()->back()->with('success', 'Produk berhasil diperbarui.');
    }

    // Menghapus produk
    public function destroy($id)
    {
        $produk = Produk::where('id_produk', $id)->firstOrFail();
        $produk->delete();

        return redirect()->back()->with('success', 'Produk berhasil dihapus.');
    }
}

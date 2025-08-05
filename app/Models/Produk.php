<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';
    protected $primaryKey = 'id_produk';

    protected $fillable = [
        'id_produk', 'nama_produk', 'kategori', 'harga_satuan', 'harga_modal', 'stok',
    ];

    public $timestamps = false; // penting! kalau tabelmu tidak punya created_at dan updated_at
    protected $connection = 'gudang'; // Tambahkan ini!
}

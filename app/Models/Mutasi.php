<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Produk;

class Mutasi extends Model
{
    protected $connection = 'gudang'; // koneksi ke database gudang_destore
    protected $table = 'mutasi';
    protected $primaryKey = 'id_mutasi';

    protected $fillable = [
        'id_produk',
        'tanggal_mutasi',
        'tipe_mutasi',
        'jumlah',
        'keterangan',
    ];

    public $timestamps = false; // karena pakai tanggal_mutasi manual

    // Relasi ke Produk
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id_produk');
    }
}

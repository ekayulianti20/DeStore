<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdukTable extends Migration
{
    public function up()
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->string('id_produk')->primary();
            $table->string('nama_produk');
            $table->string('kategori');
            $table->integer('harga_satuan');
            $table->integer('harga_modal');
            $table->integer('stok');
            // Jangan tambahkan timestamps jika kamu tidak pakai created_at / updated_at
            // $table->timestamps(); ← ini boleh dihapus
        });
    }

    public function down()
    {
        Schema::dropIfExists('produk');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::connection('gudang')->create('mutasi', function (Blueprint $table) {
            $table->id('id_mutasi');
            $table->string('id_produk');
            $table->dateTime('tanggal_mutasi');
            $table->enum('tipe_mutasi', ['in', 'out']);
            $table->integer('jumlah');
            $table->text('keterangan')->nullable();

            $table->foreign('id_produk')->references('id_produk')->on('produk')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::connection('gudang')->dropIfExists('mutasi');
    }
};

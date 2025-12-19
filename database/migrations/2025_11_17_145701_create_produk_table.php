<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->id('id_produk');
            $table->string('kode' , 255);
            $table->string('nama_produk' , 100);
            $table->integer('stok');
            $table->date('tanggal_masuk');
            $table->date('kadaluarsa');
            $table->timestamps();
            $table->foreign('kode')->references('kode')->on('kategori');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};

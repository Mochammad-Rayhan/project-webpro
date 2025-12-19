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
        Schema::create('barangmasuk', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_produk');
            $table->string('kode_supplier' , 10);
            $table->unsignedBigInteger('id_admin');
            $table->integer('jumlah_masuk');
            $table->decimal('harga_beli' , 12 , 2);
            $table->decimal('total_masuk' , 12 , 2);
            $table->date('tanggal_masuk');
            $table->timestamps();

            $table->foreign('id_produk')->references('id_produk')->on('produk');
            $table->foreign('kode_supplier')->references('kode_supplier')->on('supplier');
            $table->foreign('id_admin')->references('id_admin')->on('user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangmasuk');
    }
};

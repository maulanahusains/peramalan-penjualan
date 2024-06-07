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
        Schema::create('pembelians', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kd_produk');
            $table->integer('jumlah_pembelian');
            $table->bigInteger('harga_satuan');
            $table->date('tgl_pembelian');
            $table->integer('minggu');
            $table->string('bulan');
            $table->unsignedBigInteger('created_by');
            $table->timestamps();

            $table->foreign('kd_produk')->references('id')->on('produks')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembelians');
    }
};

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
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kd_supplier');
            $table->string('nama_produk', 100);
            $table->text('deskripsi');
            $table->char('bulan', 10)->nullable();
            $table->integer('minggu')->nullable();
            $table->bigInteger('harga');
            $table->timestamps();

            $table->foreign('kd_supplier')->references('id')->on('suppliers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};

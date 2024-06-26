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
        Schema::create('peramalans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kd_produk');
            $table->string('bulan');
            $table->integer('minggu');
            $table->bigInteger('ramalan');
            $table->timestamps();

            $table->foreign('kd_produk')->references('id')->on('produks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peramalans');
    }
};

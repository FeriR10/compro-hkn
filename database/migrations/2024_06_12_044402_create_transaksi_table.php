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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('users_id');
            $table->foreign('users_id')->references('id')->onDelete('cascade')->on('users');
            $table->unsignedBigInteger('barang_id');
            $table->foreign('barang_id')->references('id')->onDelete('cascade')->on('barang');
            $table->integer('qty');
            $table->integer('total_harga_cekout');
            $table->unsignedBigInteger('diskon_id');
            $table->foreign('diskon_id')->references('id')->onDelete('cascade')->on('diskon');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};

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
        Schema::create('profileuser', function (Blueprint $table) {
            $table->id();
            $table->string('alamat');
            $table->string('alamat_kirim');
            $table->string('no_telpon');
            $table->string('nama_pic');
            $table->unsignedBigInteger('users_id');
            $table->foreign('users_id')->references('id')->onDelete('cascade')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profileuser');
    }
};

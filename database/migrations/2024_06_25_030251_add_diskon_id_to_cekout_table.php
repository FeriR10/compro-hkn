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
        Schema::table('cekout', function (Blueprint $table) {
            $table->unsignedBigInteger('diskon_id')->nullable();
            $table->foreign('diskon_id')->references('id')->on('diskon');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cekout', function (Blueprint $table) {
            $table->dropColumn('diskon_id');
        });
    }
};

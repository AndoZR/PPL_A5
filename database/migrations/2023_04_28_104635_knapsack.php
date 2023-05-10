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
        Schema::create('knapsack', function (Blueprint $table) {
            $table->string('knapsack_id', 50)->primary();
            $table->integer('stok_baru');
            $table->string('produk_id',50);
            $table->foreign('produk_id')->references('produk_id')->on('produk');
            $table->string('akun_usaha_username',20);
            $table->foreign('akun_usaha_username')->references('username')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('knapsack');
    }
};

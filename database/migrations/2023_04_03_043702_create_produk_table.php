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
            $table->char('produk_id')->primary();
            $table->char('nama');
            $table->integer('stok');
            $table->integer('harga');
            $table->date('tgl_exp');
            $table->longText('deskripsi');
            // $table->string('usaha_username',10);
            // $table->foreign('usaha_username')->references('username')->on('usaha');
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

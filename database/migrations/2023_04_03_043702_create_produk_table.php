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
            $table->string('nama',50);
            $table->integer('stok');
            $table->integer('harga');
            $table->date('tgl_exp');
            $table->string('deskripsi',100)->nullable();
            $table->timestamp('updated_at');
            $table->char('akun_usaha_username');
            $table->foreign('akun_usaha_username')->references('username')->on('users');
            $table->char('akun_karyawan_username')->nullable();
            $table->foreign('akun_karyawan_username')->references('username')->on('karyawan');
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

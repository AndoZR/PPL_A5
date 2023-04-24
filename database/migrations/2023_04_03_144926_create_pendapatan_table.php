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
        Schema::create('pendapatan', function (Blueprint $table) {
            $table->char('pendapatan_id')->primary();
            $table->date('tanggal');
            $table->string('keterangan',100);
            $table->char('jenis_produk');
            $table->foreign('jenis_produk')->references('produk_id')->on('produk');
            $table->integer('jumlah_produk');
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
        Schema::dropIfExists('pendapatan');
    }
};

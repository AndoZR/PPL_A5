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
        Schema::create('notifikasi', function (Blueprint $table) {
            $table->string('notifikasi_id',50)->primary();
            $table->string('pesan',50);
            $table->string('status',50);
            $table->string('akun_usaha_username',20);
            $table->foreign('akun_usaha_username')->references('username')->on('users');
            $table->string('akun_karyawan_username',20)->nullable();
            $table->foreign('akun_karyawan_username')->references('username')->on('akun_karyawan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifikasi');
    }
};

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
        Schema::create('pengeluaran', function (Blueprint $table) {
            $table->integer('pengeluaran_id')->primary();
            $table->date('tanggal');
            $table->integer('nominal');
            $table->char('keterangan');
            $table->string('akun_usaha_username',10);
            $table->foreign('akun_usaha_username')->references('username')->on('akun_usaha');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengeluaran');
    }
};

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
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->char('pembayaran_id')->primary();
            $table->date('timestamp');
            $table->integer('nominal');
            $table->string('akun_usaha_username',10);
            $table->foreign('akun_usaha_username')->references('username')->on('akun_usaha');
            $table->string('transfer_bank_no_rekening',50);
            $table->foreign('transfer_bank_no_rekening')->references('no_rekening')->on('transfer_bank');
            $table->char('gopay_nomor',13);
            $table->foreign('gopay_nomor')->references('nomor')->on('gopay');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};

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
            $table->string('pembayaran_id',50)->primary();
            $table->date('timestamp');
            $table->integer('nominal');
            $table->string('akun_usaha_username',20);
            $table->foreign('akun_usaha_username')->references('username')->on('users');
            $table->string('transfer_bank_no_rekening',50)->nullable();
            $table->foreign('transfer_bank_no_rekening')->references('no_rekening')->on('transfer_bank');
            $table->string('gopay_nomor',13)->nullable();
            $table->foreign('gopay_nomor')->references('nomor')->on('gopay');
            $table->enum('status',['unpaid','paid']);
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

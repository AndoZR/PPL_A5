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
        Schema::create('transfer_bank', function (Blueprint $table) {
            $table->integer('pembayaran_id')->primary();
            $table->foreign('pembayaran_id')->references('pembayaran_id')->on('pembayaran');
            $table->char('no_rekening');
            $table->char('nama_pengirim');
            $table->integer('transfer_bank_id')->unique();
            $table->integer('bank_id');
            $table->foreign('bank_id')->references('bank_id')->on('bank');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transfer_bank');
    }
};

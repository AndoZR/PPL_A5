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
        Schema::create('gopay', function (Blueprint $table) {
            $table->integer('pembayaran_id')->primary();
            $table->foreign('pembayaran_id')->references('pembayaran_id')->on('pembayaran');
            $table->char('nomor');
            $table->char('username');
            $table->integer('gopay_id')->unique();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gopay');
    }
};

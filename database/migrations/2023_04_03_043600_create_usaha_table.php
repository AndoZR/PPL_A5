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
        Schema::create('usaha', function (Blueprint $table) {
            $table->string('username',10)->unique();
            $table->char('password');
            $table->char('nama_usaha');
            $table->char('alamat');
            $table->char('nomor_handphone',13);
            $table->char('email');
            $table->char('status',7);;
            // $table->integer('kecamatan_id');
            // $table->foreign('kecamatan_id')->references('kecamatan_id')->on('kecamatan');
            // $table->integer('kabupaten_id');
            // $table->foreign('kabupaten_id')->references('kabupaten_id')->on('kabupaten');
            // $table->integer('provinsi_id');
            // $table->foreign('provinsi_id')->references('provinsi_id')->on('provinsi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usaha');
    }
};

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
        Schema::create('karyawan', function (Blueprint $table) {
            $table->string('username')->unique();
            $table->char('password');
            $table->string('nama',50);
            $table->string('alamat',50);
            $table->char('nomor_handphone',13);
            $table->string('email',50);
            $table->string('jabatan',50);
            $table->string('akun_usaha_username',10);
            $table->foreign('akun_usaha_username')->references('username')->on('users');
            $table->integer('kecamatan_id');
            // $table->foreign('kecamatan_id')->references('kecamatan_id')->on('kecamatan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawan');
    }
};

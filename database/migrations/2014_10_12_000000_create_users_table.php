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
        Schema::create('users', function (Blueprint $table) {
            $table->string('username',20)->primary();
            $table->string('password',50);
            $table->string('nama_usaha',50);
            $table->string('alamat',100);
            $table->string('nomor_handphone',13);
            $table->string('email',50);
            $table->string('status',4);
            $table->foreign('status')->references('status_akun_id')->on('status_akun');
            $table->string('kecamatan_id',7);
            $table->timestamp('email_verified_at')->nullable();
            $table->date('tanggal_status');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

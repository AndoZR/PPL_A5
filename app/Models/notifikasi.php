<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class notifikasi extends Model
{
    use HasFactory;

    protected $table = 'notifikasi';

    protected $fillable = ['notifikasi_id', 'pesan', 'status', 'akun_usaha_username', 'akun_karyawan_username'];

    public $timestamps = false;
}

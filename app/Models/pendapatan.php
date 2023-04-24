<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pendapatan extends Model
{
    use HasFactory;

    protected $table = 'pendapatan';

    protected $fillable = ['pendapatan_id', 'tanggal', 'keterangan', 'jenis_produk', 'jumlah_produk', 'akun_usaha_username', 'akun_karyawan_username'];

    public $timestamps = false;
}

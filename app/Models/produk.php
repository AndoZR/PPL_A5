<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produk extends Model
{
    use HasFactory;

    protected $table = 'produk';

    protected $fillable = ['produk_id', 'nama', 'stok', 'harga', 'tgl_exp', 'updated_at', 'deskripsi', 'akun_usaha_username', 'akun_karyawan_username'];

    public $timestamps = false;
}

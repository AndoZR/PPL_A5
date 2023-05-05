<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengeluaran extends Model
{
    use HasFactory;

    protected $table = 'pengeluaran';

    protected $fillable = ['pengeluaran_id', 'tanggal', 'nominal', 'keterangan', 'akun_usaha_username', 'akun_karyawan_username'];

    public $timestamps = false;
}

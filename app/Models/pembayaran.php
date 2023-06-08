<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';

    protected $fillable = ['pembayaran_id', 'timestamp', 'nominal', 'akun_usaha_username'];

    public $timestamps = false;

}

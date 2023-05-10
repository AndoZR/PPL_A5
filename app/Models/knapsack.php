<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class knapsack extends Model
{
    use HasFactory;

    protected $table = 'knapsack';

    protected $fillable = ['knapsack_id', 'stok_baru', 'produk_id', 'akun_usaha_username'];

    public $timestamps = false;
}

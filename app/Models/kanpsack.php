<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kanpsack extends Model
{
    use HasFactory;

    protected $table = 'knapsack';

    protected $fillable = ['knapsack_id', 'stok_baru', 'pendapatan_id', 'akun_usaha_username'];

    public $timestamps = false;
}

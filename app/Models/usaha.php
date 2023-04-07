<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usaha extends Model
{
    use HasFactory;
    protected $fillable = ['username', 'password', 'nama_usaha', 'alamat', 'nomor_handphone', 'email', 'status'];
    protected $table = 'usaha';
    public $timestamps = false;
}

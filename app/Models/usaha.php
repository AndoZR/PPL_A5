<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usaha extends Model
{
    use HasFactory;
    
    protected $table = 'usaha';
    
    protected $fillable = ['username', 'password', 'nama_usaha', 'alamat', 'nomor_handphone', 'email', 'status', 'kecamatan_id'];
    
    public $timestamps = false;
}

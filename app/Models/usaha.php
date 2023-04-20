<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usaha extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    
    protected $table = 'usaha';
    
    protected $fillable = ['username', 
    'password', 
    'nama_usaha', 
    'alamat', 
    'nomor_handphone', 
    'email', 
    'status', 
    'kecamatan_id'];
    
    public $timestamps = false;
}

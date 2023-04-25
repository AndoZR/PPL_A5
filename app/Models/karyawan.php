<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Model;

class karyawan extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = 'karyawan';

    protected $primaryKey = 'username';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
    'username', 
    'password', 
    'nama', 
    'alamat', 
    'nomor_handphone', 
    'email', 
    'jabatan', 
    'akun_usaha_username',
    'kecamatan_id'];

}

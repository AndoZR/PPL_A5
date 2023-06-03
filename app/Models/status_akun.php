<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class status_akun extends Model
{
    use HasFactory;

    protected $table = 'status_akun';

    protected $fillable = ['status_akun_id', 'status'];

    public $timestamps = false;
}

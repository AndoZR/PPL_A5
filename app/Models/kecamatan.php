<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kecamatan extends Model
{
    use HasFactory;
    
    protected $table = 'kecamatan';

    protected $fillable = ['kecamatan_id', 'kabupaten_id', 'nama'];

    public $timestamps = false;
}

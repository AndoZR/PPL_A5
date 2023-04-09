<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;

class c_dashboard extends Controller
{
    

    public function index()
    {
        return view('layouts.dashboard');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\usaha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class c_login extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('auth.login');
    }

    public function akses(Request $request) 
    {
        Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ])->validate();
        
        if (!usaha::where('username', $request->username)->where('password', $request->password)->first()) {
            throw ValidationException::withMessages([
                'username'=>'username/password tidak sesuai',
            ]);
        }

        $request->session()->regenerate();
        return redirect()->route('dashboard');
    }
}

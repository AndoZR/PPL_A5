<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class c_register extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function simpan(Request $request)
    {
        // dd($request->provinsi);
        Validator::make($request->all(), [
            'password' => 'required|max:50',
            'nama_usaha' => 'required|max:50',
            'alamat' => 'required|max:100',
            'nomor_handphone' => 'required|numeric|digits_between:1,13',
            'email' => 'required|email',
            'provinsi' => 'required',
            'kabupaten' => 'required',
            'kecamatan' => 'required',
        ])->validate();

        if (User::where('nama_usaha', $request->nama_usaha)->first() || User::where('email', $request->email)->first()){
            return redirect()->route('register')->with('message', 'Akun anda telah terdaftar! Gagal membuat akun baru!');
        }

        // give id
        $front_username = 'USR';
        $i = 1;
        while ($i >= 0) {
            $username = $front_username . $i;

            $cek = User::where('username', $username)->first();
            if (!$cek) {
                break;
            }
    
            $i++;
        }            

        $nowDate = date('Y-m-d');

        $user = User::create([
            'username' => $username,
            'password' => Hash::make($request->password),
            'nama_usaha' => $request->nama_usaha,
            'alamat' => $request->alamat,
            'nomor_handphone' => $request->nomor_handphone,
            'email' => $request->email,
            'status' => 'sts1',
            'kecamatan_id' => $request->kecamatan,
            'tanggal_status' => $nowDate
        ]);

        event(new Registered($user));
        
        Auth::login($user);

        return redirect()->route('verification.notice');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

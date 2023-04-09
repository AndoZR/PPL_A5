<?php

namespace App\Http\Controllers;

use App\Models\usaha;
use Illuminate\Http\Request;
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
            'password' => 'required',
            'nama_usaha' => 'required',
            'alamat' => 'required',
            'nomor_handphone' => 'required|numeric',
            'email' => 'required|email',
            'provinsi' => 'required',
            'kabupaten' => 'required',
            'kecamatan' => 'required',
        ])->validate();

        // give id
        $front_username = 'USR';
        $i = 1;
        while ($i >= 0) {
            $username = $front_username . $i;

            $cek = usaha::where('username', $username)->first();
            if (!$cek) {
                break;
            }
    
            $i++;
        }            

        $user = [
            'username' => $username,
            'password' => Hash::make($request->password),
            'nama_usaha' => $request->nama_usaha,
            'alamat' => $request->alamat,
            'nomor_handphone' => $request->nomor_handphone,
            'email' => $request->email,
            'status' => 'free',
            'kecamatan_id' => $request->kecamatan,
        ];

        usaha::create($user);
        return redirect()->route('dashboard');
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

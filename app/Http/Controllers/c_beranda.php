<?php

namespace App\Http\Controllers;

use App\Models\usaha;
use Illuminate\Http\Request;

class c_beranda extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Beranda.beranda');
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
        $request->validate([
            'username' => 'required|numeric|unique:usaha,username', 
            'password' => 'required', 
            'nama_usaha' => 'required', 
            'alamat' => 'required', 
            'nomor_handphone' => 'required', 
            'email' => 'required', 
        ],[
            'username.required'=>'username wajib diisi',
            'username.numeric'=>'username wajib dalam angka',
            'username.unique'=>'username telah ada di database',
            'password.required'=>'password wajib diisi',
            'nama_usaha.required'=>'nama usaha wajib diisi',
            'alamat.required'=>'alamat wajib diisi',
            'nomor_handphone.required'=>'nomor hp wajib diisi',
            'email.required'=>'email wajib diisi'
        ]);

        $userFree = 11;
        $data = [
            'username' => $request->username,
            'password' => $request->password,
            'nama_usaha' => $request->nama_usaha,
            'alamat' => $request->alamat,
            'nomor_handphone' => $request->nomor_handphone,
            'email' => $request->email,
            'status' => 'free',
        ];
        usaha::create($data);
        return view('Beranda.beranda');
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

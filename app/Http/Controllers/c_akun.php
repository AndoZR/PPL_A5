<?php

namespace App\Http\Controllers;

use App\Models\provinsi;
use App\Models\kabupaten;
use App\Models\kecamatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class c_akun extends Controller
{
    public function akunUsaha()
    {
        $kecamatan = kecamatan::where('kecamatan_id', auth()->user()->kecamatan_id)->first();
        // dd($kecamatan);
        $kabupaten = kabupaten::where('kabupaten_id', $kecamatan->kabupaten_id)->first();
        $provinsi = provinsi::where('provinsi_id', $kabupaten->provinsi_id)->first();
        return view('akun.akunUsaha', compact('kecamatan', 'kabupaten', 'provinsi'))->with('user', auth()->user());
    }
    
    public function editAkunUsaha()
    {
        $kecamatan = kecamatan::where('kecamatan_id', auth()->user()->kecamatan_id)->first();
        $kabupaten = kabupaten::where('kabupaten_id', $kecamatan->kabupaten_id)->first();
        $provinsi = provinsi::where('provinsi_id', $kabupaten->provinsi_id)->first();
        return view('akun.editAkunUsaha', compact('kecamatan', 'kabupaten', 'provinsi'))->with('user', auth()->user());
    }

    public function editAkunUsahaProcess(Request $request)
    {
        // Validate
        $request->validate([
            'nama_usaha' => 'required', 
            'alamat' => 'required', 
            'provinsi' => 'required', 
            'kabupaten' => 'required', 
            'kecamatan' => 'required', 
            'nomor_handphone' => 'required|numeric', 
            'email' => 'required|email',
            'password' => 'required'
        ]);

        auth()->user()->update([
            'nama_usaha' => $request->nama_usaha, 
            'alamat' => $request->alamat, 
            'kecamatan_id' => $request->kecamatan, 
            'nomor_handphone' => $request->nomor_handphone, 
            'email' => $request->email,
            'password' => $request->password  
        ]);
        
        // produk::where('produk_id', $produk_id)->update($data);
        return redirect()->route('akunUsaha')->with('message', 'Data berhasil disimpan!');
    }

    public function akunKaryawan()
    {
        return view('akun.akunKaryawan');
    }
}

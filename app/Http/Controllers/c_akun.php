<?php

namespace App\Http\Controllers;

use App\Models\karyawan;
use App\Models\provinsi;
use App\Models\kabupaten;
use App\Models\kecamatan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class c_akun extends Controller
{
    // AKUN USAHA ZONE
    public function akunUsaha()
    {
        if (Auth::guard('web')->check()){
            $kecamatan = kecamatan::where('kecamatan_id', Auth::guard('web')->user()->kecamatan_id)->first();
            $kabupaten = kabupaten::where('kabupaten_id', $kecamatan->kabupaten_id)->first();
            $provinsi = provinsi::where('provinsi_id', $kabupaten->provinsi_id)->first();
            return view('akun.akunUsaha', compact('kecamatan', 'kabupaten', 'provinsi'))->with('user', auth()->user());
        }
        elseif (Auth::guard('karyawan')->check()){
            $getAkunUsaha = User::where('username',Auth::guard('karyawan')->user()->akun_usaha_username)->first();
            $kecamatan = kecamatan::where('kecamatan_id', $getAkunUsaha->kecamatan_id)->first();
            $kabupaten = kabupaten::where('kabupaten_id', $kecamatan->kabupaten_id)->first();
            $provinsi = provinsi::where('provinsi_id', $kabupaten->provinsi_id)->first();
            return view('akun.akunUsaha', compact('kecamatan', 'kabupaten', 'provinsi'))->with('user', $getAkunUsaha);
        }

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
        
        
        return redirect()->route('akunUsaha')->with('message', 'Data berhasil disimpan!');
    }



    // ------------------ AKUN KARYAWAN ZONE ------------------------
    public function akunKaryawan()
    {
        $karyawan = karyawan::where('akun_usaha_username', auth()->user()->username)->get();
        return view('akun.daftarAkunKaryawan', ['karyawan' => $karyawan]);
    }

    public function akunKaryawanAdd()
    {
        return view('akun.akunKaryawanTambah');
    }

    public function akunKaryawanAddSave(Request $request)
    {
        // Validate
        $request->validate([
            'nama' => 'required', 
            'alamat' => 'required', 
            'provinsi' => 'required', 
            'kabupaten' => 'required', 
            'kecamatan' => 'required', 
            'nomor_handphone' => 'required|numeric', 
            'email' => 'required|email',
            'jabatan' => 'required',
            'password' => 'required'
        ]);

        // give id
        $front_username_karyawan = 'KRYWN';
        $i = 1;
        while ($i >= 0) {
            $username_karyawan = $front_username_karyawan . $i;

            $cek = karyawan::where('username', $username_karyawan)->first();
            if (!$cek) {
                break;
            }
    
            $i++;
        }
        // dd(Auth::guard('user')->user()->username);
        $data = [
            'nama' => $request->nama, 
            'alamat' => $request->alamat, 
            'nomor_handphone' => $request->nomor_handphone, 
            'email' => $request->email,
            'jabatan' => $request->jabatan,
            'username' => $username_karyawan,
            'password' => Hash::make($request->password),
            'akun_usaha_username' => auth()->user()->username,
            'kecamatan_id' => $request->kecamatan, 
        ];

        $user = karyawan::create($data);
        
        Auth::guard('karyawan')->login($user);

        return redirect()->route('akunKaryawan')->with('message', 'Akun karyawan berhasil dibuat!');
    }

    public function detailKaryawan($username)
    {
        if (Auth::guard('web')->check()){
            $karyawan = karyawan::where('username', $username)->first();
            $kecamatan = kecamatan::where('kecamatan_id', $karyawan->kecamatan_id)->first();
            $kabupaten = kabupaten::where('kabupaten_id', $kecamatan->kabupaten_id)->first();
            $provinsi = provinsi::where('provinsi_id', $kabupaten->provinsi_id)->first();

            return view('akun.detailAkunKaryawan', compact('kecamatan', 'kabupaten', 'provinsi'))->with('karyawan', $karyawan);
        }
        elseif (Auth::guard('karyawan')->check()){
            $karyawan = karyawan::where('username', $username)->first();
            $kecamatan = kecamatan::where('kecamatan_id', $karyawan->kecamatan_id)->first();
            $kabupaten = kabupaten::where('kabupaten_id', $kecamatan->kabupaten_id)->first();
            $provinsi = provinsi::where('provinsi_id', $kabupaten->provinsi_id)->first();
    
            return view('akun.detailAkunKaryawan', compact('kecamatan', 'kabupaten', 'provinsi'))->with('karyawan', $karyawan);
        }
    }

    public function hapusKaryawan($username)
    {
        karyawan::where('username', $username)->delete();
        return redirect()->route('akunKaryawan');
    }

    public function editKaryawan()
    {
        $kecamatan = kecamatan::where('kecamatan_id', Auth::guard('karyawan')->user()->kecamatan_id)->first();
        $kabupaten = kabupaten::where('kabupaten_id', $kecamatan->kabupaten_id)->first();
        $provinsi = provinsi::where('provinsi_id', $kabupaten->provinsi_id)->first();
        return view('akun.editAkunKaryawan', compact('kecamatan', 'kabupaten', 'provinsi'))->with('karyawan', Auth::guard('karyawan')->user());
    }

    public function editSimpanKaryawan(Request $request)
    {
        // Validate
        $request->validate([
            'nama' => 'required', 
            'alamat' => 'required', 
            'provinsi' => 'required', 
            'kabupaten' => 'required', 
            'kecamatan' => 'required', 
            'nomor_handphone' => 'required|numeric', 
            'email' => 'required|email',
            'jabatan' => 'required',
            'password' => 'required'
        ]);

        Auth::guard('karyawan')->user()->update([
            'nama' => $request->nama, 
            'alamat' => $request->alamat, 
            'kecamatan_id' => $request->kecamatan, 
            'nomor_handphone' => $request->nomor_handphone, 
            'email' => $request->email,
            'jabatan' => $request->jabatan,
            'password' => $request->password  
        ]);
        
        return redirect()->route('akunKaryawan.detail', $request->username)->with('message', 'Data berhasil disimpan!');
    }

    // get premium mas broo!!!
    public function getPremium ()
    {
        Auth::guard('web')->user()->update([
            'status' => 'premium'
        ]);
        return redirect()->route('dashboard');
    }
}

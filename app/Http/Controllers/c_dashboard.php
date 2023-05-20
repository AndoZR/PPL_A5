<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

class c_dashboard extends Controller
{
    // public function index()
    // {
    //     return view('layouts.dashboard');
    // }
    
    protected function index() {
        if (Auth::guard('web')->check()) {
            $produk = produk::select('tgl_exp', 'nama')->where('akun_usaha_username',Auth::guard('web')->user()->username)->get();
            $nowDate = date('Y-m-d');
            
            $collectnotif = [];
            // Konversi tanggal ke representasi waktu Unix
            foreach ($produk as $data) {
                $expiredTimestamp = new DateTime($data->tgl_exp);
                $currentTimestamp = new DateTime($nowDate);

                // Hitung selisih antara tanggal saat ini dengan tanggal kedaluwarsa
                $diff = date_diff($currentTimestamp, $expiredTimestamp);

                // Ambil nilai hari
                $days = $diff->days;

                // Periksa apakah tanggal kedaluwarsa telah terlewati
                if ($currentTimestamp > $expiredTimestamp) {
                    $days = -$days; // Tambahkan tanda negatif jika tanggal kedaluwarsa telah terlewati
                }

                if ($days <= 0) {
                    $getNotifExpired = '[PERINGATAN], produk "' . $data->nama . '" telah kadaluwarsa. Segera tangani lebih lanjut!';
                    $collectnotif[] = $getNotifExpired;
                }
            }

        }

        elseif (Auth::guard('karyawan')->check()) {
            $akun_usaha_username = Auth::guard('karyawan')->user()->akun_usaha_username;
            $produk = produk::select('tgl_exp', 'nama')->where('akun_usaha_username',$akun_usaha_username)->get();
            $nowDate = date('Y-m-d');
            
            $collectnotif = [];
            // Konversi tanggal ke representasi waktu Unix
            foreach ($produk as $data) {
                $expiredTimestamp = new DateTime($data->tgl_exp);
                $currentTimestamp = new DateTime($nowDate);

                // Hitung selisih antara tanggal saat ini dengan tanggal kedaluwarsa
                $diff = date_diff($currentTimestamp, $expiredTimestamp);

                // Ambil nilai hari
                $days = $diff->days;

                // Periksa apakah tanggal kedaluwarsa telah terlewati
                if ($currentTimestamp > $expiredTimestamp) {
                    $days = -$days; // Tambahkan tanda negatif jika tanggal kedaluwarsa telah terlewati
                }

                if ($days <= 0) {
                    $getNotifExpired = 'Peringatan, produk ' . $data->nama . ' telah kadaluwarsa. Segera tangani lebih lanjut!';
                    $collectnotif[] = $getNotifExpired;
                }
            }
        }
        
        return view('layouts.dashboard')->with('collectnotif', $collectnotif);
    }
}

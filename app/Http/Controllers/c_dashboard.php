<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\produk;
use App\Models\pendapatan;
use App\Models\pengeluaran;
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
        

        if (Auth::guard('web')->check()){
            $pendapatan = pendapatan::where('akun_usaha_username', Auth::guard('web')->user()->username)->get();
            $jumlahPendapatan = 0;
            foreach ($pendapatan as $row) {
                $harga = produk::where('produk_id', $row->jenis_produk)->value('harga');
                $jumlahPendapatan += $harga * $row->jumlah_produk;
            }

            $pengeluaran = pengeluaran::where('akun_usaha_username', Auth::guard('web')->user()->username)->get();
            $jumlahPengeluaran = 0;
            foreach ($pengeluaran as $row) {
                $jumlahPengeluaran += $row->nominal;
            }

            $produk = produk::where('akun_usaha_username', Auth::guard('web')->user()->username)->get();
            $data = [
        
                'label' => [],
                'data' => []
            ];
            foreach ($produk as $dataProd => $items) {
                $data['label'][] = $items->nama;
                $data['data'][] = $items->stok;
            }
            $dataGrafik = json_encode($data);


            return view('layouts.dashboard')->with([
                'dataGrafik' => $dataGrafik,
                'collectnotif', $collectnotif,
                'pendapatan' => $pendapatan, 
                'jumlahPendapatan' => $jumlahPendapatan,
                'jumlahPengeluaran' => $jumlahPengeluaran
            ]);
        }
        elseif (Auth::guard('karyawan')->check()){
            $username_usaha = Auth::guard('karyawan')->user()->akun_usaha_username;
            $pendapatan = pendapatan::where('akun_usaha_username', $username_usaha)->get();
            $jumlahPendapatan = 0;
            foreach ($pendapatan as $row) {
                $harga = produk::where('produk_id', $row->jenis_produk)->value('harga');
                $jumlahPendapatan += $harga * $row->jumlah_produk;
            }

            $username_usaha = Auth::guard('karyawan')->user()->akun_usaha_username;
            $pengeluaran = pengeluaran::where('akun_usaha_username', $username_usaha)->get();
            $jumlahPengeluaran = 0;
            foreach ($pengeluaran as $row) {
                $jumlahPengeluaran += $row->nominal;
            }

            $username_usaha = Auth::guard('karyawan')->user()->akun_usaha_username;
            $produk = produk::where('akun_usaha_username', $username_usaha)->get();
            $data = [
        
                'label' => [],
                'data' => []
            ];
            foreach ($produk as $dataProd => $items) {
                $data['label'][] = $items->nama;
                $data['data'][] = $items->stok;
            }
            $dataGrafik = json_encode($data);

            return view('layouts.dashboard')->with([
                'dataGrafik' => $dataGrafik,
                'collectnotif', $collectnotif,
                'pendapatan' => $pendapatan,
                'jumlahPendapatan' => $jumlahPendapatan,
                'jumlahPengeluaran' => $jumlahPengeluaran
            ]);
        }
        // return view('layouts.dashboard')->with('collectnotif', $collectnotif);
    }
}

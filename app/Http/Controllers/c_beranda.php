<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\usaha;
use App\Models\produk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class c_beranda extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
                    $getNotifExpired = '[PERINGATAN] Produk "' . $data->nama . '" telah kadaluwarsa. Segera tangani lebih lanjut!';
                    $collectnotif[] = $getNotifExpired;
                }


            }

            //Check Status
            // $currentTimestamp = new DateTime($nowDate);
            if (Auth::guard('web')->user()->tanggal_status < $nowDate) {
                User::where("username", Auth::guard('web')->user()->username)
                ->update(['status' => 'sts1']);
            }
            // dd($currentTimestamp);
            return view('beranda.beranda')->with('collectnotif', $collectnotif);
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
            return view('beranda.beranda')->with('collectnotif', $collectnotif);
        }
        
        return view('beranda.beranda');
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'nomor' => 'required|integer'
        ]);
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.fonnte.com/send',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array(
        'target' => '6281216532315',
        'message' => "Punten! Ada pesan baru dari User OPERATS~\nPengirim: $request->nama\nNomor: +62 $request->nomor\nSubjek: $request->subjek\nPesan: $request->pesan",
        ),
        CURLOPT_HTTPHEADER => array(
            'Authorization: #ZPXy1+!JyabXms8uCqn'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return back()->with('message', 'Pengaduan berhasil dikirim!');
    }

    protected function index_2(){
        $isPrice = 1;
        return view('beranda.beranda')->with('isPrice',$isPrice);
    }
}

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
        return view('beranda.beranda');
    }

    public function sendMessage(Request $request)
    {
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

}

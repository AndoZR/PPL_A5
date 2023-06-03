<?php

namespace App\Http\Controllers;

use App\Models\pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class c_pembayaran extends Controller
{
    public function index(){
        return 'bayar';
    }

    // get premium
    protected function pricing_premium(){
        // Auth::guard('web')->user()->update([
        //     'status' => 'sts2'
        // ]);

        // give id prd
        $kode_pembayaran = 's';
        $i = 1;
        while ($i >= 0) {
            $pembayaran_id = $kode_pembayaran . $i;

            $pembayaran = pembayaran::where('pembayaran_id', $pembayaran_id)->first();
            if (!$pembayaran) {
                break;
            }
    
            $i++;
        }

        $data = [
            'pembayaran_id'=> $pembayaran_id,
            'timestamp'=> now(),
            'nominal'=> 10000,
            'akun_usaha_username'=> Auth::guard('web')->user()->username,
            'status'=> 'unpaid',
        ];

        pembayaran::create($data);
        
        $dataVerif = [
            'nomor'=> Auth::guard('web')->user()->nomor_handphone,
            'nama_usaha'=> Auth::guard('web')->user()->nama_usaha,
            'email'=> Auth::guard('web')->user()->email,
            'nominal' => 10000,
        ];

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $pembayaran_id,
                'gross_amount' => $data['nominal'],
            ),
            'customer_details' => array(
                'name' => Auth::guard('web')->user()->nama_usaha,
                'phone' => Auth::guard('web')->user()->nomor_handphone,
                'email' => Auth::guard('web')->user()->email,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return view('beranda.pembayaran')->with([
            'snapToken'=>$snapToken,
            'dataVerif'=>$dataVerif,
        ]);
    }

    public function callback(Request $request){
        $serverKey = config('midtrans.server_key');
        $hashed = hash('sha512', $request->order_id.$request->status_code.$request->gross_amount.$serverKey);
        if($hashed == $request->signature_key){
            if($request->transaction_status == 'capture'){
                // $order = pembayaran::find($request->order_id);
                // $order->update(['status' => 'paid']);
                pembayaran::where('pembayaran_id', $request->order_id)->update(['status' => 'paid']);
            }
        }
    }

    public function invoice($id) {
        $order = pembayaran::find($id);
        return view('beranda.invoice',compact('order'));
    }

    protected function pricing_premiumPro(){
        Auth::guard('web')->user()->update([
            'status' => 'sts3'
        ]);
        return redirect()->route('beranda');
    }
}
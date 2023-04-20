<?php

namespace App\Http\Controllers;

use App\Models\pendapatan;
use App\Models\produk;
use Illuminate\Http\Request;

class c_ramalan extends Controller
{

    public $produk;

    public function getProduk()
    {
        // $produk = produk::orderByRaw('MONTH(created_at) ASC')->get();

        // foreach($produk as $item){
        //     $data['label'][] = date('M', strtotime($item->created_at));
        //     $data['data'][] = (int) $item->stok;
        // }
        // // dd($data);
        // $this->produk = json_encode($data);
        // // dd($this->produk);
        // return view('ramalan.ramalan', ['produk' => $this->produk]);

        $produk = produk::orderByRaw('MONTH(created_at) ASC')->get();
        $grouped = $produk->groupBy(function ($item) {
            return date('M', strtotime($item->created_at));
        });
    
        $data = [
            'label' => [],
            'data' => []
        ];
    
        foreach ($grouped as $bulan => $items) {
            $data['label'][] = $bulan;
            $data['data'][] = $items->sum('stok');
        }
    
        $this->produk = json_encode($data);
        return view('ramalan.ramalan', ['produk' => $this->produk]);
    }

    public function Predict()
    {
        // Data Time Series
        $data = array(10, 12, 14, 16, 18, 20, 22, 24, 26, 28);

        // Konstanta Alpha
        $alpha = 0.2;
 
        // Hitung Smoothing Level
        $smoothing_level = array();
        $smoothing_level[0] = $data[0];
        for ($i = 1; $i < count($data); $i++) {
            $smoothing_level[$i] = $alpha * $data[$i] + (1 - $alpha) * $smoothing_level[$i-1];
        }

        // Hitung Prediksi
        $prediksi = array();
        $prediksi[0] = $data[0];
        for ($i = 1; $i < count($data); $i++) {
        //    $prediksi[$i] = $alpha * $data[$i] + (1 - $alpha) * $prediksi[$i-1];
            $prediksi[$i] = $prediksi[$i-1] + $alpha*($data[$i] - $prediksi[$i-1]);
        }

        // Output Hasil
        echo "Data Time Series: " . implode(", ", $data) . "\n";
        echo "Konstanta Alpha: " . $alpha . "\n";
        echo "Smoothing Level: " . implode(", ", $smoothing_level) . "\n";
        echo "Prediksi: " . implode(", ", $prediksi) . "\n";
    }

}

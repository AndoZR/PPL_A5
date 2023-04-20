<?php

namespace App\Http\Controllers;

use App\Models\pendapatan;
use App\Models\produk;
use Illuminate\Http\Request;

class c_ramalan extends Controller
{

    private $produk;
    private $dataAktual;
    private $dataPrediksi;

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
        $dataPrediksi = session('dataPrediksi');
        $this->dataAktual = $data['data'];
        $this->produk = json_encode($data);
        // dd($this->produk);
        return view('ramalan.ramalan', ['produk' => $this->produk]);
    }

    public function Predict(Request $request)
    {
        // Data Time Series
        // $data = array(10, 12, 14, 16, 18, 20, 22, 24, 26, 28);
        $this->getProduk();
        $dataAktual = $this->dataAktual;

        // Konstanta Alpha
        $alpha = $request->alpha;
        
        //permintaan buat prediksi ASEK
        $permintaanPredik = $request->permintaanPredik;
        
        // Hitung Prediksi
        $prediksi = array();
        $prediksi[0] = $dataAktual[0];
        
        for ($i = 1; $i < count($dataAktual) + $permintaanPredik-1; $i++) {
            if ($i < count($dataAktual)) {
                $prediksi[$i] = $prediksi[$i - 1] + $alpha * ($dataAktual[$i] - $prediksi[$i - 1]);
            } else {
                $prediksi[$i] = $prediksi[$i - 1] + $alpha * ($prediksi[$i - 1] - $prediksi[$i - 2]);
            }
        }

        
        // Output Hasil
        // echo "Data Time Series: " . implode(", ", $dataAktual) . "\n";
        // echo "Konstanta Alpha: " . $alpha . "\n";
        // echo "Prediksi: " . implode(", ", $prediksi) . "\n";

        $lastData = array_slice($prediksi, -($permintaanPredik), $permintaanPredik);
        // echo "Hasil Prediksi 2 trakhir: " . implode(", ", $lastData) . "\n";
        $data = [
            'label' => [],
            'data' => []
        ];

        foreach ($lastData as $items) {
            $data['label'][] = 'nextMonth';
            $data['data'][] = $items;
        }

        $this->dataPrediksi = json_encode($data);
        
        return view('ramalan.ramalan')->with([
            'produk' => $this->produk,
            'dataPrediksi' => $this->dataPrediksi,
        ]);
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\produk;
use App\Models\pendapatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class c_ramalan extends Controller
{

    private $dataGrafik;
    private $dataAktual;
    private $dataPrediksi;

    public function getPendapatanStok()
    {
        if (Auth::guard('web')->check())
        {
            $pendapatan = pendapatan::orderByRaw('MONTH(tanggal) ASC')->where('akun_usaha_username', Auth::guard('web')->user()->username)->get();
            $grouped = $pendapatan->groupBy(function ($item) {
                return date('M', strtotime($item->tanggal));
            });            
        }
        elseif (Auth::guard('karyawan')->check())
        {
            $username_usaha = Auth::guard('karyawan')->user()->akun_usaha_username;
            $pendapatan = pendapatan::orderByRaw('MONTH(tanggal) ASC')->where('akun_usaha_username', $username_usaha)->get();
            $grouped = $pendapatan->groupBy(function ($item) {
                return date('M', strtotime($item->tanggal));
            });
        }
        // dd($grouped);
        $data = [
        
            'label' => [],
            'data' => []
        ];
    
        foreach ($grouped as $bulan => $items) {
            $data['label'][] = $bulan;
            $data['data'][] = $items->sum('jumlah_produk');
        }
        
        $this->dataAktual = $data['data'];
        $this->dataGrafik = json_encode($data);
        // dd($this->dataGrafik);
        return view('ramalan.ramalan', ['dataGrafik' => $this->dataGrafik]);
    }

    public function Predict(Request $request)
    {
        // ------------------- KALKULASI PREDIKSI -----------------

        // Data Time Series
        // $dataAktual = array(10, 12, 14, 16, 18, 20, 22, 24, 26, 28);
        $this->getPendapatanStok();
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

        // ---------------- KALKULASI ERROR MAPE ---------------
        function mape($actual, $predicted) {
            $sum = 0;
            $n = count($actual);
            for ($i = 0; $i < $n; $i++) {
              if ($actual[$i] != 0) {
                $sum += abs(($actual[$i] - $predicted[$i]) / $actual[$i]);
              }
            }
            $mape = ($sum / $n) * 100;
            return $mape;
          }
        $mape = round(mape($dataAktual, $prediksi)) . '%';

        
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
            'dataGrafik' => $this->dataGrafik,
            'dataPrediksi' => $this->dataPrediksi,
            'mape' => $mape,
        ]);
    }

}

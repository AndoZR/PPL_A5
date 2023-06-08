<?php

namespace App\Http\Controllers;

use App\Models\produk;
use App\Models\pendapatan;
use App\Models\pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class c_keuangan extends Controller
{
    protected function index() {
        return view('keuangan.keuangan');
    }

    protected function calculate(Request $request) {
        $checkboxValues = $request->only(['januari', 'februari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember']);
        $months = [
            'januari' => 1,
            'februari' => 2,
            'maret' => 3,
            'april' => 4,
            'mei' => 5,
            'juni' => 6,
            'juli' => 7,
            'agustus' => 8,
            'september' => 9,
            'oktober' => 10,
            'november' => 11,
            'desember' => 12
        ];        
        $dates = []; // dalam digit
        $dataGrafik = [
            'label' => [],
            'data' => []
        ];
        
        foreach ($checkboxValues as $key => $value) { // key = 'januari' , value = on/null
            if ($value == 'on') {
                $dates[] = $months[$key];
                $dataGrafik['label'][] = $key;
            }
        }


        $jumlahPendapatan = [];
        $jumlahPengeluaran = [];
        if (Auth::guard('web')->check()){
            foreach ($checkboxValues as $key => $value) {
                // get data pendapatan
                $dataPendapatan = pendapatan::select('jenis_produk','jumlah_produk')
                ->where('akun_usaha_username',Auth::guard('web')->user()->username)
                ->whereMonth(DB::raw('tanggal'), $months[$key])
                ->whereYear('tanggal', $request->tahun)
                ->get();

                $jumlahPendapatanPerBulan = 0;
                foreach ($dataPendapatan as $row) {
                    $harga = produk::where('produk_id', $row->jenis_produk)->value('harga');
                    $jumlahPendapatanPerBulan += $harga * $row->jumlah_produk;
                }

                $jumlahPendapatan[] = $jumlahPendapatanPerBulan;
            }

            // get data pengeluaran    

            // SELECT DISTINCT MONTH(pendapatan.tanggal), pengeluaran.nominal, pengeluaran.keterangan
            // FROM pendapatan 
            // LEFT JOIN pengeluaran ON MONTH(pendapatan.tanggal) = MONTH(pengeluaran.tanggal)
            // WHERE pendapatan.akun_usaha_username = 'USR1' 
            //     AND MONTH(pendapatan.tanggal) IN ('5', '3', '4') 
            //     AND YEAR(pendapatan.tanggal) = 2023
            // ORDER BY MONTH(pendapatan.tanggal) ASC;
            foreach ($checkboxValues as $key => $value) {
                $dataPengeluaran = pendapatan::select(DB::raw('DISTINCT MONTH(pendapatan.tanggal) AS bulan, pengeluaran.nominal, pengeluaran.keterangan', 'pendapatan.akun_usaha_username'))
                ->leftJoin('pengeluaran', function ($join) {
                    $join->on(DB::raw('MONTH(pendapatan.tanggal)'), '=', DB::raw('MONTH(pengeluaran.tanggal)'));
                })
                ->where('pengeluaran.akun_usaha_username', Auth::guard('web')->user()->username)
                ->whereMonth(DB::raw('pendapatan.tanggal'), $months[$key])
                ->whereYear('pendapatan.tanggal', $request->tahun)
                ->get();

                $jumlahPengeluaranPerBulan = 0;
                foreach ($dataPengeluaran as $row) {
                    $jumlahPengeluaranPerBulan += $row->nominal;
                }

                $jumlahPengeluaran[] = $jumlahPengeluaranPerBulan;
            }

            // kalkulasi pendapatan dan pengeluaran
            for ($i = 0; $i < count($jumlahPendapatan); $i++) {
                if (empty($jumlahPendapatan[$i]) && empty($jumlahPengeluaran[$i])) {
                    $dataGrafik['data'][] = 0;
                } else {
                    $dataGrafik['data'][] = $jumlahPendapatan[$i] - $jumlahPengeluaran[$i];
                }
            }
        }

        elseif (Auth::guard('karyawan')->check()){
            $username_usaha = Auth::guard('karyawan')->user()->akun_usaha_username;
            foreach ($checkboxValues as $key => $value) {
                // get data pendapatan
                $dataPendapatan = pendapatan::select('jenis_produk','jumlah_produk')
                ->where('akun_usaha_username',$username_usaha)
                ->whereMonth(DB::raw('tanggal'), $months[$key])
                ->whereYear('tanggal', $request->tahun)
                ->get();

                $jumlahPendapatanPerBulan = 0;
                foreach ($dataPendapatan as $row) {
                    $harga = produk::where('produk_id', $row->jenis_produk)->value('harga');
                    $jumlahPendapatanPerBulan += $harga * $row->jumlah_produk;
                }

                $jumlahPendapatan[] = $jumlahPendapatanPerBulan;
            }

            // get data pengeluaran    

            // SELECT DISTINCT MONTH(pendapatan.tanggal), pengeluaran.nominal, pengeluaran.keterangan
            // FROM pendapatan 
            // LEFT JOIN pengeluaran ON MONTH(pendapatan.tanggal) = MONTH(pengeluaran.tanggal)
            // WHERE pendapatan.akun_usaha_username = 'USR1' 
            //     AND MONTH(pendapatan.tanggal) IN ('5', '3', '4') 
            //     AND YEAR(pendapatan.tanggal) = 2023
            // ORDER BY MONTH(pendapatan.tanggal) ASC;
            foreach ($checkboxValues as $key => $value) {
                $dataPengeluaran = pendapatan::select(DB::raw('DISTINCT MONTH(pendapatan.tanggal) AS bulan, pengeluaran.nominal, pengeluaran.keterangan'))
                ->leftJoin('pengeluaran', function ($join) {
                    $join->on(DB::raw('MONTH(pendapatan.tanggal)'), '=', DB::raw('MONTH(pengeluaran.tanggal)'));
                })
                ->where('pengeluaran.akun_usaha_username', $username_usaha)
                ->whereMonth(DB::raw('pendapatan.tanggal'), $months[$key])
                ->whereYear('pendapatan.tanggal', $request->tahun)
                ->get();

                $jumlahPengeluaranPerBulan = 0;
                foreach ($dataPengeluaran as $row) {
                    $jumlahPengeluaranPerBulan += $row->nominal;
                }

                $jumlahPengeluaran[] = $jumlahPengeluaranPerBulan;
            }

            // kalkulasi pendapatan dan pengeluaran
            for ($i = 0; $i < count($jumlahPendapatan); $i++) {
                if (empty($jumlahPendapatan[$i]) && empty($jumlahPengeluaran[$i])) {
                    $dataGrafik['data'][] = 0;
                } else {
                    $dataGrafik['data'][] = $jumlahPendapatan[$i] - $jumlahPengeluaran[$i];
                }
            }
        }

        // dd($dataPengeluaran);
        return view('keuangan.keuangan')->with([
            'dataGrafik' => json_encode($dataGrafik)
        ]);
    }
}

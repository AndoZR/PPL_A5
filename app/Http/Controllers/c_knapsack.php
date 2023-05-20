<?php

namespace App\Http\Controllers;

use App\Models\knapsack;
use App\Models\User;
use App\Models\produk;
use App\Models\pendapatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class c_knapsack extends Controller
{

    private $data_knapsack; 

    public function index_knapsack ()
    {
        return view('knapsack.knapsack');
    }

    public function index_data ()
    {
        // $table = pendapatan::select('produk.nama', DB::raw('SUM(pendapatan.jumlah_produk) as permintaan'), 'produk.harga', 'knapsack.knapsack_id', 'knapsack.stok_baru')
        // ->join('produk', 'pendapatan.jenis_produk', '=', 'produk.produk_id')
        // ->join('knapsack', 'pendapatan.jenis_produk', '=', 'knapsack.produk_id')
        // ->where('pendapatan.akun_usaha_username', Auth::guard('web')->user()->username)
        // ->whereRaw('pendapatan.tanggal >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)')
        // ->groupBy('pendapatan.jenis_produk','produk.nama','produk.harga','knapsack.stok_baru', 'knapsack.knapsack_id')
        // ->get();
        
        $table = knapsack::query()->from('knapsack AS k')
        ->leftJoin(DB::raw('(SELECT pp.jenis_produk, SUM(pp.jumlah_produk) as jumlah_produk
                            FROM pendapatan pp
                            WHERE pp.akun_usaha_username = "USR1" AND pp.tanggal >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)
                            GROUP BY pp.jenis_produk) AS p'), 'k.produk_id', '=', 'p.jenis_produk')
        ->leftJoin('produk AS pr', 'k.produk_id', '=', 'pr.produk_id')
        ->select('p.jenis_produk', DB::raw('SUM(p.jumlah_produk) as permintaan'), 'pr.harga', 'k.stok_baru', 'k.knapsack_id', 'pr.nama')
        ->groupBy('k.produk_id', 'p.jenis_produk', 'pr.harga', 'k.stok_baru', 'pr.nama', 'k.knapsack_id')
        ->get();
    
        $this->data_knapsack = $table;

        return view('knapsack.dataKnapsack', ['table' => $table]);
    }

    public function tambahKnapsack()
    {
        if (Auth::guard('web')->check()){
            $data_knapsack = pendapatan::where('akun_usaha_username', Auth::guard('web')->user()->username)->get();
            $jenis_produk = produk::where('akun_usaha_username', Auth::guard('web')->user()->username)->get();  
            return view('knapsack.tambahKnapsack', ['jenis_produk' => $jenis_produk, 'data_knapsack' => $data_knapsack]);
        }
        elseif (Auth::guard('karyawan')->check()){
            $username_usaha = Auth::guard('karyawan')->user()->akun_usaha_username;
            $jenis_produk_ftPendapatan = pendapatan::where('akun_usaha_username', $username_usaha)
            ->groupby('jenis_produk')
            ->get('jenis_produk');
            return view('knapsack.tambahKnapsack')->with('jenis_produk_ftPendapatan',$jenis_produk_ftPendapatan);
        }
    }

    public function simpan(Request $request)
    {
        $request->validate([
            'stok_baru' => 'required|integer', 
            'jenis_produk' => 'required', 
            ],
        );

        // give id prd
        $kode_knapsack = 'KNPSCK';
        $i = 1;
        while ($i >= 0) {
            $knapsack_id = $kode_knapsack . $i;

            $knapsack = knapsack::where('knapsack_id', $knapsack_id)->first();
            if (!$knapsack) {
                break;
            }
    
            $i++;
        }

        if (Auth::guard('web')->check()){
            $data = [
                'knapsack_id' => $knapsack_id,
                'stok_baru' => $request->stok_baru, 
                'produk_id' => $request->jenis_produk, 
                'akun_usaha_username' => Auth::guard('web')->user()->username,
            ];
        }
        
        knapsack::create($data);
        return redirect()->route('dataKnapsack')->with('message', 'Data berhasil disimpan!');
    }

    public function edit($knapsack_id)
    {
        if (Auth::guard('web')->check()){
            $knapsack = knapsack::where('knapsack_id',$knapsack_id)->first();
            $produk_ftKnapsack = produk::where('produk_id', $knapsack->produk_id)->first();
            $jenis_produk = produk::where('akun_usaha_username', Auth::guard('web')->user()->username)->get();
            return view('knapsack.tambahKnapsack', ['knapsack'=>$knapsack,'jenis_produk'=>$jenis_produk, 'produk_ftKnapsack'=>$produk_ftKnapsack]);
        }
    }

    public function update($knapsack_id, Request $request)
    {
        $request->validate([
            'stok_baru' => 'required|integer', 
            'jenis_produk' => 'required', 
            ],
        );
        $data = [
            'knapsack_id' => $knapsack_id,
            'stok_baru' => $request->stok_baru, 
            'produk_id' => $request->jenis_produk, 
            'akun_usaha_username' => Auth::guard('web')->user()->username,
        ];

        knapsack::where('knapsack_id', $knapsack_id)->update($data);
        return redirect()->route('dataKnapsack')->with('message', 'Data berhasil diubah!');
    }

    public function hapus($knapsack_id)
    {
        knapsack::where('knapsack_id', $knapsack_id)->delete();
        return redirect()->route('dataKnapsack');
    }



    protected function process_knapsack(Request $request)
    {

        $this->index_data();
        $data_knapsack = $this->data_knapsack;
        
        function knapsackGreedy($items, $capacity) {

            // Menghitung pendapatan untuk setiap item
            foreach ($items as $key => $item) {
                $items[$key]['pendapatan'] = $item['harga'] * $item['stok_lama'];
            }
            
                // Mengurutkan item berdasarkan pendapatan secara menurun
            array_multisort(array_column($items, 'pendapatan'), SORT_DESC, $items);
            
                $totalPendapatan = 0;
                $selectedItems = [];
                
            // echo "Sorted Items:\n";
            // foreach ($items as $item) {
            //     echo "stok_lama: {$item['stok_lama']}, pendpatan: {$item['pendapatan']}";
            // }
            
                // Memasukkan item ke dalam ransel selama masih ada kapasitas tersedia
                foreach ($items as $item) {
                    if ($capacity >= $item['stok_baru']) {
                        $selectedItems[] = $item;
                        $totalPendapatan += $item['pendapatan'];
                        $capacity -= $item['stok_baru'];
                    }
                }
            
                return [
                    'selectedItems' => $selectedItems,
                    'totalPendapatan' => $totalPendapatan,
                ];
            }
            
            // Contoh penggunaan
            // $items = [
            //     ['stok_lama' => 20, 'stok_baru' => 30, 'harga' => 10000],
            //     ['stok_lama' => 10, 'stok_baru' => 50, 'harga' => 20000],
            //     ['stok_lama' => 30, 'stok_baru' => 10, 'harga' => 1000],
            //     ['stok_lama' => 15, 'stok_baru' => 20, 'harga' => 5000],
            //     ['stok_lama' => 5, 'stok_baru' => 20, 'harga' => 25000],
            // ];

            $items = [];

            foreach ($data_knapsack as $data) {
                $items[] = ['nama' => $data['nama'],'stok_lama' => $data['permintaan'], 'stok_baru' => $data['stok_baru'], 'harga' => $data['harga']];
            }
            
            $capacity = $request->kapasitas;
            
            $result = knapsackGreedy($items, $capacity);

            // echo "Selected Items:\n";
            // foreach ($result['selectedItems'] as $item) {
            //     echo "stok_lama: {$item['stok_lama']}, harga: {$item['harga']}\n";
            // }
            // echo "Total pendapatan: {$result['totalPendapatan']}\n";
            return view('knapsack.knapsack')->with(['result' => $result, 'kapasitas' => $capacity]);
    }
}

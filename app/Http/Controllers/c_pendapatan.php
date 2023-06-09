<?php

namespace App\Http\Controllers;

use App\Models\pendapatan;
use App\Models\produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class c_pendapatan extends Controller
{
    public function index()
    {
        if (Auth::guard('web')->check()){
            $pendapatan = pendapatan::where('akun_usaha_username', Auth::guard('web')->user()->username)->get();
            $jumlahPendapatan = 0;
            foreach ($pendapatan as $row) {
                $harga = produk::where('produk_id', $row->jenis_produk)->value('harga');
                $jumlahPendapatan += $harga * $row->jumlah_produk;
            }
            return view('pendapatan.pendapatan', ['pendapatan' => $pendapatan, 'jumlahPendapatan' => $jumlahPendapatan]);
        }
        elseif (Auth::guard('karyawan')->check()){
            $username_usaha = Auth::guard('karyawan')->user()->akun_usaha_username;
            $pendapatan = pendapatan::where('akun_usaha_username', $username_usaha)->get();
            $jumlahPendapatan = 0;
            foreach ($pendapatan as $row) {
                $harga = produk::where('produk_id', $row->jenis_produk)->value('harga');
                $jumlahPendapatan += $harga * $row->jumlah_produk;
            }
            return view('pendapatan.pendapatan', ['pendapatan' => $pendapatan, 'jumlahPendapatan' => $jumlahPendapatan]);
        }
    }

    public function tambah()
    {
        if (Auth::guard('web')->check()){
            $jenis_produk = produk::where('akun_usaha_username', Auth::guard('web')->user()->username)->get();
            return view('pendapatan.tambahPendapatan')->with('jenis_produk',$jenis_produk);
        }
        elseif (Auth::guard('karyawan')->check()){
            $username_usaha = Auth::guard('karyawan')->user()->akun_usaha_username;
            $jenis_produk = produk::where('akun_usaha_username', $username_usaha)->get();
            return view('pendapatan.tambahPendapatan')->with('jenis_produk',$jenis_produk);
        }
    }

    public function simpan(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date_format:Y-m-d', 
            'jenis_produk' => 'required', 
            'jumlah_produk' => 'required|integer||digits_between:1,11',
            'keterangan' => 'max:100'
        ],
        // [
        //     'tanggal.required'=>'tanggal wajib diisi',
        //     'tanggal.date_format:Y-m-d'=>'tanggal wajib berformat tanggal',
        //     'keterangan.required'=>'keterangan wajib diisi',
        //     'jumlah_produk.required'=>'jumlah produk wajib diisi',
        //     'jumlah_produk.integer'=>'jumlah produk hanya berisikan angka',
        // ]
    );

        // give id prd
        $kode_pendapatan = 'PDPTN';
        $i = 1;
        while ($i >= 0) {
            $pendapatan_id = $kode_pendapatan . $i;

            $pendapatan = pendapatan::where('pendapatan_id', $pendapatan_id)->first();
            if (!$pendapatan) {
                break;
            }
    
            $i++;
        }

        if (Auth::guard('web')->check()){
            $data = [
                'pendapatan_id' => $pendapatan_id,
                'tanggal' => $request->tanggal, 
                'keterangan' => $request->keterangan, 
                'jenis_produk' => $request->jenis_produk, 
                'jumlah_produk' => $request->jumlah_produk, 
                'akun_usaha_username' => Auth::guard('web')->user()->username,
            ];

            $totalRows = pendapatan::where('akun_usaha_username', Auth::guard('web')->user()->username)->count();
            if ($totalRows >= 100) {
                return redirect()->route('produk')->with('messageMaksData', 'Data telah mencapai batas maksimal (50 data). Harap berlangganan akun premium!');
            }
        }
        elseif (Auth::guard('karyawan')->check()){
            $username_usaha = Auth::guard('karyawan')->user()->akun_usaha_username;
            $data = [
                'pendapatan_id' => $pendapatan_id,
                'tanggal' => $request->tanggal, 
                'keterangan' => $request->keterangan, 
                'jenis_produk' => $request->jenis_produk, 
                'jumlah_produk' => $request->jumlah_produk, 
                'akun_usaha_username' => $username_usaha,
                'akun_karyawan_username' => Auth::guard('karyawan')->user()->username,
            ];

            $username = Auth::guard('karyawan')->user()->akun_usaha_username;
            $totalRows = produk::where('akun_usaha_username', $username)->count();
            if ($totalRows >= 100) {
                return redirect()->route('produk')->with('messageMaksData', 'Data telah mencapai batas maksimal (50 data). Harap berlangganan akun premium!');
            }
        }

        // kalulasi stok
        produk::where('produk_id', $request->jenis_produk)
            ->decrement('stok', $request->jumlah_produk);

        // cari harga produk
        
        pendapatan::create($data);
        return redirect()->route('pendapatan')->with('message', 'Data berhasil disimpan!');
    }

    public function edit($pendapatan_id)
    {
        if (Auth::guard('web')->check()){
            $jenis_produk = produk::where('akun_usaha_username', Auth::guard('web')->user()->username)->get();
            $dataPendapatan = pendapatan::where('pendapatan_id', $pendapatan_id)->firstOrFail();
            $produk_ftPendapatan = produk::where('produk_id', $dataPendapatan->jenis_produk)->first();
            return view('pendapatan.tambahPendapatan', ['pendapatan'=>$dataPendapatan,'jenis_produk'=>$jenis_produk, 'produk_ftPendapatan'=>$produk_ftPendapatan]);
        }
        elseif (Auth::guard('karyawan')->check()){
            $username_usaha = Auth::guard('karyawan')->user()->akun_usaha_username;
            $jenis_produk = produk::where('akun_usaha_username', $username_usaha)->get();
            $dataPendapatan = pendapatan::where('pendapatan_id', $pendapatan_id)->firstOrFail();
            return view('pendapatan.tambahPendapatan', ['pendapatan'=>$dataPendapatan,'jenis_produk'=>$jenis_produk]);
        }
    }
    
    public function update($pendapatan_id, Request $request)
    {
        // Validate
        $request->validate([
            'tanggal' => 'required|date_format:Y-m-d', 
            'jenis_produk' => 'required', 
            'jumlah_produk' => 'required|integer|digits_between:1,11', 
        ],[
            'tanggal.required'=>'tanggal wajib diisi',
            'tanggal.date_format:Y-m-d'=>'tanggal wajib berformat tanggal',
            'jumlah_produk.required'=>'jumlah produk wajib diisi',
            'jumlah_produk.integer'=>'jumlah produk hanya berisikan angka',
        ]);

        // kalo misal opsi produk dirubah, maka perkondisian if opsi permintaan tidak sama dengan yang asli dstr

        // perkondisian edit untuk kalkulasi stok
        $stokTerjual = pendapatan::where('pendapatan_id', $pendapatan_id)->value('jumlah_produk');
        if ($request->jumlah_produk < $stokTerjual) {
            $new_jumlah_stok = $stokTerjual - $request->jumlah_produk;
            produk::where('produk_id', $request->jenis_produk)
            ->increment('stok', $new_jumlah_stok);
        }
        elseif ($request->jumlah_produk > $stokTerjual) {
            $new_jumlah_stok = $request->jumlah_produk - $stokTerjual;
            produk::where('produk_id', $request->jenis_produk)
            ->decrement('stok', $new_jumlah_stok);
        }

        if (Auth::guard('web')->check()){
            $data = [
                'pendapatan_id' => $pendapatan_id,
                'tanggal' => $request->tanggal, 
                'keterangan' => $request->keterangan, 
                'jenis_produk' => $request->jenis_produk, 
                'jumlah_produk' => $request->jumlah_produk, 
                'akun_usaha_username' => Auth::guard('web')->user()->username,
            ];
        }
        elseif (Auth::guard('karyawan')->check()){
            $username_usaha = Auth::guard('karyawan')->user()->akun_usaha_username;
            $data = [
                'pendapatan_id' => $pendapatan_id,
                'tanggal' => $request->tanggal, 
                'keterangan' => $request->keterangan, 
                'jenis_produk' => $request->jenis_produk, 
                'jumlah_produk' => $request->jumlah_produk, 
                'akun_usaha_username' => $username_usaha,
                'akun_karyawan_username' => Auth::guard('karyawan')->user()->username,
            ];
        }

        pendapatan::where('pendapatan_id', $pendapatan_id)->update($data);
        return redirect()->route('pendapatan')->with('message', 'Data berhasil disimpan!');
    }

    public function hapus($pendapatan_id)
    {
        $produk_id = pendapatan::where('pendapatan_id', $pendapatan_id)
            ->value('jenis_produk');
        $jumlah_produk = pendapatan::where('pendapatan_id', $pendapatan_id)
            ->value('jumlah_produk');

        // kalulasi stok nambah/mengembalikan nilai
        produk::where('produk_id', $produk_id)
        ->increment('stok', $jumlah_produk);

        pendapatan::where('pendapatan_id', $pendapatan_id)->delete();
        return redirect()->route('pendapatan')->with('message','Data berhasil dihapus');
    }

    public function dateFilter(Request $request)
    {
        $fromDate = $request->fromDate;
        $toDate = $request->toDate;

        $pendapatanDariTanggal = pendapatan::select()
            ->where('tanggal', '>=', $fromDate)
            ->where('tanggal', '<=', $toDate)
            ->get();
        
            $jumlahPendapatan = 0;
            foreach ($pendapatanDariTanggal as $row) {
                $harga = produk::where('produk_id', $row->jenis_produk)->value('harga');
                $jumlahPendapatan += $harga * $row->jumlah_produk;
            }
            return view('pendapatan.pendapatan', ['pendapatan' => $pendapatanDariTanggal, 'jumlahPendapatan' => $jumlahPendapatan]);
            // return view('pendapatan.pendapatan',compact('pendapatanDariTanggal'));
    }

}

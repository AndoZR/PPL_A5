<?php

namespace App\Http\Controllers;

use App\Models\pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class c_pengeluaran extends Controller
{
    public function index()
    {
        if (Auth::guard('web')->check()){
            $pengeluaran = pengeluaran::where('akun_usaha_username', Auth::guard('web')->user()->username)->get();
            $jumlahPengeluaran = 0;
            foreach ($pengeluaran as $row) {
                $jumlahPengeluaran += $row->nominal;
            }
            return view('pengeluaran.pengeluaran', ['pengeluaran' => $pengeluaran, 'jumlahPengeluaran' => $jumlahPengeluaran]);
        }
        elseif (Auth::guard('karyawan')->check()){
            $username_usaha = Auth::guard('karyawan')->user()->akun_usaha_username;
            $pengeluaran = pengeluaran::where('akun_usaha_username', $username_usaha)->get();
            $jumlahPengeluaran = 0;
            foreach ($pengeluaran as $row) {
                $jumlahPengeluaran += $row->nominal;
            }
            return view('pengeluaran.pengeluaran', ['pengeluaran' => $pengeluaran, 'jumlahPengeluaran' => $jumlahPengeluaran]);
        }
    }

    public function tambah()
    {
            return view('pengeluaran.tambahpengeluaran');
    }

    public function simpan(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date_format:Y-m-d', 
            'nominal' => 'required|integer|digits_between:1,11', 
            'keterangan' => 'required|max:100', 
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
        $kode_pengeluaran = 'PNGLRN';
        $i = 1;
        while ($i >= 0) {
            $pengeluaran_id = $kode_pengeluaran . $i;

            $pengeluaran = pengeluaran::where('pengeluaran_id', $pengeluaran_id)->first();
            if (!$pengeluaran) {
                break;
            }
    
            $i++;
        }

        if (Auth::guard('web')->check()){
            $data = [
                'pengeluaran_id' => $pengeluaran_id,
                'tanggal' => $request->tanggal, 
                'nominal' => $request->nominal,
                'keterangan' => $request->keterangan, 
                'akun_usaha_username' => Auth::guard('web')->user()->username,
            ];

            $totalRows = pengeluaran::where('akun_usaha_username', Auth::guard('web')->user()->username)->count();
            if ($totalRows >= 100) {
                return redirect()->route('produk')->with('messageMaksData', 'Data telah mencapai batas maksimal (50 data). Harap berlangganan akun premium!');
            }
        }
        elseif (Auth::guard('karyawan')->check()){
            $username_usaha = Auth::guard('karyawan')->user()->akun_usaha_username;
            $data = [
                'pengeluaran_id' => $pengeluaran_id,
                'tanggal' => $request->tanggal,
                'nominal' => $request->nominal,
                'keterangan' => $request->keterangan,  
                'akun_usaha_username' => $username_usaha,
                'akun_karyawan_username' => Auth::guard('karyawan')->user()->username,
            ];

            $username = Auth::guard('karyawan')->user()->akun_usaha_username;
            $totalRows = pengeluaran::where('akun_usaha_username', $username)->count();
            if ($totalRows >= 100) {
                return redirect()->route('produk')->with('messageMaksData', 'Data telah mencapai batas maksimal (50 data). Harap berlangganan akun premium!');
            }
        }
        
        pengeluaran::create($data);
        return redirect()->route('pengeluaran')->with('message', 'Data berhasil disimpan!');
    }

    public function edit($pengeluaran_id)
    {
        $datapengeluaran = pengeluaran::where('pengeluaran_id', $pengeluaran_id)->firstOrFail();
        return view('pengeluaran.tambahpengeluaran', ['pengeluaran'=>$datapengeluaran]);
    }
    
    public function update($pengeluaran_id, Request $request)
    {
        // Validate
        $request->validate([
            'tanggal' => 'required|date_format:Y-m-d', 
            'nominal' => 'required|digits_between:1,11', 
            'keterangan' => 'required', 
        ],
        // [
        //     'tanggal.required'=>'tanggal wajib diisi',
        //     'tanggal.date_format:Y-m-d'=>'tanggal wajib berformat tanggal',
        //     'jumlah_produk.required'=>'jumlah produk wajib diisi',
        //     'jumlah_produk.integer'=>'jumlah produk hanya berisikan angka',
        // ]
        );

        if (Auth::guard('web')->check()){
            $data = [
                'pengeluaran_id' => $pengeluaran_id,
                'tanggal' => $request->tanggal, 
                'nominal' => $request->nominal,
                'keterangan' => $request->keterangan, 
                'akun_usaha_username' => Auth::guard('web')->user()->username,
            ];
        }
        elseif (Auth::guard('karyawan')->check()){
            $username_usaha = Auth::guard('karyawan')->user()->akun_usaha_username;
            $data = [
                'pengeluaran_id' => $pengeluaran_id,
                'tanggal' => $request->tanggal,
                'nominal' => $request->nominal,
                'keterangan' => $request->keterangan,  
                'akun_usaha_username' => $username_usaha,
                'akun_karyawan_username' => Auth::guard('karyawan')->user()->username,
            ];
        }

        pengeluaran::where('pengeluaran_id', $pengeluaran_id)->update($data);
        return redirect()->route('pengeluaran')->with('message', 'Data berhasil disimpan!');
    }

    public function hapus($pengeluaran_id)
    {
        pengeluaran::where('pengeluaran_id', $pengeluaran_id)->delete();
        return redirect()->route('pengeluaran');
    }

    public function dateFilter(Request $request)
    {
        $fromDate = $request->fromDate;
        $toDate = $request->toDate;

        $pengeluaranDariTanggal = pengeluaran::select()
            ->where('tanggal', '>=', $fromDate)
            ->where('tanggal', '<=', $toDate)
            ->get();
        
        $jumlahPengeluaran = 0;
        foreach ($pengeluaranDariTanggal as $row) {
            $jumlahPengeluaran += $row->nominal;
        }

            return view('pengeluaran.pengeluaran', ['pengeluaran' => $pengeluaranDariTanggal, 'jumlahPengeluaran' => $jumlahPengeluaran]);
    }
}

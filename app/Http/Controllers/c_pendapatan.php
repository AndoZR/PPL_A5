<?php

namespace App\Http\Controllers;

use App\Models\pendapatan;
use Illuminate\Http\Request;

class c_pendapatan extends Controller
{
    public function index()
    {
        $pendapatan = pendapatan::get();
        return view('pendapatan.pendapatan', ['pendapatan' => $pendapatan]);
    }

    public function tambah()
    {
        return view('pendapatan.tambahPendapatan');
    }

    public function simpan(Request $request)
    {
        $request->validate([
            'timestamp' => 'required|date_format:Y-m-d', 
            'nominal' => 'required|integer', 
            'keterangan' => 'required', 
        ],[
            'timestamp.required'=>'timestamp wajib diisi',
            'timestamp.date_format:Y-m-d'=>'timestamp wajib berupa tanggal',
            'nominal.required'=>'nominal wajib diisi',
            'nominal.integer'=>'nominal hanya berisikan angka',
            'keterangan.required'=>'keterangan wajib diisi',
        ]);

        // give id prd
        $kode_pendapatan = 'pdptn';
        $i = 1;
        while ($i >= 0) {
            $pendapatan_id = $kode_pendapatan . $i;

            $pendapatan = pendapatan::where('pendapatan_id', $pendapatan_id)->first();
            if (!$pendapatan) {
                break;
            }
    
            $i++;
        }

        $user = auth()->user()->username;
        // set var
        $data = [
            'pendapatan_id' => $pendapatan_id,
            'timestamp' => $request->timestamp, 
            'nominal' => $request->nominal, 
            'keterangan' => $request->keterangan, 
            'usaha_username' => $user
        ];

        pendapatan::create($data);
        return redirect()->route('pendapatan')->with('message', 'Data berhasil disimpan!');
    }

    public function edit($pendapatan_id)
    {
        $dataPendapatan = pendapatan::where('pendapatan_id', $pendapatan_id)->firstOrFail();
        return view('pendapatan.tambahPendapatan', ['pendapatan'=>$dataPendapatan]);
    }
    
    public function update($pendapatan_id, Request $request)
    {
        // Validate
        $request->validate([
            'timestamp' => 'required|date_format:Y-m-d', 
            'nominal' => 'required|integer', 
            'keterangan' => 'required', 
        ],[
            'timestamp.required'=>'timestamp wajib diisi',
            'timestamp.date_format:Y-m-d'=>'timestamp wajib berupa tanggal',
            'nominal.required'=>'nominal wajib diisi',
            'nominal.integer'=>'nominal hanya berisikan angka',
            'keterangan.required'=>'keterangan wajib diisi',
        ]);

        $user = auth()->user()->username;
        // set var
        $data = [
            'pendapatan_id' => $pendapatan_id,
            'timestamp' => $request->timestamp, 
            'nominal' => $request->nominal, 
            'keterangan' => $request->keterangan, 
            'usaha_username' => $user
        ];

        pendapatan::where('pendapatan_id', $pendapatan_id)->update($data);
        return redirect()->route('pendapatan')->with('message', 'Data berhasil disimpan!');
    }

    public function hapus($pendapatan_id)
    {
        pendapatan::where('pendapatan_id', $pendapatan_id)->delete();
        return redirect()->route('pendapatan');
    }

    public function dateFilter(Request $request)
    {
        $fromDate = $request->fromDate;
        $toDate = $request->toDate;

        $pendapatan = pendapatan::select()
            ->where('timestamp', '>=', $fromDate)
            ->where('timestamp', '<=', $toDate)
            ->get();
        
            return view('pendapatan.pendapatan',compact('pendapatan'));
    }

}

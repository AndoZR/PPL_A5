<?php

namespace App\Http\Controllers;

use App\Models\produk;
use Illuminate\Http\Request;

class c_produk extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produk = produk::get();
        return view('produk.produk', ['produk'=>$produk]);
    }

    public function tambah()
    {
        return view('produk.tambahProduk');
    }

    public function simpan(Request $request)
    {
        // Validate
        $request->validate([
            'nama' => 'required', 
            'stok' => 'required|integer', 
            'harga' => 'required|integer', 
            'tgl_exp' => 'required|date_format:Y-m-d', 
            'deskripsi' => 'required', 
        ],[
            'nama.required'=>'nama wajib diisi',
            'stok.required'=>'stok wajib diisi',
            'stok.integer'=>'stok hanya berisikan angka',
            'harga.required'=>'harga wajib diisi',
            'harga.integer'=>'harga hanya berisikan angka',
            'tgl_exp.required'=>'expired wajib diisi',
            'tgl_exp.date_format'=>'expired harus berformat "tahun-bulan-tanggal"',
            'deskripsi.required'=>'deskripsi wajib diisi',
        ]);

        // give id prd
        $kode_produk = 'PRD';
        $i = 1;
        while ($i >= 0) {
            $produk_id = $kode_produk . $i;

            $produk = produk::where('produk_id', $produk_id)->first();
            if (!$produk) {
                break;
            }
    
            $i++;
        }

        // set var
        $data = [
            'produk_id' => $produk_id,
            'nama'=>$request->nama,
            'stok'=>$request->stok,
            'harga'=>$request->harga,
            'tgl_exp'=>$request->tgl_exp,
            'deskripsi'=>$request->deskripsi
        ];

        produk::create($data);
        return redirect()->route('produk'); // setelah menyimpan produk maka ototmatis diarahkan ke route produk
    }

    public function edit($produk_id)
    {
        $produk_id = produk::where('produk_id', $produk_id)->firstOrFail();
        return view('produk.tambahProduk', ['produk'=>$produk_id]);
    }
    
    public function update($produk_id, Request $request)
    {
        // Validate
        $request->validate([
            'nama' => 'required', 
            'stok' => 'required|integer', 
            'harga' => 'required|integer', 
            'tgl_exp' => 'required|date_format:Y-m-d', 
            'deskripsi' => 'required', 
        ],[
            'nama.required'=>'nama wajib diisi',
            'stok.required'=>'stok wajib diisi',
            'stok.integer'=>'stok hanya berisikan angka',
            'harga.required'=>'harga wajib diisi',
            'harga.integer'=>'harga hanya berisikan angka',
            'tgl_exp.required'=>'expired wajib diisi',
            'tgl_exp.date_format'=>'expired harus berformat "tahun-bulan-tanggal"',
            'deskripsi.required'=>'deskripsi wajib diisi',
        ]);

        $data = [
            'produk_id' => $produk_id,
            'nama'=>$request->nama,
            'stok'=>$request->stok,
            'harga'=>$request->harga,
            'tgl_exp'=>$request->tgl_exp,
            'deskripsi'=>$request->deskripsi
        ];
        produk::where('produk_id', $produk_id)->update($data);
        return redirect()->route('produk');
    }

    public function hapus($produk_id)
    {
        produk::where('produk_id', $produk_id)->delete();
        return redirect()->route('produk');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

@extends('layouts.app')

@section('title', 'Produk')

@section('content')
<form action="{{ isset($produk) ? route('produk.edit.update', $produk->produk_id) : route('produk.tambah.simpan') }}" method="post">
    @csrf
        {{-- @if ($errors->any())
        <div class="pt-1">
            <div class="alert alert-danger alert-dismissible fade show d-flex">
                <button type="button" class="close" data-dismiss='alert' aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <ul class="mb-0">
                    @foreach ($errors->all() as $items)
                    <li>{{ $items }}</li>
                    @endforeach
                </ul>

            </div>
        </div>
         @endif --}}
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ isset($produk)?'Form Edit Produk':'Form Tambah Produk' }}</h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ isset($produk) ? $produk->nama : '' }}">

                        <label for="stok">stok</label>
                        <input type="text" class="form-control" id="stok" name="stok" value="{{ isset($produk) ? $produk->stok : '' }}">

                        <label for="harga">Harga</label>
                        <input type="text" class="form-control" id="harga" name="harga" value="{{ isset($produk) ? $produk->harga : '' }}">

                        <label for="tgl_exp">Expired</label>
                        <input type="date" class="form-control" id="tgl_exp" name="tgl_exp" value="{{ isset($produk) ? $produk->tgl_exp : '' }}">

                        <label for="deskripsi">Deskripsi</label>
                        <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="{{ isset($produk) ? $produk->deskripsi : '' }}">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('produk') }}" class="btn btn-danger">Batal</a>
                </div>
            </div>
        </div>
    </div>
</form>

{{-- define errors produk --}}
@if ($errors->any())
    @foreach ($errors->all() as $error)
        @if (strpos($error, 'required') !== false)
            <script>
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Nama, stok, harga, expired wajib diisi!',
                    showConfirmButton: false,
                    timer: 5000
                })
            </script>
        @else
            <script>
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Data stok/harga/expired yang dimasukkan salah! Mohon masukkan ulang!',
                    showConfirmButton: false,
                    timer: 5000
                })
            </script>
        @endif
    @endforeach
@endif

@endsection
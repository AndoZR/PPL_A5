@extends('layouts.app')

@section('title', 'Knapsack')

@section('content')
<form action="{{ isset($knapsack) ? route('knapsack.edit.update', $knapsack->knapsack_id) : route('knapsack.tambah.simpan') }}" method="post">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ isset($knapsack)?'Form Edit knapsack':'Form Tambah knapsack' }}</h6>
                </div>
                <div class="card-body">
                    <div class="form-group">                        
                        <label for="keterangan">Stok Baru</label>
                        <input type="text" class="form-control" id="stok_baru" name="stok_baru" value="{{ isset($knapsack) ? $knapsack->stok_baru : '' }}">

                        <label class="form-label" for="jenis_produk">Jenis Produk</label>
                        <select class="form-control form-select" name="jenis_produk">
                            <option value="{{ isset($produk_ftKnapsack) ? $produk_ftKnapsack->produk_id : '' }}">{{ isset($produk_ftKnapsack) ? $produk_ftKnapsack->nama : 'Pilih Produk' }}</option>
                                @foreach ($jenis_produk as $item)
                                    @if (isset($produk_ftKnapsack) && $item->nama == $produk_ftKnapsack->nama)
                                        
                                    @else
                                        <option value="{{ $item->produk_id }}">{{ $item->nama }}</option>     
                                    @endif
                                @endforeach
                        </select>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('knapsack') }}" class="btn btn-danger">Batal</a>
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
                    title: 'Mohon mengisi form yang kosong!',
                    showConfirmButton: false,
                    timer: 5000
                })
            </script>
        @else
            <script>
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Tipe data yang dimasukkan salah!',
                    showConfirmButton: false,
                    timer: 5000
                })
            </script>
        @endif
    @endforeach
@endif

@endsection
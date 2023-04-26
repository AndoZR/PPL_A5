@extends('layouts.app')

@section('title', 'Pendapatan')

@section('content')
<form action="{{ isset($pendapatan) ? route('pendapatan.edit.update', $pendapatan->pendapatan_id) : route('pendapatan.tambah.simpan') }}" method="post">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ isset($pendapatan)?'Form Edit Pendapatan':'Form Tambah Pendapatan' }}</h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="timestamp">tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ isset($pendapatan) ? $pendapatan->tanggal : '' }}">
                        
                        <label for="keterangan">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan" name="keterangan" value="{{ isset($pendapatan) ? $pendapatan->keterangan : '' }}">

                        <label class="form-label" for="jenis_produk">Jenis Produk</label>
                        <select class="form-control form-select" name="jenis_produk">
                            <option value="">Pilih Produk</option>
                            @foreach ($jenis_produk as $item)
                            <option value="{{ $item->produk_id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>

                        <label for="jumlah_produk">Jumlah Produk</label>
                        <input type="text" class="form-control" id="jumlah_produk" name="jumlah_produk" value="{{ isset($pendapatan) ? $pendapatan->jumlah_produk : '' }}">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('pendapatan') }}" class="btn btn-danger">Batal</a>
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
                    title: 'Data yang dimasukkan salah! Mohon masukkan ulang!',
                    showConfirmButton: false,
                    timer: 5000
                })
            </script>
        @endif
    @endforeach
@endif

@endsection
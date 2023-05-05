@extends('layouts.app')

@section('title', 'Fitur Pengeluaran')

@section('content')
<form action="{{ isset($pengeluaran) ? route('pengeluaran.edit.update', $pengeluaran->pengeluaran_id) : route('pengeluaran.tambah.simpan') }}" method="post">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ isset($pengeluaran)?'Form Edit pengeluaran':'Form Tambah pengeluaran' }}</h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="timestamp">tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ isset($pengeluaran) ? $pengeluaran->tanggal : '' }}">
                        
                        <label for="nominal">Nominal</label>
                        <input type="text" class="form-control" id="nominal" name="nominal" value="{{ isset($pengeluaran) ? $pengeluaran->nominal : '' }}">

                        <label for="keterangan">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan" name="keterangan" value="{{ isset($pengeluaran) ? $pengeluaran->keterangan : '' }}">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-check"></i>
                        </span>
                        <span class="text">Simpan</span>
                    </button>
                    <a href="{{ route('pengeluaran') }}" class="btn btn-danger btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-exclamation-triangle"></i>
                        </span>
                        <span class="text">Batal</span>
                    </a>
                    {{-- <button type="submit" class="btn btn-primary">Simpan</button> --}}
                    {{-- <a href="{{ route('pengeluaran') }}" class="btn btn-danger">Batal</a> --}}
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
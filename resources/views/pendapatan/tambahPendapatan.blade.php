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
                        <label for="timestamp">Waktu</label>
                        <input type="date" class="form-control" id="timestamp" name="timestamp" value="{{ isset($pendapatan) ? $pendapatan->timestamp : '' }}">

                        <label for="nominal">Nominal</label>
                        <input type="text" class="form-control" id="nominal" name="nominal" value="{{ isset($pendapatan) ? $pendapatan->nominal : '' }}">

                        <label for="keterangan">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan" name="keterangan" value="{{ isset($pendapatan) ? $pendapatan->keterangan : '' }}">
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
@if ($errors->all())
    <script>
        Swal.fire(
        'Whoops',
           `@foreach ($errors->all() as $items)
            <li>{{ $items }}</li>
            @endforeach`,
        'error'
    )
    </script>    
@endif

@endsection
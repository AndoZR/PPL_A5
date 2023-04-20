@extends('layouts.app')

@section('title', 'Pendapatan')

{{-- count total pendapatan --}}
@php($sum = 0)
@foreach ($pendapatan as $row)
    @php($sum += $row->nominal)
@endforeach

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Pendapatan</h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-3">
                <a href="{{ route('pendapatan.tambah') }}" class="btn btn-primary mb-3">Tambahkan Pendapatan</a>
            </div>
            <div class="col-9">
                <h4>Total Pendapatan: Rp {{ $sum }}</h4>
            </div>
            <div class="col-12">
                <form action="{{ route('pendapatan.dateFilter') }}" method="POST">
                    @csrf
                    <div class="container">
                        <div class="row">
                            <div class="container-fluid">
                                <div class="form-group row">
                                    <label for="date" class="col-form-label col-sm-2">Tanggal dari</label>
                                    <div class="col-sm-3">
                                        <input type="date" class="form-control input-sm" id="fromDate" name="fromDate" required>
                                    </div>
                                    <label for="date" class="col-form-label col-sm-2">Tanggal ke</label>
                                    <div class="col-sm-3">
                                        <input type="date" class="form-control input-sm" id="toDate" name="toDate" required>
                                    </div>
                                    <div class="col-sm-2">
                                        <button class="btn" type="submit" name="search" title="Search"><img src="{{ asset('assets/src/search.png') }}" alt=""></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>no</th>
                        <th>Waktu</th>
                        <th>Nominal</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                        {{-- <th>Akun Usaha</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @php($no = 1)
                    @foreach ($pendapatan as $row)
                    <tr>
                        <th>{{ $no++ }}</th>
                        <td>{{ $row->timestamp }}</td>
                        <td>Rp  {{ $row->nominal }}</td>
                        <td style="max-width:200px; height:100px">
                            <div style="height:100%; overflow: auto">
                                {{ $row->keterangan }}
                            </div>
                        </td>
                        <td style="max-width:95px">
                            <a href="{{ route('pendapatan.edit', $row->pendapatan_id) }}" class="btn btn-warning" >Edit</a>
                            <a href="{{ route('pendapatan.hapus', $row->pendapatan_id) }}" class="btn btn-danger" id="sweetDelete">Hapus</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@if (session('message'))
    <script>
        Swal.fire(
        'Asekkkkk',
           `{{ session('message') }}`,
        'success'
    )
    </script>    
@endif 

@endsection
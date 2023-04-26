@extends('layouts.app')

@section('title', 'Daftar Akun Karyawan')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Karyawan</h6>
    </div>
    <div class="card-body">
        <a href="{{ route('akunKaryawan.tambah') }}" class="btn btn-primary mb-3">Tambahkan Akun Karyawan</a>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>no</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th >Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php($no = 1)
                    @foreach ($karyawan as $row)
                    <tr>
                        <th>{{ $no++ }}</th>
                        <td>{{ $row->nama }}</td>
                        <td>{{ $row->jabatan }}</td>
                        <td>
                            <a href="{{ route('akunKaryawan.detail', $row->username) }}" class="btn btn-info">Detail</a>
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
        'Sukses!',
           `{{ session('message') }}`,
        'success'
    )
    </script>    
@endif 
@endsection
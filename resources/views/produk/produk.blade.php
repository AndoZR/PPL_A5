@extends('layouts.app')

@section('tab', 'Produk | OPERATS')

@section('title', 'Produk')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Produk</h6>
    </div>
    <div class="card-body">
        <a href="{{ route('produk.tambah') }}" class="btn btn-primary mb-3">Tambahkan Produk</a>
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>no</th>
                        {{-- <th>Produk ID</th> --}}
                        <th>Nama</th>
                        <th>Stok</th>
                        <th>Harga</th>
                        <th>Expired</th>
                        <th>Deskripsi</th>
                        <th >Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php($no = 1)
                    @foreach ($produk as $row)
                    <tr>
                        <th>{{ $no++ }}</th>
                        {{-- <td>{{ $row->produk_id }}</td> --}}
                        <td>{{ $row->nama }}</td>
                        <td>{{ $row->stok }}</td>
                        <td>{{ $row->harga }}</td>
                        <td>{{ $row->tgl_exp }}</td>
                        <td style="max-width:200px; height:100px">
                            <div style="height:100%; overflow: auto">
                                {{ $row->deskripsi }}
                            </div>
                        </td>
                        <td style="max-width:95px">
                            <a href="{{ route('produk.edit', $row->produk_id) }}" class="btn btn-warning">Edit</a>
                            <a href="{{ route('produk.hapus', $row->produk_id) }}" class="btn btn-danger" id="sweetDelete">Hapus</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@if (session('messageBerhasil'))
    <script>
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Data berhasil disimpan',
            showConfirmButton: false,
            timer: 5000
        })
    </script>    
@elseif (session('messageMaksData'))
<script>
    Swal.fire({
        position: 'center',
        icon: 'error',
        title: 'Data telah mencapai batas maksimal (100 data). Harap berlangganan akun premium!',
        showConfirmButton: false,
        timer: 5000
    })
</script>  
@endif 

@endsection
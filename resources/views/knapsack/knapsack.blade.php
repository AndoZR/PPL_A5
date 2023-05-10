@extends('layouts.app')

@section('title', 'Knapsack')

@section('content')
<div class="row">
    <div class="col-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Apa itu Knapsack?</h6>
            </div>
            <div class="card-body">
                Knapsack adalah masalah optimisasi kombinatorial yang melibatkan pemilihan item dari himpunan item yang tersedia untuk dimasukkan ke dalam knapsack gudang atau tempat penyimpanan dengan kapasitas terbatas. Setiap item memiliki nilai(pendapatan) dan bobot(jumlah stok), dan tujuan dari masalah knapsack adalah untuk memilih kombinasi item yang memberikan nilai maksimum atau keuntungan maksimum sambil memastikan total bobot item yang dipilih tidak melebihi kapasitas knapsack.
            </div>
            <div class="card-body">
                <a href="{{ route('knapsack.tambah') }}" class="btn btn-primary">Tambah Data Knapsack</a>
            </div>
        </div>
        <!-- Area Chart -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Detail Knapsack</h6>
            </div>
            <div class="card-body">
                --Data diambil berdasarkan 30 hari ke belakang dari data pendapatan--
                <br>
                {{-- Kapasitas Gudang: {{ ($kapasitas) }} --}}
                <br>
                @if (isset($result))
                    @foreach ($result['selectedItems'] as $item)
                        >> Rekomen Produk({{ $item['nama'] }}) <br>
                        - Pendapatan: {{ $item['pendapatan'] }} <br>
                        - Stok Baru: {{ $item['stok_baru'] }} <br>
                        <br>
                    @endforeach
                @endif    
            </div>
            {{-- <!-- Tasks Card Example -->
            <div class="col-xl-6 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                                    </div>
                                    <div class="col">
                                        <div class="progress progress-sm mr-2">
                                            <div class="progress-bar bg-info" role="progressbar"
                                                style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
    <div class="col-4">
        <div class="card shadow mb-4">
            <form action="{{ route('knapsack.process') }}" method="POST">
                @csrf
                <div class="card-header py-3 d-flex">
                    <h6 class="m-0 font-weight-bold text-primary">Pengaturan</h6>
                    <button type="submit" class="btn btn-primary ml-auto">Mulai</button>
                </div>
                <div class="card-body">
                    <label class="form-label text-gray-900" for="kapasitas">Kapasitas Stok Gudang</label>
                    <input class="form-control" type="number" min="0" id="kapasitas" name="kapasitas">

                    {{-- <label class="form-label text-gray-900" for="alpha">Konstanta Perataan α (0-1)</label>
                    <input class="form-control" type="number" onkeydown="return false" min="0" max="1" step="0.1" id="alpha" name="alpha"> --}}
                </div>
            </form>
        </div>
    </div>
</div>

@if (session('message'))
    <script>
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: `{{ session('message') }}`,
            showConfirmButton: false,
            timer: 5000
        })
    </script>    
@endif 

@endsection

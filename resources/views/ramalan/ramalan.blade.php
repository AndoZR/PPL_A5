@extends('layouts.app')

@section('title', 'Ramalan')

@section('content')
<div class="row">
    <div class="col-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Apa itu Eksponensial Smoothing?</h6>
            </div>
            <div class="card-body">
                Eksponensial smoothing adalah metode peramalan yang digunakan untuk memperkirakan nilai berikutnya pada data time series berdasarkan perhitungan rata-rata tertimbang dari nilai-nilai sebelumnya. Metode ini menggunakan koefisien smoothing atau smoothing factor untuk menentukan bobot relatif dari nilai aktual dan prediksi sebelumnya dalam perhitungan rata-rata tertimbang.
            </div>
        </div>
        <!-- Area Chart -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex">
                <h6 class="m-0 font-weight-bold text-primary">Area Chart</h6>
                <a class="btn btn-primary ml-auto" href="{{ route('ramalan.predict') }}">Prediksi</a>
            </div>
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="myAreaChart"></canvas>
                </div>
                <hr>
                Styling for the area chart can be found in the
                <code>/js/demo/chart-area-demo.js</code> file.
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Peramalan per Bulan</h6>
            </div>
            <div class="card-body">
                <!-- Menambahkan elemen HTML untuk menampilkan data dari beberapa label -->
                <ul id="label-list"></ul>
                <ul id="data-chart"></ul>

                <form>
                    <label for="date">Date:</label>
                    <input type="text" id="date" name="date" readonly>
            
                    <label for="month">Month:</label>
                    <input type="text" id="month" name="month" readonly>
            
                    <label for="year">Year:</label>
                    <input type="text" id="year" name="year" readonly>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    var chartDataProduk = {!! $produk !!};

    var chartDataProdukBaru = {
  "label": ["nextMonth", "nextMonth", "nextMonth"],
  "data": [50, 100, 75]
};
</script>

@endsection

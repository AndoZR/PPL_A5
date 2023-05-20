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
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Area Chart</h6>
            </div>
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="myAreaChart"></canvas>
                </div>
                <hr>
                @if(isset($mape))
                MAPE: {{ $mape }}
                @endif
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card shadow mb-4">
            <form action="{{ route('ramalan.predict') }}" method="POST">
                @csrf
                <div class="card-header py-3 d-flex">
                    <h6 class="m-0 font-weight-bold text-primary">Peramalan per Bulan</h6>
                    <button type="submit" class="btn btn-primary ml-auto">Prediksi</button>
                </div>
                <div class="card-body">
                    <label class="form-label text-gray-900" for="permintaanPredik">Prediksi Bulan +</label>
                    <input class="form-control" type="number" min="0" id="permintaanPredik" name="permintaanPredik">

                    <label class="form-label text-gray-900" for="alpha">Konstanta Perataan α (0-1)</label>
                    <input class="form-control" type="number" onkeydown="return false" min="0" max="1" step="0.1" id="alpha" name="alpha">
                    <!-- Menambahkan elemen HTML untuk menampilkan data dari beberapa label -->
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    var chartDataGrafik = {!! $dataGrafik !!};
    
    @if(isset($dataPrediksi))
        var chartDataGrafikBaru = {!! $dataPrediksi !!};
        chartDataGrafik.label = chartDataGrafik.label.concat(chartDataGrafikBaru.label);
        chartDataGrafik.data = chartDataGrafik.data.concat(chartDataGrafikBaru.data);
    @endif

</script>


@endsection

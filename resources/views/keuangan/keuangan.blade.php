@extends('layouts.app')

@section('title', 'Keuangan')

@section('content')
<div class="row">
    <div class="col-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">PILIH BULAN DAN TAHUN</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('keuangan.calculate') }}" method="post">
                    @csrf
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="flexCheckDefault1" name="januari">
                        <label class="form-check-label" for="flexCheckDefault1">
                            Januari
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="flexCheckChecked2" name="februari">
                        <label class="form-check-label" for="flexCheckChecked2">
                            Februari
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="flexCheckChecked3" name="maret">
                        <label class="form-check-label" for="flexCheckChecked3">
                            Maret
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="flexCheckChecked4" name="april">
                        <label class="form-check-label" for="flexCheckChecked4">
                            April
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="flexCheckChecked5" name="mei">
                        <label class="form-check-label" for="flexCheckChecked5">
                            Mei
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="flexCheckChecked6" name="juni">
                        <label class="form-check-label" for="flexCheckChecked6">
                            Juni
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="flexCheckChecked7" name="juli">
                        <label class="form-check-label" for="flexCheckChecked7">
                            Juli
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="flexCheckChecked8" name="agustus">
                        <label class="form-check-label" for="flexCheckChecked8">
                            Agustus
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="flexCheckChecked9" name="september">
                        <label class="form-check-label" for="flexCheckChecked9">
                            September
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="flexCheckChecked10" name="oktober">
                        <label class="form-check-label" for="flexCheckChecked10">
                            Oktober
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="flexCheckChecked11" name="november">
                        <label class="form-check-label" for="flexCheckChecked11">
                            November
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="flexCheckChecked12" name="desember">
                        <label class="form-check-label" for="flexCheckChecked12">
                            Desember
                        </label>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="tahun">Tahun:</label>
                        <select class="form-control form-select-sm" id="tahun" name="tahun">
                            <option selected>Pilih Tahun</option>
                            @php
                            $startYear = 2000; // Tahun awal
                            $endYear = date('Y'); // Tahun akhir, menggunakan tahun saat ini
                        
                            // Loop untuk menghasilkan opsi tahun
                            for ($year = $startYear; $year <= $endYear; $year++) {
                                echo '<option value="'.$year.'">'.$year.'</option>';
                            }
                            @endphp
                        </select>
                      </div>      

                    <button class="btn btn-primary" type="submit">Get Keuangan</button>
                </form>
            </div>
        </div>
        <!-- Bar Chart -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Grafik Keuangan</h6>
            </div>
            <div class="card-body">
                <div class="chart-bar">
                    <canvas id="myBarChart"></canvas>
                </div>
                <hr>
                    tes
            </div>
        </div>
    </div>
</div>

<script>
    @if (isset($dataGrafik))
        var chartDataGrafik = {!! $dataGrafik !!};
    @endif
</script>


@endsection

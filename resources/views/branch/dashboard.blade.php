@extends('branch.layout')
@section('title', 'Dashboard')


@section('content')
<div class="main-content">
    <div class="row small-spacing">

        <!-- /.col-xl-3 col-lg-6 col-12 -->
        <div class="col-xl-3 col-lg-6 col-12">
            <div class="box-content bg-danger text-white">
                <div class="statistics-box with-icon">
                    <i class="ico far fa-building"></i>
                    <p class="text text-white">Total Toko di</p>
                    <h2 class="counter">{{ $total_toko }}</h2>
                </div>
            </div>
            <!-- /.box-content -->
        </div>

        <!-- /.col-xl-3 col-lg-6 col-12 -->
        <div class="col-xl-3 col-lg-6 col-12">
            <div class="box-content bg-secondary text-white">
                <div class="statistics-box with-icon">
                    <i class="ico fas fa-rss"></i>
                    <p class="text text-white bold">{{ Auth::user()->name }}</p>
                    <h4 class="counter">{{ Auth::user()->email }}</h4>
                    <small>{{ request()->ip() }}</small>
                </div>
            </div>
            <!-- /.box-content -->
        </div>
        <!-- /.col-xl-3 col-lg-6 col-12 -->
    </div>

    <div class="row">
        <div class="col-9">
            <div class="box-content bordered-all">
                <h4>Grafik Transaksi Penarikan dan Pemasangan {{ date('Y') }} By Branch
                    {{ Auth::user()->branch->name }}</h4>
                <canvas id="barChart" class="chartjs-chart" width="100%" height="435"></canvas>
            </div>
        </div>
        <div class="col-3">
            <div class="box-content bordered-all">
                <h4 class="box-title text-success text-center">Pemangan Bulan ini</h4>
                <div class="content widget-stat">
                    <div class="text-center">
                        <h2 class="counter text-success">
                            {{ $total_transaksi['pemasangan_per_mont'] }}</h2>
                        <p class="text text-success mt-2">Transaksi</p>
                    </div>
                </div>
            </div>

            <div class="box-content bordered-all">
                <h4 class="box-title text-warning text-center">Penarikan Bulan ini</h4>
                <div class="content widget-stat">
                    <div class="text-center">
                        <h2 class="counter text-warning">
                            {{ $total_transaksi['penarikan_per_mont'] }}</h2>
                        <p class="text text-warning mt-2">Transaksi</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@push('js-custome')
    <!-- chart.js Chart -->
    <script src="{{ asset('assets/plugin/chart/chartjs/Chart.bundle.min.js') }}"
        type="text/javascript"></script>
    <script>
        const ctx = document.getElementById('barChart').getContext('2d');

        const barChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                    'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                ],
                datasets: [{
                        label: 'Transaksi Penarikan',
                        data: @json($data_grafik['total_transaksi_penarikan']),
                        backgroundColor: '#A31D1D',
                        borderRadius: 5,
                        barThickness: 10
                    },
                    {
                        label: 'Transaksi Pemasangan',
                        data: @json($data_grafik['total_transaksi_pemasangan']),
                        backgroundColor: '#003092',
                        borderRadius: 5,
                        barThickness: 10
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                animation: {
                    duration: 2000,
                    easing: 'easeOutBounce'
                }
            }
        });
    </script>
@endpush

@extends('admin.layout')
@section('title', 'Dashboard')


@section('content')
<div class="main-content">
    <div class="row small-spacing">
        <div class="col-xl col-lg-6 col-12">
            <div class="box-content bg-success text-white">
                <div class="statistics-box with-icon">
                    <i class="ico mdi mdi-cube-outline mr-2"></i>
                    <p class="text text-white">Product</p>
                    <h2 class="counter">{{ $total_produk }}</h2>
                </div>
            </div>
            <!-- /.box-content -->
        </div>
        <!-- /.col-xl-3 col-lg-6 col-12 -->
        <div class="col-xl col-lg-6 col-12">
            <div class="box-content bg-info text-white">
                <div class="statistics-box with-icon">
                    <i class="ico fas fa-code-branch"></i>
                    <p class="text text-white">Branch</p>
                    <h2 class="counter">{{ $total_branch }}</h2>
                </div>
            </div>
            <!-- /.box-content -->
        </div>
        <!-- /.col-xl-3 col-lg-6 col-12 -->
        <div class="col-xl col-lg-6 col-12">
            <div class="box-content bg-danger text-white">
                <div class="statistics-box with-icon">
                    <i class="ico far fa-building"></i>
                    <p class="text text-white">Toko</p>
                    <h2 class="counter">{{ $total_toko }}</h2>
                </div>
            </div>
            <!-- /.box-content -->
        </div>
        <!-- /.col-xl-3 col-lg-6 col-12 -->
        <div class="col-xl col-lg-6 col-12">
            <div class="box-content bg-warning text-white">
                <div class="statistics-box with-icon">
                    <i class="ico far fa-user"></i>
                    <p class="text text-white">Account User</p>
                    <h2 class="counter">{{ $total_user }}</h2>
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
                <h4>Grafik Transaksi Penarikan dan Pemasangan {{ date('Y') }}</h4>
                <canvas id="barChart" class="chartjs-chart" width="100%" height="435"></canvas>
            </div>
        </div>
        <div class="col-3">
            <div class="box-content bordered-all">
                <h4 class="box-title text-success text-center">Pemangan Bulan ini</h4>
                <div class="content widget-stat">
                    <div class="text-center">
                        <h2 class="counter text-success">{{ number_format($total_transaksi['pemasangan_per_mont'], 0, ',', '.') }}</h2>
                        <p class="text text-success mt-2">Transaksi</p>
                    </div>
                </div>
            </div>

            <div class="box-content bordered-all">
                <h4 class="box-title text-warning text-center">Penarikan Bulan ini</h4>
                <div class="content widget-stat">
                    <div class="text-center">
                        <h2 class="counter text-warning">{{ number_format($total_transaksi['penarikan_per_mont'], 0, ',', '.') }}</h2>
                        <p class="text text-warning mt-2">Transaksi</p>
                    </div>
                </div>
            </div>

            <div class="box-content bordered-all">
                <h4 class="box-title text-primary text-center">Stock Tersedia</h4>
                <div class="content widget-stat">
                    <div class="text-center">
                        <h2 class="counter text-primary">{{ number_format($stock_tersedia, 0,',', '.') }}</h2>
                        <p class="text text-primary mt-2">PCS / SET</p>
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

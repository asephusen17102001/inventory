@extends('admin.layout')
@section('title', 'Dashboard')


@section('content')
<div class="main-content">
    <div class="row small-spacing">
        <div class="col-xl-3 col-lg-6 col-12">
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
        <div class="col-xl-3 col-lg-6 col-12">
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
        <div class="col-xl-3 col-lg-6 col-12">
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
        <div class="col-xl-3 col-lg-6 col-12">
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
    </div>
</div>
@endsection

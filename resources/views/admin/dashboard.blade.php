@extends('admin.layout')
@section('title', 'Dashboard')


@section('content')
     <div class="main-content">
           <div class="row small-spacing">
                 <div class="col-xl-3 col-lg-6 col-12">
                       <div class="box-content bg-success text-white">
                              <div class="statistics-box with-icon">
                                    <i class="ico small far fa-gem"></i>
                                    <p class="text text-white">SUCCESS</p>
                                    <h2 class="counter">72943</h2>
                              </div>
                       </div>
                       <!-- /.box-content -->
                 </div>
                 <!-- /.col-xl-3 col-lg-6 col-12 -->
                 <div class="col-xl-3 col-lg-6 col-12">
                       <div class="box-content bg-info text-white">
                              <div class="statistics-box with-icon">
                                    <i class="ico small fa fa-download"></i>
                                    <p class="text text-white">DOWNLOAD</p>
                                    <h2 class="counter">6382</h2>
                              </div>
                       </div>
                       <!-- /.box-content -->
                 </div>
                 <!-- /.col-xl-3 col-lg-6 col-12 -->
                 <div class="col-xl-3 col-lg-6 col-12">
                       <div class="box-content bg-danger text-white">
                              <div class="statistics-box with-icon">
                                    <i class="ico small fa fa-bug"></i>
                                    <p class="text text-white">FIXED BUG</p>
                                    <h2 class="counter">12564</h2>
                              </div>
                       </div>
                       <!-- /.box-content -->
                 </div>
                 <!-- /.col-xl-3 col-lg-6 col-12 -->
                 <div class="col-xl-3 col-lg-6 col-12">
                       <div class="box-content bg-warning text-white">
                              <div class="statistics-box with-icon">
                                    <i class="ico small fa fa-dollar-sign"></i>
                                    <p class="text text-white">SALES</p>
                                    <h2 class="counter">2,637</h2>
                              </div>
                       </div>
                       <!-- /.box-content -->
                 </div>
                 <!-- /.col-xl-3 col-lg-6 col-12 -->
           </div>
     </div>
@endsection
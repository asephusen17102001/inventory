@extends('branch.layout')
@section('title', 'Detail Toko')

@push('css-custome')
    <!-- Jquery UI -->
	<link rel="stylesheet" href="{{ asset('assets/plugin/jquery-ui/jquery-ui.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/plugin/jquery-ui/jquery-ui.structure.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/plugin/jquery-ui/jquery-ui.theme.min.css') }}">

    <style>
         tr>th {
            vertical-align: middle !important;
        }
        tr>td {
            font-size: 12px !important;
            font-weight: 600 !important;
            vertical-align: middle !important;
        }
    
        .select2-selection__rendered {
            line-height: 45px !important;
        }
    
        .select2-container .select2-selection--single {
            height: 45px !important;
        }
    
        .select2-selection__arrow {
            height: 45px !important;
        }
    
    </style>
@endpush


@section('content')
<div class="main-content">
    <div class="row small-spacing justify-content-center">
        <div class="col-12">
            <div class="row">
                <div class="col-12">
                    <div class="box-content bordered-all" style="padding: 2% !important;">
                        <h4 class="box-title"><i class="far fa-folder-open"></i> Detail Toko</h4>
                        <div class="dropdown js__drop_down">
                            <a href="#" class="dropdown-icon fas fa-ellipsis-v js__drop_down_button"></a>
                            <ul class="sub-menu">
                                <li><a href="{{ route('branch.stores.index') }}">Kembali</a></li>
                            </ul>
                        </div>

                        <div class="box-body p-0">
                            <div id="tabs-ui" class="margin-top-10 js__ui_tab">
                                <ul>
                                    <li><a href="#tabs-1">Detail</a></li>
                                    <li class="active"><a href="#tabs-2">Stock Product</a></li>
                                    <li><a href="#tabs-3">History Transaction</a></li>
                                </ul>
                                <div id="tabs-1">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <span class="text-muted">Nama Toko</span>
                                                <br>
                                                <b>{{ $store->name }}</b>    
                                            </div>
                                            <div class="mb-3">
                                                <span class="text-muted">Alamat</span>
                                                <br>
                                                <b>{{ $store->address }}</b>    
                                            </div>
                                            <div class="mb-3">
                                                <span class="text-muted">PIC</span>
                                                <br>
                                                <b>{{ $store->name_pic }}</b>    
                                            </div>
                                            <div class="mb-3">
                                                <span class="text-muted">Kontak Hub.</span>
                                                <br>
                                                <b>{{ $store->contact }}</b>    
                                            </div>
                                        </div>
                                        <div class="col-8">
                                            <div class="mb-3">
                                                <span class="text-muted">Status Toko.</span>
                                                <br>
                                                <b class="{{ $store->status == 'active' ? 'text-success' : 'text-danger' }}">
                                                    {{ $store->status == 'active' ? 'Aktif' : 'Non Aktif' }}    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="tabs-2">
                                    
                                    <table class="table table-bordered dataTable">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Nama Produk</th>
                                                <th class="text-center" width="15%">Stock Terpasang</th>
                                                <th class="text-center" width="15%">Stock Repair / Recondition</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($store->storeProducts->all() as $store_product)
                                                <tr>
                                                    <td># {{ $store_product->product->name }}</td>
                                                    <td class="text-center text-success">{{ $store_product->stock }} <small class="text-muted ml-2">PCS / SET</small></td>
                                                    <td class="text-center text-danger">{{ $store_product->stock_product_repair != 0 ? $store_product->stock_product_repair : 0 }} <small class="text-muted ml-2">PCS / SET</small></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                
                                </div>
                                <div id="tabs-3">
                                   <table class="table table-bordered dataTable">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th width="15%">Tanggal</th>
                                            <th width="15%">Nomor Transaction</th>
                                            <th>Methode</th>
                                            <th>Produk</th>
                                            <th class="text-center">Qty</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($store->detailProductTransactions->take(100) as $detail)
                                        @if (@$detail->product && @$detail->qty > 0)    
                                        <tr>
                                            <td>{{ date('d F Y H:i', strtotime($detail->created_at)) }}</td>
                                            <td>{{ $detail->transaction->nomor_transaction }}</td>
                                            <td class="{{ $detail->transaction->type == "penarikan" ? 'text-warning' : 'text-success' }}">{{ $detail->transaction->type == "penarikan" ? 'Penarikan' : 'Pemasangan' }}</td>
                                            <td>{{ $detail->product->name }}</td>
                                            <td class="text-right">{{ $detail->qty }} <small class="text-muted ml-2">PCS / SET</small></td>
                                        </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                   </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.col-12 -->
            </div>
        </div>
        <!-- /.col -->
    </div>
</div>
@endsection



@push('js-custome')
    <!-- Jquery UI -->
    <script src="{{ asset('assets/plugin/jquery-ui/jquery-ui.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/plugin/jquery-ui/jquery.ui.touch-punch.min.js') }}" type="text/javascript"></script>
    <script>
        $('.dataTable').dataTable({
            "paging": false,
            "searching": true,
            "ordering": false,
            "info": false,
        });
    </script>
@endpush
@extends('admin.layout')
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
        <div class="col-9">
            <div class="row">
                <div class="col-12">
                    <div class="box-content bordered-all" style="padding: 2% !important;">
                        <h4 class="box-title"><i class="far fa-folder-open"></i> Detail Toko</h4>
                        <div class="dropdown js__drop_down">
                            <a href="#" class="dropdown-icon fas fa-ellipsis-v js__drop_down_button"></a>
                            <ul class="sub-menu">
                                <li><a href="{{ route('admin.stores.index') }}">Kembali</a></li>
                            </ul>
                        </div>

                        <div class="box-body p-0">
                            <div id="tabs-ui" class="margin-top-10 js__ui_tab">
                                <ul>
                                    <li><a href="#tabs-1">Detail</a></li>
                                    <li class="active"><a href="#tabs-2">Set Product</a></li>
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
                                    <form action="{{ route('admin.stores.save_store_product', $store->id) }}" method="post" id="form-store-product">
                                        @csrf
                                    <table class="table table-bordered dataTable">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Nama Produk</th>
                                                <th class="text-center" width="15%">Stock Terpasang</th>
                                                <th class="text-center" width="15%">Stock Repair</th>
                                                <th class="text-center" width="20px">Act.</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($store->storeProducts->all() as $store_product)
                                                <tr>
                                                    <td># {{ $store_product->product->name }}</td>
                                                    <td class="text-center text-success">{{ $store_product->stock }}</td>
                                                    <td class="text-center text-danger">{{ $store_product->stock_product_repair != 0 ? $store_product->stock_product_repair : 0 }}</td>
                                                    <td class="text-center">
                                                        <button type="button" class="btn btn-xs btn-danger btn-delete"
                                                        onclick="confirm_delete(`{{ route('admin.stores.delete_store_product', $store_product->id) }}`)"><i class="fa fa-trash"></i></button>        
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                
                                                <td>
                                                    <select name="product_id" id="product_id" class="form-control select2" required>
                                                        <option value="">Pilih Produk</option>
                                                        @foreach ($products as $product)
                                                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="number" name="stock" class="form-control text-center" style="width: 100%;" placeholder="Terpasang.." required>
                                                </td>
                                                <td>
                                                    <input type="number" name="stock_product_repair" class="form-control text-center" style="width: 100%;" placeholder="Repair.." required>
                                                </td>
                                                <td class="text-center">
                                                    <button type="submit" class="btn btn-primary btn-xs"><i class="fa fa-paper-plane"></i></button>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </form>
                                </div>
                                <div id="tabs-3">
                                   <table class="table table-bordered">
                                    <thead class="thead-light">
                                        <tr>
                                            <th width="15%">Tanggal</th>
                                            <th width="15%">Nomor Transaction</th>
                                            <th>Methode</th>
                                            <th>Produk</th>
                                            <th class="text-center">Qty</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($store->detailProductTransactions as $detail)
                                        @if (@$detail->product && @$detail->qty > 0)    
                                        <tr>
                                            <td>{{ date('d M Y H:i', strtotime($detail->created_at)) }}</td>
                                            <td>{{ $detail->transaction->nomor_transaction }}</td>
                                            <td class="{{ $detail->transaction->type == "penarikan" ? 'text-info' : 'text-success' }}">{{ $detail->transaction->type == "penarikan" ? 'Penarikan' : 'Pemasangan' }}</td>
                                            <td>{{ $detail->product->name }}</td>
                                            <td class="text-right">{{ $detail->qty }}</td>
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
        $('.select2').select2({
            placeholder: '-- Pilih Product --',
            allowClear: true,
            width: '100%'
        });
       

        @if (session('success'))
            alert_success('{{ session('success') }}');

            $('#tabs-ui').tabs({active: 1});
        @endif

        @if (session('failed'))
            alert_failed('{{ session('failed') }}');
        @endif
    </script>
@endpush
@extends('admin.layout')
@section('title', 'Laporan Stock Terpasang By Branch')




@section('content')
<div class="main-content">
    <div class="row small-spacing justify-content-center">
        <div class="col-12">
            <div class="box-content bordered-all" style="padding: 2% !important;">
                <h4 class="box-title"><i class="fa fa-print"></i> Data Laporan Stock Gudang BK</h4>
            </div>
            <!-- /.box-content -->
        </div>
        <!-- /.col -->
    </div>

    <div class="row small-spacing justify-content-center">
        <div class="col-12">
            <div class="table-responsive">
                <table width="100%" cellpadding="10px" border="1px solid black">
                    <thead class="bg-light">
                        <tr>
                            <th style="min-width: 5%; white-space: nowrap;" class="bg-dark text-white">Nama Product</th>
                            <th class="text-center" width="200px">Stock</th>
                            <th class="text-center" width="200px">Proses Repair / Recondition</th>
                            <th class="text-center bg-dark text-white" style="max-width: 1%; white-space: nowrap;">Sub Total</th>
                        </tr>
                    </thead>
                    <tbody>

                        @php
                            $total = 0;
                        @endphp

                        @foreach($products as $product)
                            <tr>
                                <td style="min-width: 5%; white-space: nowrap;">{{ $product->name }}</td>
                                <td class="text-right">
                                    {{ number_format($product->stock, 0, ',','.') }}
                                </td>
                                <td class="text-right">
                                    {{ number_format($product->stock_recondition, 0, ',','.') }}
                                </td>
                                <td class="text-right">
                                    {{ number_format($product->stock + $product->stock_recondition, 0, ',','.') }}
                                </td>
                            </tr>
                            @php
                                $total += $product->stock + $product->stock_recondition;
                            @endphp
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="bg-dark text-white text-left">
                                Total &nbsp; :
                                &nbsp;&nbsp;{{ number_format($total, 0, ',', '.') }}
                                &nbsp;&nbsp;PCS / SET</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <!-- /.col -->
    </div>

</div>
@endsection
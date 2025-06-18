@extends('admin.layout')
@section('title', 'Laporan Stock Terpasang By Branch')

@push('css-custome')
<style>
    tr>td {
        font-size: 11px !important;
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
            <div class="box-content bordered-all" style="padding: 2% !important;">
                <h4 class="box-title"><i class="fa fa-print"></i> Data Laporan Stock Terpasang By Branch</h4>

                <div class="row">
                    <div class="col-3">
                        
                        <form action="" method="get" id="form-filter">
                            <div class="row mb-3 align-items-center">
                                <label for="branch_id" class="col-sm-2 col-form-label">Branch</label>
                                <div class="col-sm-10">
                                    <select class="custom-select form-control select2" name="branch_id" required>
                                        <option value=""></option>
                                        @foreach($branches as $branch)
                                            <option value="{{ $branch->id }}" {{ request('branch_id') == $branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                              </div>
                        </form>
                    </div>
                </div>

            </div>
            <!-- /.box-content -->
        </div>
        <!-- /.col -->
    </div>

    @if (request('branch_id'))
        <div class="row small-spacing justify-content-center">
            <div class="col-12">
                <div class="table-responsive">
                    <table width="100%" cellpadding="10px" border="1px solid black">
                        <thead class="bg-light">
                            <tr>
                                <th style="min-width: 5%; white-space: nowrap;" class="bg-dark text-white">Nama Product</th>
                               
                                @foreach ($stores as $store)
                                    <th class="text-center" width="200px">
                                        {{ ucwords(strtolower($store->name)) }}
                                    </th>
                                @endforeach
                                
                                <th class="text-center bg-dark text-white" style="max-width: 1%; white-space: nowrap;">Sub Total</th>
                            </tr>
                        </thead>
                        <tbody>

                            @php
                                $total = 0;
                            @endphp

                            @foreach ($products as $product)
                            <tr>
                                <td  style="min-width: 5%; white-space: nowrap;">{{ $product->name }}</td>
                                @php
                                    $sub_total = 0;
                                @endphp

                                @foreach ($stores as $store)
                                    @php
                                        $stock =  @$store->storeProducts->where('product_id', $product->id)->first()->stock ?? 0;
                                        $sub_total += $stock;
                                        $total += $stock;
                                    @endphp
                                    <td class="text-right" width="200px">
                                        {{ number_format($stock, 0, ',', '.') }}
                                    </td>
                                @endforeach

                                <td class="text-right">{{ number_format($sub_total, 0, ',','.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="bg-dark text-white text-left" colspan="{{ $stores->count() + 2 }}">
                                    Total &nbsp; :  &nbsp;&nbsp;{{ number_format($total, 0, ',', '.')  }} &nbsp;&nbsp;PCS / SET</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <!-- /.col -->
        </div>
    @endif
</div>
@endsection


@push('js-custome')
    <script>
        $(document).ready(function () {
            $('.select2').select2({
                placeholder: "-- Pilih Branch --"
            });

            $('[name="branch_id"]').change(function(){
                $('#form-filter').submit();
            })
        })
    </script>
@endpush

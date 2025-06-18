@extends('admin.layout')
@section('title', 'Laporan Transaksi Penarikan')

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
                <h4 class="box-title"><i class="fa fa-print"></i> Data Laporan Transaksi Penarikan</h4>
                <form action="" method="get" id="form-filter">
                    <div class="row">
                        <div class="col-3">
                            <div class="row mb-3 align-items-center">
                                <label for="branch_id" class="col-sm-2 col-form-label">Tanggal</label>
                                <div class="col-sm-10">
                                    <input type="date" name="f_tanggal_start" class="form-control"
                                        value="{{ request('f_tanggal_start')}}">
                                </div>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="row mb-3 align-items-center">
                                <label for="branch_id" class="col-sm-2 col-form-label">S/d.</label>
                                <div class="col-sm-10">
                                    <input type="date" name="f_tanggal_end" class="form-control"
                                        value="{{ request('f_tanggal_end')}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.box-content -->
        </div>
        <!-- /.col -->
    </div>

    @if (request('f_tanggal_start') && request('f_tanggal_end'))
    <div class="box-content bordered-all p-3">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-bordered dataTable">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th>Tanggal Transaksi</th>
                            <th>Nomor Transaksi</th>
                            <th>Branch - Nama Toko</th>
                            <th>Product - Qty</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach ($transactions as $transaction)
                            <tr>
                                <td style="border-top: 1px solid black !important;">
                                    {{ $transaction->getTanggalRansactionAttribute($transaction->tanggal_transaction) }}
                                </td>
                                <td style="border-top: 1px solid black !important;">
                                    <a href="{{ route('admin.transactions.show', ['type' => 'penarikan', 'transaction' => $transaction]) }}"  target="__blank">{{ $transaction->nomor_transaction }}</a>
                                </td>
                                <td style="border-top: 1px solid black !important;">
                                    {{ $transaction->store->branch->name }} - 
                                    {{ $transaction->store->name }}
                                </td>
                                <td width="30%" style="border-top: 1px solid black !important;">
                                    <table width="100%" cellpadding="5px">
                                        @foreach ($transaction->detailProductTransactions as $detail)    
                                        <tr>
                                            <td class="border-bottom">{{ $detail->product->name }}</td>
                                            <td class="text-right border-bottom">{{ number_format($detail->qty,0,',','.') }} <small class="text-muted ml-2">PCS / SET</small></td>
                                        </tr>
                                        @endforeach
                                    </table>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
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
        $(document).ready(function(){
            $('[name="f_tanggal_start"]').change(function(){
                checkFilter();
            });

            $('[name="f_tanggal_end"]').change(function(){
                checkFilter();
            });

            $('.dataTable').dataTable({
                paging: false,
                searching: true,
                ordering: false,
                info: true,
                language: {
                    search: "Cari &nbsp;:&nbsp;",
                    zeroRecords: "Data Transaksi tidak ditemukan",
                    info: "Total _TOTAL_ Data <b>Transaksi Penarikan</b>",
                    infoEmpty: "Tidak ada data Transaksi tersedia",
                }
            });
        });

        function checkFilter(){
            var f_tanggal_start =  $('[name="f_tanggal_start"]').val();
            var f_tanggal_end =  $('[name="f_tanggal_end"]').val();

            if(f_tanggal_start && f_tanggal_end){
                $('#form-filter').submit();
            }
        }

    </script>
@endpush
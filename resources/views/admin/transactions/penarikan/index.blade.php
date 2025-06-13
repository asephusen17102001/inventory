@php
use Carbon\Carbon;
@endphp
@extends('admin.layout')
@section('title', 'Data Transaksi Penarikan Product')


@section('content')
<div class="main-content">
    <div class="row small-spacing justify-content-center">
        <div class="col-10">
            <div class="box-content bordered" style="padding: 2% !important;">
                <h4 class="box-title"><i class="far fa-folder-open"></i> Data Product Penarikan</h4>
                <!-- /.box-title -->
                <div class="dropdown js__drop_down">
                    <a href="#" class="dropdown-icon fas fa-ellipsis-v js__drop_down_button"></a>
                    <ul class="sub-menu">
                        <li><a href="{{ route('admin.transactions.create', ['type' => 'penarikan']) }}">Add Data</a>
                        </li>
                        <li> <a href="#">Report Data</a></li>
                    </ul>
                    <!-- /.sub-menu -->
                </div>
                <!-- /.dropdown js__dropdown -->
                <div class="row mb-3">
                    <div class="col-9"></div>
                    <div class="col-3">
                        <form action="{{ route('admin.transactions.index', ['type' => 'penarikan']) }}" method="GET"
                            id="form-filter">
                            <input type="date" name="f_tanggal" class="form-control" value="{{ $f_tanggal }}">
                        </form>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped dataTable">
                        <thead class="table-secondary text-black">
                            <tr>
                                <th width="5%" class="text-center">No</th>
                                <th>Tanggal</th>
                                <th>Nomor Transaction</th>
                                <th>Branch - Toko</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $index => $transaction )
                            <tr>
                                <td class="text-center">{{ ($index+1) }}.</td>
                                <td>{{ $transaction->getTanggalRansactionAttribute($transaction->tanggal_transaction) }}
                                </td>
                                <td>
                                    <a
                                        href="{{ route('admin.transactions.show', ['type' => 'penarikan', 'transaction' => $transaction->id]) }}">
                                        {{ $transaction->nomor_transaction }}
                                    </a>
                                </td>
                                <td>
                                    {{ $transaction->store->branch->name }} - {{ $transaction->store->name }}
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('admin.transactions.show', ['type' => 'penarikan', 'transaction' => $transaction->id]) }}"
                                        class="btn btn-xs btn-primary "><i class="fa fa-eye"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>


            </div>
            <!-- /.box-content -->
        </div>
        <!-- /.col -->
    </div>
</div>
@endsection


@push('js-custome')
<script>
    $(document).ready(function () {
        $('.dataTable').dataTable();

        $('[name="f_tanggal"]').change(function () {
            $('#form-filter').submit();
        });


        @session('success')
        alert_success("{{ session('success') }}");
        @endsession

        @session('failed')
        alert_success("{{ session('failed') }}");
        @endsession
    });

</script>
@endpush

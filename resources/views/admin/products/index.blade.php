@extends('admin.layout')
@section('title', 'Product')
@push('css-custome')

<style>
    tr>th {
        font-size: 12px !important;
        font-weight: 900 !important;
        vertical-align: middle !important;
    }

    tr>td {
        font-size: 12px !important;
        font-weight: 600 !important;
        vertical-align: middle !important;
    }

</style>
@endpush

@section('content')
<div class="main-content">
    <div class="row small-spacing justify-content-center">
        <div class="col-12">
            <div class="box-content bordered" style="padding: 2% !important;">
                <h4 class="box-title"><i class="far fa-folder-open"></i> Data Product</h4>
                <!-- /.box-title -->
                <div class="dropdown js__drop_down">
                    <a href="#" class="dropdown-icon fas fa-ellipsis-v js__drop_down_button"></a>
                    <ul class="sub-menu">
                        <li><a href="{{ route('admin.products.create') }}">Add Data</a></li>
                        <li> <a href="#">Report Data</a></li>
                    </ul>
                    <!-- /.sub-menu -->
                </div>
                <!-- /.dropdown js__dropdown -->

                <div class="table-responsive">
                    <table class="table table-striped dataTable">
                        <thead class="table-secondary text-black">
                            <tr>
                                <th width="5%" class="text-center">No</th>
                                <th>Nama Product</th>
                                <th class="text-center">Stock [ New ]</th>
                                <th class="text-center">Stock Recondition</th>
                                <th class="text-center">Hrg. [ New ]</th>
                                <th class="text-center">Hrg. Recondition</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Updated At</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $index => $product )
                            <tr>
                                <td class="text-center">{{ ($index+1) }}.</td>
                                <td>{{ ucwords($product->name) }}</td>
                                <td class="text-right">{{ number_format($product->stock,0,',','.') }}</td>
                                <td class="text-right">{{ number_format($product->stock_recondition,0,',','.') }}</td>
                                <td class="text-right">Rp. {{ number_format($product->price, 0, '.', '.') }},-</td>
                                <td class="text-right">Rp. {{ number_format($product->price, 0, '.', '.') }},-</td>
                                <td
                                    class="text-center {{ $product->status == "active" ? 'text-success' : 'text-danger' }}">
                                    {{ ucwords($product->status) }}
                                </td>
                                <td>{{ date('d M Y H:i', strtotime($product->updated_at)) }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.products.edit', $product->id) }}"
                                        class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
                                    <button type="button" class="btn btn-xs btn-danger btn-delete"
                                        onclick="confirm_delete(`{{ route('admin.products.destroy', $product->id) }}`)"><i
                                            class="fa fa-trash"></i></button>
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

        @session('success')
        alert_success("{{ session('success') }}");
        @endsession

        @session('failed')
        alert_success("{{ session('failed') }}");
        @endsession
    })

</script>
@endpush

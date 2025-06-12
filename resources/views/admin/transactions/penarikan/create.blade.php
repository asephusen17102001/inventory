@extends('admin.layout')
@section('title', 'Branch')
@push('css-custome')

<style>
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
        <div class="col-10">
            <form action="{{ route('admin.transactions.store', ['type' => 'penarikan']) }}" method="post">
                @csrf

                <div class="box-content bordered" style="padding: 20px !important;">
                    <h4 class="box-title"><i class="fa fa-plus"></i> Form Add Product Penarikan</h4>
                    <!-- /.box-title -->
                    <div class="dropdown js__drop_down">
                        <a href="#" class="dropdown-icon fas fa-ellipsis-v js__drop_down_button"></a>
                        <ul class="sub-menu">
                            <li><a href="{{ route('admin.transactions.index', ['type' => 'penarikan']) }}">kembali</a>
                            </li>
                        </ul>
                        <!-- /.sub-menu -->
                    </div>
                    <!-- /.dropdown js__dropdown -->
                    <div class="row">
                        <div class="col-3">
                            <input type="date" class="form-control" name="tanggal_transaction" id="tanggal"
                                value="{{ date('d-m-Y') }}" required />
                        </div>
                        <div class="col-4">
                            <select name="store_id" id="store_id" class="form-control select2" required>
                                <option value=""></option>
                                @foreach ($stores as $store)
                                <option value="{{ $store->id }}">{{ $store->branch->name }} - {{ $store->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>
                <!-- /.box-content -->

                <div class="row content-form" style="display: none;">

                    <div class="col-4">
                        <div class="box-content" style="padding: 10px !important;">
                            <div class="mb-3">
                                <span class="text-muted">Nama Toko</span>
                                <br>
                                <b id="info-name">Asep Husen</b>
                            </div>

                            <div class="mb-3">
                                <span class="text-muted">Alamat</span>
                                <br>
                                <b id="info-address"></b>
                            </div>

                            <div class="mb-3">
                                <span class="text-muted">PIC</span>
                                <br>
                                <b id="info-ppic"></b>
                            </div>

                            <div class="mb-3">
                                <span class="text-muted">Kontak Hub.</span>
                                <br>
                                <b id="info-contact"></b>
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="box-content" style="padding: 20px !important;">
                            <input type="text" name="nomor_transaction" class="form-control" id="nomor_transaction"
                                required placeholder="Masukkan Nomor Transaksi"
                                value="{{ old('nomor_transaction') }}" />
                        </div>
                        <div class="box-content" style="padding: 20px !important;">
                            <table class="table table-striped">
                                <tbody>
                                    @foreach ($products as $index => $product)
                                    <input type="hidden" name="product_id[{{ $index }}]" value="{{ $product->id }}" />
                                    <tr>
                                        <td>{{ $product->name }}</td>
                                        <td width="20%"><input type="text"
                                                class="form-control text-center format-rupiah" value="0"
                                                name="qty[{{ $index }}]" placeholder="Qty" required /></td>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="float-right mt-5">
                                <a href="{{ route('admin.transactions.index', ['type' => 'penarikan']) }}"
                                    class="btn btn-xs btn-dark">Cancel</a>
                                <button type="submit" class="btn btn-xs btn-primary">Save Data</button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
        <!-- /.col -->
    </div>
</div>
@endsection


@push('js-custome')
<script>
    $(document).ready(function () {
        $('.dataTable').dataTable();
        $('.select2').select2({
            placeholder: '-- Pilih Toko --',
            allowClear: true
        });

        // SET STORE
        $('#store_id').on('change', function () {

            let store_id = $(this).val();
            if (store_id) {
                $.ajax({
                    url: "{{ route('admin.stores.ajax_get_store') }}",
                    data: {
                        id: store_id
                    },
                    type: 'GET',
                    success: function (response) {
                        $('#info-name').text(response.name);
                        $('#info-address').text(response.address);
                        $('#info-ppic').text(response.ppic);
                        $('#info-contact').text(response.contact);

                        $('.content-form').show();
                    },
                    error: function (xhr) {
                        console.log('Error:', xhr);
                        $('.content-form').hide();
                    }
                });
            } else {
                $('#info-name').text('');
                $('#info-address').text('');
                $('#info-ppic').text('');
                $('#info-contact').text('');
                $('.content-form').hide();
            }
        });

        $('.format-rupiah').on('keyup', function () {
            $(this).val(formatRupiah(this.value));
        });

        @session('success')
        alert_success("{{ session('success') }}");
        @endsession

        @session('failed')
        alert_success("{{ session('failed') }}");
        @endsession
    })


    function formatRupiah(angka) {
        var number_string = angka.toString().replace(/[^,\d]/g, '').toString(),
            split = number_string.split('.'),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] !== undefined ? rupiah + '.' + split[1] : rupiah;
        return rupiah;
    }

</script>
@endpush

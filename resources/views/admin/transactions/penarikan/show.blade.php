@extends('admin.layout')
@section('title', 'Detail Transaksi Penarikan Product')

@section('content')
<div class="main-content">
    <div class="row small-spacing justify-content-center">
        <div class="col-7 p-5">
            <h4>Detail Product Penarikan</h4>
            <hr>
            <div class="invoice-box mt-4">
                <table>
                    <tbody>
                        <tr class="top">
                            <td colspan="2">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td class="title" style="font-size:35px !important;">
                                                <a href="#" class="logo">BK<span> METALPLASINDO</span></a>
                                            </td>

                                            <td>
                                                Nomor Transaksi #: <b>{{ $transaction->nomor_transaction }}</b><br>
                                                Created:
                                                <b>
                                                    {{ $transaction->getTanggalRansactionAttribute($transaction->tanggal_transaction) }}<br>
                                                </b>

                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>

                        <tr class="information">
                            <td colspan="2">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td>
                                                {{ ucwords($transaction->store->name) }}<br>
                                                {{ $transaction->store->address }}<br>
                                                {{ ucwords($transaction->store->name_pic) }},
                                                {{ $transaction->store->contact }}
                                            </td>

                                            <td>
                                                PT. BK METALPLASINDO<br>
                                                Administator<br>
                                                bk-metalplasindo@gmai.com
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>

                        <tr class="heading">
                            <td>
                                Type Method
                            </td>

                            <td>

                            </td>
                        </tr>

                        <tr class="details">
                            <td>
                                # Penarikan Product
                            </td>

                            <td>

                            </td>
                        </tr>

                        <tr class="heading">
                            <td>
                                Item Product
                            </td>

                            <td>
                                Qty
                            </td>
                        </tr>

                        @foreach ($transaction->detailProductTransactions->where('qty', '>', 0) as $detail)
                        <tr class="item">
                            <td>
                                # {{ $detail->product->name }}
                            </td>

                            <td>
                                {{ $detail->qty }}
                            </td>
                        </tr>
                        @endforeach

                        <tr class="total">
                            <td></td>

                            <td>
                                Total: {{ $transaction->detailProductTransactions->sum('qty') }}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="text-right margin-top-20">
                    <ul class="list-inline">
                        <li><a href="{{ route('admin.transactions.index', ['type' => 'penarikan']) }}"
                                class="btn btn-default waves-effect waves-light">Kembali</a></li>
                        <li><button type="submit" class="btn btn-primary waves-effect waves-light"><i
                                    class="fa fa-print"></i> Print</button></button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /.col -->
    </div>
</div>
@endsection

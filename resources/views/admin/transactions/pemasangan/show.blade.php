@extends('admin.layout')
@section('title', 'Detail Transaksi Pemasangan Product')

@section('content')
<div class="main-content">
    <div class="row small-spacing justify-content-center">
        <div class="col-7 p-5">
            <h4>Detail Product Pemasangan</h4>
            <hr>
            <div class="invoice-box mt-4">
                <table>
                    <tbody>
                        <tr class="top">
                            <td colspan="4">
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
                            <td colspan="4">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td>
                                                PT. BK METALPLASINDO<br>
                                                Administator<br>
                                                bk-metalplasindo@gmai.com
                                            </td>


                                            <td>
                                                {{ ucwords($transaction->store->name) }}<br>
                                                {{ $transaction->store->address }}<br>
                                                {{ ucwords($transaction->store->name_pic) }},
                                                {{ $transaction->store->contact }}
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

                            <td colspan="3">

                            </td>
                        </tr>

                        <tr class="details">
                            <td>
                                # Pemasangan Product
                            </td>

                            <td colspan="3">

                            </td>
                        </tr>

                        <tr class="heading">
                            <td>
                                Item Product
                            </td>
                            <td class="text-right">
                                Price Recond..
                            </td>
                            <td class="text-right">
                                Qty
                            </td>
                            <td class="text-center">Sub. Total</td>
                        </tr>

                        @foreach ($transaction->detailProductTransactions->where('type', 'repair') as $detail)
                        <tr class="item">
                            <td>
                                # {{ $detail->product->name }}
                            </td>
                            <td>
                                {{ number_format($detail->product->price_recondition, 0, ',', '.') }}
                            </td>
                            <td class="text-right">
                                x &nbsp; {{ $detail->qty }}
                            </td>
                            <td class="text-right">
                               
                                {{ number_format($detail->product->price_recondition * $detail->qty, 0, ',', '.') }}
                            </td>
                        </tr>
                        @endforeach

                        <tr class="total bg-muted">
                            <td colspan="2" class="text-center">

                            </td>
                            <th class="text-right" colspan="2">
                                @php
                                $total_price_recondition =
                                $transaction->detailProductTransactions->where('type', 'repair')->sum(function($detail){
                                return ($detail->qty * $detail->product->price_recondition);
                                });
                                @endphp

                                {{ number_format($total_price_recondition, 0,',','.') }}
                                &nbsp;
                            </th>
                        </tr>

                        <tr>
                            <td colspan="4"></td>
                        </tr>

                        <tr class="heading">
                            <td>
                                Item Product
                            </td>
                            <td class="text-right">
                                Price [ New ]
                            </td>
                            <td class="text-right">
                                Qty
                            </td>
                            <td class="text-center">Sub. Total</td>
                        </tr>

                        @foreach ($transaction->detailProductTransactions->where('type', 'baru') as $detail)
                        <tr class="item">
                            <td>
                                # {{ $detail->product->name }}
                            </td>
                            <td>
                                {{ number_format($detail->product->price, 0, ',', '.') }}
                            </td>
                            <td class="text-right">
                                x &nbsp; {{ $detail->qty }}
                            </td>
                            <td class="text-right">
                               
                                {{ number_format($detail->product->price * $detail->qty, 0, ',', '.') }}
                            </td>
                        </tr>
                        @endforeach
                        <tr class="total bg-muted">
                            <td colspan="2" class="text-center">

                            </td>
                            <th class="text-right" colspan="2">
                                @php
                                $total_price = $transaction->detailProductTransactions->where('type', 'baru')->sum(function($detail){
                                return ($detail->qty * $detail->product->price);
                                });
                                @endphp

                                {{ number_format($total_price, 0,',','.') }}
                                &nbsp;
                            </th>
                        </tr>

                        <tr class="heading">
                            <td colspan="3" style="font-size: 14px !important">
                                Total Service All.
                            </td>
                            <td class="text-right" style="font-size: 14px !important">
                                Rp. {{ number_format($total_price_recondition + $total_price, 0,',','.') }}
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

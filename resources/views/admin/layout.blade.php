<!DOCTYPE html>
<html lang="en" class="js menu-active">


<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Main Styles -->
    <link rel="stylesheet" href="{{ asset('assets/styles/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/styles/custom.css') }}">

    <!-- Material Design Icon -->
    <link rel="stylesheet"
        href="{{ asset('assets/fonts/material-design/css/materialdesignicons.css') }}">

    <!-- mCustomScrollbar -->
    <link rel="stylesheet"
        href="{{ asset('assets/plugin/mCustomScrollbar/jquery.mCustomScrollbar.min.css') }}">

    <!-- Waves Effect -->
    <link rel="stylesheet" href="{{ asset('assets/plugin/waves/waves.min.css') }}">

    <!-- Sweet Alert -->
    <link rel="stylesheet" href="{{ asset('assets/plugin/sweet-alert/sweetalert.css') }}">

    <!-- Data Tables -->
    <link rel="stylesheet"
        href="{{ asset('assets/plugin/datatables/media/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/plugin/datatables/extensions/Responsive/css/responsive.bootstrap.min.css') }}">

    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/plugin/select2/css/select2.min.css') }}">

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

        html, body {
            position: relative;
            height: 100%;
            background: #f5f7fa;
            color: #505458;
            font-size: 12px;
        }
    </style>

    @stack('css-custome')

</head>

<body>
    <div class="main-menu">
        <header class="header">
            <a href="index.html" class="logo"><i class="ico mdi mdi-cube-outline"></i>Admin Dashbaord</a>
            <button type="button" class="button-close fa fa-times js__menu_close"></button>
            <div class="user">
                <a href="#" class="avatar"><img
                        src="{{ asset('assets/images/logo/logo-1.png') }}" alt=""><span
                        class="status online"></span></a>
                <h5 class="name"><a href="profile.html">Admin</a></h5>
                <h5 class="position">Administrator</h5>
                <!-- /.name -->
                <div class="control-wrap js__drop_down">
                    <i class="fa fa-caret-down js__drop_down_button"></i>
                    <div class="control-list">
                        <div class="control-item"><a href="#"><i class="fa fa-user"></i> Profile</a>
                        </div>
                        <div class="control-item"><a href="#"><i class="fas fa-cog"></i> Settings</a></div>
                        <div class="control-item"><a href="#"><i class="fas fa-sign-out-alt"></i> Log out</a>
                        </div>
                    </div>
                    <!-- /.control-list -->
                </div>
                <!-- /.control-wrap -->
            </div>
            <!-- /.user -->
        </header>
        <!-- /.header -->
        <div class="content">

            <div class="navigation">

                <!-- /.title -->
                <ul class="menu js__accordion">
                    <li class="">
                        <a class="waves-effect" href="{{ route('admin.dashboard') }}"><i
                                class="menu-icon mdi mdi-view-dashboard"></i><span>Dashboard</span></a>
                    </li>
                    <li>
                        <a class="waves-effect parent-item js__control" href="#"><i
                                class="menu-icon mdi mdi-desktop-mac"></i><span>Master Data</span><span
                                class="menu-arrow fa fa-angle-down"></span></a>
                        <ul class="sub-menu js__content">
                            <li><a href="{{ route('admin.products.index') }}"><i
                                        class="ico mdi mdi-cube-outline mr-2"></i>
                                    Produk</a></li>
                            <li><a href="{{ route('admin.branches.index') }}"><i
                                        class="fas fa-code-branch mr-2"></i>
                                    Branch</a></li>
                            <li><a href="{{ route('admin.stores.index') }}"><i
                                        class="far fa-building mr-2"></i>
                                    Toko</a></li>
                            <li><a href="{{ route('admin.users.index') }}"><i
                                        class="far fa-user mr-2"></i>
                                    Users</a></li>
                        </ul>
                    </li>

                    <li>
                        <a class="waves-effect parent-item js__control" href="#"><i
                                class="menu-icon far fa-list-alt"></i><span>Transaksi</span><span
                                class="menu-arrow fa fa-angle-down"></span></a>
                        <ul class="sub-menu js__content">
                            <li><a
                                    href="{{ route('admin.transactions.index', ['type' => 'penarikan']) }}"><i
                                        class="far fa-arrow-alt-circle-left mr-2"></i>
                                    Penarikan</a></li>

                            <li><a
                                    href="{{ route('admin.transactions.index', ['type' => 'pemasangan']) }}"><i
                                        class="far fa-arrow-alt-circle-right mr-2"></i>
                                    Pemasangan</a></li>

                        </ul>
                    </li>
                    <li>
                        <a class="waves-effect parent-item js__control" href="#"><i
                                class="menu-icon fas fa-print"></i><span>Laporan</span><span
                                class="menu-arrow fa fa-angle-down"></span></a>
                        <ul class="sub-menu js__content">
                            <li><a href="{{ route('admin.reports.stock', ['type' => 'terpasang']) }}"><i
                                        class="fa fa-print mr-2"></i>
                                    Stock Terpasang</a></li>
                            <li><a href="{{ route('admin.reports.stock', ['type' => 'repair']) }}"><i
                                        class="fa fa-print mr-2"></i>
                                    Stock Repair</a></li>
                            <li><a href="{{ route('admin.reports.stock', ['type' => 'bk']) }}"><i
                                        class="fa fa-print mr-2"></i>
                                    Stock Gudang BK</a></li>
                            <li><a href="{{ route('admin.reports.transaction', ['type' => 'penarikan']) }}"><i
                                        class="fa fa-print mr-2"></i>
                                    Trans.. Penarikan</a></li>
                            <li><a href="{{ route('admin.reports.transaction', ['type' => 'pemasangan']) }}"><i
                                        class="fa fa-print mr-2"></i>
                                    Trans.. Pemasangan</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- /.navigation -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.main-menu -->

    <div class="fixed-navbar">
        <div class="float-left">
            <button type="button" class="menu-mobile-button fas fa-bars js__menu_mobile"></button>
            <!-- /.page-title -->
        </div>
        <!-- /.float-left -->
        <div class="float-right">
            <div class="ico-item">
                <a href="#" class="ico-item mdi mdi-magnify js__toggle_open" data-target="#searchform-header"></a>
                <form action="#" id="searchform-header" class="searchform js__toggle"><input type="search"
                        placeholder="Search..." class="input-search"><button class="mdi mdi-magnify button-search"
                        type="submit"></button></form>
                <!-- /.searchform -->
            </div>
            <!-- /.ico-item -->
            <a href="#" class="ico-item mdi mdi-email notice-alarm js__toggle_open" data-target="#message-popup"></a>
            <a href="#" class="ico-item pulse"><span class="ico-item mdi mdi-bell notice-alarm js__toggle_open"
                    data-target="#notification-popup"></span></a>
            <a href="{{ route('logout') }}" class="ico-item mdi mdi-logout"></a>
        </div>
        <!-- /.float-right -->
    </div>
    <!-- /.fixed-navbar -->

    <div id="wrapper">
        @yield('content')
    </div>
    <!--/#wrapper -->

    <!-- Placed at the end of the document so the pages load faster -->
    <script src="{{ asset('assets/scripts/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/scripts/modernizr.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/plugin/bootstrap/js/bootstrap.min.js') }}"
        type="text/javascript"></script>
    <script
        src="{{ asset('assets/plugin/mCustomScrollbar/jquery.mCustomScrollbar.concat.min.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('assets/plugin/nprogress/nprogress.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('assets/plugin/sweet-alert/sweetalert.min.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('assets/plugin/waves/waves.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('assets/scripts/main.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/scripts/mycommon.js') }}" type="text/javascript"></script>


    <!-- Sweet Alert -->
    <script src="{{ asset('assets/plugin/sweet-alert/sweetalert.min.js') }}"
        type="text/javascript"></script>
    <!-- Sweet Alert -->

    <!-- Data Tables -->
    <script src="{{ asset('assets/plugin/datatables/media/js/jquery.dataTables.min.js') }}"
        type="text/javascript">
    </script>
    <script
        src="{{ asset('assets/plugin/datatables/media/js/dataTables.bootstrap4.min.js') }}"
        type="text/javascript">
    </script>
    <script
        src="{{ asset('assets/plugin/datatables/extensions/Responsive/js/dataTables.responsive.min.js') }}"
        type="text/javascript"></script>
    <script
        src="{{ asset('assets/plugin/datatables/extensions/Responsive/js/responsive.bootstrap.min.js') }}"
        type="text/javascript"></script>
    <!-- Data Tables -->


    <!-- Select2 -->
    <script src="{{ asset('assets/plugin/select2/js/select2.min.js') }}"
        type="text/javascript"></script>
    <!-- Select2 -->

    <script>
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

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function alert_success(text) {
            swal({
                title: "Berhasil",
                text: text,
                type: "success",
                confirmButtonColor: "#304ffe"
            })
        }

        function alert_failed(text) {
            swal({
                title: "Gagal !",
                text: text,
                type: "error",
                confirmButtonColor: "#304ffe"
            })
        }

        function confirm_delete(url) {
            swal({
                title: 'Yakin mau di hapus ?',
                icon: 'warning',
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus !',
                cancelButtonText: 'Batal',
            }, function (isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        success: function (response) {
                            alert_success(response.message);
                            setTimeout(function () {
                                location.reload();
                            }, 1000);
                        },
                        error: function (xhr) {
                            alert_failed('Terjadi kesalahan !');
                        },
                    });
                }
            });
        }

        $('.format-rupiah').on('keyup', function () {
            $(this).val(formatRupiah(this.value));
        });
    </script>
    @stack('js-custome')
</body>

</html>

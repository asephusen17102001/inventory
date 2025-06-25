<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Home</title>
    <link rel="stylesheet" href="{{ asset('assets/styles/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/styles/custom.css') }}">

    <!-- Sweet Alert -->
    <link rel="stylesheet" href="{{ asset('assets/plugin/sweet-alert/sweetalert.css') }}">

    <!-- Waves Effect -->
    <link rel="stylesheet" href="{{ asset('assets/plugin/waves/waves.min.css') }}">

</head>

<body>

    <div id="single-wrapper">
        <form action="{{ route('login') }}" class="frm-single" style="margin-top: 170px;" method="post">
            @csrf
            <div class="inside">
                <div class="title"><strong>BK</strong> Metalpasindo</div>
                <!-- /.title -->
                <div class="frm-title">Login</div>
                <!-- /.frm-title -->
                <div class="frm-input has-error">
                    <input type="email" name="email" placeholder="Email" class="frm-inp"
                        value="{{ old('email') }}" required><i class="fa fa-user frm-ico"></i>
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <!-- /.frm-input -->
                <div class="frm-input"><input type="password" name="password" required placeholder="Password"
                        value="{{ old('password') }}" class="frm-inp"><i
                        class="fa fa-lock frm-ico"></i></div>
                <!-- /.frm-input -->
                <div class="clearfix margin-bottom-20">
                    {{-- <div class="float-left">
                        <div class="checkbox primary"><input type="checkbox" id="rememberme"><label
                                for="rememberme">Remember me</label></div>
                        <!-- /.checkbox -->
                    </div> --}}
                    <!-- /.float-left -->
                    {{-- <div class="float-right"><a href="#" class="a-link"><i class="fa fa-unlock-alt"></i>Forgot
                            password?</a></div> --}}
                    <!-- /.float-right -->
                </div>
                <!-- /.clearfix -->
                <button type="submit" class="frm-submit">Login<i class="fa fa-arrow-circle-right"></i></button>

                <div class="frm-footer">bkmetalplasindo © 2025.</div>
                <!-- /.footer -->
            </div>
            <!-- .inside -->
        </form>
        <!-- /.frm-single -->
    </div>
    <!--/#single-wrapper -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
		<script src="assets/script/html5shiv.min.js"></script>
		<script src="assets/script/respond.min.js"></script>
	<![endif]-->
    <!-- 
	================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <script src="{{ asset('assets/scripts/jquery.min.js') }}" type="text/javascript"></script>

    <!-- Sweet Alert -->
    <script src="{{ asset('assets/plugin/sweet-alert/sweetalert.min.js') }}"
        type="text/javascript"></script>
    <!-- Sweet Alert -->

    <script>
        function alert_failed(text) {
            swal({
                title: "Gagal !",
                text: text,
                type: "error",
                confirmButtonColor: "#304ffe"
            })
        }

        @session('failed')
        alert_failed("{{ session('failed') }}");
        @endsession

    </script>
</body>

</html>
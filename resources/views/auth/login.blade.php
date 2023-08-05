<!DOCTYPE html>
<html lang="en">

<head>

    <title>{{ $title ?? env('APP_NAME') }}</title>
    <!-- HTML5 Shim and Respond.js IE11 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 11]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="{{ config('app.name') }}" />
    <meta name="keywords" content="{{ config('app.name') }}">
    <meta name="author" content="{{ config('app.name') }} Developer" />

    <!-- Favicon icon -->
    <link rel="icon" href="{{ asset('/') }}img/logo.png" type="image/x-icon">

    <!-- font css -->
    <link rel="stylesheet" href="{{ asset('admin_theme') }}/assets/fonts/font-awsome-pro/css/pro.min.css">
    <link rel="stylesheet" href="{{ asset('admin_theme') }}/assets/fonts/feather.css">
    <link rel="stylesheet" href="{{ asset('admin_theme') }}/assets/fonts/fontawesome.css">

    <!-- vendor css -->
    <link rel="stylesheet" href="{{ asset('admin_theme') }}/assets/css/style.css">
    <link rel="stylesheet" href="{{ asset('admin_theme') }}/assets/css/customizer.css">


</head>

<!-- [ signin-img ] start -->
<div class="auth-wrapper align-items-stretch aut-bg-img">
    <div class="flex-grow-1 d-flex">
        <div class="h-100 d-md-flex align-items-end auth-side-img" style="background-image: url('{{ asset('img/Karacak-Valley-2.jpg') }}')">
            <div class="col-sm-10 auth-content w-auto">
                {{-- <img src="{{ asset('/') }}img/e-wisata.png" alt="{{ config('app.name') }}" class="img-fluid" style="max-width: 400px;"> --}}
                {{-- <h1 class="text-white my-4">Login Sistem</h1>
                <h4 class="text-white font-weight-normal">Silahkan login ke dalam sistem {{ config('app.name') }}</h4> --}}
            </div>
        </div>
        <form method="POST" action="{{ route('login') }}" class="auth-side-form">
            @csrf
            <div class="auth-content">
                <img src="{{ asset('/') }}img/{{ config('app.name') }}.png" alt=""
                    class="img-fluid mb-4 d-block d-xl-none d-lg-none">
                <h3 class="mb-4 f-w-400">Login</h3>
                <h6 class="mb-4 f-w-400">Masukan Username dan Password anda dengan Benar!</h6>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i data-feather="user"></i></span>
                    </div>
                    <input type="text" class="form-control @error('username') is-invalid @enderror" placeholder="Username"  name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                    @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="input-group mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i data-feather="lock"></i></span>
                    </div>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-block btn-success mb-0">Login</button>
                <div class="text-center">
                    <div class="saprator my-4"><span>OR</span></div>
                    <p class="mb-0 text-muted">Belum punya akun? <a href="{{ url('register') }}"
                            class="f-w-400">Daftar Sekarang!</a></p>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- [ signin-img ] end -->

<!-- Required Js -->
<script src="{{ asset('admin_theme') }}/assets/js/vendor-all.min.js"></script>
<script src="{{ asset('admin_theme') }}/assets/js/plugins/bootstrap.min.js"></script>
<script src="{{ asset('admin_theme') }}/assets/js/plugins/feather.min.js"></script>
<script src="{{ asset('admin_theme') }}/assets/js/pcoded.min.js"></script>
<div class="pct-customizer">
    <div href="#!" class="pct-c-btn">
        <button class="btn btn-light-danger" id="pct-toggler">
            <i data-feather="settings"></i>
        </button>
        <button class="btn btn-light-primary" data-toggle="tooltip" title="Document" data-placement="left">
            <i data-feather="book"></i>
        </button>
        <button class="btn btn-light-success" data-toggle="tooltip" title="Buy Now" data-placement="left">
            <i data-feather="shopping-bag"></i>
        </button>
        <button class="btn btn-light-info" data-toggle="tooltip" title="Support" data-placement="left">
            <i data-feather="headphones"></i>
        </button>
    </div>
    <div class="pct-c-content ">
        <div class="pct-header bg-primary">
            <h5 class="mb-0 text-white f-w-500">Nextro Customizer</h5>
        </div>
        <div class="pct-body">
            <h6 class="mt-2"><i data-feather="credit-card" class="mr-2"></i>Header settings</h6>
            <hr class="my-2">
            <div class="theme-color header-color">
                <a href="#!" class="" data-value="bg-default"><span></span><span></span></a>
                <a href="#!" class="" data-value="bg-primary"><span></span><span></span></a>
                <a href="#!" class="" data-value="bg-danger"><span></span><span></span></a>
                <a href="#!" class="" data-value="bg-warning"><span></span><span></span></a>
                <a href="#!" class="" data-value="bg-info"><span></span><span></span></a>
                <a href="#!" class="" data-value="bg-success"><span></span><span></span></a>
                <a href="#!" class="" data-value="bg-dark"><span></span><span></span></a>
            </div>
            <h6 class="mt-4"><i data-feather="layout" class="mr-2"></i>Sidebar settings</h6>
            <hr class="my-2">
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="cust-sidebar">
                <label class="custom-control-label f-w-600 pl-1" for="cust-sidebar">Light Sidebar</label>
            </div>
            <div class="custom-control custom-switch mt-2">
                <input type="checkbox" class="custom-control-input" id="cust-sidebrand">
                <label class="custom-control-label f-w-600 pl-1" for="cust-sidebrand">Color Brand</label>
            </div>
            <div class="theme-color brand-color d-none">
                <a href="#!" class="active" data-value="bg-primary"><span></span><span></span></a>
                <a href="#!" class="" data-value="bg-danger"><span></span><span></span></a>
                <a href="#!" class="" data-value="bg-warning"><span></span><span></span></a>
                <a href="#!" class="" data-value="bg-info"><span></span><span></span></a>
                <a href="#!" class="" data-value="bg-success"><span></span><span></span></a>
                <a href="#!" class="" data-value="bg-dark"><span></span><span></span></a>
            </div>
        </div>
    </div>
</div>
<script>
    // header option
    $('#pct-toggler').on('click', function() {
        $('.pct-customizer').toggleClass('active');

    });
    // header option
    $('#cust-sidebrand').change(function() {
        if ($(this).is(":checked")) {
            $('.theme-color.brand-color').removeClass('d-none');
            $('.m-header').addClass('bg-dark');
        } else {
            $('.m-header').removeClassPrefix('bg-');
            $('.m-header > .b-brand > .logo-lg').attr('src', 'assets/images/logo-dark.svg');
            $('.theme-color.brand-color').addClass('d-none');
        }
    });
    // Header Color
    $('.brand-color > a').on('click', function() {
        var temp = $(this).attr('data-value');
        // $('.header-color > a').removeClass('active');
        // $('.pcoded-header').removeClassPrefix('brand-');
        // $(this).addClass('active');
        if (temp == "bg-default") {
            $('.m-header').removeClassPrefix('bg-');
        } else {
            $('.m-header').removeClassPrefix('bg-');
            $('.m-header > .b-brand > .logo-lg').attr('src', 'assets/images/logo.svg');
            $('.m-header').addClass(temp);
        }
    });
    // Header Color
    $('.header-color > a').on('click', function() {
        var temp = $(this).attr('data-value');
        // $('.header-color > a').removeClass('active');
        // $('.pcoded-header').removeClassPrefix('brand-');
        // $(this).addClass('active');
        if (temp == "bg-default") {
            $('.pc-header').removeClassPrefix('bg-');
        } else {
            $('.pc-header').removeClassPrefix('bg-');
            $('.pc-header').addClass(temp);
        }
    });
    // sidebar option
    $('#cust-sidebar').change(function() {
        if ($(this).is(":checked")) {
            $('.pc-sidebar').addClass('light-sidebar');
            $('.pc-horizontal .topbar').addClass('light-sidebar');
            // $('.m-header > .b-brand > .logo-lg').attr('src', 'assets/images/logo-dark.svg');
        } else {
            $('.pc-sidebar').removeClass('light-sidebar');
            $('.pc-horizontal .topbar').removeClass('light-sidebar');
            // $('.m-header > .b-brand > .logo-lg').attr('src', 'assets/images/logo.svg');
        }
    });
    $.fn.removeClassPrefix = function(prefix) {
        this.each(function(i, it) {
            var classes = it.className.split(" ").map(function(item) {
                return item.indexOf(prefix) === 0 ? "" : item;
            });
            it.className = classes.join(" ");
        });
        return this;
    };

</script>

</html>

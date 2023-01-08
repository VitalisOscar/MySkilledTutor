<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name'))</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>

    <!-- Styles -->
    <link href="{{ asset('static/css/main.css') }}" rel="stylesheet">

    @yield('links')
</head>
<body>
    {{-- If there is a status info or error message, display an alert for it --}}
    <div class="alert-area px-0 col-lg-4 col-xl-5 col-md-6 mx-auto">
        @if (session()->has('status'))
        <div class="alert alert-default mt-3">
            <button type="button" class="close text-white" data-dismiss="alert" aria-label="Close">
                <i class="fa fa-times"></i>
            </button>
            {{ session()->get('status') }}
        </div>
        @endif

        @if ($errors->has('status'))
        <div class="alert alert-danger mt-3">
            <button type="button" class="close text-white" data-dismiss="alert" aria-label="Close">
                <i class="fa fa-times"></i>
            </button>
            {{ $errors->get('status')[0] }}
        </div>
        @endif

        {{-- Auto dismiss the alert --}}
        <script>
            if(document.querySelector('.alert-area .alert') != null){
                setTimeout(function(){
                    document.querySelector('.alert-area .alert .close').click();
                }, 7000);
            }
        </script>
    </div>

    <nav class="top-navbar navbar navbar-expand-md navbar-light border-bottom sticky-top">
        <div class="container-fluid">
            @if(preg_match('/client/', $current_route->getName()))
            <button class="navbar-toggler menu-button text-default mr-3" onclick="$('.sidebar').toggleClass('open')">
                <span class="fa fa-bars"></span>
            </button>
            @endif

            <a class="navbar-brand mr-auto" href="{{ url('/') }}">
                <img class="app-logo" src="{{ asset('static/img/logo.png') }}" alt="{{ config('app.name') }}" >
            </a>

            <div class="ml-auto">
                <a class="d-none d-sm-inline-block btn btn-outline-danger btn-rounded px-4 shadow-none ml-auto" href="{{ route('client.orders.create') }}">
                    <i class="fa fa-plus mr-2"></i>Make Order
                </a>

                <a class="d-sm-none btn btn-text text-default btn-rounded px-2 py-2 shadow-none ml-auto" href="{{ route('client.dashboard') }}">
                    <i class="fa fa-user fa-sm mr-1"></i>User
                </a>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <script src="https://kit.fontawesome.com/ce4529ea37.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Any additional scripts --}}
    @yield('scripts')
</body>
</html>

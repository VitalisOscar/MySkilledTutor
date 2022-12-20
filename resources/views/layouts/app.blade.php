<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name'))</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

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
            <a href="#" class="close text-white" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session()->get('status') }}
        </div>
        @endif

        @if ($errors->has('status'))
        <div class="alert alert-danger mt-3">
            <a href="#" class="close text-white" data-dismiss="alert" aria-label="close">&times;</a>
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

    <nav class="top-navbar navbar navbar-expand-md navbar-light border-bottom">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img class="app-logo" src="{{ asset('static/img/logo.png') }}" alt="{{ config('app.name') }}" >
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link @if($current_route->getName() == 'landing'){{ __('active') }}@endif" href="{{ route('landing') }}">{{ __('Home') }}</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link @if(preg_match('/client./', $current_route->getName())){{ __('active') }}@endif " href="{{ route('client.dashboard') }}">{{ __('Client Area') }}</a>
                    </li>
                </ul>

                <a class="btn btn-outline-danger btn-rounded px-4 shadow-none ml-auto" href="{{ route('client.orders.create') }}">
                    <i class="fa fa-plus mr-2"></i>Make an Order
                </a>

            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>
</body>
</html>

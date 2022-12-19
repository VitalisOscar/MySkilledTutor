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
    <div id="app">
        <nav class="top-navbar navbar navbar-expand-md navbar-light border-bottom">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <strong>{{ config('app.name') }}</strong>
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
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Home') }}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Contact Us') }}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('login') }}">{{ __('Client Area') }}</a>
                        </li>

                        <!-- Authentication Links -->
                        {{-- @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Get Started') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle btn btn-success btn-rounded" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    My Account
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest --}}
                    </ul>

                    <a class="btn btn-outline-danger px-4 shadow-none ml-auto" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <i class="fa fa-plus mr-2"></i>Make an Order
                    </a>

                </div>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>

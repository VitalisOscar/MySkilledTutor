<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('static/css/main.css?v='.$asset_version) }}">
    <link rel="stylesheet" href="{{ asset('static/css/admin.css?v='.$asset_version) }}">

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

    <aside class="sidebar">
        <div class="scroll-wrapper">

            <div class="sidebar-header d-flex align-items-center">
                <h4 class="d-block mb-0">
                    <a class="font-weight-800 text-white" style="color: #fff !important" href="{{ route('admin.dashboard') }}">
                        <img src="{{ asset('static/img/logo.png') }}" class="logo img-fluid" alt="{{ config('app.name') }}">
                    </a>
                </h4>

                <span class="close menu-button ml-auto" onclick="$('.sidebar').removeClass('open')">
                    <i class="fa fa-times"></i>
                </span>
            </div>

            <div class="scroll-inner">

                <div class="sidebar-inner py-4">
                    <div>

                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link @if($current_route->getName() == 'admin.dashboard'){{ __('active') }}@endif " href="{{ route('admin.dashboard') }}">
                                    <i class="fa fa-line-chart text-primary"></i>
                                    <span class="nav-link-text">Dashboard</span>
                                </a>
                            </li>

                        </ul>

                        <h4 class="sidebar-heading text-muted">Orders</h4>

                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link @if(preg_match('/admin.orders.all/', $current_route->getName())){{ __('active') }}@endif " href="{{ route('admin.orders.all', 'active') }}">
                                    <i class="fa fa-tasks text-default"></i>
                                    <span class="nav-link-text">View Orders</span>
                                </a>
                            </li>
                        </ul>

                        <h4 class="sidebar-heading text-muted">Clients</h4>

                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link @if($current_route->getName() == 'admin.clients.all'){{ __('active') }}@endif" href="{{ route('admin.clients.all') }}">
                                    <i class="fa fa-users text-indigo"></i>
                                    <span class="nav-link-text">Clients List</span>
                                </a>
                            </li>
                        </ul>

                        <h4 class="sidebar-heading text-muted">Other</h4>

                        <ul class="navbar-nav mb-4">
                            <li class="nav-item">
                                <a class="nav-link @if($current_route->getName() == 'admin.auth.password'){{ __('active') }}@endif" href="{{ route('admin.auth.password') }}">
                                    <i class="fa fa-lock text-muted"></i>
                                    <span class="nav-link-text">Update Password</span>
                                </a>
                            </li>
                        </ul>

                        <a href="{{ route('admin.auth.logout') }}" class="btn btn-outline-danger btn-block py-2">
                            <i class="fa fa-power-off mr-2"></i>Log Out
                        </a>

                    </div>
                </div>

            </div>
        </div>
    </aside>

    <main class="main-content">
        <nav class="header bg-gradient-white">

            <button class="navbar-toggler menu-button mr-3" onclick="$('.sidebar').toggleClass('open')">
                <span class="fa fa-bars"></span>
            </button>

            <style>
                .page-heading{
                    color: #172b4d !important;
                }

                .page-heading i{
                    display: inline-flex;
                    width: 35px;
                    height: 35px;
                    border-radius: 50%;
                    background: #172b4d;
                    color: #fff;
                    align-items: center;
                    justify-content: center;
                    font-size: .6em !important;
                }

                @media(max-width: 767px){
                    .page-heading i{
                        display: none;
                    }
                }
            </style>

            <h4 class="mb-0 d-none d-md-flex align-items-center page-heading">
                @yield('page_heading')
            </h4>

            <a class="navbar-brand d-block d-md-none logo-on-sm" href="{{ route('admin.dashboard') }}">
                <img src="{{ asset('static/img/logo.png') }}" class="logo img-fluid" alt="{{ config('app.name') }}">
            </a>

            <div class="dropdown float-right ml-auto d-sm-block d-none">
                <ul class="dropdown-menu">
                    <li class="dropdown-item py-0">
                        <a href="{{ route('admin.auth.password') }}" class="py-3 d-flex align-items-center text-border">
                            <i class="fa fa-lock mr-3 text-success"></i>Change Password
                        </a>
                    </li>

                    <li class="dropdown-divider my-0"></li>

                    <li class="dropdown-item py-0">
                        <a href="{{ route('admin.auth.logout') }}" class="py-3 d-flex align-items-center text-border">
                            <i class="fa fa-power-off mr-3 text-danger"></i>Log Out
                        </a>
                    </li>
                </ul>

                <div class="float-right ml-auto d-flex align-items-center dropdown-toggle btn btn-rounded btn-outline-danger py-2 px-4" data-toggle="dropdown">
                    {{ $user->username }}
                </div>
            </div>

        </nav>

        <div class="py-4 px-4 content">

            <h3 class="mb-3 d-flex d-md-none align-items-center page-heading heading-title text-default">
                @yield('page_heading')
            </h3>

            @yield('content')
        </div>
    </main>

    @yield('modals')


    <script src="https://kit.fontawesome.com/ce4529ea37.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Any additional scripts --}}
    @yield('scripts')
</body>
</html>

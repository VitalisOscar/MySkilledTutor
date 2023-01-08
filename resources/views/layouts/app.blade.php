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

    @if(!preg_match('/client/', $current_route->getName() ?? ''))
    <footer class="pt-5 text-white">

        <div class="container">

            <div class="row">

                <div class="col-sm-5">
                    <div class="mb-3">
                        <img class="img-fluid d-block mb-3" style="max-width: 200px;" src="{{ asset('static/img/logo.png') }}" alt="{{ config('app.name') }}" >

                        <p>
                            {{ config('app.name') }} helps students submit quality assignments on time at very pocket friendly pricing.
                            We link clients' assignments with our verified tutors enabling them
                            to scoop the best grades in their assignments leading
                            to a better overall grade.
                        </p>
                    </div>

                </div>

                <div class="col-sm-7">
                    <div class="row">

                        <div class="col-sm">
                            <div>
                                <h6 class="heading text-white">Clients</h6>

                                <ul class="list-unstyled">
                                    <li class="mb-2 px-2">
                                        <a href="{{ route('register') }}">
                                            <i class="fa fa-caret-right mr-1"></i>Registration
                                        </a>
                                    </li>

                                    <li class="mb-2 px-2">
                                        <a href="{{ route('login') }}">
                                            <i class="fa fa-caret-right mr-1"></i>Sign In
                                        </a>
                                    </li>

                                    <li class="mb-2 px-2">
                                        <a href="{{ route('client.dashboard') }}">
                                            <i class="fa fa-caret-right mr-1"></i>My Account
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </div>

                        <div class="col-sm">
                            <div>
                                <h6 class="heading text-white">More Links</h6>

                                <ul class="list-unstyled">
                                    <li class="mb-2 px-2">
                                        <a href="{{ route('client.orders.create') }}">
                                            <i class="fa fa-caret-right mr-1"></i>New Order
                                        </a>
                                    </li>

                                    <li class="mb-2 px-2">
                                        <a href="{{ route('admin.orders.all', 'active') }}">
                                            <i class="fa fa-caret-right mr-1"></i>My Orders
                                        </a>
                                    </li>

                                    <li class="mb-2 px-2">
                                        <a href="{{ route('client.notifications') }}">
                                            <i class="fa fa-caret-right mr-1"></i>Notifications
                                        </a>
                                    </li>

                                    <li class="mb-2 px-2"><a href= "mailto:{{ config('site.contact_email') }}?subject=Site+Help"><i class="fa fa-caret-right mr-1"></i>Feedback</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-sm">
                            <div>

                                <h6 class="heading text-white">Get in touch</h6>
                                <ul class="list-unstyled">
                                    {{-- <li class="px-1 mb-2">
                                        <a href="">
                                            <i class="fa fa-fw fa-map-marker mr-2 text-primary"></i>
                                            Some Place
                                        </a>
                                    </li> --}}
                                    <li class="px-1 mb-2">
                                        <a href="tel:+254790210091">
                                            <i class="fa fa-fw fa-phone mr-2 text-success"></i>
                                            {{ config('site.contact_phone') }}
                                        </a>
                                    </li>
                                    <li class="px-1">
                                        <a href="mailto:info@automanual.co.ke">
                                            <i class="fa fa-fw fa-envelope mr-2 text-warning"></i>
                                            {{ config('site.contact_email') }}
                                        </a>
                                    </li>
                                </ul>

                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>

        <div class="bg-dark p-2 text-center">
            <small>&copy;{{ now()->year }} All Rights Reserved | {{ config('app.name') }}</small>
        </div>

    </footer>
    @endif

    <script src="https://kit.fontawesome.com/ce4529ea37.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Any additional scripts --}}
    @yield('scripts')
</body>
</html>

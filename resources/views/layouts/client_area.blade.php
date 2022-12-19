@extends('layouts.app')

@section('links')
    <link href="{{ asset('static/css/pages/client_area.css') }}" rel="stylesheet">

    @yield('more_links')
@endsection

@section('content')

<div class="container-fluid py-5">

    <div class="row">

        {{-- Sidenav --}}
        <div class="col-lg-3">
            @include('layouts.sidenav')
        </div>

        {{-- Main content --}}
        <div class="col-lg-9 px-md-4 px-lg-5">

            @yield('page_content')

        </div>
        {{-- End Main content --}}

    </div>

</div>

@endsection

@section('scripts')
    @yield('scripts')
@endsection

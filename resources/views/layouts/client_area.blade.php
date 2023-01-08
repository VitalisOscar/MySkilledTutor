@extends('layouts.app')

@section('links')
    <link href="{{ asset('static/css/pages/client_area.css') }}" rel="stylesheet">
    @yield('more_links')
@endsection

@section('content')

{{-- <div class="container-fluid py-5">

    < class="row"> --}}

        {{-- Sidenav --}}
        @include('layouts.sidenav')

        {{-- Main content --}}
        <div class="main-content px-4 px-lg-5 py-4 py-lg-5">

            <div class="container-fluid">
                @yield('page_content')
            </div>

        </div>
        {{-- End Main content --}}

    {{-- </div>

</div> --}}

@endsection

@section('scripts')
    @yield('scripts')
@endsection

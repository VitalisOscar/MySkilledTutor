@extends('layouts.admin')

@section('title', 'Dashboard')

@section('page_heading')
<i class="fa fa-pie-chart mr-3"></i>Admin Dashboard
@endsection

@section('links')
    <link href="{{ asset('static/css/pages/dashboard.css?v='.$asset_version) }}" rel="stylesheet">
    <link href="{{ asset('static/css/pages/orders.css?v='.$asset_version) }}" rel="stylesheet">
@endsection

@section('content')
<div class="col-lg-11 col-xl-10">

    {{-- Summaries --}}
    <div class="row">

        <div class="col-lg-4 col-sm-6">
            <div class="card bg-primary summary">
                <a href="{{ route('admin.clients.all') }}" class="link"></a>

                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <h2 class="summary-count mb-0">{{ $users }}</h2>
                        <i class="summary-icon fa fa-users ml-auto"></i>
                    </div>

                    <span class="summary-label">Verified Users</span>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-sm-6">
            <div class="card bg-warning summary">
                <a href="{{ route('admin.orders.all', 'active') }}" class="link"></a>

                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <h2 class="summary-count mb-0">{{ $active_orders }}</h2>
                        <i class="summary-icon fa fa-edit ml-auto"></i>
                    </div>

                    <span class="summary-label">Active Orders</span>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-sm-6">
            <div class="card bg-success summary">
                <a href="{{ route('admin.orders.all', 'completed') }}" class="link"></a>

                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <h2 class="summary-count mb-0">{{ $completed_orders }}</h2>
                        <i class="summary-icon fa fa-check ml-auto"></i>
                    </div>

                    <span class="summary-label">Completed Orders</span>
                </div>
            </div>
        </div>

    </div>
    {{-- End Summaries --}}


    {{-- Orders --}}
    <div class="mb-4">
        <div class="d-sm-flex align-items-sm-center mb-3">
            <h4 class="mb-sm-0">Recent Orders</h4>

            <a href="{{ route('admin.orders.all', 'active') }}" class="ml-sm-auto btn btn-outline-primary btn-sm">View All</a>
        </div>

        @if(count($recent_orders) == 0)
        <p class="lead">
            There are no orders at the moment. You shall see the most recent orders here
        </p>
        @endif

        @foreach($recent_orders as $order)
        @include('admin.orders._order_item', ['order' => $order])
        @endforeach
    </div>

</div>
@endsection

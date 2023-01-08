@extends('layouts.client_area')

@section('title', 'Client Dashboard')

@section('more_links')
    <link href="{{ asset('static/css/pages/dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('static/css/pages/notifications.css') }}" rel="stylesheet">
@endsection

@section('page_content')
<div>

    {{-- Summaries --}}
    <div class="row">

        <div class="col-lg-4">
            <div class="card bg-gradient-danger summary">
                <a href="{{ route('client.orders.all', 'active') }}" class="link"></a>

                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <h2 class="summary-count mb-0">{{ $all_orders }}</h2>
                        <i class="summary-icon fa fa-tasks ml-auto"></i>
                    </div>

                    <span class="summary-label">All Orders</span>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card bg-gradient-default summary">
                <a href="{{ route('client.orders.all', 'active') }}" class="link"></a>

                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <h2 class="summary-count mb-0">{{ $active_orders }}</h2>
                        <i class="summary-icon fa fa-edit ml-auto"></i>
                    </div>

                    <span class="summary-label">Active Orders</span>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card bg-gradient-success summary">
                <a href="{{ route('client.orders.all', 'completed') }}" class="link"></a>

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

    {{-- Notifications --}}
    <div>
        <div class="d-sm-flex align-items-sm-center mb-3">
            <h4 class="mb-sm-0">Recent Notifications</h4>

            <a href="{{ route('client.notifications') }}" class="ml-sm-auto btn btn-outline-primary btn-sm">View All</a>
        </div>

        @if(count($notifications) == 0)
        <p class="lead">
            There is nothing to bring to your attention at the moment. You shall see your most recent notifications here
        </p>
        @endif

        @foreach($notifications as $notification)
        <div class="notification">
            <a href="{{ route('client.orders.single', $notification->data['order_id']) }}" class="link"></a>

            <div class="d-flex align-items-center">
                <span class="icon icon-shape bg-success text-white">
                    <i class="fa fa-bell"></i>
                </span>

                <div class="ml-3">
                    <h6 class="notification-title">{{ $notification->data['title'] }}</h6>
                    <p class="mb-1 notification-content">
                        {{ $notification->data['message'] }}
                    </p>
                    <div class="text-muted">
                        <i class="fa fa-clock-o mr-2"></i>{{ $notification->created_at->diffForHumans() }}
                    </div>
                </div>
            </div>
        </div>
        @endforeach

    </div>

</div>
@endsection

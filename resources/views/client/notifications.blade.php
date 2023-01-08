@extends('layouts.client_area')

@section('title', 'Notifications')

@section('more_links')
    <link href="{{ asset('static/css/pages/notifications.css') }}" rel="stylesheet">
@endsection

@section('page_content')
<div>

    <div class="d-sm-flex align-items-sm-center mb-3">
        <h4 class="font-weight-600 mb-sm-0">Your Notifications</h4>
    </div>

    <div class="mb-4">

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

        @if($notifications->count() == 0)
        <p class="lead">
            There is nothing to bring to your attention at the moment. You shall see your recent and past notifications here
        </p>
        @endif

    </div>

</div>
@endsection

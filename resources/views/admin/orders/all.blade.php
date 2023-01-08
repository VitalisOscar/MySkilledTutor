@extends('layouts.admin')

@section('title', 'Orders')

@section('links')
<link rel="stylesheet" href="{{ asset('static/css/pages/orders.css?v='.$asset_version) }}">
@endsection

@section('page_heading')
<i class="fa fa-tasks mr-3"></i>Client Orders
@endsection

@section('content')
<div class="row">
    <div class="col-lg-10 col-xl-9">

        <div class="statuses mb-4">
            <a href="{{ route($current_route->getName(), array_merge($current_route->parameters(), ['status' => 'active'])) }}" @if($status == 'active')class="active" @endif>Active</a>
            <a href="{{ route($current_route->getName(), array_merge($current_route->parameters(), ['status' => 'completed'])) }}" @if($status == 'completed')class="active" @endif>Completed</a>
            <a href="{{ route($current_route->getName(), array_merge($current_route->parameters(), ['status' => 'cancelled'])) }}" @if($status == 'cancelled')class="active" @endif>Cancelled</a>
        </div>

        @if($status == 'active')
        <p class="info">
            <span class="info-icon fa fa-info-circle"></span>

            <span class="text">
                Active orders are those that have been paid for by the client and yet to be completed.
            </span>
        </p>
        @elseif($status == 'completed')
        <p class="info">
            <span class="info-icon fa fa-info-circle"></span>

            <span class="text">
                Completed orders are those where the final answer has been submitted to the client. 
            </span>
        </p>
        @elseif($status == 'pending')
        <p class="info">
            <span class="info-icon fa fa-info-circle"></span>

            <span class="text">
                Pending orders are those that have been created but payment is still underway.
            </span>
        </p>
        @elseif($status == 'cancelled')
        <p class="info">
            <span class="info-icon fa fa-info-circle"></span>

            <span class="text">
                Cancelled orders are those which were cancelled or payment failed.
            </span>
        </p>
        @endif

        @if($orders->count() == 0)
        <div class="py-4 col-lg-10 col-xl-9 px-0">
            <h4 class="font-weight-500 mb-0">No Orders</h4>

            <p class="lead mb-4">
                All {{ $status }} orders will be shown here.
                There are none at the moment.
            </p>

        </div>
        @endif

        <div class="mb-4">
            @foreach($orders as $order)
            @include('admin.orders._order_item', ['order' => $order])
            @endforeach
        </div>

        @if($orders->count() > 0)
        <div class="pt-2 d-flex align-items-center">
            <a href="{{ $orders->previousPageUrl() }}" class="mr-auto btn btn-outline-default btn-sm shadow-none py-2 @if($orders->onFirstPage())disabled @endif"><i class="fa fa-angle-double-left mr-1"></i>Prev</a>
            <span>Page {{ $orders->currentPage() }} of {{ $orders->lastPage() }}</span>
            <a href="{{ $orders->nextPageUrl() }}" class="ml-auto btn btn-outline-default btn-sm shadow-none py-2 @if(!$orders->hasMorePages())disabled @endif">Next<i class="fa fa-angle-double-right ml-1"></i></a>
        </div>
        @endif

    </div>
</div>
@endsection

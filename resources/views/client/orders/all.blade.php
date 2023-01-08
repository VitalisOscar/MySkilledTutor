@extends('layouts.client_area')

@section('title', 'Your Orders')

@section('more_links')
<link rel="stylesheet" href="{{ asset('static/css/pages/orders.css?v='.$asset_version) }}">
@endsection

@section('page_content')
<div>

    <div class="d-sm-flex align-items-sm-center mb-3">
        <h4 class="font-weight-600 mb-sm-0">Your Orders</h4>
    </div>

    <div class="row">
        <div class="col-lg-10 col-xl-9">

            <div class="statuses mb-4">
                <a href="{{ route('client.orders.all', 'active') }}" @if($status == 'active')class="active" @endif>Active</a>
                <a href="{{ route('client.orders.all', 'pending') }}" @if($status == 'pending')class="active" @endif>Pending</a>
                <a href="{{ route('client.orders.all', 'completed') }}" @if($status == 'completed')class="active" @endif>Completed</a>
                <a href="{{ route('client.orders.all', 'cancelled') }}" @if($status == 'cancelled')class="active" @endif>Cancelled</a>
            </div>

            @if($status == 'active')
            <p class="info">
                <span class="info-icon fa fa-info-circle"></span>

                <span class="text">
                    Active orders are those that are currently being worked on by a tutor.
                </span>
            </p>
            @elseif($status == 'completed')
            <p class="info">
                <span class="info-icon fa fa-info-circle"></span>

                <span class="text">
                    Completed orders are those that have been worked on by the tutor and the answer submitted to you
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
                    These are orders that have been cancelled and were not worked on to completion.
                </span>
            </p>
            @endif

            @if($orders->count() == 0)
            <div class="py-4 col-lg-10 col-xl-9 px-0">
                <h4 class="font-weight-500 mb-0">No Orders</h4>

                <p class="lead mb-4">
                    All your {{ $status }} orders will be shown here.
                    There are none at the moment. Create an order and
                    we will assign it to an expert writer.
                </p>

                <div>
                    <a href="{{ route('client.orders.create') }}" class="btn btn-link p-0"><i class="fa fa-plus mr-1"></i>Create New Order</a>
                </div>
            </div>
            @endif

            <div class="mb-4">
                @foreach($orders as $order)
                @include('client.orders._order_item', ['order' => $order])
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

</div>
@endsection

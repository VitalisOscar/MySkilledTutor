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
    <div class="col-12">

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

        <div class="card shadow-xs border-none">
            <div class="card-header bg-white border-bottom pb-0">

                <div class="pb-3 d-sm-flex align-items-center">
                    <form class="input-group w-sm-25 ms-auto" action="{{ route('admin.orders.all', 'search') }}">
                        <input name="search" value="{{ request()->get('search') }}" type="text" class="form-control" placeholder="Search order number, keyword...">
                    </form>
                </div>

            </div>

            <div class="card-body px-0 py-0">
                <div class="table-responsive p-0">
                    <table class="table align-items-center justify-content-center mb-0">
                        <thead class="bg-dark">
                            <tr>
                                <th class="text-white text-xs">Title</th>
                                <th class="text-white text-xs">Order Ref</th>
                                <th class="text-white text-xs ps-2">Urgency</th>
                                <th class="text-white text-xs ps-2">Pages</th>
                                <th class="text-white text-xs ps-2">Price</th>
                                <th class="text-white text-xs">Status</th>
                                <th class="text-white text-xs"></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td>
                                    <div class="d-flex p-2">
                                        {{ $order->title }}
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex p-2">
                                        {{ $order->order_number }}
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex p-2">
                                        {{ $order->fmt_urgency }}
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex p-2">
                                        {{ $order->fmt_pages }}
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex p-2">
                                        {{ $order->fmt_price }}
                                    </div>
                                </td>
                                <td class="align-middle">
                                    @if($order->isCancelled())
                                    <span class="badge badge-sm badge-danger">
                                        {{ $order->status }}
                                    </span>
                                    @elseif($order->isActive())
                                    <span class="badge badge-sm badge-info">
                                        {{ $order->status }}
                                    </span>
                                    @else
                                    <span class="badge badge-sm badge-success">
                                        {{ $order->status }}
                                    </span>
                                    @endif
                                </td>
                                <td class="align-middle">
                                    <a href="{{ route('admin.orders.single', $order) }}" class="m-0 btn btn-link text-primary btn-sm">
                                        View
                                    </a>
                                </td>
                            </tr>
                            @endforeach

                            @if($orders->count() == 0)
                            <tr>
                                <td colspan="7">
                                    <div class="px-3 py-2">
                                        No orders here
                                    </div>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>

                    <div class="py-3 px-3 d-flex align-items-center border-top">
                        <p class="font-weight-semibold mb-0 text-dark text-sm">{{ 'Page '. $orders->currentPage() .' of '.$orders->lastPage() }}</p>
                        <div class="ms-auto">
                            @if($orders->currentPage() > 1)
                            <a href="{{ $orders->previousPageUrl() }}" class="btn btn-sm btn-white mb-0">Previous</a>
                            @endif

                            @if($orders->currentPage() != $orders->lastPage())
                            <a href="{{ $orders->nextPageUrl() }}" class="btn btn-sm btn-white mb-0">Next</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

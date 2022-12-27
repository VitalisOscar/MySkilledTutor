@extends('layouts.client_area')

@section('title', 'Your Orders')

@section('page_content')
<div>

    <div class="d-sm-flex align-items-sm-center mb-3">
        <h4 class="font-weight-600 mb-sm-0">Your Orders</h4>
    </div>

    <div class="row">
        <div class="col-12">

            <div class="statuses mb-4">
                <a href="{{ route('client.orders.all', 'active') }}" @if($status == 'active')class="active" @endif>Active</a>
                <a href="{{ route('client.orders.all', 'pending') }}" @if($status == 'pending')class="active" @endif>Pending</a>
                <a href="{{ route('client.orders.all', 'completed') }}" @if($status == 'completed')class="active" @endif>Completed</a>
            </div>

            <style>
                .statuses{
                    overflow-x: hidden;
                    white-space: nowrap;
                }

                .statuses a{
                    display: inline-block;
                    color: #444;
                    padding: 10px 15px;
                    font-weight: 800;
                    border-radius: .3rem;
                    transition: .25s all !important;
                    background: #eee;
                }

                .statuses a:not(:last-child){
                    margin-right: 5px
                }

                .statuses a.active{
                    background: #172b4d;
                    color: #fff;
                }

                .statuses a:not(.active):hover,
                .statuses a:not(.active):focus
                {
                    color: #007cba;
                }
            </style>

            @if($status == 'active')
            <p class="info">
                <span class="info-icon fa fa-info-circle"></span>

                <span class="text">
                    Active orders are those that are currently being worked on by a writer.
                </span>
            </p>
            @elseif($status == 'completed')
            <p class="info">
                <span class="info-icon fa fa-info-circle"></span>

                <span class="text">
                    Completed orders are those that have been worked on by the writer and the answer submitted to you
                </span>
            </p>
            @elseif($status == 'pending')
            <p class="info">
                <span class="info-icon fa fa-info-circle"></span>

                <span class="text">
                    Pending orders are those that have been created but payment is still underway.
                </span>
            </p>
            @endif

            {{-- @if($result->isEmpty()) --}}
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
            {{-- @endif --}}

            <div class="row">
                @foreach($orders as $order)

                @endforeach
            </div>

            {{-- @if(!$result->isEmpty()) --}}
            <div class="pt-2 d-flex align-items-center">
                {{-- @if($result->hasPreviousPage())
                    <a href="{{ $result->prevPageUrl() }}" class="mr-auto btn btn-primary shadow-none py-2"><i class="fa fa-angle-double-left mr-1"></i>Prev</a>
                @endif

                <span>Page {{ $result->page }} of {{ $result->max_pages }}</span>

                @if($result->hasNextPage())
                    <a href="{{ $result->nextPageUrl() }}" class="ml-auto btn btn-primary shadow-none py-2">Next<i class="fa fa-angle-double-right ml-1"></i></a>
                @endif --}}
            </div>
            {{-- @endif --}}

        </div>
    </div>

</div>
@endsection

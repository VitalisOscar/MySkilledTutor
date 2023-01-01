@extends('layouts.admin')

@section('title', 'Clients')

@section('page_heading')
<i class="fa fa-users mr-3"></i>Clients
@endsection

@section('content')
<div>

    <div class="row">
        <div class="col-lg-10">

            <form action="{{ route('admin.clients.all') }}" method="get" class="mb-3 d-sm-flex w-100 align-items-sm-center">
                <input type="text" name="search" class="form-control mr-sm-3 mb-3 mb-sm-0 w-100" placeholder="Search..." value="{{ request()->search }}" />
    
                <select name="order" class="form-control mr-sm-3 mb-3 mb-sm-0">
                    <option value="recent" @if(request()->order == 'recent') selected @endif >Newest clients first</option>
                    <option value="oldest" @if(request()->order == 'oldest') selected @endif >Oldest clients first</option>
                    <option value="atoz" @if(request()->order == 'atoz') selected @endif >Sort by name (A-Z)</option>
                    <option value="ztoa" @if(request()->order == 'ztoa') selected @endif >Sort by name (Z-A)</option>
                </select>
    
                <div>
                    <button type="submit" class="btn btn-outline-danger shadow-none">
                        Refresh
                    </button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table bg-white border">
                    <tr class="bg-default rounded-top text-white sticky-top" style="z-index: unset">
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Orders</th>
                        <th>Joined</th>
                        <th></th>
                    </tr>

                    @foreach($clients as $index => $client)
                    <tr>
                        <td>
                            {{ (($clients->currentPage() - 1) * $clients->perPage()) + $index + 1 }}
                        </td>
                        <td>{{ $client->name }}</td>
                        <td>{{ $client->email }}</td>
                        <td>{{ $client->countable_orders_count }}</td>
                        <td>{{ $client->fmt_created_at }}</td>
                        <td>
                            <a href="{{ route('admin.orders.all.from_client', ['client' => $client, 'status' => 'active']) }}" class="btn btn-sm btn-outline-default shadow-none">View Orders</a>
                        </td>
                    </tr>
                    @endforeach

                    @if($clients->count() == 0)
                    <tr>
                        <td colspan="6">
                            All clients will be shown here. There are none at the moment.
                        </td>
                    </tr>
                    @else
                    <tr>
                        <td colspan="6">
                            <div class="pt-2 d-flex align-items-center">
                                <a href="{{ $clients->previousPageUrl() }}" class="mr-auto btn btn-text btn-link btn-sm shadow-none py-2 @if($clients->onFirstPage())disabled @endif"><i class="fa fa-angle-double-left mr-1"></i>Prev</a>
                                <span>Page {{ $clients->currentPage() }} of {{ $clients->lastPage() }}</span>
                                <a href="{{ $clients->nextPageUrl() }}" class="ml-auto btn btn-text btn-link btn-sm shadow-none py-2 @if(!$clients->hasMorePages())disabled @endif">Next<i class="fa fa-angle-double-right ml-1"></i></a>
                            </div>
                        </td>
                    </tr>
                    @endif

                </table>
            </div>

        </div>
    </div>

</div>
@endsection

@extends('layouts.client_area')

@section('title', 'Order Info - '.$order->title)

@section('more_links')
<link rel="stylesheet" href="{{ asset('static/css/pages/orders.css?v='.$asset_version) }}">
@endsection

@section('page_content')
<div>

    @include('client.orders._saved_order', ['order' => $order])

</div>
@endsection

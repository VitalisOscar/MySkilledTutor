@extends('emails.base')

@section('message')
@if($order->isCompleted())
    Your order <strong>{{ $order->title }}</strong> has been completed.<br>
    Open the order to view or download the final answer
@elseif($order->isCancelled())
    Your order <strong>{{ $order->title }}</strong> has been cancelled.<br>
    Reason: {{ $order->cancellation_reason }}
@elseif($order->didFail())
    We were unable to complete payment processing of <strong>{{ $order->fmt_price }}</strong> for your order <strong>{{ $order->title }}</strong>.<br>
    You can visit our platform and try placing the order again.
@endif

@if(!$order->didFail())
    <br><br>
    {{-- View Order button --}}
    <a href="{{ route('client.orders.single', $order) }}" style="display: inline-block; padding: 15px 20px; background: #f5365c; color: #fff; border-radius: 9px; text-decoration: none !important;">
        View Order
    </a>
@endif

@endsection

@extends('emails.admin')

@section('message')
    A new order <strong>{{ $order->title }}</strong> has just been been paid for by a client.<br>
    <table>
        <tr>
            <th>Urgency:</th>
            <td>{{ $order->fmt_urgency }}</td>
        </tr>

        <tr>
            <th>Pages:</th>
            <td>{{ $order->fmt_pages }}</td>
        </tr>

        <tr>
            <th>Price:</th>
            <td>{{ $order->fmt_price }}</td>
        </tr>
    </table>
    <br>
    Open the order to view the instructions or attached files

    <br><br>
    <a href="{{ route('admin.orders.single', $order) }}" style="display: inline-block; padding: 15px 20px; background: #f5365c; color: #fff; border-radius: 9px; text-decoration: none !important;">
        View Order
    </a>

@endsection

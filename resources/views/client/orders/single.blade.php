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

@section('scripts')
    <script>
        function copy(el) {
            var node = document.getElementById(el);
            navigator.clipboard.writeText(node.innerText);

            if (window.getSelection) {
                var selection = window.getSelection();
                var range = document.createRange();
                range.selectNodeContents(node);
                selection.removeAllRanges();
                selection.addRange(range);
            }else if (document.body.createTextRange) {
                const range = document.body.createTextRange();
                range.moveToElementText(node);
                range.select();
            }
        }
    </script>
@endsection

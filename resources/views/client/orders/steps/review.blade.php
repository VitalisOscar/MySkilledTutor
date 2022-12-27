<div>
    You will pay {{ $order->fmt_price }}
</div>



<div class="d-flex align-items-center">
    <a class="btn btn-white shadow-none" href="{{ route('client.orders.create.requirements', $order) }}">
        <i class="fa fa-arrow-left mr-1"></i>Previous
    </a>

    <button class="btn btn-danger shadow-none ml-auto">
        Complete Payment
    </button>
</div>

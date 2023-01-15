<div>
    @include('client.orders._saved_order', ['order' => $order])
</div>

<p class="info">
    <span class="info-icon">
        <i class="fa fa-info-circle"></i>
    </span>
    <span class="text">
        If you are satisfied that you have provided all the needed information,
        you can complete payment. Once processed, this order will be assigned to
        a tutor. You will be be able to communicate with the tutor via the
        order page as your work is done.
    </span>
</p>

<div class="d-flex align-items-center">
    <a class="btn btn-white shadow-none" href="{{ route('client.orders.create.requirements', $order) }}">
        <i class="fa fa-arrow-left mr-1"></i>Previous
    </a>

    <button class="btn btn-danger shadow-none ml-auto">
        Pay {{ $order->fmt_price }}
    </button>
</div>

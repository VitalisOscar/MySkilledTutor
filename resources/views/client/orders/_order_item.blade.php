<a href="{{ route('client.orders.single', $order) }}" class="order d-flex align-items-center mb-3 bg-white p-3">
    <span class="order-icon">
        <i class="fa fa-file"></i>
    </span>

    <div class="ml-3">
        <h5 class="mb-2">
            {{ $order->title ?? 'Order Title' }}
        </h5>

        {{-- Pages, price, date, notification count --}}
        <div class="d-sm-flex align-items-center mb-2">
            <span>{{ $order->subject->name }}</span>
            <i class="fa fa-circle text-default separator-dot"></i>
            <span>{{ $order->paperType->name }}</span>
            <i class="fa fa-circle text-default separator-dot"></i>
            <span>{{ $order->pages.' page'.($order->pages == 1 ? '':'s') }}</span>
        </div>

        <div class="d-flex align-items-center">
            <i class="fa fa-clock-o mr-1 small text-default"></i>
            
            <span class="mr-4">
                {{ $order->fmt_urgency }}
            </span>
            
            <i class="fa fa-coins mr-1 small text-default"></i>
            
            <span class="">
                {{ $order->fmt_price }}
            </span>
        </div>
    </div>

    <span class="ml-auto mr-3 d-none d-sm-inline-block">
        <i class="fa fa-chevron-right"></i>
    </span>
</a>

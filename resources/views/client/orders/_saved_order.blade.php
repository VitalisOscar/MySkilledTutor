<div class="mb-3">
    <h4 class="font-weight-600 mb-3">{{ $order->title }}</h4>

    <div class="d-sm-flex align-items-center mb-2">
        <span>{{ $order->subject->name }}</span>
        <span class="mx-2">|&nbsp;|</span>
        <span>{{ $order->paperType->name }}</span>
        <span class="mx-2">|&nbsp;|</span>
        <span>{{ 'Level: '.$order->academicLevel->name.' ('.$order->formatting.' Formating)' }}</span>
    </div>
</div>

<div class="row mb-3">
    <div class="col-12 col-sm-4 col-lg-3 d-flex align-items-center">
        <i class="fa fa-fw fa-clock-o"></i>
        <span class="ml-2">
            {{ $order->fmt_urgency }}

            @if($order->isActive() || $order->isCompleted())
            @if($order->deadlineElapsed())
            (Elapsed)
            @else
            ({{ $order->time_remaining.' to go' }})
            @endif
            @endif
        </span>
    </div>
    <div class="col-6 col-sm-4 col-lg-3 d-flex align-items-center">
        <i class="fa fa-fw fa-coins"></i>
        <span class="ml-2">
            {{ $order->fmt_price }}
        </span>
    </div>
    <div class="col-6 col-sm-4 col-lg-3 d-flex align-items-center">
        <i class="fa fa-fw fa-file"></i>
        <span class="ml-2">
            {{ $order->fmt_pages }}
        </span>
    </div>
    <div class="col-6 col-sm-4 col-lg-3 d-flex align-items-center">
        <i class="fa fa-fw fa-tasks"></i>
        <span class="ml-2">
            {{ $order->status }}
        </span>
    </div>
</div>

{{-- Check status --}}
@if($order->isPendingPayment())
<div class="info">
    <i class="info-icon fa fa-info-circle"></i>
    <span class="text">
        Order is currently pending payment. A tutor will be assigned the order once payment is done.
    </span>
</div>
@elseif($order->isActive())
<div class="info">
    <i class="info-icon fa fa-info-circle"></i>
    <span class="text">
        This order is currently assigned to a tutor.
        You can use the chat to communicate with the tutor, send additional material or raise any concerns.
    </span>
</div>
@elseif($order->isCompleted())
<div class="info">
    <i class="info-icon fa fa-info-circle"></i>
    <span class="text">
        This order has been completed by the tutor. You can download the final answer.
    </span>
</div>
@elseif($order->isCancelled())
<div class="info">
    <i class="info-icon fa fa-info-circle"></i>
    <span class="text">
        This order was cancelled after being assigned to a tutor.
    </span>
</div>
@endif

{{-- Order details --}}
<div class="mb-3">
    <h5 class="heading mb-3">Instructions</h5>
    <div class="mb-4">
        <div>
            {!! $order->instructions ?? 'None provided' !!}
        </div>
    </div>

    @if($order->attachments->count() > 0)
        <h5 class="heading mb-3">Attached Files</h5>

        <div class="mb-4">
            <div>
                <div class="row">
                    @foreach($order->attachments as $attachment)
                    <div class="col-6 col-sm-4 col-md-3 col-xl-2">
                        <a title="{{ $attachment->name }}" href="{{ \Illuminate\Support\Facades\URL::temporarySignedRoute('get_attachment', now()->addMinutes(60), ['order' => $order, 'attachment' => $attachment]) }}" class="attachment" @if($attachment->isImage()) target="_blank" @endif >
                            <div class="preview d-flex align-items-center justify-content-center">
                                @if($attachment->isImage())
                                <i class="preview-icon fa fa-image"></i>
                                @elseif($attachment->isPdf())
                                <i class="preview-icon fa fa-file-pdf-o"></i>
                                @elseif($attachment->isWordDoc())
                                <i class="preview-icon fa fa-file-word-o"></i>
                                @elseif($attachment->isZip())
                                <i class="preview-icon fa fa-file-zip-o"></i>
                                @else
                                <i class="preview-icon fa fa-file-o"></i>
                                @endif
                            </div>

                            <h6 class=" text-truncate px-3 py-2 mb-0">{{ $attachment->name }}</h6>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

</div>


@if($order->didFail())
<div class="info mb-4">
    <i class="info-icon fa fa-info-circle"></i>
    <div class="text">
        <div>
            Payment for this order was not completed and order cannot be done

            <form action="{{ route('client.orders.retry_payment', $order) }}" method="post">
                @csrf
                <button class="btn btn-link py-2 px-0">Retry Payment</button>
            </form>
        </div>
    </div>
</div>
@endif

{{-- Order chat --}}
{{-- Show this message for active or completed orders --}}
@if($order->isActive() || $order->isCompleted())
<div class="info mb-4">
    <i class="info-icon fa fa-info-circle"></i>
    <div class="text">
        <div>
            Use this chat to communicate with the tutor e.g:
            <ul class="px-3">
                <li>To send any additional material/clarification</li>
                <li>To raise any concerns or ask questions</li>
            </ul>
            You will get your responses here. When an answer is ready, it will be sent
            here as well
        </div>
    </div>
</div>
@endif

{{-- Show past messages for orders with past messages --}}
@if($order->hasMessages())
@php
$last_sender = null;
@endphp

@foreach ($order->messages as $message)
@php
if($message->sender_type == $last_sender){
    // Continuous
    $continuous = true;
}else{
    $continuous = false;
}

$last_sender = $message->sender_type;
@endphp

@include('client.orders._message', ['message' => $message, 'continuous' => $continuous])
@endforeach
@endif

{{-- For an order that was cancelled --}}
@if ($order->isCancelled())
<div class="info">
    <i class="info-icon fa fa-info-circle"></i>
    <span class="text">
        This order was cancelled: {{ $order->cancellation_reason }}
    </span>
</div>
@endif

{{-- Allow send message for active and complete orders --}}
@if($order->isActive() || $order->isCompleted())
<form action="{{ route('client.orders.send_message', $order) }}" method="post" class="pt-3" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <label for="message">New Message</label>
        <textarea name="message" placeholder="" id="message" class="form-control" rows="4">{{ old('message') }}</textarea>
        @error('message')
        <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group">
        <label>Attach Files</label>
        <div class="custom-file">
            <input type="file" name="attachments[]" id="attachment" class="form-control-file" multiple>
        </div>
        @error('attachments')
        <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-danger shadow-none px-4">Send</button>
    </div>

</form>

@endif

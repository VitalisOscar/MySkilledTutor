@extends('layouts.client_area')

@section('title', 'Order Info - '.$order->title)

@section('more_links')
<link rel="stylesheet" href="{{ asset('static/css/pages/orders.css') }}">
@endsection

@section('page_content')
<div>

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
        <div class="col-6 col-sm-4 d-flex align-items-center">
            <i class="fa fa-clock-o"></i>
            <span class="ml-2">
                {{ $order->fmt_urgency }}
            </span>
        </div>
        <div class="col-6 col-sm-4 d-flex align-items-center">
            <i class="fa fa-coins"></i>
            <span class="ml-2">
                {{ $order->fmt_price }}
            </span>
        </div>
        <div class="col-6 col-sm-4 d-flex align-items-center">
            <i class="fa fa-file"></i>
            <span class="ml-2">
                {{ $order->fmt_pages }}
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
            This order was cancelled as a result of a failed or cancelled payment and was not assigned to a tutor.
        </span>
    </div>
    @endif

    {{-- Time remaining --}}
    @if($order->isActive() || $order->isCompleted())
    <div>
        Time Left: {{ $order->time_remaining }}
    </div>
    @endif

    {{-- Order details --}}
    <div class="mb-3">
        @if(!$order->instructions)
        <div class="mb-3">
            <div>
                {!! $order->instructions !!}
            </div>
        </div>
        @endif

        @if($order->attachments->count() > 0)
        <div class="mb-3">
            <div>
                <ul class="attachments list-unstyled">
                    @foreach($order->attachments as $attachment)
                    <li>
                        <a href="{{ $attachment->url }}" class="attachment d-block" target="_blank">
                            {{-- If image, show an image preview, else, show a document icon --}}
                            @if($attachment->isImage())
                            <div class="preview d-flex">
                                <img src="{{ $attachment->url }}" alt="{{ $attachment->name }}">
                            </div>
                            @else
                            <div class="preview d-flex align-items-center justify-content-center">
                                {{-- May be pdf, word doc or zip file --}}
                                @if($attachment->isPdf())
                                <i class="preview-icon fa fa-file-pdf-o"></i>
                                @elseif($attachment->isWordDoc())
                                <i class="preview-icon fa fa-file-word-o"></i>
                                @elseif($attachment->isZip())
                                <i class="preview-icon fa fa-file-zip-o"></i>
                                @else
                                <i class="preview-icon fa fa-file-o"></i>
                                @endif
                            </div>
                            @endif

                            <h6 class=" text-truncate px-3 py-2 mb-0">{{ $attachment->name }}</h6>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif

    </div>


</div>
@endsection

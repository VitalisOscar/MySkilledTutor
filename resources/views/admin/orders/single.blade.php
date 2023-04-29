@extends('layouts.admin')

@section('title', 'Order Info - '.$order->title)

@section('links')
<link rel="stylesheet" href="{{ asset('static/css/pages/orders.css?v='.$asset_version) }}">
@endsection

@section('page_heading')
<i class="fa fa-file mr-3"></i>{{ 'Order: ' . $order->title }}
@endsection

@section('content')
<div class="row">
    <div class="col-lg-10 col-xl-10">

        <div class="mb-3">

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
        @if($order->isActive())
        <div class="info">
            <i class="info-icon fa fa-info-circle"></i>
            <span class="text">
                This order has been paid for.
            </span>
        </div>
        @elseif($order->isCompleted())
        <div class="info">
            <i class="info-icon fa fa-info-circle"></i>
            <span class="text">
                This order has been marked as complete. You can still use the chat to communicate with the client.
            </span>
        </div>
        @elseif($order->isCancelled())
        <div class="info">
            <i class="info-icon fa fa-info-circle"></i>
            <span class="text">
                This order was cancelled by an admin.
            </span>
        </div>
        @endif

        <div class="d-flex align-items-center my-3">
            <strong class="font-weight-700">Order Ref:</strong>
            <span class="ml-2" id="order_number">{{ $order->order_number }}</span>
            <button onclick="copy('order_number')" class="ml-4 btn btn-text btn-sm px-2">
                <i class="fa fa-copy mr-1"></i>Copy
            </button>
        </div>

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

        {{-- Order chat --}}
        {{-- Show this message for active or completed orders --}}
        @if($order->isActive() || $order->isCompleted())
        <div class="info mb-4">
            <i class="info-icon fa fa-info-circle"></i>
            <div class="text">
                <div>
                    Use this chat to communicate with the client when:
                    <ul class="px-3">
                        <li>Requesting additional material/clarification</li>
                        <li>Responding to any concerns or questions</li>
                    </ul>
                    When the solution to the order is ready,
                    zip and attach the necessary files, tick the "Mark as answer" checkbox and send
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

        @include('admin.orders._message', ['message' => $message, 'continuous' => $continuous])
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
        <form action="{{ route('admin.orders.send_message', $order) }}" method="post" class="pt-3" enctype="multipart/form-data">
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
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="complete" id="complete" class="custom-control-input" >
                    <label for="complete" class="custom-control-label mb-0">Mark as answer</label>
                </div>
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

            <div class="form-group d-flex align-items-center">
                <button type="submit" class="btn btn-danger shadow-none px-4">Send</button>

                @if($order->isActive())
                <div class="ml-sm-auto d-flex align-items-center">
                    <span>Or</span>&nbsp;
                    <a data-toggle="modal" href="#cancelOrder">Cancel Order</a>
                </div>
                @endif
            </div>

        </form>

        @endif

    </div>
</div>
@endsection

@section('modals')
{{-- Order cancellation modal --}}
@if($order->isActive())
<div class="modal fade" id="cancelOrder">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <h5 class="mb-0">Cancel Order</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span>&times;</span>
                </button>
            </div>

            <form action="{{ route('admin.orders.cancel', $order) }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="reason">Reason for cancellation</label>
                        <textarea name="reason" id="reason" class="form-control" rows="4">{{ old('reason') }}</textarea>
                        @error('reason')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary shadow-none" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger shadow-none">Cancel Order</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
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

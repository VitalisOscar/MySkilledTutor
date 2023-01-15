<div class="message @if($message->byCurrent()) sent @endif @if($message->is_answer) is_answer @endif @if($continuous) continuous @endif ">
    <div class="message-header">
        @if(!$message->byCurrent())
        <div class="d-flex align-items-center justify-content-end">
            <div class="meta mr-3">
                <strong class="name">{{ $message->sender->message_sender_name }}</strong>
            </div>
            <div class="avatar">
                <img src="{{ asset('static/img/icons/user.png') }}" alt="{{ $message->sender->message_sender_name }}">
            </div>
        </div>
        @else
        <div class="d-flex align-items-center">
            <div class="avatar mr-3">
                <img src="{{ asset('static/img/icons/user.png') }}" alt="{{ $message->sender->message_sender_name }}">
            </div>
            <div class="meta">
                <strong class="name">{{ $message->sender->message_sender_name }}</strong>
            </div>
        </div>
        @endif
    </div>

    <div class="message-body pt-2">

        @if($message->is_answer)
        <div class="mb-2">
            <strong style="font-size: .9em" class="text-success">
                <i class="fa fa-check-circle-o mr-2"></i> ANSWER
            </strong>
        </div>
        @endif

        <div class="text">
            {!! $message->message !!}
        </div>

        @if(count($message->attachments) > 0)
        <div class="attachments mt-2">
            <div class="row">
                @foreach($message->attachments as $attachment)
                    <div class="col-6 col-sm-4 col-md-3 col-xl-2">
                        <a title="{{ $attachment->name }}" href="{{ \Illuminate\Support\Facades\URL::temporarySignedRoute('get_attachment', now()->addMinutes(60), ['order' => $order, 'attachment' => $attachment, 'message' => $message]) }}" class="attachment" @if($attachment->isImage()) target="_blank" @endif >
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
        @endif

        <div class="small">
            <i class="fa fa-clock-o mr-1"></i>{{ $message->created_at->diffForHumans() }}
        </div>
    </div>
</div>

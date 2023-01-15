<div class="form-group mb-4">
    <label class="font-weight-600">Title</label>

    <p class="mb-0">
        Try to summarize what you want done in the title
    </p>

    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">
                <i class="fa fa-tag"></i>
            </span>
        </div>

        <input name="title" class="form-control" value="{{ old('title') ?? $order->title }}" required>
    </div>

    @error('title')
        <span class="small text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror

</div>

<div class="form-group mb-4">
    <label class="font-weight-600">Requirements</label>

    <p class="mb-0">
        Describe your assignment needs, any special requests e.g. number of sources, number of pages, spacing etc.
    </p>

    <div class="input-group">
        <textarea name="instructions" class="form-control" rows="6">{{ old('instructions') ?? $order->instructions }}</textarea>
    </div>

    @error('instructions')
        <span class="small text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror

</div>

<div class="form-group mb-4">
    <label class="font-weight-600">Attachments</label>

    <p class="mb-0">
        Attach any files that contain additional info or data relating to this assignment.
        Supported files are images, .docx and .pdf documents and zip files
    </p>

    {{-- Selected files --}}
    <div class="selected-files">
        @foreach ($order->attachments ?? [] as $attachment)
            <div class="d-flex align-items-center">
                <a href="{{ $attachment->url }}" target="_blank">{{ $attachment->name }}</a>

                <form id="delete_attachment_{{ $attachment->id }}" action="{{ route('delete_attachment', ['order' => $order, 'attachment' => $attachment]) }}" method="post">
                    @csrf
                </form>

                <span style="cursor: pointer" class="p-1 ml-auto text-danger" title="Delete attachment" onclick="if(confirm('Delete attachment {{ $attachment->name }}?')){document.querySelector('#delete_attachment_{{ $attachment->id }}').submit()}">
                    <i class="fa fa-times"></i>
                </span>
            </div>
        @endforeach
    </div>

    <input type="file" name="attachments[]" class="form-control-file" multiple>

    @error('attachments')
        <span class="small text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror

    @error('attachments.*')
        <span class="small text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror

</div>

<div class="form-group mb-4">
    <label class="font-weight-600">Formating Style</label>

    <p class="mb-0">
        Select the formatting style you want your assignment done in
    </p>

    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">
                <i class="fa fa-edit"></i>
            </span>
        </div>

        <select name="formatting" class="form-control" required>
            <option value="">Select Formatting</option>
            @foreach ($formatting as $option)
                <option value="{{ $option }}" @if(old('formatting') ?? $order->formatting == $option){{ __('selected') }}@endif>
                    {{ $option }}
                </option>
            @endforeach
        </select>

    </div>

    @error('formatting')
        <span class="small text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror

</div>

<div class="form-group mb-4">
    <label class="font-weight-600">Page Count</label>

    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">
                <i class="fa fa-file-o"></i>
            </span>
        </div>

        <input name="pages" class="form-control" placeholder="Pages" value="{{ old('pages') ?? $order->pages }}" required>
    </div>

    @error('pages')
        <span class="small text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror

</div>

<div class="form-group mb-4">
    <label class="font-weight-600">Urgency</label>

    <p class="mb-0">
        How soon do you need your assignment done?
    </p>

    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">
                <i class="fa fa-clock-o"></i>
            </span>
        </div>

        @php
            $urgency = old('urgency') ?? $order->urgency ?? 3;

            $urgency_type = old('urgency_type') ?? $order->urgency_type;

            if($order && !$urgency_type){
                if($urgency > 24 && $urgency % 24 == 0){
                    $urgency /= 24;
                    $urgency_type = 'days';
                }else{
                    $urgency_type = 'hours';
                }
            }else{
                $urgency_type = 'days';
            }

        @endphp

        <input name="urgency" class="form-control" placeholder="e.g 4" value="{{ $urgency }}" required>

        <select name="urgency_type" class="form-control">
            <option value="days" @if($urgency_type == 'days'){{ __('selected') }}@endif>
                Days
            </option>
            <option value="hours" @if($urgency_type == 'hours'){{ __('selected') }}@endif>
                Hours
            </option>
        </select>
    </div>

    @error('urgency')
        <span class="small text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror

    @error('urgency_type')
        <span class="small text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror

</div>

<div class="d-flex align-items-center">
    <a class="btn btn-white shadow-none" href="{{ route('client.orders.create', $order) }}">
        <i class="fa fa-arrow-left mr-1"></i>Previous
    </a>

    <button class="btn btn-danger shadow-none ml-auto">
        Next<i class="fa fa-arrow-right ml-1"></i>
    </button>
</div>

<div class="form-group mb-4">
    <p>
        Select a subject that is as close as possible to
        your actual assignment from the given list below
    </p>

    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">
                <i class="fa fa-book"></i>
            </span>
        </div>

        <select name="subject" class="form-control">
            <option value="">Select a subject</option>
            @foreach ($subjects as $option)
                <option value="{{ $option->id }}" @if((old('subject') ?? $order->subject_id ?? null) == $option->id){{ __('selected') }}@endif >
                    {{ $option->name }}
                </option>
            @endforeach
        </select>
    </div>

    @error('subject')
        <span class="small text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror

</div>

<div class="form-group mb-4">
    <p>
        Select the academic level you need your assignment done.
        We will select a writer who is qualified in providing services in that level.
    </p>

    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">
                <i class="fa fa-university"></i>
            </span>
        </div>

        <select name="academic_level" class="form-control">
            <option value="">Select a level</option>
            @foreach ($academic_levels as $option)
                <option value="{{ $option->id }}" @if((old('academic_level') ?? $order->academic_level_id ?? null) == $option->id){{ __('selected') }}@endif>
                    {{ $option->name }}
                </option>
            @endforeach
        </select>
    </div>

    @error('academic_level')
        <span class="small text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror

</div>

<div class="form-group mb-4">
    <p>
        Select the type of paper you need.
        You will specify more requirements in the next step
    </p>

    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">
                <i class="fa fa-file"></i>
            </span>
        </div>

        <select name="paper_type" class="form-control">
            <option value="">Select a value</option>
            @foreach ($paper_types as $option)
                <option value="{{ $option->id }}" @if((old('paper_type') ?? $order->paper_type_id ?? null) == $option->id){{ __('selected') }}@endif>
                    {{ $option->name }}
                </option>
            @endforeach
        </select>
    </div>

    @error('paper_type')
        <span class="small text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror

</div>

<div class="d-flex align-items-center">
    <button class="btn btn-danger shadow-none ml-auto">
        Next<i class="fa fa-arrow-right ml-1"></i>
    </button>
</div>

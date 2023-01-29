@extends('layouts.admin')

@section('title', 'Create FAQs')

@section('page_heading')
<i class="fa fa-tasks mr-3"></i>Create FAQs
@endsection

@section('content')
<section class="">
    <div class="row">
        <div class="col-md-10 col-lg-7 col-xl-6 mx-auto">

            <div class="card shadow-sm">
                <form method="post">
                    @csrf

                    <div class="card-body">

                        <div class="form-group mb-4">
                            <label>Question</label>

                            <input class="form-control rounded-0" name="question" type="text" value="{{ old('question') }}" required />

                            @error('question')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label>Answer</label>

                            <textarea class="form-control rounded-0" name="answer" rows="5" required>{{ old('answer') }}</textarea>

                            @error('answer')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-default">Save</button>

                    </div>

                </form>
            </div>

        </div>
    </div>
</section>
@endsection

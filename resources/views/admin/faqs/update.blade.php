@extends('layouts.admin')

@section('title', 'Update FAQ')

@section('page_heading')
<i class="fa fa-tasks mr-3"></i>Update FAQ
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

                            <input class="form-control rounded-0" name="question" type="text" value="{{ old('question') ?? $faq->question }}" required />

                            @error('question')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label>Answer</label>

                            <textarea class="form-control rounded-0" name="answer" rows="5" required>{{ old('answer') ?? $faq->answer }}</textarea>

                            @error('answer')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="d-flex align-items-center">
                            <button type="submit" class="btn btn-default">Update</button>
                        </div>

                    </div>

                </form>
            </div>

            <form method="post" class="delete-faq mt-4 text-right">
                @csrf
                @method('DELETE')
                <button type="button" onclick="if(confirm('Are you sure you want to delete the FAQ?')){ $('.delete-faq').submit() }" class="btn btn-link ml-auto">Delete FAQ</button>
            </form>

        </div>
    </div>
</section>
@endsection

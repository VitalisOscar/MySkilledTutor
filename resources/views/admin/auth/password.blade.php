@extends('layouts.admin')

@section('title', 'Update your password')

@section('page_heading')
<i class="fa fa-lock mr-3"></i>Update Password
@endsection

@section('content')

<!-- Main content -->
<section class="">
    <div class="row">
        <div class="col-md-10 col-lg-7 col-xl-6">

            <div class="card shadow-sm">
                <form role="form" method="post">
                    @csrf

                    <div class="card-body">

                        <div class="form-group mb-4">
                            <label>Your Current Password</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-fw fa-lock"></i>
                                    </span>
                                </div>
                                <input class="form-control rounded-0" name="current_password" type="password" value="{{ old('current_password') }}" required />
                            </div>
                            @error('current_password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label>New Password</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-fw fa-lock"></i>
                                    </span>
                                </div>
                                <input class="form-control rounded-0" name="password" type="password" value="{{ old('password') }}" required />
                            </div>
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label>Confirm New Password</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-fw fa-lock"></i>
                                    </span>
                                </div>
                                <input class="form-control rounded-0" name="password_confirmation" type="password" value="{{ old('password_confirmation') }}" required />
                            </div>
                            @error('password_confirmation')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-default">Save Changes</button>

                    </div>

                </form>
            </div>

        </div>
    </div>
</section>

@endsection

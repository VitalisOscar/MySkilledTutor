@extends('layouts.client_area')

@section('title', 'Account Settings')

@section('more_links')
    <link href="{{ asset('static/css/pages/notifications.css?v='.$asset_version) }}" rel="stylesheet">
@endsection

@section('page_content')
<div>

    <div class="row">
        <div class="col-md-6 col-lg-7">

            <div class="mb-5">
                <h5 class="font-weight-600">Personal Info</h5>

                <form method="POST">
                    @csrf

                    <p>View your personal information. This information is usually verified and hence cannot be freely updated</p>

                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-sm-3 col-md-12 col-lg-4 d-flex align-items-center">
                                <strong>Name:</strong>
                            </div>

                            <div class="col-sm-9 col-md-12 col-lg-8">
                                <input class="form-control" value="John Doe" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-sm-3 col-md-12 col-lg-4 d-flex align-items-center">
                                <strong>Email:</strong>
                            </div>

                            <div class="col-sm-9 col-md-12 col-lg-8">
                                <input class="form-control" value="john@gmail.com" disabled>
                            </div>
                        </div>
                    </div>

                    {{-- <div>
                        <button class="btn btn-default py-2 shadow-none">Save Changes</button>
                    </div> --}}
                </form>
            </div>


            <div class="mb-4">

                <h5 class="font-weight-600">Verification</h5>

                <p>
                    To ensure that we have contact information from the rightful person, we require your account to be verified
                </p>

                <div>

                    <div>
                        <h6 class="mb-1">Email Address</h6>
                        <p class="mb-0">
                            Verified on {{ $user->email_verified_at->format('M d, Y') }}
                        </p>
                    </div>

                </div>
            </div>

        </div>

        <div class="col-md-6 col-lg-5 pl-lg-5">

            <div>
                <h5 class="font-weight-600">Change your Password</h5>

                <form action="{{ route('client.account.password') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <strong>Current Password:</strong>
                        <br><small>We need this to confirm that it is you making this change</small>
                        <input class="form-control" type="password" name="password" value="{{ old('password') }}" required>
                        @error('password')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <strong>New Password:</strong>
                        <br><small>Enter the new password that you want to be using</small>
                        <input class="form-control" type="password" name="new_password" value="{{ old('new_password') }}" required>
                        @error('new_password')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <strong>Confirm Password:</strong>
                        <br><small>Retype your new password</small>
                        <input class="form-control" type="password" name="confirm_password" value="{{ old('confirm_password') }}" required>
                        @error('confirm_password')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div>
                        <button class="btn btn-default btn-block py-2 shadow-none"><i class="fa fa-lock mr-2"></i>Save Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection

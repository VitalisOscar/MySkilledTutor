@extends('layouts.app')

@section('links')
<link rel="stylesheet" href="{{ asset('static/css/auth.css') }}" />
@endsection

@section('title', 'Reset password')

@section('content')
<section class="py-4 py-md-5">
    <div class="container">

        <div class="row">

            <div class="col main-content">

                <form class="auth-form" method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="mb-4 text-center">
                        <h4 class="mb-0">Reset Password</h4>

                        <h6>{{ $email ?? old('email') }}</h6>
                    </div>

                    <div class="auth-card border mb-4">

                        <div class="p-4">

                            <div class="form-group d-none mb-3">
                                <label>Your Email</label>
                                <div class="input-group bg-white">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-fw fa-envelope"></i>
                                        </span>
                                    </div>
                                    <input class="form-control" name="email" placeholder="Email Address" value="{{ $email ?? old('email') }}" type="email" required />
                                </div>
                                @error('email')
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
                                    <input class="form-control rounded-0" placeholder="New Password" name="password" id="password" type="password" value="{{ old('password') }}" required />
                                    <div class="input-group-append pass-toggle">
                                        <span class="input-group-text" onclick="togglePassword('password', this)">
                                            <i class="fa fa-fw fa-eye"></i>
                                        </span>
                                    </div>
                                </div>
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label>Confirm Password</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-fw fa-lock"></i>
                                        </span>
                                    </div>
                                    <input class="form-control rounded-0" placeholder="Confirm Password" name="password_confirmation" id="password_confirmation" type="password" value="{{ old('password_confirmation') }}" required />
                                    <div class="input-group-append pass-toggle">
                                        <span class="input-group-text" onclick="togglePassword('password_confirmation', this)">
                                            <i class="fa fa-fw fa-eye"></i>
                                        </span>
                                    </div>
                                </div>
                                @error('password_confirmation')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <button class="btn btn-danger btn-block shadow-none">Save Password</button>
                            </div>

                        </div>

                    </div>

                    <div class="text-center mb-3">
                        <a href="{{ route('login') }}">Back to login</a></span>
                    </div>

                </form>

            </div>

        </div>
    </div>
</section>
@endsection

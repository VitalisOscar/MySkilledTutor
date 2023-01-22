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

                <form class="auth-form" method="post" action="{{ route('password.email') }}">
                    @csrf

                    <div class="mb-4 text-center">
                        <h4 class="mb-0">Reset Password</h4>
                    </div>

                    <div class="auth-card border mb-4">

                        <div class="p-4">

                            <div class="form-group mb-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-fw fa-envelope"></i>
                                        </span>
                                    </div>
                                    <input class="form-control" name="email" placeholder="Your Email Address" value="{{ old('email') }}" type="email" required />
                                </div>
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <button class="btn btn-danger btn-block shadow-none">Send Reset Link</button>
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

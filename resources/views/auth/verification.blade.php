@extends('layouts.app')

@section('title', 'Verify Email')

@section('links')
<link rel="stylesheet" href="{{ asset('static/css/auth.css') }}" />
@endsection

@section('content')
<section class="py-4 py-md-5">
    <div class="container">

        <div class="row">

            <div class="col main-content">

                <form class="auth-form" method="post" autocomplete="off">
                    @csrf

                    <div class="mb-4 text-center">
                        <h4 class="mb-0">Verify your email</h4>
                    </div>

                    <div class="auth-card border mb-4">

                        <div class="p-4">

                            <div class="mb-3">
                                We sent a code to your registered email, <strong>{{ $email }}</strong>.
                                Enter the verification code to continue using the site
                            </div>

                            <div class="form-group mb-3">
                                <div class="input-group">
                                    <input class="form-control" name="code" placeholder="Verification Code" value="{{ old('code') }}" type="number" required />
                                </div>
                                @error('code')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <button class="btn btn-danger mb-3 btn-block shadow-none">Verify Code</button>
                            </div>

                            <hr class="my-3">

                            <div>
                                <div class="mb-2">
                                    If you did not receive the code and it is not in your spam inbox, request a new one.
                                </div>

                                <button onclick="document.querySelector('.new_code').submit()" type="button" class="btn btn-outline-default btn-block shadow-none">Send Code Again</button>
                            </div>

                        </div>

                    </div>


                    <div class="text-center mb-3">
                        <a href="#" onclick="document.querySelector('.logout').submit()">Sign Out</a>
                    </div>

                </form>

                <form class="logout" action="{{ route('logout') }}" method="post">
                    @csrf
                </form>

                <form class="new_code" action="{{ route('get_verification_code') }}" method="post">
                    @csrf
                </form>

            </div>

        </div>
    </div>
</section>
@endsection

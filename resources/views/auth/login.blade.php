@extends('layouts.app')

@section('title', 'Login')

@section('links')
<link rel="stylesheet" href="{{ asset('static/css/auth.css') }}" />
@endsection

@section('content')
<section class="py-4 py-md-5">
    <div class="container">

        <div class="row">

            <div class="col main-content">

                <form class="auth-form">

                    <div class="mb-4 text-center">
                        <h4 class="mb-0">Log in to your account</h4>
                    </div>

                    <div class="auth-card border mb-4">

                        <div class="p-4">

                            <div class="form-group mb-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-fw fa-envelope"></i>
                                        </span>
                                    </div>
                                    <input class="form-control" name="email" placeholder="Email Address" type="email" required />
                                </div>
                            </div>

                            <div class="form-group mb-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-fw fa-lock"></i>
                                        </span>
                                    </div>
                                    <input class="form-control rounded-0" placeholder="Password" name="password" type="password" required />
                                    <div class="input-group-append pass-toggle">
                                        <span class="input-group-text">
                                            <i class="fa fa-fw fa-eye"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-4">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input mb-0" id="remember" name="remember_me" type="checkbox" />
                                    <label for="remember" class="custom-control-label">
                                        <span>Remember Me</span>
                                    </label>
                                </div>
                            </div>

                            <div>
                                <button class="btn btn-danger btn-block shadow-none">Submit</button>
                            </div>

                        </div>

                    </div>


                    <div class="text-center mb-4">
                        <div class="mb-3">Or continue using</div>

                        <div>
                            <a href="" class="social-btn mr-3 btn btn-google bg-danger">
                                <i class="fa fa-google text-white"></i>
                            </a>

                            <a href="" class="social-btn mr-3 btn btn-facebook">
                                <i class="fa fa-facebook text-white"></i>
                            </a>

                            <a href="" class="social-btn btn btn-twitter">
                                <i class="fa fa-twitter"></i>
                            </a>
                        </div>
                    </div>

                    <div class="text-center mb-3">
                        <span>Forgot Password? <a href="{{ route('password.request') }}">Reset Password</a></span>
                    </div>

                    <div class="text-center">
                        <span>Not Registered? <a href="{{ route('register') }}">Create Account</a></span>
                    </div>

                </form>

            </div>

        </div>
    </div>
</section>
@endsection

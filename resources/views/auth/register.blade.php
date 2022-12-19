@extends('layouts.app')

@section('title', 'Register')

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
                        <h4 class="mb-0">Create a new account</h4>
                    </div>

                    <div class="auth-card border mb-4">

                        <div class="p-4">

                            <div class="form-group mb-3">
                                <label>Your Name</label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-fw fa-user"></i>
                                        </span>
                                    </div>
                                    <input class="form-control" name="name" placeholder="" type="email" required />
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label>Email Address</label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-fw fa-envelope"></i>
                                        </span>
                                    </div>
                                    <input class="form-control" name="email" placeholder="" type="email" required />
                                </div>

                                <span>You will verify this in the next step</span>
                            </div>

                            <div class="form-group mb-4">
                                <label>Set Password</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-fw fa-lock"></i>
                                        </span>
                                    </div>
                                    <input class="form-control rounded-0" placeholder="" name="password" type="password" required />
                                    <div class="input-group-append pass-toggle">
                                        <span class="input-group-text">
                                            <i class="fa fa-fw fa-eye"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-4">
                                <label>Security Question</label>

                                <div class="input-group">
                                    <select class="form-control rounded-0" name="question" required>
                                        <option>Select Security Question</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group mb-4">
                                <label>Answer to Security Question</label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-fw fa-info"></i>
                                        </span>
                                    </div>
                                    <input class="form-control rounded-0" placeholder="" name="password" type="password" required />
                                </div>
                            </div>

                            <div>
                                <button class="btn btn-danger btn-block shadow-none">Get Started</button>
                            </div>

                        </div>

                    </div>


                    <div class="text-center mb-4">
                        <div class="mb-3">Sign up using</div>

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

                    <div class="text-center">
                        <span>Already Registered? <a href={getAppRoute(APP_ROUTES.SIGN_UP)}>Log In</a></span>
                    </div>

                </form>

            </div>

        </div>
    </div>
</section>
@endsection

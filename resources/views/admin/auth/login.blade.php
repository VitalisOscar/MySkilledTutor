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

                <form class="auth-form" method="post">
                    @csrf

                    <div class="mb-4 text-center">
                        <h4 class="mb-0">Admin Log in</h4>
                    </div>

                    <div class="auth-card border mb-4">

                        <div class="p-4">

                            <div class="form-group mb-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-fw fa-user"></i>
                                        </span>
                                    </div>
                                    <input class="form-control" name="username" placeholder="Username" value="{{ old('username') }}" type="text" required />
                                </div>
                                @error('username')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-fw fa-lock"></i>
                                        </span>
                                    </div>
                                    <input class="form-control rounded-0" placeholder="Password" name="password" id="password" type="password" value="{{ old('password') }}" required />
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
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input mb-0" id="remember" name="remember" type="checkbox" />
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

                </form>

            </div>

        </div>
    </div>
</section>
@endsection

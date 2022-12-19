@extends('layouts.client_area')

@section('title', 'Notifications')

@section('more_links')
    <link href="{{ asset('static/css/pages/notifications.css') }}" rel="stylesheet">
@endsection

@section('page_content')
<div>

    {{-- New --}}
    <div class="mb-4">
        <div class="d-sm-flex align-items-sm-center mb-3">
            <h5 class="mb-sm-0 heading">New Notifications</h5>

            <button class="ml-sm-auto btn btn-outline-primary btn-sm">Mark All As Read</button>
        </div>

        <div class="notification">
            <a href="" class="link"></a>

            <div class="d-flex align-items-center">
                <span class="icon icon-shape bg-success text-white">
                    <i class="fa fa-bell"></i>
                </span>

                <div class="ml-3">
                    <h6 class="notification-title">Assignment Submitted</h6>
                    <p class="mb-1 notification-content">
                        Your assignment 'A paper on traditional politics in African communities'
                        has received a submission
                    </p>
                    <div class="text-muted">
                        <i class="fa fa-clock-o mr-2"></i>Today 11:23
                    </div>
                </div>
            </div>
        </div>

        <div class="notification">
            <a href="" class="link"></a>

            <div class="d-flex align-items-center">
                <span class="icon icon-shape bg-success text-white">
                    <i class="fa fa-bell"></i>
                </span>

                <div class="ml-3">
                    <h6 class="notification-title">Assignment Submitted</h6>
                    <p class="mb-1 notification-content">
                        Your assignment 'A paper on traditional politics in African communities'
                        has received a submission
                    </p>
                    <div class="text-muted">
                        <i class="fa fa-clock-o mr-2"></i>Today 11:23
                    </div>
                </div>
            </div>
        </div>

    </div>


    {{-- Older --}}
    <div>
        <div class="d-sm-flex align-items-sm-center mb-3">
            <h5 class="mb-sm-0 heading">Older</h5>
        </div>

        <div class="notification">
            <a href="" class="link"></a>

            <div class="d-flex align-items-center">
                <span class="icon icon-shape bg-success text-white">
                    <i class="fa fa-bell"></i>
                </span>

                <div class="ml-3">
                    <h6 class="notification-title">Assignment Submitted</h6>
                    <p class="mb-1 notification-content">
                        Your assignment 'A paper on traditional politics in African communities'
                        has received a submission
                    </p>
                    <div class="text-muted">
                        <i class="fa fa-clock-o mr-2"></i>Today 11:23
                    </div>
                </div>
            </div>
        </div>

        <div class="notification">
            <a href="" class="link"></a>

            <div class="d-flex align-items-center">
                <span class="icon icon-shape bg-success text-white">
                    <i class="fa fa-bell"></i>
                </span>

                <div class="ml-3">
                    <h6 class="notification-title">Assignment Submitted</h6>
                    <p class="mb-1 notification-content">
                        Your assignment 'A paper on traditional politics in African communities'
                        has received a submission
                    </p>
                    <div class="text-muted">
                        <i class="fa fa-clock-o mr-2"></i>Today 11:23
                    </div>
                </div>
            </div>
        </div>

        <div class="notification">
            <a href="" class="link"></a>

            <div class="d-flex align-items-center">
                <span class="icon icon-shape bg-success text-white">
                    <i class="fa fa-bell"></i>
                </span>

                <div class="ml-3">
                    <h6 class="notification-title">Assignment Submitted</h6>
                    <p class="mb-1 notification-content">
                        Your assignment 'A paper on traditional politics in African communities'
                        has received a submission
                    </p>
                    <div class="text-muted">
                        <i class="fa fa-clock-o mr-2"></i>Today 11:23
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection

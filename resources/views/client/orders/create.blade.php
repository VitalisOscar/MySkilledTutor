@extends('layouts.client_area')

@section('title', 'Create Order')

@section('more_links')
    <link href="{{ asset('static/css/pages/new_order.css') }}" rel="stylesheet">
@endsection

@section('page_content')
<div class="">

    <div class="d-sm-flex align-items-sm-center mb-3">
        <h4 class="font-weight-600 mb-sm-0">New Order</h4>
    </div>

    <div class="row">

        {{-- Wizard stepper --}}
        <div class="col-lg-8 col-xl-12">
            <form method="post" action="{{ route($current_route->getName(), $current_route->parameters()) }}" enctype="multipart/form-data">

                @csrf

                <div class="wizard content-area">

                    <div class="wizard-step @if($step == 'start'){{ __('active') }}@endif ">

                        <div class="wizard-step-header">
                            <div class="wizard-step-header-indicator">
                                1
                            </div>

                            <h5 class="wizard-step-header-title">Subject &amp; Academic Level</h5>
                        </div>

                        <div class="wizard-step-content">
                            @if($step == 'start')
                            @include('client.orders.steps.start')
                            @endif
                        </div>

                    </div>

                    <div class="wizard-step @if($step == 'requirements'){{ __('active') }}@endif ">

                        <div class="wizard-step-header">
                            <div class="wizard-step-header-indicator">
                                2
                            </div>

                            <h5 class="wizard-step-header-title">Specific Requirements</h5>
                        </div>

                        <div class="wizard-step-content">
                            @if($step == 'requirements')
                            @include('client.orders.steps.requirements')
                            @endif
                        </div>

                    </div>

                    <div class="wizard-step @if($step == 'review'){{ __('active') }}@endif ">

                        <div class="wizard-step-header">
                            <div class="wizard-step-header-indicator">
                                3
                            </div>

                            <h5 class="wizard-step-header-title">Review and Submit</h5>
                        </div>

                        <div class="wizard-step-content">
                            @if($step == 'review')
                            @include('client.orders.steps.review')
                            @endif
                        </div>

                    </div>

                </div>

            </form>
        </div>
        {{-- End Wizard stepper --}}

        {{-- Calculator --}}
        <div class="col-lg-4 col-xl-4">
            <div class="calculator">

            </div>
        </div>
        {{-- End calculator --}}

    </div>

</div>
@endsection

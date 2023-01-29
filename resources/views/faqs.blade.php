@extends('layouts.app')

@section('title', 'Frequently Asked Questions')

@section('links')
    <link href="{{ asset('static/css/home.css?v='.$asset_version) }}" rel="stylesheet">
@endsection

@section('content')

    <section class="section section-shaped py-5">

        <div class="container">

            <div class="row">
                <div class="col-lg-11 col-xl-10 mx-auto">

                    <h4 class="heading-title mb-4 text-danger text-center">Frequently Asked Questions</h4>

                    <p class="lead text-center mb-5 mx-auto" style="max-width: 650px">
                        Here are some frequently asked questions to help you gain some more info regarding the platform
                    </p>

                    <div class="accordion" id="faqs">
                        @php $i = 0; @endphp
                        @foreach($faqs as $faq)
                        <div class="card mb-2 border">
                            <div class="card-header bg-white py-2 px-3">
                                <h5 class="mb-0">
                                    <button class="px-0 btn btn-link shadow-none @if($i > 0){{ 'collapsed' }}@endif " type="button" data-toggle="collapse" data-target="{{ '#faq_'.$faq->id }}" aria-expanded="true" aria-controls="collapseOne">
                                        {{ $faq->question }}
                                    </button>
                                </h5>
                            </div>

                            <div id="{{ 'faq_'.$faq->id }}" class="collapse @if($i == 0){{ 'show' }}@endif " data-parent="#faqs">
                                <div class="card-body">
                                    {{ $faq->answer }}
                                </div>
                            </div>
                        </div>
                        @php $i++; @endphp
                        @endforeach
                    </div>


                </div>
            </div>

        </div>
    </section>


@endsection

@extends('layouts.admin')

@section('title', 'FAQs')

@section('page_heading')
<i class="fa fa-tasks mr-3"></i>FAQs
@endsection

@section('content')
<div class="row">
    <div class="col-lg-10 col-xl-9">

        @if($faqs->count() > 0)
        <div class="mb-3">
            <a href="{{ route('admin.faqs.create') }}" class="btn btn-outline-default py-2"><i class="fa fa-plus mr-1"></i>Create More FAQs</a>
        </div>
        @endif

        <div class="accordion mb-3" id="faqs">
            @php $i = 0; @endphp
            @foreach($faqs as $faq)
            <div class="card mb-2 border">
                <div class="card-header bg-white py-2 px-3">
                    <h5 class="mb-0 d-flex align-items-center">
                        <button class="px-0 text-default btn btn-link shadow-none @if($i > 0){{ 'collapsed' }}@endif " type="button" data-toggle="collapse" data-target="{{ '#faq_'.$faq->id }}" aria-expanded="true" aria-controls="collapseOne">
                            {{ $faq->question }}
                        </button>

                        <a href="{{ route('admin.faqs.update', $faq) }}" class="btn btn-sm btn-outline-primary ml-auto shadow-none" type="button">
                            Edit
                        </a>
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

        @if($faqs->count() > 0)
        <div class="pt-2 d-flex align-items-center">
            <a href="{{ $faqs->previousPageUrl() }}" class="mr-auto btn btn-outline-default btn-sm shadow-none py-2 @if($faqs->onFirstPage())disabled @endif"><i class="fa fa-angle-double-left mr-1"></i>Prev</a>
            <span>Page {{ $faqs->currentPage() }} of {{ $faqs->lastPage() }}</span>
            <a href="{{ $faqs->nextPageUrl() }}" class="ml-auto btn btn-outline-default btn-sm shadow-none py-2 @if(!$faqs->hasMorePages())disabled @endif">Next<i class="fa fa-angle-double-right ml-1"></i></a>
        </div>
        @endif

        @if($faqs->count() == 0)
        <div class="py-4 col-lg-10 col-xl-9 px-0">
            <h4 class="font-weight-500 mb-0">No FAQs</h4>

            <p class="lead mb-4">
                All added FAQs will be shown here.
                There are none at the moment.
            </p>

            <a href="{{ route('admin.faqs.create') }}" class="btn btn-link"><i class="fa fa-plus mr-1"></i>Create One</a>

        </div>
        @endif

    </div>
</div>
@endsection

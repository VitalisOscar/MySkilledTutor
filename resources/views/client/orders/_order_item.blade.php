<article class="col-12 col-sm-6 mb-3">
    <div class="bg-white rounded ad">
        <div class="px-0">

            <div class="w-100 d-flex align-items-center h-100 bg-lighter">
                <div class="embed-responsive embed-responsive-16by9 rounded-top">
                    <div class="embed-responsive-item">
                        @if($ad->hasImageMedia())
                        <img src="{{ $ad->media_path }}" class="img-fluid">
                        @else
                        <video controls muted src="{{ $ad->media_path }}" class="img-fluid" type="video/*"></video>
                        @endif
                    </div>
                </div>
            </div>

        </div>

        <div class="px-3 py-3">
            <h6><strong>{{ $ad->time }}</strong></h6>

            @if($ad->isApproved())
            <p class="description">
                {{ $ad->description }}
            </p>
            {{--
            <div class="mb-3 font-weight-700">
                {{ 'KSh 24,000' }}
            </div> --}}
            @else
            <p class="description">
                {{ $ad->description }}
            </p>
            @endif

            <div class="mb-3">
                <span class="mr-3">
                    <i class="fa fa-bullhorn text-muted font-weight-bold mr-1"></i>{{ $ad->category_name }}
                </span>

                <span>
                    <i class="fa fa-check-square text-muted font-weight-bold mr-1"></i>{{ $ad->status }}
                    {{-- <i class="fa fa-video-camera text-muted font-weight-bold mr-1"></i>{{ $ad->slots }} @if($ad->slots != 1){{ __('Bookings') }}@else{{ __('Booking') }}@endif --}}
                </span>
            </div>

            <div class="d-flex">
                @if($ad->isApproved())
                @if(!$ad->isPaidFor())
                <form action="{{ route('platform.invoices.pay', $ad->invoice->number) }}" method="get" class="w-50">
                    <button class="btn btn-block btn-outline-success btn-sm shadow-none mr-1"><i class="ni ni-money-coins mr-1"></i>Pay Now</button>
                </form>
                @else
                <span class="w-50">
                    <i class="ni ni-money-coins text-success"></i>&nbsp;Paid
                </span>
                @endif
                @endif
                <a href="{{ route('platform.ads.single', $ad->id) }}" class="ml-1 w-50 btn btn-primary shadow-none btn-sm">View Details&nbsp;<i class="fa fa-share"></i></a>
            </div>
        </div>
    </div>
</article>

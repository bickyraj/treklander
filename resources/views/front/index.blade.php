@extends('layouts.front')
@section('content')
    <!-- Slider -->
    @include('front.elements.banner2')

    <h1 class="sr-only">{{ Setting::get('site_name') }}- Home</h1>

    {{-- Destinations --}}
    <div class="my-20 destinations">
        <div class="mx-auto max-w-7xl">
            <p class="mb-2 text-lg text-center">Where do you want to go?</p>
            <div class="flex justify-center px-4 mb-10">
                <h2 class="text-3xl font-bold text-primary lg:text-5xl font-display">
                    Best places to experience adventures
                </h2>
            </div>
            <div class="flex grid-cols-2 gap-4 px-4 lg:grid md:grid-cols-4" style="overflow-x:auto ">
                @foreach ($regions as $region)
                    @include('front.elements.destination_card', ['destination' => $region, 'link' => route('front.regions.show', $region->slug)])
                @endforeach
            </div>
        </div>
    </div>
    {{-- Destinations --}}

    <!-- About and reviews-->
    <div class="py-20 bg-light">
        <div class="container">
            <div class="grid gap-10">
                <div class="">
                    <div class="mb-10">
                        <p class="mb-2 text-lg text-center uppercase text-primary heading-lead">About Us</p>
                        <h2 class="relative text-3xl font-bold text-center text-gray-600 lg:text-5xl font-display text-balance">
                            {{ Setting::get('homePage')['welcome']['title'] ?? '' }}
                        </h2>
                    </div>

                    <div class="mx-auto prose text-center"><?= Setting::get('homePage')['welcome']['content'] ?? '' ?></div>

                    <div class="mt-10 text-center"><a href="{{ url('/about-us') }}" class="btn btn-primary btn-sm">More about us</a></div>
                </div>
                {{-- <div class="flex items-center">
                    <div class='w-full embed-container'><iframe src='{{ getYoutubeEmbedUrl(Setting::get('homePage')['video']['link']) }}' frameborder='0' allowfullscreen></iframe></div>
                </div> --}}
            </div>
        </div>
    </div>
    <!-- About -->

    {{-- Activities --}}
    <div class="py-20 activities">
        <div class="container">
            <div>
                <p class="mb-2 text-lg text-center uppercase text-primary">Choose your activity</p>
                <h2 class="mb-20 text-3xl font-bold text-center text-gray-600 lg:text-5xl font-display">
                    Trip Categories
                </h2>
            </div>

            <div class="grid max-w-6xl gap-4 mx-auto lg:grid-cols-4 lg:justify-center">
                @foreach ($activities as $activity)
                    @include('front.elements.activity-card', ['activity' => $activity])
                @endforeach
            </div>
        </div>
    </div>{{-- Activities --}}

    <!-- Trip of the month -->
    <div class="py-20 text-white bg-primary">
        <div class="container">
            <div class="flex items-center justify-between gap-10">
                <div>
                    <p class="mb-2 text-lg text-white uppercase">This doesn't get any better</p>
                    <h2 class="pr-10 mb-16 text-3xl font-bold lg:text-5xl font-display text-light">
                        {{ Setting::get('homePage')['trip_block_3']['title'] ?? '' }}
                    </h2>
                </div>
                <div class="flex justify-end gap-4 trips-month-slider-controls">
                    <button class="p-2 rounded-full bg-light">
                        <svg class="w-6 h-6 text-accent">
                            <use xlink:href="{{ asset('assets/front/img/sprite.svg#arrownarrowleft') }}" />
                        </svg>
                    </button>
                    <button class="p-2 rounded-full bg-light">
                        <svg class="w-6 h-6 text-accent">
                            <use xlink:href="{{ asset('assets/front/img/sprite.svg#arrownarrowright') }}" />
                        </svg>
                    </button>
                </div>
            </div>

            <div class="trips-month-slider">
                @forelse ($block_3_trips as $block3tour)
                    @include('front.elements.tour_card_slider', ['tour' => $block3tour])
                @empty
                @endforelse
            </div>
        </div>
    </div>

    <!-- Popular right now -->
    <div class="py-20 featured bg-gray">
        <div class="container">
            <p class="mb-2 text-lg text-center uppercase text-primary">The best of what we offer</p>
            <h2 class="relative px-10 mb-16 text-3xl font-bold text-center text-gray-600 lg:text-5xl font-display">
                {{ Setting::get('homePage')['trip_block_2']['title'] ?? '' }}
            </h2>
            <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3 md:gap-8">
                {{-- @for ($i = 0; $i < 6; $i++) --}}
                @foreach ($block_2_trips as $block_2_tour)
                    @include('front.elements.tour-card', ['tour' => $block_2_tour])
                @endforeach
                {{-- @endfor --}}
            </div>
        </div>
    </div> <!-- Popular right now -->

    {{-- Blog --}}
    <div class="py-20">
        <div class="container">

            <div class="flex justify-center">
                <h2 class="relative px-10 mb-16 text-3xl font-bold text-center text-gray-600 lg:text-5xl font-display">
                    Latest travel blogs
                </h2>
            </div>

            <div class="grid gap-10 mb-10 lg:grid-cols-3">
                @foreach ($blogs as $blog)
                    @include('front.elements.blog-card')
                @endforeach
            </div>
            <div class="text-center">
                <a href="{{ route('front.blogs.index') }}" class="btn btn-primary btn-sm">Go to blog
                </a>
            </div>
        </div>
    </div>{{-- Blog --}}

    @include('front.elements.plan_trip')

    {{-- 
    <!-- Departure Dates -->
    <div class="py-10 departure-dates">
        <div class="container">
            <div class="items-center justify-between mb-4 lg:flex">
                <div>
                    <h1 class="text-4xl uppercase lg:text-5xl font-display text-primary">Upcoming Departures
                    </h1>
                    <div class="mb-6 underline bg-accent"></div>
                </div>

                <form id="filter-trip-departure-form" action="" method="GET">
                    <div class="form-group">
                        <select name="month" id="select-trip-departure-filter" class="bg-gray">
                            <option selected disabled>Choose Month & Year</option>
                            @php
                                $current_date = \Carbon\Carbon::now();
                            @endphp
                            <option value="{{ $current_date->format('n') }}">{{ $current_date->format('M Y') }}</option>
                            @for ($i = 0; $i < 3; $i++)
                                @php
                                    $current_date->add('1 month')->format('M Y');
                                @endphp
                                <option value="{{ $current_date->format('n') }}">{{ $current_date->format('M Y') }}</option>
                            @endfor
                        </select>
                    </div>
                </form>
            </div>
            <div id="departure-card-block" class="grid grid-cols-2 gap-2 md:grid-cols-3 lg:grid-cols-5">
                @forelse ($departures as $departure)
                    @include('front.elements.tour_departure_card', $departure)
                @empty
                @endforelse
            </div>
        </div>
    </div><!-- Departure Dates -->
 --}}


    {{-- Reviews --}}
    <div class="container py-10 lg:py-20">
        <p class="mb-2 text-2xl text-primary">Reviews</p>
        <h2 class="mb-8 text-3xl font-bold text-gray-600 lg:text-5xl font-display">What our customers say</h2>
        <div class="grid gap-10 py-10 lg:grid-cols-2 lg:gap-20">
            @foreach ($reviews as $review)
                @include('front.elements.review', ['review' => $review])
            @endforeach
        </div>
        <div class="text-center">
            <a href="{{ route('front.reviews.index') }}" class="btn btn-primary btn-sm">
                View all reviews
            </a>
        </div>
    </div>
    {{-- <div class="py-20 bg-light">
        <div class="mx-auto max-w-7xl">
            
            <div class="flex gap-4 px-4 mb-10 sm:grid sm:grid-cols-2 lg:grid-cols-4" style="overflow-x: scroll">
                @for ($i = 0; $i < 4; $i++)
                    <div class="relative flex-shrink-0 overflow-hidden review-video rounded-3xl" x-data="{ play: false }" x-init="$watch('play', (value) => {
                        if (value) {
                            $refs.video.play()
                        } else {
                            $refs.video.pause()
                        }
                    })">
                        <video src="{{ asset('assets/front/video-review.mp4') }}"x-ref="video" class="block" x-on:click="play=!play" loop></video>
                        <div class="absolute bottom-0 flex items-center w-full gap-4 p-4 details" style="background: linear-gradient(to top, rgba(0,0,0,.5), rgba(0,0,0,0))">
                            <img src="{{ asset('assets/front/img/hero.jpg') }}" alt="" class="w-16 h-16 rounded-full border-accent" loading="lazy">
                            <div class="text-white">
                                <div class="font-bold">William H. Peterson</div>
                                <div class="text-sm">USA</div>
                            </div>
                        </div>
                        <div x-show="!play" class="absolute pointer-events-none" style="top: 50%; left: 50%; translate: -50% -50%">
                            <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"></path>
                            </svg>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div> --}}
    {{-- Reviews --}}

    {{-- @include('front.elements.search_widget') --}}
@endsection

@push('scripts')
    <script>
        $(function() {
            $("#select-trip-departure-filter").on('change', function(event) {
                event.preventDefault();
                let url = "{!! route('front.trip-departures.filter') !!}";
                let e = $(this);
                let month = e.children("option:selected").val();

                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'JSON',
                    data: {
                        month: month
                    },
                    async: false,
                    success: function(response) {
                        if (response.data != "") {
                            $("#departure-card-block").html(response.data);
                        } else {
                            $("#departure-card-block").html('No data to show.');
                        }
                    }
                });
            });

            $("#banner-slider>.slide").each(function(i, v) {
                let img = new Image();
                let image_src = $(v).find('img').data('img');
                img.onload = function() {
                    $(v).find('img').attr('src', image_src);
                }
                img.src = image_src;
                if (img.complete) img.onload();
            });

            const monthSlider = tns({
                container: '.trips-month-slider',
                nav: false,
                controlsContainer: '.trips-month-slider-controls',
                autoplay: true,
                autoplayButtonOutput: false
            })
        });
    </script>
@endpush

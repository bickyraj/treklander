@extends('layouts.front')
@section('content')
    <!-- Hero -->
    <section class="relative hero hero-alt">
        {{-- <img src="{{ asset('assets/front/img/hero.jpg') }}" alt="B{{ Setting::get('site_name') }}" style="border-radius: 0px;height: 300px;"> --}}
        {{-- <img src="{{ $page->imageUrl }}" alt="B{{ Setting::get('site_name') }}" style="border-radius: 0px;height: 400px;"> --}}
        <img src="{{ $page->imageUrl }}" alt="B{{ Setting::get('site_name') }}">
        <div class="absolute overlay">
            <div class="container ">
                <h1>{{ $page->name ?? '' }}</h1>
                <div class="breadcrumb-wrapper">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb fs-sm wrap">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $page->name ?? '' }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
    </section>

    <section class="py-20 about-page">
        <div class="container">
            <div class="flex flex-wrap justify-center gap-10">
                <div class="p-10 rounded-lg bg-gradient" style="width:min(100%, 400px)">
                    <h2 class="mb-4 text-xl text-gray-600">Our <span class="block text-3xl font-handwriting">Mission</span></h2>
                    <p>
                        Our mission statements is “to be No. #1 adventure travel brand” in Nepal.
                    </p>
                </div>
                <div class="p-10 rounded-lg bg-gradient" style="width:min(100%, 400px)">
                    <h2 class="mb-4 text-xl text-gray-600">Our <span class="block text-3xl font-handwriting">Motto</span></h2>
                    <p>
                        “To be No. #1 in travel company, Your journey in the Himalaya begins with {{ Setting::get('site_name') }}”
                    </p>
                </div>
                <div class="p-10 rounded-lg bg-gradient" style="width:min(100%, 400px)">
                    <h2 class="mb-4 text-xl text-gray-600">Our <span class="block text-3xl font-handwriting">Experience</span></h2>
                    <p>
                        “+25 years of expertise. We have the best adventure tour to offer.”
                    </p>
                </div>
                <div class="p-10 rounded-lg bg-gradient" style="width:min(100%, 400px)">
                    <h2 class="mb-4 text-xl text-gray-600">Our <span class="block text-3xl font-handwriting">Vision</span></h2>
                    <p>
                        “To be 1st choice of responsible travel company for adventure lover.”
                    </p>
                </div>
                <div class="p-10 rounded-lg bg-gradient" style="width:min(100%, 400px)">
                    <h2 class="mb-4 text-xl text-gray-600">Our <span class="block text-3xl font-handwriting">Commitment</span></h2>
                    <p>
                        “Our team & wide alliances are committed to make ‘ur dreams come true.”
                    </p>
                </div>
            </div>


            <div class="py-10 mx-auto prose">

            </div>

            <div class="py-10">
                <div class="max-w-6xl px-4 mx-auto">
                    <div class="grid gap-10 lg:grid-cols-2">
                        <div>
                            <img src="{{ asset('assets/front/img/team.jpg') }}">
                        </div>
                        <div class="px-4 prose">
                            <h2>
                                <div class="mb-4 text-2xl font-bold text-left text-gray-600 lg:text-4xl">
                                    Discover the faces behind our incredible trekking adventures.
                                </div>
                                <div class="text-xl font-bold text-left text-gray-600 lg:text-3xl font-handwriting">
                                    Meet Our Team of experienced guides and mountaineers!
                                </div>
                            </h2>
                            <!--<p>Inquire me and I will tailor-made your holidays! You will have incredible experiences and life time memory!</p> -->
                            <a href="{{ route('front.teams.index') }}" class="btn btn-accent" style="text-decoration:none;">Meet Our Team</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="py-10 text-center">

            </div>
            <!--<div class="prose tour-details-section">-->
            <!--    <p>-->
            <!--        <?= $page->description ?? '' ?>-->
            <!--    </p>-->
            <!--</div>-->
        </div>
        </div>

    </section>
@endsection

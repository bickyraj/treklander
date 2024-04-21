@extends('layouts.front_inner')
@section('content')
    {{--  Hero --}}
    <section class="relative pt-28">
        <img src="{{ asset('assets/front/img/hero.jpg') }}" alt="{{ Setting::get('site_name') }}" class="object-cover w-full h-96">
        <div class="absolute bottom-0 w-full bg-gradient-to-t from-primary-dark/60 to-primary-dark/0">
            <div class="container">
                <div class="py-10">
                    <h1 class="mb-4 text-4xl font-bold text-white font-display lg:text-7xl hero-title drop-shadow-lg">
                        <span>{{ $team->name }}</span>
                    </h1>
                    <div class="breadcrumb-wrapper">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb fs-sm wrap">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('front.teams.index') }}">Our Team</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $team->name }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20">
        <div class="container grid lg:grid-cols-3">
            <div>
                <img class="img-fluid" src="{{ $team->imageUrl }}" alt="{{ $team->name }}" style="height: 349px; padding-top: 29px;">
                <h2 class="text-xl text-primary">{{ $team->name }}</h2>
                <p class="text-lg">{{ $team->position }}</p>
            </div>
            <div class="lg:col-span-2">
                <div class="prose">
                    <?= $team->description ?>
                </div>
            </div>
        </div>
    </section>
@endsection

@extends('layouts.front')
@section('content')
    <!-- Hero -->

    @include('front.elements.hero', [
        'image' => asset('assets/front/img/hero.jpg'),
        'title' => 'Blog',
        'breadcrumbs' => [
            'Home' => route('home'),
        ],
    ])

    <section class="py-20 news">
        <div class="container">
            <div class="grid gap-6 mb-10 lg:grid-cols-3">
                @foreach ($blogs as $blog)
                    @include('front.elements.blog-card')
                @endforeach
            </div>
            {{ $blogs->links('pagination.default') }}
        </div>
    </section>
@endsection

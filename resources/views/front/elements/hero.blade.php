<section class="relative">
    <img src="{{ $image }}" alt="" class="w-full h-[36rem] object-cover">
    <div class="absolute bottom-0 w-full text-white bg-gradient-to-t from-primary-dark/60 to-primary-dark/0">
        <div class="container">
            <div class="py-10">
                <h1 class="mb-4 text-4xl font-bold lg:text-6xl drop-shadow-xl">
                    {{ $title }}
                </h1>
                <div class="breadcrumb-wrapper">
                    <nav aria-label="breadcrumb">
                        <ol class="flex gap-2">
                            @foreach ($breadcrumbs as $key => $value)
                                <li class="breadcrumb-item"><a href="{{ $value }}">{{ $key }}</a> / </li>
                            @endforeach
                            <li><a href="" aria-current="page">{{ $title }}</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>

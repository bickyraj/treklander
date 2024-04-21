<div class="relative">
    <div class="grid gap-20 lg:grid-cols-2">
        <div>
            <img src="{{ $tour->imageUrl }}" alt="{{ $tour->name }}" style="border-radius: 10px;" loading="lazy">
        </div>
        <div>
            <h3 class="mb-8 text-4xl font-display">
                {{ $tour->name }}
            </h3>
            <div class="mb-8 prose text-white">
                <p> {!! truncate(trim(strip_tags($tour->trip_info['overview'] ?? '')), 300) !!} </p>
            </div>
            <div class="flex flex-wrap gap-4 mb-8">
                <div class="flex gap-2 px-4 py-2 rounded-lg bg-primary-dark">
                    <svg class="w-6 h-6">
                        <use xlink:href="{{ asset('assets/front/img/sprite.svg#calendar') }}"></use>
                    </svg>
                    <div>
                        <div class="upper bold fs-xs">Duration</div>
                        <span class="fs-lg bold"> <?= $tour->duration ?> </span> days
                    </div>
                </div>
                <div class="flex gap-2 px-4 py-2 rounded-lg bg-primary-dark">
                    <svg class="w-6 h-6">
                        <use xlink:href="{{ asset('assets/front/img/sprite.svg#emojihappy') }}"></use>
                    </svg>
                    <div>
                        <div class="upper bold fs-xs">Difficulty</div>
                        {{ $tour->difficulty_grade_value }}
                    </div>
                </div>
            </div>

            <div class="flex items-end justify-between gap-10">
                @if ($tour->cost)
                    <div class="price">
                        <div>
                            <span class="text-sm">
                                from
                            </span>
                            <s>
                                USD {{ number_format($tour->cost) }}
                            </s>
                        </div>
                        <div class="font-display">
                            <span>USD</span>
                            <span class="text-4xl">{{ number_format($tour->offer_price) }}</span>
                        </div>
                    </div>
                @endif

                <a href="{{ route('front.trips.show', $tour->slug) }}" class="btn btn-accent">
                    Explore
                    <svg class="w-6 h-6">
                        <use xlink:href="{{ asset('assets/front/img/sprite.svg#arrownarrowright') }}"></use>
                    </svg>
                </a>

            </div>
        </div>
    </div>
</div>

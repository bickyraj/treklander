<div class="flex flex-col bg-white shadow-md tour">
    <div class="top">
        <img src="{{ $tour->imageUrl }}" alt="{{ $tour->name }}" width="400" height="250" loading="lazy">
        <div class="top__overlay">
            <div class="flex items-center gap-2 location">
                <svg class="w-4 h-4">
                    <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#locationmarker" />
                </svg>
                <span><?= $tour->location ?></span>
            </div>
        </div>
    </div>
    <div class="offer">{{ $tour->best_value }}</div>
    <div class="flex flex-col justify-between bottom flex-grow-1">
        <div class="flex flex-col p-4 flex-grow-1">
            {{-- Activity badge --}}
            <div class="flex justify-between gap-20">
                <div class="flex items-center justify-between gap-4 mb-2">
                    <span class="inline-block px-2 py-1 text-xs rounded-full bg-light">
                        {{ $tour->trip_activity_type }}
                    </span>
                </div>
                <div clas="text-center">
                    <div class="flex items-center justify-center gap-1 text-yellow-400">
                        @for ($i = 0; $i < $tour->rating; $i++)
                            <svg class="w-5 h-5" viewbox="0 0 20 20" stroke="currentColor" fill="none">
                                <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#star" />
                            </svg>
                        @endfor
                        @for ($i = 0; $i < 5 - $tour->rating; $i++)
                            <svg class="w-5 h-5" viewbox="0 0 20 20" stroke="currentColor" fill="none">
                                <path stroke-linecap="round" stroke-width="1.5"
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                            </svg>
                        @endfor
                    </div>
                    @if($tour->reviews_count)
                        <div class="text-xs text-right">({{ $tour->reviews_count }} @if($tour->reviews_count == 1) review) @else reviews) @endif</div>
                    @endif
                </div>
            </div>

            {{-- Tour Name --}}
            <a href="{{ route('front.trips.show', ['slug' => $tour->slug]) }}" class="mb-4 flex-grow-1">
                <h3 class="mb-2 text-2xl font-display text-primary">{{ $tour->name }}</h3>
            </a>

            {{-- Duration / Grade --}}
            <div class="flex justify-center mb-4 details">
                <div class="pr-4 mr-4 border-right-light">
                    <div class="text-sm uppercase font-display text-gray">Duration</div>
                    <div class="flex items-center">
                        {{-- <svg class="flex-shrink-0 w-6 h-6 mr-2 text-primary">
                            <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#calendar" /></svg> --}}
                        <div class="flex items-center">
                            <span class="mr-2 text-3xl text-primary font-display">{{ $tour->duration }}</span> days
                        </div>
                    </div>
                </div>
                <div>
                    <div class="mb-1 text-sm uppercase font-display text-gray">Grading</div>
                    <div class="flex items-center">
                        <svg "http://www.w3.org/2000/svg" viewbox="0 0 50 50" class="flex-shrink-0 w-10 h-10 mr-2 text-primary">
                            <circle cx="25" cy="25" r="20" fill="none" stroke="#ddd" stroke-width="10" />
                            @php
                                $circ = 2 * pi() * 20;
                            @endphp
                            @if (strtolower($tour->difficulty_grade_value) === 'easy')
                                <circle cx="25" cy="25" r="20" fill="none" stroke="#1b5" stroke-dasharray="{{ $circ / 3 }} {{ ($circ / 3) * 2 }}"
                                    stroke-dashoffset="{{ $circ / 4 }}" stroke-width="10" />
                            @elseif (strtolower($tour->difficulty_grade_value) === 'moderate')
                                <circle cx="25" cy="25" r="20" fill="none" stroke="orange" stroke-dasharray="{{ ($circ / 3) * 2 }} {{ $circ / 3 }}"
                                    stroke-dashoffset="{{ $circ / 4 }}" stroke-width="10" />
                            @elseif (strtolower($tour->difficulty_grade_value) === 'difficult')
                                <circle cx="25" cy="25" r="20" fill="none" stroke="red" stroke-width="10" />
                            @endif
                        </svg>
                        {{-- <svg class="flex-shrink-0 w-6 h-6 mr-2 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg> --}}
                        {{ $tour->difficulty_grade_value }}
                    </div>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="flex items-end justify-between">

                {{-- Price --}}
                @if ($tour->cost)
                    <div class="price">
                        <div class="mr-2 text-gray">
                            <span class="text-sm">
                                from
                            </span>
                            <s class="font-bold text-red">
                                USD {{ number_format($tour->cost, 2) }}
                            </s>
                        </div>
                        <div class="text-gray-600">
                            <span>USD</span>
                            @php
                                $price_arr = explode('.', number_format($tour->offer_price, 2));
                            @endphp
                            <span class="text-2xl"> {{ $price_arr[0] }} </span>
                            <span class="text-xl">.{{ $price_arr[1] }}</span>
                        </div>
                    </div>
                @endif
                <a href="{{ route('front.trips.show', ['slug' => $tour->slug]) }}" class="btn btn-primary">
                    Explore
                    <svg class="w-4 h-4">
                        <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#arrownarrowright" />
                    </svg>
                </a>
                {{-- <a href="{{ route('tours.book', ['slug' => $tour->slug]) }}" class="btn btn-accent">Book Now</a> --}}
            </div>
        </div>


    </div>
</div>

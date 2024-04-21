<a href="{{ route('front.activities.show', $activity->slug) }}" class="@if ($loop->first) lg:col-span-2 lg:row-span-2 @endif flex items-center gap-4 relative overflow-hidden">
    <img src="{{ $activity->imageUrl }}" alt="{{ $activity->name }}" class="block object-cover w-full h-full transition duration-700 scale-105 hover:scale-100" loading="lazy">
    <div class="absolute bottom-0 left-0 w-full px-4 py-4 bg-gradient-to-t from-primary/100 to-primary/0">
        <h3 class="text-white uppercase font-display">{{ $activity->name }}</h3>
        <div class="text-white tours">
            <span class="fs-xl bold">{{ $activity->trips->count() }}</span>
            <span class="fs-sm">tours</span>
        </div>
    </div>
</a>

<div class="relative flex-shrink-0 destination">
    <a href="{{ $link }}">
        <div class="mb-4 destination__img"><img src="{{ $destination->imageUrl }}" class="aspect-[2/1]" alt="{{ $destination->image_alt ?? $destination->name }}"></div>
        <h3 class="font-bold text-center text-primary">{{ $destination->name }}</h3>
        <div class="text-sm text-center text-gray">{{ $destination->trips->count() }} {{ $destination->trips->count() > 1 ? 'tours' : 'tour' }}</div>
    </a>
</div>

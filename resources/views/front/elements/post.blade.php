<div class="article">
    <a href="{{ route('front.blogs.show', $blog->slug) }}">
        <div class="relative mb-8">
            <img src="{{ $blog->imageUrl }}" alt="{{ $blog->image_alt }}" loading="lazy">
            <div class="absolute px-4 py-2 text-center text-white bg-primary" style="bottom:0; left:1rem;">
                <div class="text-sm">{{ date('M', strtotime($blog->blog_date)) }}</div>
                <div class="text-lg font-bold">{{ date('j', strtotime($blog->blog_date)) }}</div>
            </div>
        </div>
    </a>
    <div>
        <a href="{{ route('front.blogs.show', $blog->slug) }}" class="block mb-2 text-gray-600">
            <h3 class="text-lg">{{ $blog->name }}</h3>
        </a>
        <p class="text-gray-600">
            {{ truncate(strip_tags($blog->toc)) }}
        </p>
    </div>
</div>

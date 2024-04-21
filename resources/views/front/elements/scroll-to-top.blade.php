<button type="button" class="fixed p-4 text-white rounded bottom-20 right-4 bg-primary" x-data="{ showScrollToTop: false }" x-cloak x-show.transition="showScrollToTop" x-on:click="window.scrollTo({top:0})"
    x-on:scroll.window="showScrollToTop = window.pageYOffset > 500">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 10.5L12 3m0 0l7.5 7.5M12 3v18"></path>
    </svg>
    <span class="sr-only">Scroll to top</span>
</button>

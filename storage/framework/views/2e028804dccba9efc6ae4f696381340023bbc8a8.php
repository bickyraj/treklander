<div class="absolute bottom-0 w-full translate-y-1/2 lg:bottom-48">
    <div class="max-w-5xl px-4 mx-auto" x-data="searchDropdown()" x-model="keyword" x-on:click.outside="reset()" x-on:keyup.esc="reset()" x-on:keyup.down="selectNext()" x-on:keyup.up="selectPrev()"
        x-init="$watch('keyword', () => selectedIndex = '')">
        <span class="hidden" x-init="trips = JSON.parse($el.innerText)"><?php echo $formattedTrips; ?></span>
        <div class="relative max-w-xl mx-auto">
            <form action="<?php echo e(route('front.trips.search')); ?>" x-on:submit.prevent="handleSubmit($event.target)">
                <input type="search" name="q" class="w-full px-4 py-4 text-lg text-gray-600 border-2 border-white rounded-lg shadow focus:ring-0 focus:border-accent focus:outline-0"
                    placeholder="Search Trips">
                <button class="absolute flex flex-col p-2 -translate-y-1/2 bg-gray-200 rounded-lg text-accent right-2 top-1/2 focus:bg-accent focus:text-white hover:bg-accent hover:text-white">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"></path>
                    </svg>
                </button>
            </form>
            <div class="absolute w-full overflow-scroll rounded-lg max-h-96 top-[calc(100%+1rem)] border border-gray-200 shadow-lg" x-show="filteredTrips.length > 0"
                x-transition:enter="transition duration-500" x-transition:enter-start="translate-y-4">
                <ul x-ref="results">
                    <template x-for="(trip, index) in filteredTrips" :key="trip.url">
                        <li
                            :class="{
                                'transition': true,
                                'bg-gray-100 hover:bg-gray-50': selectedIndex !== index,
                                'bg-light': selectedIndex === index,
                                'border-b border-gray-200': index !== filteredTrips.length
                            }">
                            <a x-bind:href="trip.url" class="block px-4 py-2">
                                <div class="flex gap-4">
                                    <img :src="trip.image_url" alt="" class="object-cover w-16 h-16 rounded-lg">
                                    <div class="flex-grow">
                                        <div class="text-lg" x-text="trip.name"></div>
                                        <div class="flex justify-between gap-2">
                                            <span class="text-sm text-gray-600" x-text="`${trip.duration} days`"></span>
                                            <span class="text-sm text-gray-600" x-text="`US $ ${trip.offer_price}`"></span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </template>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
    function searchDropdown() {
        return {
            keyword: '',
            selectedIndex: '',
            trips: [],
            get filteredTrips() {
                if (this.keyword === '') {
                    return []
                }
                return this.trips.filter(trip => trip.name.toLowerCase().includes(this.keyword.toLowerCase()))
            },
            reset() {
                this.keyword = ''
            },
            selectNext() {
                if (this.selectedIndex === '') {
                    this.selectedIndex = 0;
                } else {
                    this.selectedIndex++;
                }
                if (this.selectedIndex === this.filteredTrips.length) {
                    this.selectedIndex = 0;
                }
                this.focusSelected();
            },
            selectPrev() {
                if (this.selectedIndex === '') {
                    this.selectedIndex = this.filteredTrips.length - 1;
                } else {
                    this.selectedIndex--;
                }
                if (this.selectedIndex === -1) {
                    this.selectedIndex = this.filteredTrips.length - 1;
                }
                this.focusSelected();
            },
            focusSelected() {
                this.$refs.results.children[this.selectedIndex + 1].scrollIntoView({
                    block: 'nearest'
                })
            },
            handleSubmit(form) {
                if (this.selectedIndex !== '') {
                    window.location.href = this.filteredTrips[this.selectedIndex].url;
                } else {
                    form.submit();
                }
            }
        }
    }
</script>
<?php /**PATH /home/tlanders/public_html/resources/views/front/elements/trip-search.blade.php ENDPATH**/ ?>
<div x-data="{isGroupDiscountsShown: <?php echo e($isGroupDiscountsShown == false ? 'false' : 'true'); ?>}" class="pt-4 mb-6 rounded-lg price-card bg-primary">
    <div class="relative flex mb-4 ribbon">
        <div class="relative px-4 py-1 text-xl bg-green-200 font-display text-primary">
            Best Price Guarantee
        </div>
    </div>

    <div class="p-4 text-white">
        <?php if($trip->cost): ?>
            <div class="">
                <span class="mb-2 mr-2 text-sm">Price starting from</span>
                <s class="text-xl font-bold">$<?php echo e(number_format($trip->cost)); ?></s>
            </div>
            <div class="mb-2 font-display">
                <span class="text-2xl font-bold">USD $</span>
                <span class="text-5xl font-bold text-accent"><?php echo e(number_format($trip->offer_price)); ?></span>
                <span class="text-xl">per person</span>
            </div>
                <button x-on:click="isGroupDiscountsShown=!isGroupDiscountsShown" class="mb-6 text-sm text-accent">Show Group Discounts</button>
        <?php endif; ?>
        
        <table x-show="isGroupDiscountsShown" x-cloak class="w-full mb-4">
            <thead>
                <th class="px-1 py-2 text-left border-b border-white font-display">No of people</th>
                <th class="px-1 py-2 text-right border-b border-white font-display">Price per person</th>
            </thead>
            <tbody>
                <?php if($trip->people_price_range != null): ?>
                    <?php $__empty_1 = true; $__currentLoopData = $trip->people_price_range; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="border-b border-white/30">
                            <td class="px-1 py-2 text-sm"><?php echo e($item['from']); ?> <?php echo e(($item['to'] != "") ? " - ". $item['to']: ""); ?></td>
                            <td class="px-1 py-2 text-sm text-right">$<?php echo e(number_format($item['price'])); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                    <?php endif; ?>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="mb-2 text-center">
            <a href="<?php echo e(route('front.trips.booking', $trip->slug)); ?>" class="w-full mb-2 btn btn-accent">Book Now</a>
            <a href="<?php echo e(route('front.plantrip.createfortrip', $trip->slug)); ?>" class="btn btn-accent">

                <svg class="flex-shrink-0 w-6 h-6 mr-2">
                    <use xlink:href="<?php echo e(asset('assets/front/img/sprite.svg')); ?>#adjustments" />
                </svg>
                Plan My Trip
            </a>
        </div>
        <div class="">
            <a href="<?php echo e(route('front.trips.print', ['slug' => $trip->slug])); ?>" class="flex items-center text-white" title="Print tour details">
                <svg class="flex-shrink-0 w-4 h-4 mr-2">
                    <use xlink:href="<?php echo e(asset('assets/front/img/sprite.svg')); ?>#printer" />
                </svg>
                <span class="text-sm">Print Tour Details</span>
            </a>
            <a href="#" class="flex items-center text-white" title="">
                <svg class="flex-shrink-0 w-4 h-4 mr-2">
                    <use xlink:href="<?php echo e(asset('assets/front/img/sprite.svg')); ?>#download" />
                </svg>
                <span class="text-sm">Download Tour Brochure</span>
            </a>
            
        </div>
    </div>
    <div class="p-4 rounded-b-lg bg-amber-200">
        <h2 class="flex items-center justify-center gap-2 mb-2 text-primary">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M7.217 10.907a2.25 2.25 0 100 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186l9.566-5.314m-9.566 7.5l9.566 5.314m0 0a2.25 2.25 0 103.935 2.186 2.25 2.25 0 00-3.935-2.186zm0-12.814a2.25 2.25 0 103.933-2.185 2.25 2.25 0 00-3.933 2.185z">
                </path>
            </svg>
            Share this tour
        </h2>
        <div class="flex justify-center gap-6">
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(route('front.trips.show', ['slug' => $trip->slug])); ?>" class="mr-2 text-primary hover:text-accent">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-6 h-6 " viewBox="0 0 16 16">
                    <path
                        d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
                </svg>
            </a>
            <a href="https://twitter.com/intent/tweet?url=<?php echo e(route('front.trips.show', ['slug' => $trip->slug])); ?>&text=" class="mr-2 text-primary hover:text-accent">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-6 h-6 " viewBox="0 0 16 16">
                    <path
                        d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z" />
                </svg>
            </a>
            <a href="<?php echo e(Setting::get('instagram')); ?>" class="text-primary hover:text-accent">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-6 h-6 " viewBox="0 0 16 16">
                    <path
                        d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z" />
                </svg>
            </a>
        </div>
    </div>
    
</div>
<?php /**PATH /home/tlanders/public_html/resources/views/front/elements/price_card.blade.php ENDPATH**/ ?>
<?php $__env->startPush('styles'); ?>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<?php $__env->stopPush(); ?>


<header class="<?php if(!request()->routeIs('front.trips.show')): ?> fixed <?php endif; ?> flex items-center w-full transition h-20 header shadow" x-data="{ mobilenavOpen: false, searchboxOpen: false }">
    <div class="container relative flex items-end justify-between w-full">
        <!-- Logo -->
        <a class="flex-shrink-0" href="<?php echo e(route('home')); ?>">
            <img src="<?php echo e(asset('assets/front/img/logo-h.webp')); ?>" class="block w-auto py-2 h-14 brand" alt="<?php echo e(config('app.name')); ?>" width="640" height="438">
        </a><!-- Logo -->
        <div class="flex items-end gap-2 px-2 py-2 rounded-lg lg:px-4">
            <!-- Nav -->
            <?php echo $__env->make('front.elements.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            
            <button class="hidden p-2 lg:block" x-on:click="searchboxOpen=true;setTimeout(()=>$refs.searchInput.focus(),100)">
                <svg class="w-6 h-6 header-color">
                    <use xlink:href="<?php echo e(asset('assets/front/img/sprite.svg')); ?>#search"></use>
                </svg>
            </button>

            <div x-show="searchboxOpen" x-cloak class="absolute w-full max-w-3xl left-1/2 top-[8rem]" @click.away="searchboxOpen=false" style="transform: translateX(-50%)">
                <form action="<?php echo e(route('front.trips.search')); ?>" id="header-search-from">
                    <div class="flex bg-white border-2 rounded-lg">
                        <input id="header-search" x-ref="searchInput" class="flex-grow px-6 py-4 text-gray-700 placeholder-gray-500 bg-white border-0 border-transparent focus:placeholder-transparent"
                            type="text" name="keyword" placeholder="Search site" aria-label="Search site" style="box-shadow: none">
                        <button class="px-4 py-3 text-sm font-medium tracking-wider text-gray-100 rounded-md bg-primary hover:bg-primary-dark">
                            <svg class="w-6 h-6 text-white">
                                <use xlink:href="<?php echo e(asset('assets/front/img/sprite.svg')); ?>#arrownarrowright"></use>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
            

            
            <div class="hidden lg:block">
                <div class="flex items-center justify-end gap-1 header-color">
                    <span class="text-xs">Talk to an expert</span>
                    <a href="<?php echo e(Setting::get('viber') ?? ''); ?>" style="color:#d766ff">
                        <svg class="w-5 h-5">
                            <use xlink:href="<?php echo e(asset('assets/front/img/sprite.svg')); ?>#viber" />
                        </svg>
                    </a>
                    <a href="<?php echo e(Setting::get('whatsapp') ?? ''); ?>" style="color:#28d146">
                        <svg class="w-5 h-5">
                            <use xlink:href="<?php echo e(asset('assets/front/img/sprite.svg')); ?>#whatsapp" />
                        </svg>
                    </a>
                </div>
                <div>
                    <a href="tel:<?php echo e(Setting::get('mobile1') ?? ''); ?>" class="flex items-center header-color">
                        <svg class="w-4 h-4">
                            <use xlink:href="<?php echo e(asset('assets/front/img/sprite.svg')); ?>#phone" />
                        </svg>
                        <div><?php echo e(Setting::get('mobile1') ?? ''); ?></div>
                    </a>
                </div>
            </div>

            
            <div class="lg:none">
                <button class="p-2" @click="mobilenavOpen=!mobilenavOpen">
                    <svg class="w-6 h-6 header-color" x-show="!mobilenavOpen">
                        <use xlink:href="<?php echo e(asset('assets/front/img/sprite.svg')); ?>#menu" />
                    </svg>
                    <svg class="w-6 h-6" x-cloak x-show="mobilenavOpen">
                        <use xlink:href="<?php echo e(asset('assets/front/img/sprite.svg')); ?>#x" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</header>
<?php if(!request()->routeIs('front.trips.show')): ?>
    <div class="pt-20"></div>
<?php endif; ?>
<?php $__env->startPush('scripts'); ?>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="<?php echo e(asset('assets/js/search-trips.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php /**PATH E:\xampp\htdocs\laravelapps\laravel5\treklander\resources\views/front/elements/header.blade.php ENDPATH**/ ?>
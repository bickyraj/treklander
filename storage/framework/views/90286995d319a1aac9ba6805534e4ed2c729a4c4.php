
<?php $__env->startSection('content'); ?>
    <!-- Slider -->
    <?php echo $__env->make('front.elements.banner2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <h1 class="sr-only"><?php echo e(Setting::get('site_name')); ?>- Home</h1>

    
    <div class="my-20 destinations">
        <div class="mx-auto max-w-7xl">
            <p class="mb-2 text-lg text-center">Where do you want to go?</p>
            <div class="flex justify-center px-4 mb-10">
                <h2 class="text-3xl font-bold text-primary lg:text-5xl font-display">
                    Best places to experience adventures
                </h2>
            </div>
            <div class="flex grid-cols-2 gap-4 px-4 lg:grid md:grid-cols-4" style="overflow-x:auto ">
                <?php $__currentLoopData = $regions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $region): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo $__env->make('front.elements.destination_card', ['destination' => $region, 'link' => route('front.regions.show', $region->slug)], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
    

    <!-- About and reviews-->
    <div class="py-20 bg-light">
        <div class="container">
            <div class="grid gap-10">
                <div class="">
                    <div class="mb-10">
                        <p class="mb-2 text-lg text-center uppercase text-primary heading-lead">About Us</p>
                        <h2 class="relative text-3xl font-bold text-center text-gray-600 lg:text-5xl font-display text-balance">
                            <?php echo e(Setting::get('homePage')['welcome']['title'] ?? ''); ?>

                        </h2>
                    </div>

                    <div class="mx-auto prose text-center"><?= Setting::get('homePage')['welcome']['content'] ?? '' ?></div>

                    <div class="mt-10 text-center"><a href="<?php echo e(url('/about-us')); ?>" class="btn btn-primary btn-sm">More about us</a></div>
                </div>
                
            </div>
        </div>
    </div>
    <!-- About -->

    
    <div class="py-20 activities">
        <div class="container">
            <div>
                <p class="mb-2 text-lg text-center uppercase text-primary">Choose your activity</p>
                <h2 class="mb-20 text-3xl font-bold text-center text-gray-600 lg:text-5xl font-display">
                    Trip Categories
                </h2>
            </div>

            <div class="grid max-w-6xl gap-4 mx-auto lg:grid-cols-4 lg:justify-center">
                <?php $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo $__env->make('front.elements.activity-card', ['activity' => $activity], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>

    <!-- Trip of the month -->
    <div class="py-20 text-white bg-primary">
        <div class="container">
            <div class="flex items-center justify-between gap-10">
                <div>
                    <p class="mb-2 text-lg text-white uppercase">This doesn't get any better</p>
                    <h2 class="pr-10 mb-16 text-3xl font-bold lg:text-5xl font-display text-light">
                        <?php echo e(Setting::get('homePage')['trip_block_3']['title'] ?? ''); ?>

                    </h2>
                </div>
                <div class="flex justify-end gap-4 trips-month-slider-controls">
                    <button class="p-2 rounded-full bg-light">
                        <svg class="w-6 h-6 text-accent">
                            <use xlink:href="<?php echo e(asset('assets/front/img/sprite.svg#arrownarrowleft')); ?>" />
                        </svg>
                    </button>
                    <button class="p-2 rounded-full bg-light">
                        <svg class="w-6 h-6 text-accent">
                            <use xlink:href="<?php echo e(asset('assets/front/img/sprite.svg#arrownarrowright')); ?>" />
                        </svg>
                    </button>
                </div>
            </div>

            <div class="trips-month-slider">
                <?php $__empty_1 = true; $__currentLoopData = $block_3_trips; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $block3tour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php echo $__env->make('front.elements.tour_card_slider', ['tour' => $block3tour], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Popular right now -->
    <div class="py-20 featured bg-gray">
        <div class="container">
            <p class="mb-2 text-lg text-center uppercase text-primary">The best of what we offer</p>
            <h2 class="relative px-10 mb-16 text-3xl font-bold text-center text-gray-600 lg:text-5xl font-display">
                <?php echo e(Setting::get('homePage')['trip_block_2']['title'] ?? ''); ?>

            </h2>
            <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3 md:gap-8">
                
                <?php $__currentLoopData = $block_2_trips; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $block_2_tour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo $__env->make('front.elements.tour-card', ['tour' => $block_2_tour], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
            </div>
        </div>
    </div> <!-- Popular right now -->

    
    <div class="py-20">
        <div class="container">

            <div class="flex justify-center">
                <h2 class="relative px-10 mb-16 text-3xl font-bold text-center text-gray-600 lg:text-5xl font-display">
                    Latest travel blogs
                </h2>
            </div>

            <div class="grid gap-10 mb-10 lg:grid-cols-3">
                <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo $__env->make('front.elements.blog-card', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div class="text-center">
                <a href="<?php echo e(route('front.blogs.index')); ?>" class="btn btn-primary btn-sm">Go to blog
                </a>
            </div>
        </div>
    </div>

    <?php echo $__env->make('front.elements.plan_trip', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    


    
    <div class="container py-10 lg:py-20">
        <p class="mb-2 text-2xl text-primary">Reviews</p>
        <h2 class="mb-8 text-3xl font-bold text-gray-600 lg:text-5xl font-display">What our customers say</h2>
        <div class="grid gap-10 py-10 lg:grid-cols-2 lg:gap-20">
            <?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make('front.elements.review', ['review' => $review], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="text-center">
            <a href="<?php echo e(route('front.reviews.index')); ?>" class="btn btn-primary btn-sm">
                View all reviews
            </a>
        </div>
    </div>
    
    

    
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        $(function() {
            $("#select-trip-departure-filter").on('change', function(event) {
                event.preventDefault();
                let url = "<?php echo route('front.trip-departures.filter'); ?>";
                let e = $(this);
                let month = e.children("option:selected").val();

                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'JSON',
                    data: {
                        month: month
                    },
                    async: false,
                    success: function(response) {
                        if (response.data != "") {
                            $("#departure-card-block").html(response.data);
                        } else {
                            $("#departure-card-block").html('No data to show.');
                        }
                    }
                });
            });

            $("#banner-slider>.slide").each(function(i, v) {
                let img = new Image();
                let image_src = $(v).find('img').data('img');
                img.onload = function() {
                    $(v).find('img').attr('src', image_src);
                }
                img.src = image_src;
                if (img.complete) img.onload();
            });

            const monthSlider = tns({
                container: '.trips-month-slider',
                nav: false,
                controlsContainer: '.trips-month-slider-controls',
                autoplay: true,
                autoplayButtonOutput: false
            })
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/tlanders/public_html/resources/views/front/index.blade.php ENDPATH**/ ?>
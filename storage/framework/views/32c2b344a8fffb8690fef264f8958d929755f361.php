<?php $__env->startPush('styles'); ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tiny-slider@2.9.3/dist/tiny-slider.css">
<?php $__env->stopPush(); ?>

<section>
    <div class="relative hero">
        
        <div id="banner-slider" class="hero-slider">
            <?php $__empty_1 = true; $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="relative slide banner">
                    <img src="<?php echo e($banner->thumbImageUrl); ?>" data-img="<?php echo e($banner->imageUrl); ?>" class="block w-full min-h-[30rem] lazyload aspect-[2/1] object-cover" alt="<?php echo e($banner->name); ?>"
                        width="1500" height="1000">
                    <div class="absolute w-full bottom-24 lg:bottom-64">
                        <div class="container">
                            <div class="flex flex-col items-center mb-8">
                                <div class="font-bold text-white hero-slider-title">
                                    <span><?php echo e($banner->caption); ?></span>
                                </div>
                            </div>

                            
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        
        

        <?php echo $__env->make('front.elements.trip-search', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div><!-- Hero -->
</section>

<?php $__env->startPush('scripts'); ?>
    <script src="https://cdn.jsdelivr.net/npm/tiny-slider@2.9.3/dist/tiny-slider.min.js"></script>

    <script>
        const heroSlider = tns({
            mode: 'gallery',
            container: '.hero-slider',
            nav: false,
            // controlsContainer: '.hero-slider-controls .container',
            controls: false,
            autoplay: true,
            autoplayButtonOutput: false,
            mouseDrag: true
        })
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH /home/tlanders/public_html/resources/views/front/elements/banner2.blade.php ENDPATH**/ ?>
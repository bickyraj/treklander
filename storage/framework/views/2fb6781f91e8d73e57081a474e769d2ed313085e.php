
<?php $__env->startSection('content'); ?>
    <!-- Hero -->

    <?php echo $__env->make('front.elements.hero', [
        'image' => asset('assets/front/img/hero.jpg'),
        'title' => 'Blog',
        'breadcrumbs' => [
            'Home' => route('home'),
        ],
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <section class="py-20 news">
        <div class="container">
            <div class="grid gap-6 mb-10 lg:grid-cols-3">
                <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo $__env->make('front.elements.blog-card', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php echo e($blogs->links('pagination.default')); ?>

        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/tlanders/public_html/resources/views/front/blogs/index.blade.php ENDPATH**/ ?>
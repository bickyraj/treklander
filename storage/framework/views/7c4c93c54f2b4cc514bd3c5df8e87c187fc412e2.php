<section class="relative">
    <img src="<?php echo e($image); ?>" alt="" class="w-full h-[36rem] object-cover">
    <div class="absolute bottom-0 w-full text-white bg-gradient-to-t from-primary-dark/60 to-primary-dark/0">
        <div class="container">
            <div class="py-10">
                <h1 class="mb-4 text-4xl font-bold lg:text-6xl drop-shadow-xl">
                    <?php echo e($title); ?>

                </h1>
                <div class="breadcrumb-wrapper">
                    <nav aria-label="breadcrumb">
                        <ol class="flex gap-2">
                            <?php $__currentLoopData = $breadcrumbs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="breadcrumb-item"><a href="<?php echo e($value); ?>"><?php echo e($key); ?></a> / </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <li><a href="" aria-current="page"><?php echo e($title); ?></a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<?php /**PATH E:\xampp\htdocs\laravelapps\laravel5\treklander\resources\views/front/elements/hero.blade.php ENDPATH**/ ?>
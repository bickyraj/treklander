
<?php $__env->startSection('content'); ?>
    <!-- Hero -->
    <section class="relative hero hero-alt">
        
        <img src="<?php echo e($page->imageUrl); ?>" alt="<?php echo e(Setting::get('site_name')); ?>" style="border-radius: 0px;height: 400px;">
        <div class="absolute overlay">
            <div class="container ">
                <h1><?php echo e($page->name ?? ''); ?></h1>
                <div class="breadcrumb-wrapper">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb fs-sm wrap">
                            <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo e($page->name ?? ''); ?></li>
                        </ol>
                    </nav>
                </div>
            </div>
    </section>

    <section class="py-3 about-page">
        <div class="container">
            <div class="grid gap-1 lg:grid-cols-3 xl:grid-cols-1">
                <div class="lg:col-2 xl:col-3">
                    <div class="tour-details-section lim">
                        <p>
                            <?= $page->description ?? '' ?>
                        </p>
                    </div>
                </div>
                <aside>
                    <!-- enquiry block -->
                    
                    <!-- end of enquiry block -->
                </aside>
            </div>
        </div>

    </section>



    <!--<section class="hero-second">-->
    <!--  <div class="slide" style="background-image: url(<?php echo e($page->imageUrl ?? ''); ?>)">-->
    <!--  </div>-->
    <!--  <div class="hero-bottom">-->
    <!--    <div class="container">-->
    <!--      <h1><?php echo e($page->name ?? ''); ?></h1>-->
    <!--      <nav aria-label="breadcrumb">-->
    <!--        <ol class="breadcrumb">-->
    <!--          <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a></li>-->
    <!--          <li class="breadcrumb-item active" aria-current="page"><?php echo e($page->name); ?></li>-->
    <!--        </ol>-->
    <!--      </nav>-->
    <!--    </div>-->
    <!--</section>-->

    <!--<section class="tour-details">-->
    <!--  <div class="container mt-2">-->
    <!--    <div class="row">-->
    <!--      <div class="col-md-8 col-lg-9">-->
    <!--        <div class="tour-details-section">-->
    <!--        	<div>-->
    <!--        		<?= $page->description ?? '' ?>-->
    <!--        	</div>-->
    <!--        </div>-->
    <!--      </div>-->
    <!--      <div class="col-md-4 col-lg-3">-->
    <!--        <aside>-->
    <!-- enquiry block -->
    <!--          <?php echo $__env->make('front.elements.enquiry', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>-->
    <!-- end of enquiry block -->
    <!--        </aside>-->
    <!--      </div>-->
    <!--    </div>-->
    <!--</section>-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/tlanders/public_html/resources/views/front/pages/show.blade.php ENDPATH**/ ?>
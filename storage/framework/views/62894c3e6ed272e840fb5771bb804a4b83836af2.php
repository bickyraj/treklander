<?php
  if (session()->has('success_message')) {
    $session_success_message = session('success_message');
    session()->forget('success_message');
  }

  if (session()->has('error_message')) {
    $session_error_message = session('error_message');
    session()->forget('error_message');
  }
?>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
<script src="https://www.google.com/recaptcha/api.js?onload=CaptchaCallback&render=explicit" async defer></script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<!-- Hero -->
<section class="hero hero-alt relative">
    <img src="<?php echo e(asset('assets/front/img/hero.jpg')); ?>" alt="">
    <div class="overlay absolute">
        <div class="container ">
            <h1 class="font-display upper"><?php echo e($trip->name); ?> Gallery</h1>
            <div class="breadcrumb-wrapper">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb fs-sm wrap">
                        <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo e(route('front.trips.all-gallery')); ?>">Gallery</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo e($trip->name); ?></li>
                    </ol>
                </nav>
            </div>
        </div>
</section>

<section class="py-10">
    <div class="container">
        <div class="grid lg:grid-cols-3 xl:grid-cols-4 gap-10">
            <div class="lg:col-span-2 xl:col-span-3">
                <div class="gallery grid grid-cols-2 md:grid-cols-3 gap-4">

                    <?php $__empty_1 = true; $__currentLoopData = $trip->trip_galleries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $gallery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                    <a data-fancybox="gallery" href="<?php echo e($gallery->imageUrl); ?>" class="item" data-caption="<?php echo e($gallery->name); ?> <?php echo e($key + 1); ?>">
                        <div class="relative">
                            <img class="block" src="<?php echo e($gallery->mediumImageUrl); ?>" alt="">
                            <div class="overlay absolute flex justify-center items-center w-full h-full">
                            </div>
                            <svg class="absolute w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path></svg>
                        </div>
                    </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                      <p>No gallery to show.</p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <aside>
                <?php echo $__env->make('front.elements.enquiry', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </aside>
        </div>
    </div>

</section>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
<script>
    $(function() {
        var session_success_message = '<?php echo e($session_success_message ?? ''); ?>';
        var session_error_message = '<?php echo e($session_error_message ?? ''); ?>';
        if (session_success_message) {
          toastr.success(session_success_message);
        }

        if (session_error_message) {
          toastr.danger(session_error_message);
        }

        var enquiry_validator = $("#enquiry-form").validate({
            ignore: "",
            rules: {
                'name': 'required',
                'email': 'required',
                'country': 'required',
                'phone': 'required',
                'message': 'required',
            },
            errorPlacement: function(error, element) {
                error.insertAfter(element.closest('.flex'));
                // error.append(element.closest('.form-group'));
            },
            submitHandler: function(form, event) {
                event.preventDefault();
                if (grecaptcha.getResponse(0)) {
                    var btn = $(form).find('button[type=submit]').attr('disabled', true).html('Sending...');
                    setTimeout(() => {
                        form.submit();
                    }, 500);
                }else{
                    grecaptcha.reset(enquiry_captcha);
                    grecaptcha.execute(enquiry_captcha);
                }
            },
        });
    });

    function onSubmitEnquiry(token) {
        $("#enquiry-form").submit();
        return true;
    }

    let enquiry_captcha;
    var CaptchaCallback = function() {
        enquiry_captcha = grecaptcha.render('inquiry-g-recaptcha', {'sitekey' : '<?php echo config("constants.recaptcha.sitekey"); ?>'});
        // review_captcha = grecaptcha.render('review-g-recaptcha', {'sitekey' : '<?php echo config("constants.recaptcha.sitekey"); ?>'});
    };
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.front_inner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/tlanders/public_html/resources/views/front/trips/gallery.blade.php ENDPATH**/ ?>
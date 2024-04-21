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
    <script src="https://www.google.com/recaptcha/api.js?onload=CaptchaCallback&render=explicit" async defer></script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <!-- Hero -->
    <section class="relative hero hero-alt">
        <img src="<?php echo e(asset('assets/front/img/hero.jpg')); ?>" alt="<?php echo e(Setting::get('site_name')); ?>" style="height: 300px;">
        <div class="absolute overlay">
            <div class="container ">
                <h1 class="font-display upper">Reviews</h1>
                <div class="breadcrumb-wrapper">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb fs-sm wrap">
                            <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Reviews</li>
                        </ol>
                    </nav>
                </div>
            </div>
    </section>

    <section class="py-10">
        <div class="container">
            <div class="grid gap-10 lg:grid-cols-3 xl:grid-cols-4">
                <div class="lg:col-span-2 xl:col-span-3">
                    <div class="grid gap-2 lg:grid-cols-1 lg:gap-3">
                        <?php $__empty_1 = true; $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="p-4 review">
                                <div class="review__content">
                                    <h2 class="mb-2 text-2xl font-display text-primary"><?php echo e($review->title); ?></h2>
                                    <p><?php echo e($review->review); ?></p>
                                </div>
                                <div class="flex items-center">
                                    <div class="mr-2">
                                        <img src="<?php echo e($review->thumbImageUrl); ?>" alt="">
                                    </div>
                                    <div>
                                        <div class="font-bold"><?php echo e(ucfirst($review->review_name)); ?></div>
                                        <div class="text-sm text-gray"><?php echo e($review->review_country); ?></div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <?php endif; ?>
                    </div>
                </div>
                <aside>
                    <a href="<?php echo e(route('front.reviews.create')); ?>" class="mb-4 btn btn-accent">Write a review</a>
                    <?php echo $__env->make('front.elements.enquiry', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </aside>
            </div>
        </div>

    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
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
                    } else {
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
            enquiry_captcha = grecaptcha.render('inquiry-g-recaptcha', {
                'sitekey': '<?php echo config('constants.recaptcha.sitekey'); ?>'
            });
            // review_captcha = grecaptcha.render('review-g-recaptcha', {'sitekey' : '<?php echo config('constants.recaptcha.sitekey'); ?>'});
        };
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.front_inner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/tlanders/public_html/resources/views/front/reviews/index.blade.php ENDPATH**/ ?>
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
    
    <section class="relative">
        <?php echo $__env->make('front.elements.hero', [
            'title' => 'Our Team',
            'image' => asset('assets/front/img/hero.jpg'),
            'breadcrumbs' => [
                'Home' => route('home'),
            ],
        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </section>

    <section class="py-20">
        <div class="container">
            <div class="grid gap-10 lg:grid-cols-3 xl:grid-cols-4" x-data="{ active: 'administration' }">
                <div class="lg:col-span-2 xl:col-span-3">
                    <div class="mb-20 prose">
                        <p>
                            "Embark on a Journey of Discovery with Our Team at <?php echo e(Setting::get('site_name')); ?> in Nepal"

                            Nestled amidst the towering Himalayan peaks and lush valleys, <?php echo e(Setting::get('site_name')); ?> is your gateway to the most awe-inspiring trekking adventures in Nepal. Our
                            dedicated
                            team of experienced guides, passionate nature enthusiasts, and local experts is here to make your trekking dreams a reality. Whether you're a seasoned trekker or a first-time
                            adventurer, our team is ready to lead you through breathtaking landscapes, ancient cultures, and unforgettable experiences. Discover the heart of the Himalayas with the trusted
                            companionship of <?php echo e(Setting::get('site_name')); ?>.
                        </p>
                    </div>

                    <?php if(!$administrations->isEmpty()): ?>
                        <button :class="{ 'btn': true, 'btn-accent': active === 'administration', 'btn-primary': active !== 'administration' }" x-on:click="active='administration'">Administration</button>
                    <?php endif; ?>
                    <?php if(!$representatives->isEmpty()): ?>
                        <button :class="{ 'btn': true, 'btn-accent': active === 'representatives', 'btn-primary': active !== 'representatives' }"
                            x-on:click="active='representatives'">Representatives</button>
                    <?php endif; ?>
                    <?php if(!$tour_guides->isEmpty()): ?>
                        <button :class="{ 'btn': true, 'btn-accent': active === 'tourguides', 'btn-primary': active !== 'tourguides' }" x-on:click="active='tourguides'">Tour Guides</button>
                    <?php endif; ?>


                    <?php if(!$administrations->isEmpty()): ?>
                        <div x-show="active==='administration'">
                            <div class="grid gap-2 pt-8 lg:gap-3">
                                <?php $__currentLoopData = $administrations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php echo $__env->make('front.elements.team_card', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if(!$representatives->isEmpty()): ?>
                        <div x-show="active==='representatives'">
                            <div class="grid gap-2 pt-8 lg:gap-3">
                                <?php $__currentLoopData = $representatives; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php echo $__env->make('front.elements.team_card', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if(!$tour_guides->isEmpty()): ?>
                        <div x-show="active==='tourguides'">
                            <div class="grid gap-2 pt-8 lg:gap-3">
                                <?php $__currentLoopData = $tour_guides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php echo $__env->make('front.elements.team_card', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
                <aside>
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

<?php echo $__env->make('layouts.front_inner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/tlanders/public_html/resources/views/front/teams/index.blade.php ENDPATH**/ ?>
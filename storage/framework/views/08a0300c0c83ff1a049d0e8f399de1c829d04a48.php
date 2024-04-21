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
    <style>
        .payment-radio-block {
            display: flex;
        }

        .nature-from-radio-button {
            cursor: pointer;
            margin-right: 6px;
            width: 16px !important;
            padding: 0px !important;
        }

        .nature-form-check label {
            cursor: pointer !important;
        }

        .nature-form-check {
            margin-right: 40px;
            margin-bottom: 12px;
            display: flex;
            align-content: flex-start;
            justify-content: flex-start;
            align-items: center;

        }
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <!-- Hero -->
    <section class="relative hero-alt">
        <img src="<?php echo e($trip->imageUrl); ?>" alt="" class="h-full">
        <div class="absolute bottom-0 w-full bg-gradient-to-t from-primary-dark/60 to-primary-dark/0">
            <div class="container pb-10">
                <h1 class="mb-4 text-4xl font-bold text-white font-display lg:text-7xl hero-title drop-shadow-lg">Book <?php echo e($trip->name); ?></h1>
                <div class="breadcrumb-wrapper">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb fs-sm wrap">
                            <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Booking Form</li>
                        </ol>
                    </nav>
                </div>
            </div>
    </section>

    <section class="py-20" x-data="{ noOfTravellers: 1, rate: <?php echo e(isset($trip->offer_price) && !empty($trip->offer_price) ? $trip->offer_price : $trip->cost); ?>, paymentType: 'half' }">
        <div class="container">
            <div class="grid gap-20 lg:grid-cols-3">
                <div class="lg:col-span-2">
                    <form id="captcha-form" action="<?php echo e(route('front.store_payment')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="id" value="<?php echo e($trip->id); ?>">
                        <h2 class="mb-4 text-2xl font-bold text-primary">Personal details</h2>
                        <div class="grid gap-10 mb-10 lg:grid-cols-3">
                            <div class="form-group">
                                <label for="">First name *</label>
                                <input type="text" class="form-control" name="first_name" placeholder="First name" required>
                            </div>
                            <div class="form-group">
                                <label for="">Middle name</label>
                                <input type="text" class="form-control" name="middle_name" placeholder="Middle name">
                            </div>
                            <div class="form-group">
                                <label for="">Last name *</label>
                                <input type="text" class="form-control" name="last_name" placeholder="Last name" required>
                            </div>
                            <div class="form-group">
                                <label for="">Country *</label>
                                <?php echo $__env->make('front.elements.country', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                            <div class="form-group">
                                <label for="">Email *</label>
                                <input type="email" name="email" class="form-control" placeholder="Email" required>
                            </div>
                            <div class="form-group">
                                <label for="">Contact no. *</label>
                                <input type="tel" name="contact_no" class="form-control" placeholder="Contact no." required>
                            </div>
                            <div class="form-group">
                                <label for="">Gender </label>
                                <select name="gender" id="" class="form-control">
                                    <option value="" selected disabled>Gender</option>
                                    <option value="">Male</option>
                                    <option value="">Female</option>
                                </select>
                            </div>
                        </div>

                        <h2 class="mb-4 text-2xl font-bold text-primary">Payment option</h2>
                        <div class="grid gap-2 mb-2 lg:grid-cols-1">
                            <div class="form-group">
                                <label for="">Payment </label>
                                <div class="payment-radio-block">
                                    <div class="form-check nature-form-check">
                                        <input class="nature-from-radio-button" type="radio" name="payment_type" id="flexRadioDefault1" value="full" x-model="paymentType">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Full amount payment
                                        </label>
                                    </div>
                                    <div class="form-check nature-form-check">
                                        <input class="nature-from-radio-button" checked type="radio" name="payment_type" id="flexRadioDefault2" valud="half" x-model="paymentType">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            25% advance payment
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h2 class="mt-20 mb-2 text-2xl font-bold text-primary">Trip details</h2>
                        <div class="grid gap-10 mb-10 lg:grid-cols-3">
                            <div class="form-group">
                                <label for="">No. of travellers </label>
                                <input type="number" name="no_of_travellers" class="form-control" min="1" x-model="noOfTravellers" placeholder="No. of travellers">
                            </div>
                            <div class="form-group">
                                <label for="">Preferred departure date</label>
                                <input type="date" name="preferred_departure_date" name="" id="" class="form-control" min="<?php echo date('Y-m-d'); ?>">
                            </div>
                            <div class="form-group lg:col-span-2">
                                <label for="">Message </label>
                                <textarea name="emergency_contact" id="" cols="60" rows="3" class="form-control" placeholder="Message"></textarea>
                            </div>
                        </div>

                        <?php echo $__env->make('front.elements.recaptcha', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <button id="make_a_payment_btn" type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <aside>
                    <div class="p-10 rounded-lg bg-light">
                        <h2 class="text-2xl font-bold text-primary">Book <?php echo e($trip->name); ?></h2>
                        <div class="mt-4 prose">
                            <p class="flex justify-between"><span>Duration:</span><?php echo e($trip->duration); ?> days</p>
                            <p class="flex justify-between"><span>No of Travellers:</span><span><span x-text="noOfTravellers"></span> people</span></p>
                            <p class="flex justify-between"><span>Rate:</span><span>USD <span x-text="rate.toLocaleString()"></span></span></p>

                            <p class="flex justify-between"><span>Total amount:</span><span class="text-xl font-bold text-primary">USD <span
                                        x-text="(noOfTravellers * rate).toLocaleString()"></span></span></p>

                            <p class="flex justify-between"><span>Payable Now:</span><span class="text-xl font-bold text-primary">USD <span
                                        x-text="(noOfTravellers * rate * ((paymentType === 'half')? 0.25: 1)).toLocaleString()"></span></span></p>

                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script type="text/javascript">
        $(function() {
            var session_success_message = '<?php echo e($session_success_message ?? ''); ?>';
            var session_error_message = '<?php echo e($session_error_message ?? ''); ?>';
            if (session_success_message) {
                toastr.success(session_success_message);
            }

            if (session_error_message) {
                toastr.danger(session_error_message);
            }

            $(document).on('click', '#make_a_payment_btn', function(ev) {
                ev.preventDefault();
                let btn = $(this);
                btn.prop('disabled', true);
                btn.html('submitting...');
                setTimeout(() => {
                    $("#captcha-form").submit();
                }, 1000);
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.front_inner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\laravelapps\laravel5\treklander\resources\views/front/trips/booking.blade.php ENDPATH**/ ?>
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

<?php $__env->startSection('content'); ?>

<!-- Hero -->
<section class="hero hero-alt relative">
    <img src="<?php echo e(asset('assets/front/img/hero.jpg')); ?>" alt="">
    <div class="overlay absolute">
        <div class="container ">
            <h1><?php echo e($trip->name); ?></h1>
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

<section class="py-5">
    <div class="container">
        <div class="grid lg:grid-cols-3 xl:grid-cols-4 gap-2 xl:gap-3">
            <div class="lg:col-span-2 xl:col-span-3">
                <div style="margin-bottom: 5px; padding-bottom: 7px;">
                    <h3>Departure</h3>
                    <div>
                      <ul style="padding: 0px;">
                        <li><strong class="badge badge-warning">From </strong> <?php echo e(formatDate($trip_departure->from_date)); ?> <strong class="badge badge-warning">To </strong> <?php echo e(formatDate($trip_departure->to_date)); ?>

                        </li>
                      </ul>
                    </div>
                    <hr>
                </div>

                <form id="captcha-form" action="<?php echo e(route('front.trips.departure-booking.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="departure_id" value="<?php echo e($trip_departure->id); ?>">
                    <input type="hidden" name="id" value="<?php echo e($trip->id); ?>">
                    <h2 class="fs-lg bold text-primary mb-2">Personal details</h2>
                    <div class="grid lg:grid-cols-3 gap-2 mb-2">
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
                        <div class="form-group lg:col-2">
                            <label for="">Mailing address *</label>
                            <textarea name="mailing_address" id="" cols="30" rows="3" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Email *</label>
                            <input type="email" name="email" class="form-control" placeholder="Email" required>
                        </div>
                        <div class="form-group">
                            <label for="">Contact no. *</label>
                            <input type="tel" name="contact_no" class="form-control" placeholder="Contact no." required>
                        </div>
                    </div>
                    <div class="grid lg:grid-cols-3 gap-2 mb-2">
                        <div class="form-group">
                            <label for="">Gender *</label>
                            <select name="gender" id="" class="form-control" required>
                                <option value="" selected disabled>Gender</option>
                                <option value="">Male</option>
                                <option value="">Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Date of birth *</label>
                            <input type="date" name="dob" id="" class="form-control" max="<?php echo date('Y-m-d');?>">
                        </div>
                    </div>
                    <br>
                    <hr class="mb-2">

                    <h2 class="fs-lg bold text-primary mb-2">Trip details</h3>
                        <div class="grid lg:grid-cols-3 gap-2 mb-2">
                            <div class="form-group">
                                <label for="">Passport no.</label>
                                <input type="text" name="passport_no" class="form-control" placeholder="Passport No.">
                            </div>
                            <div class="form-group">
                                <label for="">Place of issue</label>
                                <input type="text" name="place_of_issue" class="form-control" placeholder="Place of issue">
                            </div>
                        </div>
                        <div class="grid lg:grid-cols-3 gap-2 mb-2">
                            <div class="form-group">
                                <label for="">Issue date</label>
                                <input type="date" name="issue_date" class="form-control" max="<?php echo date('Y-m-d');?>" placeholder="Issue date">
                            </div>
                            <div class="form-group">
                                <label for="">Expiry date </label>
                                <input type="date" name="expiry_date" class="form-control" min="<?php echo date('Y-m-d');?>" placeholder="Expiry date">
                            </div>
                        </div>
                        <div class="grid lg:grid-cols-3 gap-2 mb-2">
                            <div class="form-group">
                                <label for="">No. of travellers</label>
                                <input type="number" name="no_of_travellers" class="form-control" min="<?php echo date('Y-m-d');?>"
                                placeholder="No. of travellers">
                            </div>
                            <div class="form-group">
                                <label for="">Emergency Contact *</label>
                                <textarea name="emergency_contact" id="" cols="30" rows="3" class="form-control"
                                placeholder="Emergency Contact"></textarea>
                            </div>
                        </div>
                        <?php echo $__env->make('front.elements.recaptcha', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <input type="hidden" id="recaptcha" name="google_recaptcha" value="">
                        <button class="btn btn-theme">Submit</button>
                </form>
            </div>

            <aside>
                <div class="border-light p-2">
                    <h2 class="fs-lg text-primary bold"><?php echo e($trip->name); ?></h2>
                    <div class="card-body">
                        <p><?php echo e($trip->duration); ?> Days</p>
                        <!-- <b>Earliest Fixed Depature Date</b>
                        <p>1 Jan 2020</p> -->
                        <?php if($trip->offer_price): ?>
                        <b>USD <?php echo e($trip->offer_price); ?></b> per person
                        <?php endif; ?>
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
      toastr.error(session_error_message);
    }
  });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.front_inner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/tlanders/public_html/resources/views/front/trips/departure-booking.blade.php ENDPATH**/ ?>
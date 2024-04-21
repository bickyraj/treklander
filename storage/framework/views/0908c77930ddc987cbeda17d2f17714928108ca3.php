<?php
  if (session()->has('success_message')) {
    $success_message = session('success_message');
    session()->forget('success_message');
  }
  if (session()->has('error_message')) {
    $error_message = session('error_message');
    session()->forget('error_message');
  }
?>

<?php $__env->startSection('content'); ?>
<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-list"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Faq Categories
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <!--begin: Search Form -->
            <div class="kt-form kt-form--label-right kt-margin-b-10">
                <div class="row align-items-center">
                    <div class="col-xl-12 order-2 order-xl-1">
                        <form action="<?php echo e(route('admin.faq-categories.store')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="row align-items-center">
                                <div class="col-md-6 kt-margin-b-20-tablet-and-mobile">
                                    <div class="kt-form__group kt-form__group--inline">
                                        <div class="kt-form__label">
                                            <label>Name</label>
                                        </div>
                                        <div class="kt-form__control">
                                            <input type="text" name="name" class="form-control form-control-sm" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 kt-margin-b-20-tablet-and-mobile">
                                    <div class="kt-form__group kt-form__group--inline">
                                        <div class="kt-form__control">
                                            <button type="submit" class="btn btn-sm btn-success">Create</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--end: Search Form -->
        </div>
        <div class="kt-portlet__body kt-portlet__body--fit">
            <!--begin: Datatable -->
            <div class="kt-datatable" id="local_data"></div>
            <!--end: Datatable -->
        </div>
    </div>
</div>
<!-- end:: Content -->
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script src="./assets/js/data-faq-category-list.js" data-id="faq-category-list-script" data-url="<?php echo e(url('/')); ?>" type="text/javascript"></script>
<script>
    $(function() {
        var success_message = '<?php echo e($success_message ?? ''); ?>';
        var error_message = '<?php echo e($error_message ?? ''); ?>';
        if (success_message) {
          Toast.fire({
            type: 'success',
            title: success_message
          })
        }

        if (error_message) {
            toastr.error(error_message);
        }
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/tlanders/public_html/resources/views/admin/faqCategories/index.blade.php ENDPATH**/ ?>
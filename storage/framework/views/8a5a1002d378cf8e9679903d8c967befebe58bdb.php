
<?php $__env->startPush('styles'); ?>
<link href="./assets/vendors/general/summernote/dist/summernote.css" rel="stylesheet" type="text/css" />
<link href="./assets/vendors/bootstrap-rating-master/bootstrap-rating.css" rel="stylesheet">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="row">
        <div class="col">
            <!--begin::Portlet-->
            <div class="kt-portlet">
                <form class="kt-form" id="add-form-page" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo e($trip_faq->id); ?>">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                          <span class="kt-portlet__head-icon">
                              <i class="kt-font-brand flaticon-edit-1"></i>
                          </span>
                            <h3 class="kt-portlet__head-title">
                                Edit Trip Faq
                            </h3>
                        </div>
                        <div class="kt-form__actions mt-3">
                            <a href="<?php echo e(route('admin.trip-faqs.index')); ?>" class="btn btn-sm btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-sm btn-primary">
                              <i class="flaticon2-check-mark"></i>
                            Update
                          </button>
                        </div>
                    </div>
                <!--begin::Form-->
                    <?php echo e(csrf_field()); ?>

                    <div class="kt-portlet__body">
                        <div class="form-group">
                          <label class="form-label">Trip</label>
                          <select class="custom-select form-control form-control-sm" name="trip_id">
                              <option value="">--Select Trip--</option>
                              <?php $__currentLoopData = $trips; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value="<?php echo e($trip->id); ?>" <?php echo (($trip_faq->trip_id == $trip->id)?'selected':'');?>><?php echo e($trip->name); ?></option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </select>
                        </div>
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" value="<?php echo e($trip_faq->title); ?>" name="title" class="form-control" placeholder="" required>
                        </div>
                        <div class="form-group">
                            <label>Faq</label>
                            
                            <div id="summernote-description" class="summernote"></div>
                        </div>
                    </div>
                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <button type="submit" class="btn btn-sm btn-primary">
                              <i class="flaticon2-check-mark"></i>
                            Update
                          </button>
                        </div>
                    </div>
                </form>
                <!--end::Form-->
            </div>
            <!--end::Portlet-->
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script src="./assets/vendors/general/summernote/dist/summernote.js" type="text/javascript"></script>
<script src="./assets/vendors/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="./assets/vendors/bootstrap-rating-master/bootstrap-rating.min.js"></script>
<script type="text/javascript">
$(function() {
    function initSummerNote() {
      $('#summernote-description').summernote({
        height: 400
      });
      let code = `<?= $trip_faq->description; ?>`;
      $('#summernote-description').summernote("code", code);
    }

  $("#trip-rating").rating();
	$("#add-form-page").validate({
		submitHandler: function(form, event) {
      event.preventDefault();
      var btn = $(form).find('button[type=submit]').attr('disabled', true).html('Publishing...');
      handleRegionForm(form);
	  }
	});

  function handleRegionForm(form) {
    var form = $(form);
    var formData = new FormData(form[0]);
    var description = form.find('#summernote-description').summernote('code');
    formData.append('description', description);
    $.ajax({
        url: "<?php echo e(route('admin.trip-faqs.update')); ?>",
        type: 'POST',
        data: formData,
        dataType: 'json',
        processData: false,
        contentType: false,
        async: false,
        success: function(res) {
            if (res.status === 1) {
                location.href = '<?php echo e(route('admin.trip-faqs.index')); ?>';
            }
        }
    });
  }
  initSummerNote();
});

</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/tlanders/public_html/resources/views/admin/tripFaqs/edit.blade.php ENDPATH**/ ?>
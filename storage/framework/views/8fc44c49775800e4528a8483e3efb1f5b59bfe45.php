
<?php $__env->startPush('styles'); ?>
<link href="./assets/vendors/general/summernote/dist/summernote.css" rel="stylesheet" type="text/css" />
<link href="./assets/vendors/cropperjs/dist/cropper.min.css" rel="stylesheet">
<link href="./assets/vendors/bootstrap-rating-master/bootstrap-rating.css" rel="stylesheet">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="row">
        <div class="col">
            <!--begin::Portlet-->
            <div class="kt-portlet">
                <form class="kt-form" id="add-form-page" enctype="multipart/form-data">

                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                      <span class="kt-portlet__head-icon">
                          <i class="kt-font-brand flaticon-business"></i>
                      </span>
                        <h3 class="kt-portlet__head-title">
                            Add Trip Faq
                        </h3>
                    </div>
                    <div class="kt-form__actions mt-3">
                        <a href="<?php echo e(route('admin.trip-faqs.index')); ?>" class="btn btn-sm btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-sm btn-primary">
                              <i class="flaticon2-arrow-up"></i>
                            Publish</button>
                    </div>
                </div>
                <!--begin::Form-->
                    <?php echo e(csrf_field()); ?>

                    <div class="kt-portlet__body">
                        <div class="form-group">
                          <label class="form-label">Trip</label>
                          <select class="custom-select form-control form-control-sm" name="trip_id">
                              <option selected="" value="">--Select Trip--</option>
                              <?php $__currentLoopData = $trips; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value="<?php echo e($trip->id); ?>"><?php echo e($trip->name); ?></option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </select>
                        </div>
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" placeholder="" required>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            
                            <div id="summernote-description" class="summernote"></div>
                        </div>
                    </div>
                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            
                            
                            <button type="submit" class="btn btn-sm btn-primary">
                                  <i class="flaticon2-arrow-up"></i>
                                Publish</button>
                        </div>
                    </div>
                <!--end::Form-->
            </div>
                </form>

            <!--end::Portlet-->
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script src="./assets/vendors/general/summernote/dist/summernote.js" type="text/javascript"></script>
<script src="./assets/js/demo1/pages/crud/forms/widgets/summernote.js" type="text/javascript"></script>
<script src="./assets/vendors/cropperjs/dist/cropper.min.js"></script>
<script src="./assets/vendors/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="./assets/vendors/bootstrap-rating-master/bootstrap-rating.min.js"></script>
<script type="text/javascript">
$(function() {
  $("#trip-rating").rating();
		$("#add-form-page").validate({
			submitHandler: function(form, event) {
        event.preventDefault();
        var btn = $(form).find('button[type=submit]').attr('disabled', true).html('Publishing...');
        handleFaqAddForm(form);
		  }
		});
		var cropped = false;
    const image = document.getElementById('cropper-image');
    var cropper = "";

    function handleFaqAddForm(form) {
      var form = $(form);
      var formData = new FormData(form[0]);
      var description = form.find('#summernote-description').summernote('code');
      formData.append('description', description);

      if (cropper) {
        formData.append('cropped_data', JSON.stringify(cropper.getData()));
      }

      $.ajax({
          url: "<?php echo e(route('admin.trip-faqs.store')); ?>",
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

    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
          $('#cropper-image').attr('src', e.target.result);
          initCropperjs();
        }

        reader.readAsDataURL(input.files[0]);
      }
    }

    $("#cropper-upload").change(function() {
      readURL(this);
    });

    function initCropperjs() {
    	if (cropped) {
    		cropper.destroy();
    		cropped = false;
    	}

	    cropper = new Cropper(image, {
	        aspectRatio: 1 / 1,
	        zoomable: false,
	        viewMode: 2,
	        crop(event) {
	            // console.log(event.detail.x);
	            // console.log(event.detail.y);
	            // console.log(event.detail.width);
	            // console.log(event.detail.height);
	            // console.log(event.detail.rotate);
	            // console.log(event.detail.scaleX);
	            // console.log(event.detail.scaleY);
	        },
	    });

	    cropped = true;
    }
});

</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/tlanders/public_html/resources/views/admin/tripFaqs/add.blade.php ENDPATH**/ ?>

<?php $__env->startPush('styles'); ?>
<link href="./assets/vendors/cropperjs/dist/cropper.min.css" rel="stylesheet">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="row">
        <div class="col">
            <!--begin::Portlet-->
            <div class="kt-portlet">
                <form class="kt-form" id="add-form-page" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo e($banner->id); ?>">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                          <span class="kt-portlet__head-icon">
                              <i class="kt-font-brand flaticon-edit-1"></i>
                          </span>
                            <h3 class="kt-portlet__head-title">
                                Edit Banner
                            </h3>
                        </div>
                        <div class="kt-form__actions mt-3">
                            <a href="<?php echo e(route('admin.banners.index')); ?>" class="btn btn-sm btn-secondary">Cancel</a>
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
                            <label for="">Banner Image</label>
                            <div class="row">
                              <div class="col-lg-7">
                                <div class="mb-3">
                                    <img id="cropper-image" class="crop-img-div" src="<?php echo e($banner->image_url); ?>">
                                </div>
                                <input type="file" name="file" id="cropper-upload">
                              </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>ALT Tag</label>
                            <input type="text" value="<?php echo e($banner->image_alt); ?>" name="image_alt" class="form-control" placeholder="">
                        </div>
                        <div class="form-group">
                            <label>Caption</label>
                            <input type="text" value="<?php echo e($banner->caption); ?>" name="caption" class="form-control" placeholder="">
                        </div>
                        <div class="form-group">
                            <label>View More Button Link</label>
                            <input type="text" value="<?php echo e($banner->btn_link); ?>" name="btn_link" class="form-control" placeholder="">
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
<script src="./assets/vendors/cropperjs/dist/cropper.min.js"></script>
<script src="./assets/vendors/jquery-validation/dist/jquery.validate.min.js"></script>
<script type="text/javascript">
$(function() {
	$("#add-form-page").validate({
		submitHandler: function(form, event) {
      event.preventDefault();
      var btn = $(form).find('button[type=submit]').attr('disabled', true).html('Publishing...');
      handleBannerForm(form);
	  }
	});
	var cropped = false;
  const image = document.getElementById('cropper-image');
  var cropper = "";

  function handleBannerForm(form) {
    var form = $(form);
    var formData = new FormData(form[0]);
    if (cropper) {
      formData.append('cropped_data', JSON.stringify(cropper.getData()));
    }

    $.ajax({
        url: "<?php echo e(route('admin.banners.update')); ?>",
        type: 'POST',
        data: formData,
        dataType: 'json',
        processData: false,
        contentType: false,
        async: false,
        success: function(res) {
            if (res.status === 1) {
                location.href = '<?php echo e(route('admin.banners.index')); ?>';
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
        aspectRatio: 3 / 2,
        zoomable: false,
        viewMode: 1,
        ready: function (data) {
          var contData = cropper.getImageData(); //Get container data
          cropper.setCropBoxData({"left":0,"top":0,"width":contData.width,"height":contData.height});
        },
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

  initCropperjs();
  initSummerNote();
});

</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/tlanders/public_html/resources/views/admin/banners/edit.blade.php ENDPATH**/ ?>

<?php $__env->startPush('styles'); ?>
<link href="./assets/vendors/general/summernote/dist/summernote.css" rel="stylesheet" type="text/css" />
<link href="./assets/vendors/cropperjs/dist/cropper.min.css" rel="stylesheet">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="row">
        <div class="col">
            <!--begin::Portlet-->
            <div class="kt-portlet">
                <form class="kt-form" id="add-form-page" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo e($page->id); ?>">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                          <span class="kt-portlet__head-icon">
                              <i class="kt-font-brand flaticon-edit-1"></i>
                          </span>
                            <h3 class="kt-portlet__head-title">
                                Edit Page
                            </h3>
                        </div>
                        <div class="kt-form__actions mt-3">
                            <a href="<?php echo e(route('admin.pages.index')); ?>" class="btn btn-sm btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-sm btn-primary">
                              <i class="flaticon2-check-mark"></i>
                            Update
                          </button>
                        </div>
                    </div>
                    <!--begin::Form-->
                    <?php echo e(csrf_field()); ?>

                    <div class="kt-portlet__body">
                      <ul class="nav nav-tabs" id="tripTab" role="tablist">
                          <li class="nav-item">
                              <a class="nav-link active" data-toggle="tab" href="#kt_tabs_1_1">
                                  <i class="la la-map-pin"></i> General
                              </a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" data-toggle="tab" href="#kt_tabs_1_2">
                                  <i class="la la-map-signs"></i> Seo Manager
                              </a>
                          </li>
                      </ul>
                      <div class="tab-content trip-tab-form">
                        
                        <div class="tab-pane active" id="kt_tabs_1_1" role="tabpanel">
                          <div class="form-group">
                              <label for="">Page Image</label>
                              <div class="row">
                                <div class="col-lg-7">
                                  <div class="mb-3">
                                      <img id="cropper-image" class="crop-img-div" src="<?php echo e($page->image_url); ?>">
                                  </div>
                                  <input type="file" name="file" id="cropper-upload">
                                </div>
                              </div>
                          </div>
                          <div class="form-group">
                              <label>Title</label>
                              <input type="text" value="<?php echo e($page->name); ?>" name="name" class="form-control" aria-describedby="emailHelp" placeholder="Title" required>
                          </div>
                          <div class="form-group">
                              <label>Description</label>
                              <div id="summernote-description" class="summernote">
                              </div>
                          </div>
                        </div>
                        
                        
                        <div class="tab-pane" data-index="2" id="kt_tabs_1_2" role="tabpanel">
                          <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Meta Title</label>
                            <div class="col-lg-7">
                              <textarea name="seo[meta_title]" class="form-control form-control-sm" id="" cols="30" rows="2"><?php echo e($page->seo->meta_title ?? ''); ?></textarea>
                              
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Meta Keywords</label>
                            <div class="col-lg-7">
                              <textarea name="seo[meta_keywords]" class="form-control form-control-sm" id="" cols="30" rows="2"><?php echo e($page->seo->meta_keywords ?? ''); ?></textarea>
                              
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Canonical Url</label>
                            <div class="col-lg-7">
                              <input type="text" id="input-trip-name" value="<?php echo e($page->seo->canonical_url ?? ''); ?>" class="form-control form-control-sm" name="seo[canonical_url]">
                              
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Meta Description</label>
                            <div class="col-lg-7">
                              <textarea name="seo[meta_description]" class="form-control form-control-sm" id="" cols="30" rows="2"><?php echo e($page->seo->meta_description ?? ''); ?></textarea>
                              
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Social Image</label>
                            <div class="col-lg-7">
                              <div>
                                <p id="social_image_name"><?php echo e($page->seo->social_image ?? ''); ?></p>
                              </div>
                              <div>
                                <button type="button" class="btn btn-sm btn-secondary btn-wide" onclick="document.getElementById('social_image').click();"> Upload Social Image
                                </button>
                              </div>
                              <input type="file" style="display: none;" id="social_image" class="form-control form-control-sm" name="seo[social_image]">
                            </div>
                          </div>
                        </div>
                        
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

<script src="./assets/vendors/cropperjs/dist/cropper.min.js"></script>
<script src="./assets/vendors/jquery-validation/dist/jquery.validate.min.js"></script>
<script type="text/javascript">
$(function() {
  function initSummerNote() {
    $('#summernote-description').summernote({
      height: 400
    });
    let code = `<?= $page->description; ?>`;
    $('#summernote-description').summernote("code", code);
  }
	$("#add-form-page").validate({
		submitHandler: function(form, event) {
      event.preventDefault();
      var btn = $(form).find('button[type=submit]').attr('disabled', true).html('Publishing...');
      handlePageForm(form);
	  }
	});
	var cropped = false;
  const image = document.getElementById('cropper-image');
  var cropper = "";

  function handlePageForm(form) {
    var form = $(form);
    var formData = new FormData(form[0]);
    var description = form.find('#summernote-description').summernote('code');
    formData.append('description', description);
    if (cropper) {
      formData.append('cropped_data', JSON.stringify(cropper.getData()));
    }

    $.ajax({
        url: "<?php echo e(route('admin.pages.update')); ?>",
        type: 'POST',
        data: formData,
        dataType: 'json',
        processData: false,
        contentType: false,
        async: false,
        success: function(res) {
            if (res.status === 1) {
                location.href = '<?php echo e(route('admin.pages.index')); ?>';
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
        viewMode: 2,
        ready: function (data) {
          var contData = cropper.getImageData(); //Get container data
          console.log(contData);
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/tlanders/public_html/resources/views/admin/pages/edit.blade.php ENDPATH**/ ?>
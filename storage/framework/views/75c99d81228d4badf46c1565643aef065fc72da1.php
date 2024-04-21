<?php
  if (session()->has('success_message')) {
    $success_message = session('success_message');
    session()->forget('success_message');
  }
?>

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
                  <div class="kt-portlet__head">
                      <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon">
                            <i class="kt-font-brand flaticon2-settings"></i>
                        </span>
                          <h3 class="kt-portlet__head-title">
                              Seo Manager
                          </h3>
                      </div>
                  </div>
                  <!--begin::Form-->
                  <div class="kt-portlet__body">
                      
                      <div class="tab-pane" data-index="3" id="kt_tabs_1_3" role="tabpanel">
                        <form class="kt-form" method="POST" action="<?php echo e(route('admin.settings.seo-manager.store')); ?>" id="setting-contact-us-form" enctype="multipart/form-data">
                          <?php echo e(csrf_field()); ?>

                          <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Meta Title </label>
                            <div class="col-lg-7">
                              <input type="text" id="input-trip-name" class="form-control form-control-sm" name="meta_title" value="<?php echo e(Setting::get('homePageSeo')['meta_title'] ?? ''); ?>">
                              
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Meta Keywords </label>
                            <div class="col-lg-7">
                              <textarea name="meta_keywords" class="form-control" id="" cols="30" rows="2"><?php echo e(Setting::get('homePageSeo')['meta_keywords'] ?? ''); ?></textarea>
                              
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-lg-2 col-form-label">OG Title</label>
                            <div class="col-lg-7">
                              <input type="text" id="input-trip-name" class="form-control form-control-sm" name="og_title" value="<?php echo e(Setting::get('homePageSeo')['og_title'] ?? ''); ?>">
                              
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-lg-2 col-form-label">OG Site Name</label>
                            <div class="col-lg-7">
                              <input type="text" id="input-trip-name" class="form-control form-control-sm" name="og_site_name" value="<?php echo e(Setting::get('homePageSeo')['og_site_name'] ?? ''); ?>">
                              
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-lg-2 col-form-label">OG Description</label>
                            <div class="col-lg-7">
                              <textarea name="og_description" class="form-control" id="" cols="30" rows="2"><?php echo e(Setting::get('homePageSeo')['og_description'] ?? ''); ?></textarea>
                              
                            </div>
                          </div>
                          <div class="form-group row">
                            
                            <label class="col-lg-2 col-form-label">Og Image</label>
                            <div class="col-lg-7">
                              <div class="row">
                                <div class="col-lg-7">
                                  <div class="mb-3">
                                      <img id="cropper-image" class="crop-img-div" src="<?php echo e(Setting::getSiteSettingImage(Setting::get('homePageSeo')['og_image']??null)); ?>">
                                  </div>
                                </div>
                              </div>
                              <input type="hidden" id="cropped-data-input" name="cropped_data">
                              <input type="file" name="file" id="cropper-upload">
                              
                            </div>
                          </div>
                          <hr>
                          <div class="kt-form__actions">
                            <button type="submit" class="btn btn-sm btn-primary">
                                  <i class="flaticon2-arrow-up"></i>
                                Save</button>
                            
                          </div>
                        </form>
                      </div>
                      
                  </div>
                  <!-- <div class="kt-portlet__foot">
                      <div class="kt-form__actions">
                          
                          
                          <button type="submit" class="btn btn-sm btn-primary">
                                <i class="flaticon2-arrow-up"></i>
                              Publish</button>
                      </div>
                  </div> -->
                <!--end::Form-->
            </div>
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
<script src="./assets/vendors/jquery-validation/dist/additional-methods.min.js"></script>
<script src="./assets/vendors/bootstrap-rating-master/bootstrap-rating.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
$(function() {
  var success_message = '<?php echo e($success_message ?? ''); ?>';
  if (success_message) {
    Toast.fire({
      type: 'success',
      title: success_message
    })
  }

    var cropped = false;
    const image = document.getElementById('cropper-image');
    var cropper = "";

    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
          $('#cropper-image').attr('src', e.target.result);
          // initCropperjs();
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
          aspectRatio: 2 / 1,
          zoomable: false,
          viewMode: 2,
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

    // initCropperjs();
});

</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/tlanders/public_html/resources/views/admin/siteSettings/seo-manager.blade.php ENDPATH**/ ?>
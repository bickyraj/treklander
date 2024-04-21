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
                              Site Settings
                          </h3>
                      </div>
                  </div>
                  <!--begin::Form-->
                  <div class="kt-portlet__body">

                    <ul class="nav nav-tabs trip-nav-tabs" id="tripTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#kt_tabs_1_1">
                                <i class="la la-map-pin"></i> General
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#kt_tabs_1_2">
                                <i class="la la-map-signs"></i> Home Page
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#kt_tabs_1_3">
                                <i class="la la-phone"></i> Contact Us
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#kt_tabs_1_4">
                                <i class="la la-share-alt"></i> Get Connected
                            </a>
                        </li>
                    </ul>

                    <div id="trip-tab" class="tab-content trip-tab-form">
                      <div class="tab-pane active" data-index="1" id="kt_tabs_1_1" role="tabpanel">
                        <form class="kt-form" method="POST" action="<?php echo e(route('admin.settings.general.store')); ?>" id="setting-form" enctype="multipart/form-data">
                        <?php echo e(csrf_field()); ?>


                          <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Site Name </label>
                            <div class="col-lg-7">
                              <input type="text" id="input-trip-name" class="form-control form-control-sm" name="site_name" value="<?php echo e(Setting::get('site_name')); ?>">
                              
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Email</label>
                            <div class="col-lg-7">
                              <input type="email" id="input-trip-name" class="form-control form-control-sm" name="email" value="<?php echo e(Setting::get('email')); ?>">
                              
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Telephone</label>
                            <div class="col-lg-7">
                              <input type="text" id="input-trip-name" class="form-control form-control-sm" name="telephone" value="<?php echo e(Setting::get('telephone')); ?>">
                              
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Mobile 1</label>
                            <div class="col-lg-7">
                              <input type="text" id="input-trip-name" class="form-control form-control-sm" name="mobile1" value="<?php echo e(Setting::get('mobile1')); ?>">
                              
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Mobile 2</label>
                            <div class="col-lg-7">
                              <input type="text" id="input-trip-name" class="form-control form-control-sm" name="mobile2" value="<?php echo e(Setting::get('mobile2')); ?>">
                              
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Address</label>
                            <div class="col-lg-7">
                              <input type="text" id="input-trip-name" class="form-control form-control-sm" name="address" value="<?php echo e(Setting::get('address')); ?>">
                              
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Office Time</label>
                            <div class="col-lg-7">
                              <input type="text" id="input-office-time" class="form-control form-control-sm" name="office_time" value="<?php echo e(Setting::get('office_time')); ?>">
                              
                            </div>
                          </div>
                          <hr>
                          <div class="kt-form__actions">
                            <button type="submit" class="btn btn-sm btn-primary">
                                  <i class="flaticon2-arrow-up"></i>
                                Save</button>
                            <a href="<?php echo e(route('admin.settings.general')); ?>" class="btn btn-secondary">Cancel</a>
                          </div>
                        </form>
                      </div>

                      
                      <div class="tab-pane" data-index="2" id="kt_tabs_1_2" role="tabpanel">
                        <form class="kt-form" method="POST" action="<?php echo e(route('admin.settings.home-page.store')); ?>" id="setting-home-form" enctype="multipart/form-data">
                          <?php echo e(csrf_field()); ?>

                          
                          <h5>Welcome</h5>
                          <hr>
                          <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Title </label>
                            <div class="col-lg-7">
                              <input type="text" id="input-trip-name" class="form-control form-control-sm" name="welcome[title]" value="<?php echo e(Setting::get('homePage')['welcome']['title']??''); ?>">
                              
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Sub Title </label>
                            <div class="col-lg-7">
                              <input type="text" id="input-trip-name" class="form-control form-control-sm" name="welcome[sub_title]" value="<?php echo e(Setting::get('homePage')['welcome']['sub_title']??''); ?>">
                              
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Content</label>
                            <div class="col-lg-7">
                              <input type="hidden" name="welcome[content]">
                              <div id="summernote-home-content" class="summernote"><?= Setting::get('homePage')['welcome']['content']??'' ?></div>
                            </div>
                          </div>
                          <hr>
                          <!-- <h5>Reason</h5>
                            <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Title </label>
                            <div class="col-lg-7">
                              <input type="text" id="input-trip-name" class="form-control form-control-sm" name="reason[title]" value="<?php echo e(Setting::get('homePage')['reason']['title']??''); ?>">
                              <span class="form-text text-muted">Please enter your full name</span>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Content</label>
                            <div class="col-lg-7">
                              <input type="hidden" name="reason[content]">
                              <div id="summernote-reason-content" class="summernote"><?= Setting::get('homePage')['reason']['content']??'' ?></div>
                            </div>
                          </div>
                          <hr> -->
                          <h5>Trip Block 1</h5>
                          <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Title </label>
                            <div class="col-lg-7">
                              <input type="text" id="input-trip-name" class="form-control form-control-sm" name="trip_block_1[title]" value="<?php echo e(Setting::get('homePage')['trip_block_1']['title'] ?? ''); ?>">
                              
                            </div>
                          </div>
                          <hr>
                          <h5>Trip Block 2</h5>
                          <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Title </label>
                            <div class="col-lg-7">
                              <input type="text" id="input-trip-name" class="form-control form-control-sm" name="trip_block_2[title]" value="<?php echo e(Setting::get('homePage')['trip_block_2']['title'] ?? ''); ?>">
                              
                            </div>
                          </div>
                          <h5>Trip Block 3</h5>
                          <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Title </label>
                            <div class="col-lg-7">
                              <input type="text" id="input-trip-name" class="form-control form-control-sm" name="trip_block_3[title]" value="<?php echo e(Setting::get('homePage')['trip_block_3']['title'] ?? ''); ?>">
                              
                            </div>
                          </div>
                          <hr>
                          <!-- <h5>Blog Block</h5>
                          <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Title </label>
                            <div class="col-lg-7">
                              <input type="text" id="input-trip-name" class="form-control form-control-sm" name="blog[title]" value="<?php echo e(Setting::get('homePage')['blog']['title'] ?? ''); ?>">
                              
                            </div>
                          </div>
                          <hr> -->
                          <h5>Video</h5>
                          <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Link </label>
                            <div class="col-lg-7">
                              <input type="text" id="input-trip-name" class="form-control form-control-sm" name="video[link]" value="<?php echo e(Setting::get('homePage')['video']['link'] ?? ''); ?>">
                              
                            </div>
                          </div>
                          

                          <hr>
                          <div class="kt-form__actions">
                            <button type="submit" id="home-page-save-btn" class="btn btn-sm btn-primary">
                                  <i class="flaticon2-arrow-up"></i>
                                Save</button>
                            <a href="<?php echo e(route('admin.settings.general')); ?>" class="btn btn-secondary">Cancel</a>
                          </div>
                        </form>
                      </div>
                      

                      
                      <div class="tab-pane" data-index="3" id="kt_tabs_1_3" role="tabpanel">
                        <form class="kt-form" method="POST" action="<?php echo e(route('admin.settings.contact-us.store')); ?>" id="setting-contact-us-form" enctype="multipart/form-data">
                          <?php echo e(csrf_field()); ?>

                          <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Title </label>
                            <div class="col-lg-7">
                              <input type="text" id="input-trip-name" class="form-control form-control-sm" name="title" value="<?php echo e(Setting::get('contactUs')['title'] ?? ''); ?>">
                              
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Content </label>
                            <div class="col-lg-7">
                              <textarea name="content" class="form-control" id="" cols="30" rows="10"><?php echo e(Setting::get('contactUs')['content'] ?? ''); ?></textarea>
                              
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Map Iframe</label>
                            <div class="col-lg-7">
                              <textarea name="map" class="form-control" id="" cols="30" rows="10"><?php echo e(Setting::get('contactUs')['map'] ?? ''); ?></textarea>
                              
                            </div>
                          </div>
                          <hr>
                          <div class="kt-form__actions">
                            <button type="submit" class="btn btn-sm btn-primary">
                                  <i class="flaticon2-arrow-up"></i>
                                Save</button>
                            <a href="<?php echo e(route('admin.settings.general')); ?>" class="btn btn-secondary">Cancel</a>
                          </div>
                        </form>
                      </div>
                      

                      
                      <div class="tab-pane" data-index="4" id="kt_tabs_1_4" role="tabpanel">
                        <form class="kt-form" method="POST" action="<?php echo e(route('admin.settings.socialmedia.store')); ?>" id="setting-form">
                        <?php echo e(csrf_field()); ?>


                          <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Pinterest </label>
                            <div class="col-lg-7">
                              <input type="text" id="input-pinterest" class="form-control form-control-sm" name="pinterest" value="<?php echo e(Setting::get('pinterest')); ?>">
                              
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Facebook</label>
                            <div class="col-lg-7">
                              <input type="text" id="input-facebook" class="form-control form-control-sm" name="facebook" value="<?php echo e(Setting::get('facebook')); ?>">
                              
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Instagram</label>
                            <div class="col-lg-7">
                              <input type="text" id="input-instagram" class="form-control form-control-sm" name="instagram" value="<?php echo e(Setting::get('instagram')); ?>">
                              
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Twitter</label>
                            <div class="col-lg-7">
                              <input type="text" id="input-twitter" class="form-control form-control-sm" name="twitter" value="<?php echo e(Setting::get('twitter')); ?>">
                              
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Flicker</label>
                            <div class="col-lg-7">
                              <input type="text" id="input-flicker" class="form-control form-control-sm" name="flicker" value="<?php echo e(Setting::get('flicker')); ?>">
                              
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-lg-2 col-form-label">What's App</label>
                            <div class="col-lg-7">
                              <input type="text" id="input-whatsapp" class="form-control form-control-sm" name="whatsapp" value="<?php echo e(Setting::get('whatsapp')); ?>">
                              
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Viber</label>
                            <div class="col-lg-7">
                              <input type="text" id="input-viber" class="form-control form-control-sm" name="viber" value="<?php echo e(Setting::get('viber')); ?>">
                              
                            </div>
                          </div>
                          <hr>
                          <div class="kt-form__actions">
                            <button type="submit" class="btn btn-sm btn-primary">
                                  <i class="flaticon2-arrow-up"></i>
                                Save</button>
                            <a href="<?php echo e(route('admin.settings.general')); ?>" class="btn btn-secondary">Cancel</a>
                          </div>
                        </form>
                      </div>
                      
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

    var validation_rules = {
        pdf_file_name: {
          extension: "pdf"
        },
        map_file_name: {
          extension: "jpeg|jpg|png|gif"
        },
        "trip_seo[og_image]": {
          extension: "jpeg|jpg|png|gif"
        },
        cost: {
          number: true
        },
        max_altitude: {
          number: true
        },
        offer_price: {
          number: true
        }
    };
    var validation_messages = {
      pdf_file_name: {
          extension: "Only pdf is allowed."
      },
      map_file_name: {
          extension: "Only image files is allowed."
      }
    };

    $('#setting-home-form button[type="submit"]').on('click', function(event) {
      event.preventDefault();
      $('input[name="welcome[content]"]').val($('#summernote-home-content').summernote('code'));
      $('input[name="reason[content]"]').val($('#summernote-reason-content').summernote('code'));
      $("#setting-home-form").submit();
    });

    function handleTripAddForm(form, cont = false) {

      var form = $(form);
      var formData = new FormData(form[0]);

      if (!$('#tripTab li:nth-child(2) a').hasClass("disabled")) {
        var trip_info = "";

        trip_info = {
          'accomodation' : $('#summernote-accomodation').summernote('code'),
          'meals' : $('#summernote-meals').summernote('code'),
          'transportation' : $('#summernote-transportation').summernote('code'),
          'overview' : $('#summernote-overview').summernote('code'),
          'highlights' : $('#summernote-highlights').summernote('code')
        };

        formData.append('trip_info', JSON.stringify(trip_info));
      }

      if (!$('#tripTab li:nth-child(3) a').hasClass("disabled")) {
        var trip_include = "";

        trip_include = {
          'include' : $('#summernote-include').summernote('code'),
          'exclude' : $('#summernote-exclude').summernote('code'),
        };

        formData.append('trip_include_exclude', JSON.stringify(trip_include));
      }

      if (!$('#tripTab li:nth-child(4) a').hasClass("disabled")) {
        var trip_leader = $('#summernote-leader').summernote('code');
        formData.append('trip_seo[about_leader]', trip_leader);
      }

      if (!$('#tripTab li:nth-child(5) a').hasClass("disabled")) {

        $.each($("#itinerary-block>.itinerary-group").find('.summernote'), function(i, v) {
          var desc = $(v).summernote('code');
          formData.append('trip_itineraries['+i+'][day]', i + 1);
          formData.append('trip_itineraries['+i+'][display_order]', i + 1);
          formData.append('trip_itineraries['+i+'][description]', desc);
        });
      }

      $.ajax({
          url: "<?php echo e(route('admin.trips.store')); ?>",
          type: 'POST',
          data: formData,
          dataType: 'json',
          processData: false,
          contentType: false,
          async: false,
          success: function(res) {
              if (res.status === 1) {
                if (cont) {
                  if (typeof(Storage) !== "undefined") {
                    // Store
                    sessionStorage.setItem("save-and-continue", true);
                  }

                  location.href = '<?php echo e(url('/admin/trips/edit')); ?>' + '/' + res.trip.id ;
                } else {
                  location.href = '<?php echo e(route('admin.trips.index')); ?>';
                }
              }
          }
      });
    }

    function initSummerNote() {
      $('#summernote-home-content').summernote();
      $('#summernote-reason-content').summernote();
    }

    var cropped = false;
    const image = document.getElementById('cropper-image');
    var cropper = "";

    function handleBannerAddForm(form) {
      var form = $(form);
      var formData = new FormData(form[0]);
      if (cropper) {
        formData.append('cropped_data', JSON.stringify(cropper.getData()));
      }
    }

    $("#home-page-save-btn").on('click', function(event) {
      event.preventDefault();
      if (cropper) {
        $("#cropped-data-input").val(JSON.stringify(cropper.getData()));
      }
      $(this).closest('form').submit();
    });

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

    initCropperjs();
    initSummerNote();
});

</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/tlanders/public_html/resources/views/admin/siteSettings/index.blade.php ENDPATH**/ ?>
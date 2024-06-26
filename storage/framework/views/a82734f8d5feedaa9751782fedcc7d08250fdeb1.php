
<?php $__env->startPush('styles'); ?>
<link href="./assets/vendors/general/summernote/dist/summernote.css" rel="stylesheet" type="text/css" />
<link href="./assets/css/drag-drop.css" rel="stylesheet" type="text/css" />
<style>
    .nestable .mega-menu-div {
        display: none;
    }

    .nestable2 .mega-menu-div {
        display: none;
    }

    .nestable2>ol>li>div.mega-menu-div {
        display: inherit;
    }
</style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="row">
        <div class="col">
            <!--begin::Portlet-->
            <div class="kt-portlet">
                <form class="kt-form" id="add-form-page" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo e($menu->id); ?>">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <span class="kt-portlet__head-icon">
                                <i class="kt-font-brand flaticon-business"></i>
                            </span>
                            <h3 class="kt-portlet__head-title">
                                Add Menu
                            </h3>
                        </div>
                        <div class="kt-form__actions mt-3">
                            <a href="<?php echo e(route('admin.menus.index')); ?>" class="btn btn-sm btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-sm btn-primary">
                                <i class="flaticon2-arrow-up"></i>
                                Publish</button>
                        </div>
                    </div>
                    <!--begin::Form-->
                    <?php echo e(csrf_field()); ?>

                    <div class="kt-portlet__body">
                        <div class="form-group row">
                            <label class="col-lg-1 col-form-label">Name</label>
                            <div class="col-lg-3">
                                <input type="text" class="form-control" name="name" value="<?php echo e($menu->name); ?>" placeholder="name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <menu id="nestable-menu" class="pull-right">
                                    <button type="button" class="ml-2 btn btn-bold btn-label-brand btn-square btn-sm pull-right" data-backdrop="static" data-toggle="modal" data-target="#kt_modal_4">Add Custom Link</button>
                                    <button class="btn btn-sm btn-outline-brand btn-elevate btn-square" type="button" data-action="expand-all">Expand All
                                        <i class="flaticon2-arrow-1"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-brand btn-elevate btn-square" type="button" data-action="collapse-all">Collapse All
                                        <i class="flaticon2-size"></i>
                                    </button>
                                </menu>
                                <div class="cf nestable-lists">
                                    <div class="dd nestable" id="nestable">
                                        <ol class="dd-list">
                                            <?php if($pages): ?>
                                              <li class="dd-item" data-type="main" data-mega-menu="0" data-name="pages" data-id="1">
                                                  <div class="dd-handle">Pages</div>
                                                  <div class="mega-menu-div">
                                                      <div class="checkbox-inline" style="position: absolute; top: 0px; right: 12px; padding-top: 6px;">
                                                          <label class="checkbox checkbox-success" style="color:white;">
                                                          <input class="mega-menu-checkbox" type="checkbox">
                                                          <span></span>Mega Menu</label>
                                                      </div>
                                                  </div>
                                                  <ol class="dd-list">
                                                  <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li class="dd-item" data-mega-menu="0" data-type="page" data-name="<?= $page->name; ?>" data-id="<?= $page->id; ?>">
                                                        <div class="dd-handle"><?php echo e($page->name); ?></div>
                                                        <div class="mega-menu-div">
                                                            <div class="checkbox-inline" style="position: absolute; top: 0px; right: 12px; padding-top: 6px;">
                                                                <label class="checkbox checkbox-success" style="color:white;">
                                                                <input class="mega-menu-checkbox" type="checkbox">
                                                                <span></span>Mega Menu</label>
                                                            </div>
                                                        </div>
                                                    </li>
                                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                  </ol>
                                              </li>
                                            <?php endif; ?>
                                            <?php if($destinations): ?>
                                              <li class="dd-item" data-type="main" data-mega-menu="0" data-name="destinations" data-id="2">
                                                  <div class="dd-handle">Destinations</div>
                                                  <div class="mega-menu-div">
                                                      <div class="checkbox-inline" style="position: absolute; top: 0px; right: 12px; padding-top: 6px;">
                                                          <label class="checkbox checkbox-success" style="color:white;">
                                                          <input class="mega-menu-checkbox" type="checkbox">
                                                          <span></span>Mega Menu</label>
                                                      </div>
                                                  </div>
                                                  <ol class="dd-list">
                                                  <?php $__currentLoopData = $destinations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $destination): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li class="dd-item" data-mega-menu="0" data-type="destination" data-name="<?= $destination->name; ?>" data-id="<?= $destination->id; ?>">
                                                        <div class="dd-handle"><?php echo e($destination->name); ?></div>
                                                        <div class="mega-menu-div">
                                                            <div class="checkbox-inline" style="position: absolute; top: 0px; right: 12px; padding-top: 6px;">
                                                                <label class="checkbox checkbox-success" style="color:white;">
                                                                <input class="mega-menu-checkbox" type="checkbox">
                                                                <span></span>Mega Menu</label>
                                                            </div>
                                                        </div>
                                                    </li>
                                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                  </ol>
                                              </li>
                                            <?php endif; ?>
                                            <?php if($trips): ?>
                                              <li class="dd-item" data-type="main" data-mega-menu="0" data-name="packages" data-id="3">
                                                  <div class="dd-handle">Packages</div>
                                                  <div class="mega-menu-div">
                                                      <div class="checkbox-inline" style="position: absolute; top: 0px; right: 12px; padding-top: 6px;">
                                                          <label class="checkbox checkbox-success" style="color:white;">
                                                          <input class="mega-menu-checkbox" type="checkbox">
                                                          <span></span>Mega Menu</label>
                                                      </div>
                                                  </div>
                                                  <ol class="dd-list">
                                                  <?php $__currentLoopData = $trips; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li class="dd-item" data-type="trip" data-mega-menu="0" data-name="<?= $trip->name; ?>" data-id="<?= $trip->id; ?>">
                                                        <div class="dd-handle"><?php echo e($trip->name); ?></div>
                                                        <div class="mega-menu-div">
                                                            <div class="checkbox-inline" style="position: absolute; top: 0px; right: 12px; padding-top: 6px;">
                                                                <label class="checkbox checkbox-success" style="color:white;">
                                                                <input class="mega-menu-checkbox" type="checkbox">
                                                                <span></span>Mega Menu</label>
                                                            </div>
                                                        </div>
                                                    </li>
                                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                  </ol>
                                              </li>
                                            <?php endif; ?>
                                            <?php if($activities): ?>
                                              <li class="dd-item" data-type="main" data-mega-menu="0" data-name="activities" data-id="4">
                                                  <div class="dd-handle">Activities</div>
                                                  <div class="mega-menu-div">
                                                      <div class="checkbox-inline" style="position: absolute; top: 0px; right: 12px; padding-top: 6px;">
                                                          <label class="checkbox checkbox-success" style="color:white;">
                                                          <input class="mega-menu-checkbox" type="checkbox">
                                                          <span></span>Mega Menu</label>
                                                      </div>
                                                  </div>
                                                  <ol class="dd-list">
                                                  <?php $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li class="dd-item" data-type="activity" data-mega-menu="0" data-name="<?= $activity->name; ?>" data-id="<?= $activity->id; ?>">
                                                        <div class="dd-handle"><?php echo e($activity->name); ?></div>
                                                        <div class="mega-menu-div">
                                                            <div class="checkbox-inline" style="position: absolute; top: 0px; right: 12px; padding-top: 6px;">
                                                                <label class="checkbox checkbox-success" style="color:white;">
                                                                <input class="mega-menu-checkbox" type="checkbox">
                                                                <span></span>Mega Menu</label>
                                                            </div>
                                                        </div>
                                                    </li>
                                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                  </ol>
                                              </li>
                                            <?php endif; ?>
                                            <?php if($regions): ?>
                                              <li class="dd-item" data-type="main" data-mega-menu="0" data-name="regions" data-id="4">
                                                  <div class="dd-handle">Regions</div>
                                                  <div class="mega-menu-div">
                                                      <div class="checkbox-inline" style="position: absolute; top: 0px; right: 12px; padding-top: 6px;">
                                                          <label class="checkbox checkbox-success" style="color:white;">
                                                          <input class="mega-menu-checkbox" type="checkbox">
                                                          <span></span>Mega Menu</label>
                                                      </div>
                                                  </div>
                                                  <ol class="dd-list">
                                                  <?php $__currentLoopData = $regions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $region): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li class="dd-item" data-type="region" data-mega-menu="0" data-name="<?= $region->name; ?>" data-id="<?= $region->id; ?>">
                                                        <div class="dd-handle"><?php echo e($region->name); ?></div>
                                                        <div class="mega-menu-div">
                                                            <div class="checkbox-inline" style="position: absolute; top: 0px; right: 12px; padding-top: 6px;">
                                                                <label class="checkbox checkbox-success" style="color:white;">
                                                                <input class="mega-menu-checkbox" type="checkbox">
                                                                <span></span>Mega Menu</label>
                                                            </div>
                                                        </div>
                                                    </li>
                                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                  </ol>
                                              </li>
                                            <?php endif; ?>
                                        </ol>
                                    </div>
                                    <div class="dd nestable2" id="nestable2">
                                        <ol class="<?php echo e((iterator_count($menu_items))?'dd-list': 'dd-empty'); ?>">
                                            <?php if($menu_items): ?>
                                                <?php $__currentLoopData = $menu_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li class="dd-item" data-link="<?php echo e($menu->link); ?>" data-type="<?php echo e($menu->type); ?>" data-name="<?php echo e($menu->name); ?>" data-mega-menu="<?php echo e($menu->mega_menu); ?>" data-id="<?php echo (($menu->menu_itemable_type == null)?1:$menu->menu_itemable_id);?>">
                                                    <div class="dd-handle"><?php echo e($menu->name); ?></div>
                                                    <div>
                                                        <div class="checkbox-inline" style="position: absolute; top: 0px; right: 12px; padding-top: 6px;">
                                                            <label class="checkbox checkbox-success" style="color:white;">
                                                            <input class="mega-menu-checkbox" <?php echo e(($menu->mega_menu == 1 ? 'checked':'')); ?> type="checkbox">
                                                            <span></span>Mega Menu</label>
                                                        </div>
                                                    </div>
                                                    <?php if($menu->children): ?>
                                                    <?php echo $__env->make('admin.menus.child-menu', ['children' => $menu->children()->orderBy('display_order', 'asc')->get()], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                    <?php endif; ?>
                                                </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!--end::Form-->
                </div>
            </form>
            <!--end::Portlet-->
        </div>
    </div>
</div>
<div class="modal fade" id="kt_modal_4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Custom Link</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <form class="kt-form" id="add-link-form">
              <?php echo e(csrf_field()); ?>

              <div class="modal-body">
                <div class="form-group">
                    <label for="recipient-name" class="form-control-label">Link Name</label>
                    <input type="text" name="name" required="required" class="form-control">
                </div>
                <div class="form-group">
                    <label for="recipient-url" class="form-control-label">URL</label>
                    <input type="text" name="link" required="required" class="form-control">
                </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Add Link</button>
              </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script src="./assets/vendors/general/summernote/dist/summernote.js" type="text/javascript"></script>
<script src="./assets/js/demo1/pages/crud/forms/widgets/summernote.js" type="text/javascript"></script>
<script src="./assets/vendors/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="./assets/vendors/nestable/jquery.nestable.js"></script>
<script type="text/javascript">
$(function() {
    var updateOutput = function(e) {
        if ($(e.target).attr('type') == 'checkbox') {
            return;
        }

        var list = e.length ? e : $(e.target),
            output = list.data('output');
        if (window.JSON) {
            output.val(window.JSON.stringify(list.nestable('serialize'))); //, null, 2));
        } else {
            output.val('JSON browser support required for this demo.');
        }
    };
    // activate Nestable for list 1
    $('#nestable').nestable({
            group: 1
        })
        .on('change', updateOutput);

    // activate Nestable for list 2
    $('#nestable2').nestable({
            group: 1
        })
        .on('change', updateOutput);

    $(document).on('click', '.mega-menu-checkbox', function (e) {
        // e.stopPropagation();
        let el = $(this);
        if (el.is(':checked')) {
            el.closest('.dd-item').data('mega-menu', 1);
        } else {
            el.closest('.dd-item').data('mega-menu', 0);
        }
    });

    // output initial serialised data
    updateOutput($('#nestable').data('output', $('#nestable-output')));
    updateOutput($('#nestable2').data('output', $('#nestable2-output')));

    $('#nestable-menu').on('click', function(e) {
        var target = $(e.target),
            action = target.data('action');
        if (action === 'expand-all') {
            $('.dd').nestable('expandAll');
        }
        if (action === 'collapse-all') {
            $('.dd').nestable('collapseAll');
        }
    });

    $("#add-form-page").validate({
        submitHandler: function(form, event) {
            event.preventDefault();
            var btn = $(form).find('button[type=submit]').attr('disabled', true).html('Publishing...');
            handleMenuEditForm(form);
        }
    });

    function handleMenuEditForm(form) {
        var form = $(form);
        var formData = new FormData(form[0]);
        formData.append('menu_items', window.JSON.stringify($('#nestable2').nestable('serialize')));

        $.ajax({
            url: "<?php echo e(route('admin.menus.update')); ?>",
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            async: false,
            success: function(res) {
                if (res.status === 1) {
                    location.href = '<?php echo e(route("admin.menus.index")); ?>';
                }
            }
        });
    }

    $("#add-link-form").validate({
        submitHandler: function(form, event) {
            event.preventDefault();
            // var btn = $(form).find('button[type=submit]').attr('disabled', true).html('Publishing...');
            handleLinkAddForm(form);
        }
    });

    function handleLinkAddForm(form) {
        var form = $(form);
        var formData = form.serializeArray();
        var ul = $("#nestable2>ol");

        var li = '<li class="dd-item" data-link="'+formData[2].value+'" data-type="custom" data-name="'+formData[1].value+'" data-id="0">\
                    <div class="dd-handle">'+formData[1].value+'</div>\
                    <div>\
                        <div class="checkbox-inline" style="position: absolute; top: 0px; right: 12px; padding-top: 6px;">\
                            <label class="checkbox checkbox-success" style="color:white;">\
                            <input class="mega-menu-checkbox" type="checkbox">\
                            <span></span>Mega Menu</label>\
                        </div>\
                    </div>\
                </li>';
        ul.append(li).removeClass('dd-empty').addClass('dd-list');
        $('#kt_modal_4').modal('hide');
        $("#add-link-form")[0].reset();
    }
});

</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/tlanders/public_html/resources/views/admin/menus/edit.blade.php ENDPATH**/ ?>
<?php if(iterator_count($trip->trip_itineraries)): ?>
    <?php $__currentLoopData = $trip->trip_itineraries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itinerary): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="form-group itinerary-group">
            <div class="kt-timeline-v2 travel-timeline">
                <div class="kt-timeline-v2__items kt-padding-top-25 kt-padding-bottom-30">
                    <div class="kt-timeline-v2__item">
                        <span class="kt-timeline-v2__item-time">Day <span class="day-number"><input type="number" required value="<?php echo e($itinerary->day); ?>" class="form-control form-control-sm"
                                    style="width: 83px;"></span></span>
                        <div class="kt-timeline-v2__item-cricle">
                            <i class="fa fa-genderless kt-font-success"></i>
                        </div>
                        <div class="kt-timeline-v2__item-text kt-timeline-v2__item-text--bold">
                            <div class="itinerary-block-action">
                                <div>
                                    <button type="button" title="remove" class="btn btn-outline-danger btn-sm btn-elevate-hover btn-icon pull-right remove-itinerary"><i
                                            class="fa fa-times"></i></button>
                                    <div title="move" class="mr-1 btn btn-outline-brand btn-sm btn-elevate-hover btn-icon pull-right move-itinerary"><i class="la la-unsorted"></i></div>
                                </div>
                            </div>
                            <input type="hidden" id="input-trip-itinerary-id" name="itinerary_id" value="<?php echo e($itinerary->id); ?>">
                            <input type="text" name="trip_itineraries[][name]" id="input-trip-name" value="<?php echo e($itinerary->name); ?>" class="mb-3 form-control form-control-sm" placeholder="Title">
                            
                            <input type="text" id="input-trip-max-altitude" value="<?php echo e($itinerary->max_altitude); ?>" class="mb-3 form-control form-control-sm" placeholder="Max altitude">
                            
                            <input type="text" id="input-trip-accomodation" value="<?php echo e($itinerary->accomodation); ?>" class="mb-3 form-control form-control-sm" placeholder="Accomodation">
                            
                            <input type="text" id="input-trip-meals" value="<?php echo e($itinerary->meals); ?>" class="mb-3 form-control form-control-sm" placeholder="Meals">
                              
                            <input type="text" id="input-trip-place" value="<?php echo e($itinerary->place); ?>" class="form-control mb-3 form-control-sm" placeholder="Place">
                            
                            <input type="file" id="input-trip-image" name="itinerary_image" value="<?php echo e($itinerary->image_name); ?>" class="mb-3 form-control form-control-sm">
                            <div class="itinerary-description-block">
                                <div id="summernote-itinerary-<?php echo e($itinerary->day); ?>" class="summernote-itinerary"><?= $itinerary->description ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php else: ?>
    <div class="form-group itinerary-group">
        <div class="kt-timeline-v2 travel-timeline">
            <div class="kt-timeline-v2__items kt-padding-top-25 kt-padding-bottom-30">
                <div class="kt-timeline-v2__item">
                    <span class="kt-timeline-v2__item-time">Day <span class="day-number"><input type="number" required class="form-control form-control-sm" style="width: 83px;"></span></span>
                    <div class="kt-timeline-v2__item-cricle">
                        <i class="fa fa-genderless kt-font-success"></i>
                    </div>
                    <div class="kt-timeline-v2__item-text kt-timeline-v2__item-text--bold">
                        <div class="itinerary-block-action">
                            <div>
                                <button type="button" title="remove" class="btn btn-outline-danger btn-sm btn-elevate-hover btn-icon pull-right remove-itinerary"><i class="fa fa-times"></i></button>
                                <div title="move" class="mr-1 btn btn-outline-brand btn-sm btn-elevate-hover btn-icon pull-right move-itinerary"><i class="la la-unsorted"></i></div>
                            </div>
                        </div>
                        <input type="text" name="trip_itineraries[][name]" id="input-trip-name" class="mb-3 form-control form-control-sm" placeholder="Title">
                        
                        <input type="text" id="input-trip-max-altitude" class="mb-3 form-control form-control-sm" placeholder="Title">
                        
                        <input type="text" id="input-trip-accomodation" class="mb-3 form-control form-control-sm" placeholder="Title">
                        
                        <input type="text" id="input-trip-meals" class="mb-3 form-control form-control-sm" placeholder="Title">
                        
                        <input type="text" id="input-trip-place" class="form-control mb-3 form-control-sm" placeholder="Title">
                        
                        <input type="file" id="input-trip-image" class="mb-3 form-control form-control-sm">
                        <div class="itinerary-description-block">
                            <div id="summernote-itinerary-1" class="summernote-itinerary"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH E:\xampp\htdocs\laravelapps\laravel5\treklander\resources\views/admin/trips/edit-itinerary-form.blade.php ENDPATH**/ ?>
<?php if($essential_trip_informations): ?>
<div class="mb-3 essential-info" style="background: #ffecc7; padding: 15px;">
    <h3>Essential Trip Information</h3>
    <ul class="essential-links" style="font-size: 17px;">
        <?php $__currentLoopData = $essential_trip_informations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trip_info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li style="padding: 5px 0px;">
            <a href="<?php echo ($trip_info->link)?$trip_info->link:'javascript:;'; ?>" target="_blank" class="flex">
            <svg class="w-6 h-6 mr-1 mt-1 flex-shrink-0">
                <use xlink:href="<?php echo e(asset('assets/front/img/sprite.svg#arrownarrowright')); ?>" /></svg>

            <?php echo e($trip_info->name); ?> </a>
        </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</div>
<?php endif; ?><?php /**PATH E:\xampp\htdocs\laravelapps\laravel5\treklander\resources\views/front/elements/essential_trip_information.blade.php ENDPATH**/ ?>
<a href="#" class="block mb-4">
    <div class="px-4 pt-10 pb-4 text-white rounded-lg" style="background: linear-gradient(rgba(0,0,0,.2), rgba(0,0,0,.5)), center / cover url('<?php echo e($trip->imageUrl); ?>')">
        <h3 class="text-2xl font-display"><?php echo e($trip->name); ?></h3>
        <div class="mb-4 days"><?= $trip->duration ?> days</div>
        <div class="price"><span class="text-xs">from </span><b>USD <?php echo e(number_format($trip->cost, 2)); ?></b></div>
    </div>
</a>
<?php /**PATH /home/tlanders/public_html/resources/views/front/elements/addon_trip.blade.php ENDPATH**/ ?>
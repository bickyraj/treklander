<div class="relative flex-shrink-0 destination">
    <a href="<?php echo e($link); ?>">
        <div class="mb-4 destination__img"><img src="<?php echo e($destination->imageUrl); ?>" class="aspect-[2/1]" alt="<?php echo e($destination->image_alt ?? $destination->name); ?>"></div>
        <h3 class="font-bold text-center text-primary"><?php echo e($destination->name); ?></h3>
        <div class="text-sm text-center text-gray"><?php echo e($destination->trips->count()); ?> <?php echo e($destination->trips->count() > 1 ? 'tours' : 'tour'); ?></div>
    </a>
</div>
<?php /**PATH /home/tlanders/public_html/resources/views/front/elements/destination_card.blade.php ENDPATH**/ ?>
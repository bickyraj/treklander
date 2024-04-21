<div class="p-2">
    <div class="items-start md:flex">
        <div class="flex-shrink-0 mb-4 md:mr-4">
            <img src="<?php echo e($item->imageUrl); ?>" width="250" alt="<?php echo e(Setting::get('site_name')); ?>" style="border: 13px solid #e8e8e8; border-radius: 140px;">
        </div>
        <div>
            <h2 class="mb-1 text-2xl font-display text-primary"><?php echo e($item->name); ?></h2>
            <div class="mb-2 text-gray"><?php echo e($item->position); ?></div>
            <div class="mb-8 prose">
                <?php echo $item->description; ?>

            </div>
            <a href="<?php echo e(route('front.teams.show', ['slug' => $item->slug])); ?>" class="btn btn-sm btn-primary">Read more</a>
        </div>
    </div>
</div>
<?php /**PATH /home/tlanders/public_html/resources/views/front/elements/team_card.blade.php ENDPATH**/ ?>
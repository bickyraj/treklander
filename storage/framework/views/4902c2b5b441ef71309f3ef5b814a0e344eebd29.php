<div class="review">
    <h3 class="mb-4 text-2xl text-gray-600 font-display"><?php echo e($review->title); ?></h3>
    <div class="mb-8 prose">
        <p><?php echo e($review->review); ?></p>
    </div>
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-4">
            <img src="<?php echo e($review->thumbImageUrl); ?>" alt="<?php echo e($review->review_name); ?>" class="object-cover w-16 h-16 rounded-full border-accent" loading="lazy">
            <div>
                <div class="font-bold text-gray-600"><?php echo e(ucfirst($review->review_name)); ?></div>
                <div class="text-sm"><?php echo e($review->review_country); ?></div>
                <div class="flex">
                    <?php for($i = 0; $i < 5; $i++): ?>
                        <svg class="w-5 h-5 text-accent">
                            <use xlink:href="<?php echo e(asset('assets/front/img/sprite.svg')); ?>#star" />
                        </svg>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-10 h-10 text-light" viewBox="0 0 16 16">
            <path
                d="M16 8c0 3.866-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.584.296-1.925.864-4.181 1.234-.2.032-.352-.176-.273-.362.354-.836.674-1.95.77-2.966C.744 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7zM7.194 6.766a1.688 1.688 0 0 0-.227-.272 1.467 1.467 0 0 0-.469-.324l-.008-.004A1.785 1.785 0 0 0 5.734 6C4.776 6 4 6.746 4 7.667c0 .92.776 1.666 1.734 1.666.343 0 .662-.095.931-.26-.137.389-.39.804-.81 1.22a.405.405 0 0 0 .011.59c.173.16.447.155.614-.01 1.334-1.329 1.37-2.758.941-3.706a2.461 2.461 0 0 0-.227-.4zM11 9.073c-.136.389-.39.804-.81 1.22a.405.405 0 0 0 .012.59c.172.16.446.155.613-.01 1.334-1.329 1.37-2.758.942-3.706a2.466 2.466 0 0 0-.228-.4 1.686 1.686 0 0 0-.227-.273 1.466 1.466 0 0 0-.469-.324l-.008-.004A1.785 1.785 0 0 0 10.07 6c-.957 0-1.734.746-1.734 1.667 0 .92.777 1.666 1.734 1.666.343 0 .662-.095.931-.26z" />
        </svg>
    </div>
</div>
<?php /**PATH /home/tlanders/public_html/resources/views/front/elements/review.blade.php ENDPATH**/ ?>
<a href="<?php echo e(route('front.blogs.show', $blog->slug)); ?>">
    <div class="article">
        <div class="image">
            <img src="<?php echo e($blog->mediumImageUrl); ?>" alt="<?php echo e($blog->name); ?>">
        </div>
        <div class="content">
            <h3 class="mb-2 font-bold hover:text-primary"><?php echo e($blog->name); ?></h3>
            <div class="flex items-center text-sm text-gray-500">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <?php echo e(formatDate($blog->blog_date)); ?>

            </div>
            <p>
                <?php echo truncate(strip_tags($blog->toc)); ?>

            </p>
        </div>
    </div>
</a>
<?php /**PATH /home/tlanders/public_html/resources/views/front/elements/blog-card.blade.php ENDPATH**/ ?>
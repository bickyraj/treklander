<ul class="mega-menu">
    <div class="lg:fixed lg:py-10 rounded-lg" id="mega1">
        <div class="container grid lg:grid-cols-4 gap-4">
            <?php $__currentLoopData = $menu->children()->orderBy('display_order', 'asc')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <ul class="mega-menu-column">
                    <li>
                        <a href="<?php echo ($child->link)?$child->link:'javascript:;'; ?>"><?php echo e($child->name); ?></a>
                        <?php if(iterator_count($child->children)): ?>
                            <ul>
                                <?php $__currentLoopData = $child->children()->orderBy('display_order', 'asc')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child_2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <a href="<?php echo ($child_2->link)?$child_2->link:'javascript:;'; ?>"><?php echo e($child_2->name); ?></a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        <?php endif; ?>
                    </li>
                </ul>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</ul>
<?php /**PATH /home/tlanders/public_html/resources/views/front/elements/mega_menu.blade.php ENDPATH**/ ?>
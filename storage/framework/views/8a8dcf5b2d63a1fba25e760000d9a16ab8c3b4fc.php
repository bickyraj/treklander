<!-- Nav -->
<nav :class="{ show: mobilenavOpen }">
    <ul id="main-nav" class="absolute sm sm-simple lg:static" style="top:100%;left:0;right:0">
        <?php if($menus): ?>
            <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li>
                    <a href="<?php echo $menu->link ? $menu->link : 'javascript:;'; ?>" class="uppercase font-display text-primary"><?php echo e($menu->name); ?></a>
                    <?php if(iterator_count($menu->children)): ?>
                        <?php if($menu->mega_menu): ?>
                            <?php echo $__env->make('front.elements.mega_menu', ['menu' => $menu], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php else: ?>
                            <ul>
                                <?php $__currentLoopData = $menu->children()->orderBy('display_order', 'asc')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <a href="<?php echo $child->link ? $child->link : 'javascript:;'; ?>"><?php echo e($child->name); ?></a>
                                        <?php if(iterator_count($child->children)): ?>
                                            <?php echo $__env->make('front.elements.child-menu', [
                                                'children' => $child->children()->orderBy('display_order', 'asc')->get(),
                                                'n_count' => 2,
                                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        <?php endif; ?>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        <?php endif; ?>
                    <?php endif; ?>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </ul>
</nav><!-- Nav -->
<?php $__env->startPush('scripts'); ?>
    <script>
        //
        // Initialize jQuery Smartmenus
        $(function() {
            $('#main-nav').smartmenus();
        });
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH E:\xampp\htdocs\laravelapps\laravel5\treklander\resources\views/front/elements/navbar.blade.php ENDPATH**/ ?>
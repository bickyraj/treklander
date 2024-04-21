<ol class="dd-list">
	<?php $__currentLoopData = $children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<li class="dd-item" data-link="<?php echo e($child->link); ?>" data-type="<?php echo e($child->type); ?>" data-name="<?= $child->name; ?>" data-id="<?= $child->menu_itemable_id; ?>">
	  <div class="dd-handle"><?php echo e($child->name); ?></div>
	  <?php if($child->children()->orderBy('display_order', 'asc')->get()): ?>
        <?php echo $__env->make('admin.menus.child-menu', ['children' => $child->children()->orderBy('display_order', 'asc')->get()], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	  <?php endif; ?>
	</li>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ol>
<?php /**PATH /home/tlanders/public_html/resources/views/admin/menus/child-menu.blade.php ENDPATH**/ ?>
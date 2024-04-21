<ul>
  <!-- Level three dropdown-->
  <?php $__currentLoopData = $children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <li>
    <a href="<?php echo ($child->link)?$child->link:'javascript:;'; ?>"><?php echo e($child->name); ?></a>
      <?php if(iterator_count($child->children)): ?>
          <?php echo $__env->make('front.elements.child-menu', ['children' => $child->children()->orderBy('display_order', 'asc')->get(), 'n_count' => $n_count++], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <?php endif; ?>
  </li>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>
<?php /**PATH /home/tlanders/public_html/resources/views/front/elements/child-menu.blade.php ENDPATH**/ ?>
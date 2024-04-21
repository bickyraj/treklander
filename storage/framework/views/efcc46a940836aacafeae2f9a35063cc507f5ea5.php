    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                
                 
                <span class="kt-subheader__separator kt-hidden"></span>
                <?php $segments = request()->segments(); 
                ?>
                <?php if(count($segments) > 1): ?>
                <div class="kt-subheader__breadcrumbs">
                    <a href="<?php echo e(route('admin.dashboard')); ?>" class="kt-subheader__breadcrumbs-link">Dashboard</a>
                    <!-- <span class="kt-subheader__breadcrumbs-separator"></span> -->
                    <?php $url = 'admin'; ?>
                    <?php for($i=1; $i < count($segments); $i++): ?>
                        <?php 
                            if(($i + 2) == count($segments) && is_numeric($segments[$i + 1])) {
                                $url .= '/'. $segments[$i] . '/' . $segments[$i + 1];
                            } else {
                                $url .= '/'. $segments[$i];
                            }
                        ?>
                        <?php if (!is_numeric($segments[$i]) && ($segments[$i] != "dashboard")): ?>
                            <span class="kt-subheader__breadcrumbs-separator"></span>
                            <a href="<?php echo e($url); ?>" class="kt-subheader__breadcrumbs-link"><?php echo e(breadCrumbTitle($segments[$i])); ?></a>
                        <?php endif ?>
                    <?php endfor; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div><?php /**PATH /home/tlanders/public_html/resources/views/admin/elements/breadcrumbs.blade.php ENDPATH**/ ?>
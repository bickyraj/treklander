
<?php $__env->startSection('content'); ?>
<style type="text/css">
    .error-template {padding: 40px 15px;text-align: center;}
    .error-actions {margin-top:15px;margin-bottom:15px;}
    .error-actions .btn { margin-right:10px; }
</style>

<div class="container">
    <div class="row py-10" style="text-align: center;">
        <div class="col-md-12">
            <div class="error-template">
                <h1> Oops!</h1>
                <h2> <?php echo $__env->yieldContent('code'); ?></h2>
                <div class="error-details">
                    <?php echo $__env->yieldContent('message'); ?>
                </div>
                <div class="error-actions">
                    <a href="<?php echo e(url('/')); ?>" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-home"></span>
                        Take Me Home </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/tlanders/public_html/resources/views/errors/minimal.blade.php ENDPATH**/ ?>
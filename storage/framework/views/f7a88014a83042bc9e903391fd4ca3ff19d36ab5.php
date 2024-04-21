
<?php $__env->startPush('scripts'); ?>
<script src="https://www.google.com/recaptcha/api.js?render=<?php echo e(config('constants.recaptcha.sitekey')); ?>"></script>

<script type="text/javascript">
    grecaptcha.ready(function () {
        grecaptcha.execute('<?php echo e(config("constants.recaptcha.sitekey")); ?>', {
                action: 'contact'
            }).then(function (token) {
            if (token) {
                document.getElementById('recaptcha').value = token;
            }
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php /**PATH E:\xampp\htdocs\laravelapps\laravel5\treklander\resources\views/front/elements/recaptcha.blade.php ENDPATH**/ ?>
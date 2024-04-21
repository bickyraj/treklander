<div class="mb-8 overflow-hidden rounded-lg">
    <div class="px-2 py-10 text-white bg-primary">
        <div class="grid grid-cols-3">
            <div class="col-span-2">
                <p class="mb-0">Still confused?</p>
                <h3 class="mb-2">Talk to our experts</h3>
            </div>
            <div>
                <svg class="w-20 h-20">
                    <use xlink:href="<?php echo e(asset('assets/front/img/sprite.svg')); ?>#customersupport" />
                </svg>
            </div>
        </div>
        <div class="flex mb-1 experts-phone">
            <a href="<?php echo e(Setting::get('mobile1')); ?>" class="flex items-center">
                <svg class="w-6 h-6 mr-1">
                    <use xlink:href="<?php echo e(asset('assets/front/img/sprite.svg')); ?>#phone" />
                </svg>
                <?php echo e(Setting::get('mobile1')); ?>

            </a>
        </div>
        <div class="flex mb-3 experts-phone">
            <a href="mailto:<?php echo e(Setting::get('email')); ?>" class="flex items-center">
                <svg class="w-6 h-6 mr-1">
                    <use xlink:href="<?php echo e(asset('assets/front/img/sprite.svg')); ?>#mail" />
                </svg>
                <?php echo e(Setting::get('email')); ?>

            </a>
        </div>
    </div>
    <div class="flex justify-around p-2 bg-light">
        <a href="<?php echo e(Setting::get('facebook')); ?>" class="mr-1 text-primary hover:text-accent">
            <svg class="w-6 h-6">
                <use xlink:href="<?php echo e(asset('assets/front/img/sprite.svg')); ?>#facebookmessenger" />
            </svg>
        </a>
        <a href="<?php echo e(Setting::get('viber')); ?>" class="mr-1 text-primary hover:text-accent">
            <svg class="w-6 h-6">
                <use xlink:href="<?php echo e(asset('assets/front/img/sprite.svg')); ?>#viber" />
            </svg>
        </a>
        <a href="<?php echo e(Setting::get('whatsapp')); ?>" class="mr-1 text-primary hover:text-accent">
            <svg class="w-6 h-6">
                <use xlink:href="<?php echo e(asset('assets/front/img/sprite.svg')); ?>#whatsapp" />
            </svg>
        </a>
        <a href="<?php echo e(Setting::get('skype')); ?>" class="mr-1 text-primary hover:text-accent">
            <svg class="w-6 h-6">
                <use xlink:href="<?php echo e(asset('assets/front/img/sprite.svg')); ?>#skype" />
            </svg>
        </a>
    </div>
</div>
<?php /**PATH E:\xampp\htdocs\laravelapps\laravel5\treklander\resources\views/front/elements/experts-card.blade.php ENDPATH**/ ?>
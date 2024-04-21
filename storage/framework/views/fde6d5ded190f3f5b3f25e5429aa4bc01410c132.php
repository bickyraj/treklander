<div class="relative py-10 bg-light">
    <div class="max-w-5xl px-4 mx-auto">
        <div class="grid gap-10 plan-trip lg:grid-cols-3">
            <img src="<?php echo e(asset('assets/front/img/treklanders-plan-trip.jpeg')); ?>" alt="" loading="lazy" class="object-cover w-full aspect-[3/4]">
            <div class="px-4 py-10 prose lg:col-span-2">
                <h2>
                    <div class="mb-4 text-3xl font-bold text-left text-gray-600 lg:text-5xl">
                        Plan your trip
                    </div>
                    <div class="text-2xl text-left text-gray-600 lg:text-4xl">
                        Tailor-made trips to suit your needs and desires.
                    </div>
                </h2>
                <p>Please feel free to ask any questions, and together we'll create the ideal journey based on your interests and aspirations.</p>
                <?php if(request()->routeIs('home')): ?>
                    <a href="<?php echo e(route('front.plantrip')); ?>" class="btn btn-accent" style="text-decoration:none;">Start planning</a>
                <?php else: ?>
                    <a href="<?php echo e(route('front.contact.index')); ?>" class="btn btn-accent" style="text-decoration:none;">Contact Us</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php /**PATH E:\xampp\htdocs\laravelapps\laravel5\treklander\resources\views/front/elements/plan_trip.blade.php ENDPATH**/ ?>
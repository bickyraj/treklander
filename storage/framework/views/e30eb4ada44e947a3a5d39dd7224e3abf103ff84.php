<div class="flex flex-col bg-white shadow-md tour">
    <div class="top">
        <img src="<?php echo e($tour->imageUrl); ?>" alt="<?php echo e($tour->name); ?>" width="400" height="250" loading="lazy">
        <div class="top__overlay">
            <div class="flex items-center gap-2 location">
                <svg class="w-4 h-4">
                    <use xlink:href="<?php echo e(asset('assets/front/img/sprite.svg')); ?>#locationmarker" />
                </svg>
                <span><?= $tour->location ?></span>
            </div>
        </div>
    </div>
    <div class="offer"><?php echo e($tour->best_value); ?></div>
    <div class="flex flex-col justify-between bottom flex-grow-1">
        <div class="flex flex-col p-4 flex-grow-1">
            
            <div class="flex justify-between gap-20">
                <div class="flex items-center justify-between gap-4 mb-2">
                    <span class="inline-block px-2 py-1 text-xs rounded-full bg-light">
                        <?php echo e($tour->trip_activity_type); ?>

                    </span>
                </div>
                <div clas="text-center">
                    <div class="flex items-center justify-center gap-1 text-yellow-400">
                        <?php for($i = 0; $i < $tour->rating; $i++): ?>
                            <svg class="w-5 h-5" viewbox="0 0 20 20" stroke="currentColor" fill="none">
                                <use xlink:href="<?php echo e(asset('assets/front/img/sprite.svg')); ?>#star" />
                            </svg>
                        <?php endfor; ?>
                        <?php for($i = 0; $i < 5 - $tour->rating; $i++): ?>
                            <svg class="w-5 h-5" viewbox="0 0 20 20" stroke="currentColor" fill="none">
                                <path stroke-linecap="round" stroke-width="1.5"
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                            </svg>
                        <?php endfor; ?>
                    </div>
                    <?php if($tour->reviews_count): ?>
                        <div class="text-xs text-right">(<?php echo e($tour->reviews_count); ?> <?php if($tour->reviews_count == 1): ?> review) <?php else: ?> reviews) <?php endif; ?></div>
                    <?php endif; ?>
                </div>
            </div>

            
            <a href="<?php echo e(route('front.trips.show', ['slug' => $tour->slug])); ?>" class="mb-4 flex-grow-1">
                <h3 class="mb-2 text-2xl font-display text-primary"><?php echo e($tour->name); ?></h3>
            </a>

            
            <div class="flex justify-center mb-4 details">
                <div class="pr-4 mr-4 border-right-light">
                    <div class="text-sm uppercase font-display text-gray">Duration</div>
                    <div class="flex items-center">
                        
                        <div class="flex items-center">
                            <span class="mr-2 text-3xl text-primary font-display"><?php echo e($tour->duration); ?></span> days
                        </div>
                    </div>
                </div>
                <div>
                    <div class="mb-1 text-sm uppercase font-display text-gray">Grading</div>
                    <div class="flex items-center">
                        <svg "http://www.w3.org/2000/svg" viewbox="0 0 50 50" class="flex-shrink-0 w-10 h-10 mr-2 text-primary">
                            <circle cx="25" cy="25" r="20" fill="none" stroke="#ddd" stroke-width="10" />
                            <?php
                                $circ = 2 * pi() * 20;
                            ?>
                            <?php if(strtolower($tour->difficulty_grade_value) === 'easy'): ?>
                                <circle cx="25" cy="25" r="20" fill="none" stroke="#1b5" stroke-dasharray="<?php echo e($circ / 3); ?> <?php echo e(($circ / 3) * 2); ?>"
                                    stroke-dashoffset="<?php echo e($circ / 4); ?>" stroke-width="10" />
                            <?php elseif(strtolower($tour->difficulty_grade_value) === 'moderate'): ?>
                                <circle cx="25" cy="25" r="20" fill="none" stroke="orange" stroke-dasharray="<?php echo e(($circ / 3) * 2); ?> <?php echo e($circ / 3); ?>"
                                    stroke-dashoffset="<?php echo e($circ / 4); ?>" stroke-width="10" />
                            <?php elseif(strtolower($tour->difficulty_grade_value) === 'difficult'): ?>
                                <circle cx="25" cy="25" r="20" fill="none" stroke="red" stroke-width="10" />
                            <?php endif; ?>
                        </svg>
                        
                        <?php echo e($tour->difficulty_grade_value); ?>

                    </div>
                </div>
            </div>

            
            <div class="flex items-end justify-between">

                
                <?php if($tour->cost): ?>
                    <div class="price">
                        <div class="mr-2 text-gray">
                            <span class="text-sm">
                                from
                            </span>
                            <s class="font-bold text-red">
                                USD <?php echo e(number_format($tour->cost, 2)); ?>

                            </s>
                        </div>
                        <div class="text-gray-600">
                            <span>USD</span>
                            <?php
                                $price_arr = explode('.', number_format($tour->offer_price, 2));
                            ?>
                            <span class="text-2xl"> <?php echo e($price_arr[0]); ?> </span>
                            <span class="text-xl">.<?php echo e($price_arr[1]); ?></span>
                        </div>
                    </div>
                <?php endif; ?>
                <a href="<?php echo e(route('front.trips.show', ['slug' => $tour->slug])); ?>" class="btn btn-primary">
                    Explore
                    <svg class="w-4 h-4">
                        <use xlink:href="<?php echo e(asset('assets/front/img/sprite.svg')); ?>#arrownarrowright" />
                    </svg>
                </a>
                
            </div>
        </div>


    </div>
</div>
<?php /**PATH E:\xampp\htdocs\laravelapps\laravel5\treklander\resources\views/front/elements/tour-card.blade.php ENDPATH**/ ?>
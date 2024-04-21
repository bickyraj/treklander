<!-- Newsletter -->
<div class="pt-10 bg-gray">
    <div class="max-w-5xl px-4 mx-auto">
        <div class="grid gap-8 lg:grid-cols-2">
            <div>
                <h2 class="mb-2 text-4xl font-display text-balance text-primary">Subscribe for seasonal discounts.</h2>
                <div>Sign up to stay updated with latest offers, recent events and more news.</div>
            </div>
            <div>
                <form id="email-subscribe-form">
                    <div class="flex flex-col gap-2 p-1 border-2 border-transparent rounded-full md:flex-row md:overflow-hidden md:bg-white md:focus-within:border-accent">
                        <label for="emailsub" class="sr-only">Email</label>
                        <input type="email" id="emailsub" class="w-full p-4 border-2 rounded-full focus:ring-0 lg:text-xl lg:mb-0 lg:mr-2 md:border-0 focus:border-accent"
                            placeholder="Enter your email" required>
                        <button type="submit" class="btn btn-accent">Subscribe</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <img src="<?php echo e(asset('assets/front/img/webpage_art.webp')); ?>" width="1920" height="275" alt="Art representing various natural and cultutal heritages of Nepal"
        class="object-cover w-full h-auto footer-art" loading="lazy">
</div><!-- Newsletter -->
<!-- Footer -->

<footer class="text-white bg-primary">
   
    <div class="container fs-sm">
        <div class="grid grid-cols-2 gap-3 lg:grid-cols-4">
            <div class="mb-4">
                <h1 class="text-2xl text-white font-display">Destinations</h1>
                <ul>
                    <?php if($footer1): ?>
                        <?php $__currentLoopData = $footer1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="text-sm">
                                <a href="<?php echo $menu->link ? $menu->link : 'javascript:;'; ?>"><?php echo e($menu->name); ?></a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="mb-4">
                <h1 class="text-2xl text-white font-display">Activities</h1>
                <ul>
                    <?php if($footer2): ?>
                        <?php $__currentLoopData = $footer2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="text-sm">
                                <a href="<?php echo $menu->link ? $menu->link : 'javascript:;'; ?>"><?php echo e($menu->name); ?></a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="mb-4">
                <h1 class="text-2xl text-white font-display">About Us</h1>
                <ul>
                    <?php if($footer3): ?>
                        <?php $__currentLoopData = $footer3; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="text-sm">
                                <a href="<?php echo $menu->link ? $menu->link : 'javascript:;'; ?>"><?php echo e($menu->name); ?></a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </ul>
            </div>

            <div class="col-span-2 lg:col-span-1">
                <h1 class="text-2xl text-white font-display">Head Office, Nepal</h1>
                <ul class="icon-list">
                    <li class="flex">
                        <svg class="flex-shrink-0 mr-1">
                            <use xlink:href="<?php echo e(asset('assets/front/img/sprite.svg')); ?>#locationmarker" />
                        </svg>
                        <span class="text-sm"><?php echo e(Setting::get('address')); ?></span>
                    </li>
                    <li class="flex">
                        <svg class="flex-shrink-0 mr-1">
                            <use xlink:href="<?php echo e(asset('assets/front/img/sprite.svg')); ?>#phone" />
                        </svg>
                        <a class="text-sm" href="tel:<?php echo e(Setting::get('mobile1')); ?>"><?php echo e(Setting::get('mobile1')); ?></a>
                    </li>
                    <li class="flex">
                        <svg class="flex-shrink-0 mr-1">
                            <use xlink:href="<?php echo e(asset('assets/front/img/sprite.svg')); ?>#mail" />
                        </svg>
                        <a class="text-sm" href="mailto:<?php echo e(Setting::get('email')); ?>"><?php echo e(Setting::get('email')); ?></a>
                    </li>
                    <li class="flex">
                        <svg class="flex-shrink-0 mr-1">
                            <use xlink:href="<?php echo e(asset('assets/front/img/sprite.svg')); ?>#mail" />
                        </svg>
                        <a class="text-sm" href="mailto:treklanders@gmail.com">treklanders@gmail.com</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="bottom">
        <div class="container">
            <ul class="flex-wrap mb-4 social-links">
                <li class="mb-1">
                    <a href="<?php echo e(Setting::get('facebook')); ?>">
                        <svg>
                            <use xlink:href="<?php echo e(asset('assets/front/img/sprite.svg')); ?>#facebook" />
                        </svg>
                    </a>
                </li>
                <li class="mb-1">
                    <a href="<?php echo e(Setting::get('twitter')); ?>">
                        <svg>
                            <use xlink:href="<?php echo e(asset('assets/front/img/sprite.svg')); ?>#twitter" />
                        </svg>
                    </a>
                </li>
                <li class="mb-1">
                    <a href="<?php echo e(Setting::get('instagram')); ?>">
                        <svg>
                            <use xlink:href="<?php echo e(asset('assets/front/img/sprite.svg')); ?>#instagram" />
                        </svg>
                    </a>
                </li>
                <li class="mb-1">
                    <a href="<?php echo e(Setting::get('whatsapp')); ?>">
                        <svg>
                            <use xlink:href="<?php echo e(asset('assets/front/img/sprite.svg')); ?>#whatsapp" />
                        </svg>
                    </a>
                </li>
                <li class="mb-1">
                    <a href="<?php echo e(Setting::get('viber')); ?>">
                        <svg>
                            <use xlink:href="<?php echo e(asset('assets/front/img/sprite.svg')); ?>#viber" />
                        </svg>
                    </a>
                </li>
                
                <li class="mb-1">
                    <a href="https://line.com">
                        <svg xml:space="preserve" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" fill-rule="evenodd" viewBox="0 0 214 204">
                            <path fill="#fff" fill-rule="evenodd"
                                d="M213.381 86.58C213.381 38.84 165.522 0 106.693 0 47.868 0 .004 38.84.004 86.58c0 42.798 37.955 78.642 89.226 85.417 3.473.751 8.203 2.292 9.398 5.262 1.076 2.696.704 6.922.346 9.646 0 0-1.252 7.529-1.524 9.134-.465 2.695-2.144 10.549 9.243 5.752 11.386-4.799 61.44-36.18 83.824-61.941h-.005c15.461-16.957 22.869-34.165 22.869-53.27 M177.881 114.145h-29.974a2.036 2.036 0 0 1-2.037-2.037V65.547c0-1.125.912-2.037 2.037-2.037h29.974c1.12 0 2.037.916 2.037 2.037v7.566a2.037 2.037 0 0 1-2.037 2.037h-20.37v7.857h20.37c1.12 0 2.037.917 2.037 2.037v7.567a2.037 2.037 0 0 1-2.037 2.037h-20.37v7.857h20.37c1.12 0 2.037.916 2.037 2.036v7.567a2.036 2.036 0 0 1-2.037 2.037M67.01 114.145a2.036 2.036 0 0 0 2.037-2.037v-7.567c0-1.12-.917-2.036-2.037-2.036H46.639V65.547a2.042 2.042 0 0 0-2.036-2.037h-7.567a2.037 2.037 0 0 0-2.037 2.037v46.561c0 1.126.912 2.037 2.037 2.037H67.01ZM85.054 63.51h-7.565a2.038 2.038 0 0 0-2.038 2.037v46.562c0 1.125.913 2.037 2.038 2.037h7.565a2.036 2.036 0 0 0 2.037-2.037V65.547a2.037 2.037 0 0 0-2.037-2.037M136.563 63.51h-7.566a2.038 2.038 0 0 0-2.037 2.037v27.655l-21.303-28.769a2.11 2.11 0 0 0-.3-.352l-.038-.035a3.389 3.389 0 0 0-.11-.094l-.056-.041a2.527 2.527 0 0 0-.17-.111 1.758 1.758 0 0 0-.112-.062l-.065-.032a2.503 2.503 0 0 0-.119-.051l-.066-.024a1.79 1.79 0 0 0-.197-.059l-.121-.026-.086-.014c-.037-.004-.073-.009-.11-.012-.036-.004-.072-.005-.108-.006-.024-.001-.047-.004-.071-.004h-7.524a2.038 2.038 0 0 0-2.037 2.037v46.562c0 1.125.912 2.037 2.037 2.037h7.566a2.037 2.037 0 0 0 2.037-2.037V84.463l21.33 28.805c.147.208.327.378.526.513l.023.016c.041.028.085.054.128.078.02.011.039.023.06.032a.888.888 0 0 0 .098.048 1.434 1.434 0 0 0 .164.067c.046.016.093.032.141.045.01.003.02.006.029.007.17.045.348.072.533.072h7.524a2.037 2.037 0 0 0 2.037-2.037V65.547a2.038 2.038 0 0 0-2.037-2.037" />
                        </svg>
                    </a>
                </li>
                
            </ul>

            <div class="mb-2 affiliations">
                <div class="col-lg-12 col-md-12 col-sm-12">
                     <a href="<?php echo e(route('front.makeapayment')); ?>" class="btn btn-accent">Make a Payment</a> 
                </div>
            </div>

            <div class="mb-2 affiliations">
                <ul>
                    
                </ul>
            </div>

            <div class="mb-2 affiliations">
                <div class="mb-2 text-xs">We are affiliated to</div>
                <ul class="flex gap-2">
                    <li class="p-2 mr-1"><a href="#"><img loading="lazy" src="<?php echo e(asset('assets/front/img/ng.svg')); ?>" alt="Nepal Government Ministry of Culture, Tourism & Civil Aviation"
                                class="object-contain w-16 h-16" width="179" height="150"></a></li>
                    <li class="p-2 mr-1"><a href="#"><img loading="lazy" src="<?php echo e(asset('assets/front/img/ntb.svg')); ?>" alt="Nepal Tourism Board" class="object-contain w-16 h-16" width="148"
                                height="150"></a></li>
                    <li class="p-2 mr-1"><a href="#"><img loading="lazy" src="<?php echo e(asset('assets/front/img/taan.svg')); ?>" class="object-contain w-16 h-16"
                                alt="Trekking Agencies' Association of Nepal" width="112" height="150"></a></li>
                    <li class="p-2"><a href="#"><img loading="lazy" src="<?php echo e(asset('assets/front/img/nma.svg')); ?>" class="object-contain w-16 h-16"
                                alt="Nepal Mountaineering Association" width="180" height="150"></a>
                    </li>
                     <li class="p-2"><a href="https://www.tripadvisor.com/Attraction_Review-g293890-d25277337-Reviews-Treklanders_Adventures-Kathmandu_Kathmandu_Valley_Bagmati_Zone_Central_Region.html" target="_blank"><img loading="lazy" src="<?php echo e(asset('assets/front/img/ta.jpg')); ?>" class="object-contain w-16 h-16"
                                alt="TripAdvisor Reviews" width="180" height="150"></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="pb-20 text-xs text-center bg-primary">
        <div class="container justify-between md:flex">
            <div class="mb-2">
                All Contents &copy; <?php echo e(date('Y')); ?>. All right Reserved.
            </div>

            <div class="mb-4">
                Powered by
                <a href="https://thirdeyesystem.com">Third Eye Systems</a>
            </div>

            <div class="payments">
                <img src="<?php echo e(asset('assets/front/img/payment.svg')); ?>" alt="we accept mastercard, visa, and american express" loading="lazy">
            </div>
        </div>
    </div>
</footer><!-- Footer -->
<?php $__env->startPush('scripts'); ?>
    <script type="text/javascript">
        $(function() {

            $('#email-subscribe-form').on('submit', function(event) {
                event.preventDefault();
                var form = $(this);
                var formData = form.serialize();

                $.ajax({
                    url: "<?php echo e(route('front.email-subscribers.store')); ?>",
                    type: "POST",
                    data: formData,
                    dataType: "json",
                    async: "false",
                    success: function(res) {
                        if (res.status == 1) {
                            toastr.success(res.message);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        var status = jqXHR.status;
                        if (status == 404) {
                            toastr.warning("Element not found.");
                        } else if (status == 422) {
                            toastr.info(jqXHR.responseJSON.errors.email[0]);
                        }
                    }
                });
            });
        });
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH /home/tlanders/public_html/resources/views/front/elements/footer.blade.php ENDPATH**/ ?>
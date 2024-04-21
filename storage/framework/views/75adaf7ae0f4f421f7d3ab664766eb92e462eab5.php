<?php
    if (request()->has('destination_id')) {
        $get_destination_id = request('destination_id');
    }

    if (request()->has('keyword')) {
        $get_keyword = request('keyword');
    }

    if (request()->has('activity_id')) {
        $get_activity_id = request('activity_id');
    }

    if (request()->has('price')) {
        $get_price = request('price');
    }

    if (request()->has('duration')) {
        $get_duration = request('duration');
    }

    if (request()->has('page')) {
        $get_page = request('page');
    }
?>

<?php $__env->startPush('styles'); ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tiny-slider@2.9.3/dist/tiny-slider.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="<?php echo e(asset('assets/front/css/front-search-slider.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('meta_og_title'); ?><?php echo $seo->meta_title ?? ''; ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('meta_description'); ?><?php echo $seo->meta_description ?? ''; ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('meta_keywords'); ?><?php echo $seo->meta_keywords ?? ''; ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('meta_og_url'); ?><?php echo $seo->canonical_url ?? ''; ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('meta_og_description'); ?><?php echo $seo->meta_description ?? ''; ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('meta_og_image'); ?><?php echo $seo->socialImageUrl ?? ''; ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- Hero -->
    <section class="relative hero hero-alt">
        <img src="<?php echo e($destination->imageUrl); ?>" alt="" class="object-cover w-full h-96">
        <div class="absolute w-full top-1/2">
            <div class="container ">
                
                <h1 style="text-align: center;"><?php echo e($destination->name); ?></h1>
                
            </div>
    </section>

    <section class="pt-5">
        <div class="container" style="padding-top: 20px;max-width: 1100px;">
            <div class="mb-4">
                <?php if(strip_tags($destination->description) != ''): ?>
                    <div class="relative mb-4 tour-details-section" x-data="{ expanded: false }">
                        <div x-show="expanded" class="pb-20 mx-auto prose" x-collapse.min.427px>
                            <?= $destination->description ?></div>
                        <div class="absolute bottom-0 flex justify-center w-full py-4" style="background: linear-gradient(to top, rgba(255,255,255,1), rgba(255,255,255,0));"><button
                                class="px-4 py-2 text-xs rounded-full bg-light" x-on:click="expanded=!expanded" x-text="expanded?'Show less':'Show more'">Show more</button></div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        
        <div class="py-10 activities bg-gray">
            <div class="container">
                <div class="items-center justify-between gap-20 mb-4 lg:flex">
                    <div>
                        <p class="mb-2 text-2xl font-handwriting text-primary">Choose your activity</p>
                        <div class="flex">
                            <h2 class="relative pr-10 mb-8 text-3xl font-bold text-gray-600 uppercase lg:text-5xl font-display">
                                Things To Do
                                <div class="absolute right-0 w-6 h-1 rounded top-1/2 bg-accent"></div>
                            </h2>
                        </div>
                    </div>
                    
                </div>

                <!--<div class="activities-slider">-->
                <div class="grid max-w-6xl gap-4 mx-auto lg:grid-cols-4 lg:justify-center">

                    <?php $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo $__env->make('front.elements.activity-card', ['activity' => $activity], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>


        
        <div class="relative py-10">
            <div class="container">
                <div class="grid gap-4 lg:grid-cols-2">
                    <div class="prose lg:pr-10">
                        <h2>
                            <div class="mb-2 text-2xl font-handwriting text-primary">The Definitive</div>
                            <div class="text-3xl font-bold text-gray-600 uppercase font-display lg:text-5xl">
                                <?php echo e($destination->name); ?> Travel Guide</div>
                        </h2>
                        <p><?php echo $destination->tour_guide_description; ?></p>
                        

                        <a href="" class="btn btn-accent" style="text-decoration:none;">View Full Guide</a>
                    </div>
                    <?php if(!empty($destination->tour_guide_image_name)): ?>
                        <div class="right-0 w-full lg:absolute lg:w-1/2"><img src="<?php echo e($destination->tour_guide_image_url); ?>" style="padding-top: 44px;"></div>
                    <?php else: ?>
                        <div class="right-0 w-full lg:absolute lg:w-1/2"><img src="<?php echo e(asset('assets/front/img/nepal.webp')); ?>" style="padding-top: 44px;"></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <section class="pt-5">
        <div class="container">
            <div class="mb-4" id="searchDiv">
                <div class="grid gap-2 lg:grid-cols-4">
                    <div class="col-lg-2 col-md-2 col-sm-2">
                        <div class="form-group">
                            <label for="">Keywords</label>
                            <input type="text" id="keyword" class="form-control" value="<?php echo e($get_keyword ?? ''); ?>" name="keyword" />
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Activities</label>
                            <select name="" id="select-activity" class="custom-select">
                                <option value="" selected>All activities</option>
                                <?php if($activities): ?>
                                    <?php $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($activity->id); ?>" <?php echo e(isset($get_activity_id) && $get_activity_id == $activity->id ? 'selected' : ''); ?>>
                                            <?php echo e($activity->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group" style="border-left: 1px solid #ededed; padding-left: 19px; margin-left: 12px;">
                            <label for="">Duration</label>
                            <div class="custom-slider-container">
                                <div id="duration-slider-range"></div>
                                <input class="price-range-input" type="text" id="trip-days" readonly style="border:0; color:black; font-size:16px;" value="1 days - 60 days">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group" style="border-left: 1px solid #ededed; padding-left: 19px; margin-left: 12px;">
                            <label for="">Price Range</label>
                            <div class="custom-slider-container">
                                <div id="slider-range"></div>
                                <input class="price-range-input" type="text" id="amount" readonly style="border:0; color:black; font-size:16px;" value="$0 - $5000">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-light">
            <div class="container py-4">
                <div id="tirps-block" class="grid gap-2 md:grid-cols-2 lg:grid-cols-3 xl:gap-8">
                </div>
            </div>
            <div class="flex items-center" style="justify-content: center; margin-top: 50px;">
                <div id="spinner-block"></div>
                <button id="show-more" class="btn btn-accent" style="display: block; margin-bottom: 50px;">show
                    more</button>
            </div>
        </div>
    </section>

    <?php echo $__env->make('front.elements.plan_trip', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script src="https://cdn.jsdelivr.net/npm/tiny-slider@2.9.3/dist/tiny-slider.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script type="text/javascript">
        $(function() {
            let destination_id = "<?php echo $destination->id ?? ''; ?>";
            let xhr;
            let typingTimer;
            const debounceTime = 500;
            let totalPage;
            let nextPage;
            let currentPage = `<?php echo e(isset($get_page) && !empty($get_page) ? $get_page : 1); ?>`;

            function initSlider() {
                $("#duration-slider-range").slider({
                    classes: {
                        "ui-slider": "custom-slider"
                    },
                    range: true,
                    min: 1,
                    max: 60,
                    values: [1, 60],
                    change: function(event, ui) {
                        performSearch();
                    },
                    slide: function(event, ui) {
                        currentPage = 1;
                        $("#trip-days").val(ui.values[0] + " days - " + ui.values[1] + " days");
                    }
                });

                $("#slider-range").slider({
                    classes: {
                        "ui-slider": "custom-slider"
                    },
                    range: true,
                    min: 0,
                    max: 5000,
                    values: [0, 5000],
                    change: function(event, ui) {
                        performSearch();
                    },
                    slide: function(event, ui) {
                        currentPage = 1;
                        $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
                    }
                });

                const duration = `<?php echo e($get_duration ?? ''); ?>`;
                if (duration) {
                    const duration_arr = duration.split(",");
                    $("#trip-days").val(duration_arr[0] + " days - " + duration_arr[1] + " days");
                    $("#duration-slider-range").slider("values", duration_arr);
                }

                const price = `<?php echo e($get_price ?? ''); ?>`;
                if (price) {
                    const price_arr = price.split(",");
                    $("#amount").val("$" + price_arr[0] + " - $" + price_arr[1]);
                    $("#slider-range").slider("values", price_arr);
                }
            }

            initSlider();

            $("select").on('change', function(event) {
                event.preventDefault();
                performSearch();
            });

            // $('html, body').animate({
            //     scrollTop: $("#searchDiv").offset().top
            // }, "fast");

            $("#show-more").on('click', async function(event) {
                event.preventDefault();
                if (nextPage) {
                    currentPage++;
                    await paginate(currentPage);
                    if (!nextPage) {
                        $("#show-more").hide();
                    }
                }
            });

            $("#keyword").on('keyup', function(event) {
                handleKeyDown();
            });

            function handleKeyDown() {
                currentPage = 1;
                clearTimeout(typingTimer);
                typingTimer = setTimeout(performSearch, debounceTime);
            }

            function performSearch() {
                if (xhr && xhr.readyState !== 4) {
                    // If there is an ongoing AJAX request, abort it
                    xhr.abort();
                }
                filter();
            }

            async function paginate(page) {
                return new Promise((resolve, reject) => {
                    const keyword = $("#keyword").val();
                    const amount = $("#slider-range").slider("values");
                    const duration = $("#duration-slider-range").slider("values");
                    var activity_id = $("#select-activity").val();
                    var url_query =
                        `page=${currentPage}&keyword=${keyword}&destination_id=${destination_id}&activity_id=${activity_id}&price=${amount}&duration=${duration}`;
                    var url = "<?php echo e(url('trips/filter')); ?>" + `?${url_query}`;
                    $.ajax({
                        url: url,
                        type: "GET",
                        dataType: "json",
                        async: "false",
                        beforeSend: function(xhr) {
                            var spinner = '<button style="margin:0 auto;" class="text-white btn btn-sm btn-primary" type="button" disabled>\
                                                                                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>\
                                                                                            Loading Trips...\
                                                                                            </button>';
                            $("#spinner-block").html(spinner);
                            $("#show-more").hide();
                        },
                        success: function(res) {
                            if (res.success) {
                                $("#tirps-block").append(res.data);
                                nextPage = res.pagination.next_page;
                            }
                        }
                    }).done(function(data) {
                        $("#spinner-block").html('');
                        $("#show-more").show();
                        const slug = getCurrentUrlSlug();
                        let newUrl = "<?php echo route('front.destinations.show', ':SLUG'); ?>";
                        newUrl = newUrl.replace(":SLUG", slug);
                        window.history.pushState({}, "", newUrl + "?" + url_query);
                        resolve(true);
                    });
                });
            }

            performSearch();

            function getCurrentUrlSlug() {
                var path = window.location.pathname; // Get the path of the current URL
                var segments = path.split('/'); // Split the path into segments

                // Get the last segment (slug)
                var slug = segments[segments.length - 1];

                return slug;
            }

            function filter() {
                const keyword = $("#keyword").val();
                const amount = $("#slider-range").slider("values");
                const duration = $("#duration-slider-range").slider("values");
                var activity_id = $("#select-activity").val();
                var url_query =
                    `page=${currentPage}&keyword=${keyword}&destination_id=${destination_id}&activity_id=${activity_id}&price=${amount}&duration=${duration}`;
                var url = "<?php echo e(url('trips/filter')); ?>" + `?${url_query}`;
                xhr = $.ajax({
                    url: url,
                    type: "GET",
                    dataType: "json",
                    //data: data,
                    async: "false",
                    beforeSend: function(xhr) {
                        var spinner = '<button style="margin:0 auto;" class="text-white btn btn-sm btn-primary" type="button" disabled>\
                                                                              <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>\
                                                                              Loading Trips...\
                                                                            </button>';
                        $("#spinner-block").html(spinner);
                        $("#show-more").hide();
                    },
                    success: function(res) {
                        if (res.success) {
                            $("#tirps-block").html(res.data);
                            totalPage = res.pagination.total;
                            currentPage = res.pagination.current_page;
                            nextPage = res.pagination.next_page;
                        }
                    }
                }).done(function(data) {
                    $("#spinner-block").html('');
                    if (!nextPage) {
                        $("#show-more").hide();
                    } else {

                        $("#show-more").show();
                    }
                    const slug = getCurrentUrlSlug();
                    let newUrl = "<?php echo route('front.destinations.show', ':SLUG'); ?>";
                    newUrl = newUrl.replace(":SLUG", slug);
                    window.history.pushState({}, "", newUrl + "?" + url_query);
                });
            }
        });
    </script>
    
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.front_inner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/tlanders/public_html/resources/views/front/destinations/show.blade.php ENDPATH**/ ?>
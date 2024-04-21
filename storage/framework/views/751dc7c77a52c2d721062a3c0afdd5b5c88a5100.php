<?php $__env->startPush('styles'); ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tiny-slider@2.9.3/dist/tiny-slider.css">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Hero -->
    <section class="relative hero hero-alt">
        <img src="<?php echo e(asset('assets/front/img/destinations.webp')); ?>" alt="">
        <div class="absolute w-full top-1/2">
            <div class="container text-center">
                <h1 style="max-width: unset;">Destinations</h1>
                <div class="text-xl text-white">Explore Tours by Destination</div>
            </div>
        </div>

        
    </section>

    <section>
        

        <div class="bg-light">
            <div class="container py-20">
                <?php if(isset($keyword) && !empty($keyword)): ?>
                    <p id="search-p" class="fs-sm">Search results for "<strong><?php echo e(strtoupper($keyword)); ?></strong>"</p>
                <?php endif; ?>


                <div id="destination-card-block" class="grid gap-8 mb-5 md:grid-cols-2 lg:grid-cols-4">
                    <?php $__empty_1 = true; $__currentLoopData = $destinations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $destination): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php echo $__env->make('front.elements.destination_card', ['destination' => $destination, 'link' => route('front.destinations.show', $destination->slug)], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <?php endif; ?>
                </div>
                <?php if($destinations->nextPageUrl()): ?>
                    <div class="flex items-center" style="justify-content: center; margin-top: 50px;">
                        <div id="spinner-block"></div>
                        <button id="show-more" class="btn btn-accent" style="display: block;">show more</button>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <?php echo $__env->make('front.elements.plan_trip', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Trip of the month -->
    <div class="py-10 text-white bg-primary">
        <div class="container">

            <p class="mb-2 text-2xl text-white font-handwriting">This doesn't get any better</p>

            <div class="flex">
                <h2 class="relative pr-10 text-3xl font-bold uppercase lg:text-5xl font-display">
                    Trip of the Month
                    <div class="absolute right-0 w-6 h-1 rounded top-1/2 bg-accent"></div>
                </h2>
            </div>

            <div class="flex justify-end gap-4 trips-month-slider-controls">
                <button class="p-2 rounded-lg bg-light">
                    <svg class="w-6 h-6 text-accent">
                        <use xlink:href="<?php echo e(asset('assets/front/img/sprite.svg#arrownarrowleft')); ?>" />
                    </svg>
                </button>
                <button class="p-2 rounded-lg bg-light">
                    <svg class="w-6 h-6 text-accent">
                        <use xlink:href="<?php echo e(asset('assets/front/img/sprite.svg#arrownarrowright')); ?>" />
                    </svg>
                </button>
            </div>

            <div class="trips-month-slider">
                <?php $__empty_1 = true; $__currentLoopData = $block_3_trips; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $block3tour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php echo $__env->make('front.elements.tour_card_slider', ['tour' => $block3tour], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script src="https://cdn.jsdelivr.net/npm/tiny-slider@2.9.3/dist/tiny-slider.min.js"></script>
    <script type="text/javascript">
        //     let xhr;
        //     let typingTimer;
        //     const debounceTime = 500;
        //     let totalPage = "<?php echo e($destinations->total()); ?>";
        //     let nextPage = "<?php echo e($destinations->nextPageUrl()); ?>"
        //     let currentPage = "<?php echo e($destinations->currentPage()); ?>";
        //     $('html, body').animate({
        //         scrollTop: $("#searchDiv").offset().top
        //     }, "fast");

        //   $(".custom-select").on('change', function(event) {
        //     filter();
        //   });

        //   $("#search-keyword").on('keyup', function(event) {
        //     handleKeyDown();
        //   });

        //   function handleKeyDown() {
        //     clearTimeout(typingTimer);
        //     typingTimer = setTimeout(performSearch, debounceTime);
        // }

        function performSearch() {
            if (xhr && xhr.readyState !== 4) {
                // If there is an ongoing AJAX request, abort it
                xhr.abort();
            }

            filter();
        }

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

        async function paginate(page) {
            return new Promise((resolve, reject) => {
                var keyword = $("#search-keyword").val();
                const url = "<?php echo route('front.destinations.index'); ?>" + "?page=" + page + "&keyword=" + keyword;
                $.ajax({
                    url: url,
                    type: "GET",
                    dataType: "json",
                    async: "false",
                    beforeSend: function(xhr) {
                        var spinner = '<button style="margin:0 auto;" class="text-white btn btn-sm btn-primary" type="button" disabled>\
                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>\
                                        Loading Destinations...\
                                        </button>';
                        $("#spinner-block").html(spinner);
                        $("#show-more").hide();
                    },
                    success: function(res) {
                        if (res.success) {
                            $("#destination-card-block").append(res.data);
                            nextPage = res.pagination.next_page;
                        }
                    }
                }).done(function(data) {
                    $("#spinner-block").html('');
                    $("#show-more").show();
                    resolve(true);
                });
            });
        }

        const monthSlider = tns({
            container: '.trips-month-slider',
            nav: false,
            controlsContainer: '.trips-month-slider-controls',
            autoplay: true,
            autoplayButtonOutput: false
        })

        function filter() {
            var keyword = $("#search-keyword").val();
            // var activity_id = $("#select-activity").val();
            // var sortBy = $("#select-sort").val();
            // var url_query = "keyword=" + destination_id + "&act=" + activity_id + "&price=" + sortBy;
            var url_query = "keyword=" + keyword;

            var filter_url = '<?php echo e(route('front.destinations.search')); ?>' + '?' + url_query;
            // window.location.href = filter_url;
            const url = "<?php echo route('front.destinations.search'); ?>" + "?" + url_query;
            xhr = $.ajax({
                url: url,
                type: "GET",
                dataType: "json",
                async: "false",
                beforeSend: function(xhr) {
                    var spinner = '<button style="margin:0 auto;" class="text-white btn btn-sm btn-primary" type="button" disabled>\
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>\
                                    Loading Destinations...\
                                    </button>';
                    $("#spinner-block").html(spinner);
                    $("#show-more").hide();
                },
                success: function(res) {
                    if (res.success) {
                        $("#destination-card-block").html(res.data);
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
            });
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.front_inner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/tlanders/public_html/resources/views/front/destinations/index.blade.php ENDPATH**/ ?>
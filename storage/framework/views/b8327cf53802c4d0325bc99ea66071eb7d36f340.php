<?php
$mapImageUrl = $trip->mapImageUrl;
if (session()->has('success_message')) {
    $session_success_message = session('success_message');
    session()->forget('success_message');
}

if (session()->has('error_message')) {
    $session_error_message = session('error_message');
    session()->forget('error_message');
}
?>

<?php $__env->startSection('meta_og_title'); ?><?php echo $trip->trip_seo->meta_title ?? ''; ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('meta_description'); ?><?php echo $trip->trip_seo->meta_description ?? ''; ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('meta_keywords'); ?><?php echo $trip->trip_seo->meta_keywords ?? ''; ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('meta_og_url'); ?><?php echo $trip->trip_seo->canonical_url ?? ''; ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('meta_og_description'); ?><?php echo $trip->trip_seo->meta_description ?? ''; ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('meta_og_image'); ?><?php echo e(trim($trip->trip_seo->ogImageUrl) === '' ? $trip->imageUrl : $trip->trip_seo->ogImageUrl); ?><?php $__env->stopSection(); ?>
    <?php $__env->startPush('styles'); ?>
        <script src="https://www.google.com/recaptcha/api.js?onload=CaptchaCallback&render=explicit" async defer></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tiny-slider@2.9.3/dist/tiny-slider.css">
        <style>
            .blocker {
                z-index: 10000 !important;
            }

            .embed-container {
                position: relative;
                padding-bottom: 56.25%;
                height: 0;
                overflow: hidden;
                max-width: 100%;
            }

            .embed-container iframe,
            .embed-container object,
            .embed-container embed {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
            }

            .modal {
                z-index: 99999 !important;
            }

            .map-image-modal {
                cursor: zoom-in;
                object-fit: cover;
                /*width: 200px;*/
            }

            .trip-faq-description ul li {
                list-style-type: inherit !important;
            }

            .modal-body {
                /* 100% = dialog height, 120px = header + footer */
                /*height: 70vh;*/
                /*overflow-y: scroll;*/
            }

            .trip-map-iframe {
                display: flex;
            }
             canvas#ctx {
                background: center / cover url(https://www.havenholidaysnepal.com/assets/front/img/mountains.jpg);
            }
        </style>
        
    <script type="application/ld+json">
    {
      "@context": "https://schema.org/",
      "@type": "Product",
      "name": "<?php echo $__env->yieldContent('meta_og_title'); ?>",
      "image": [
        "<?php echo $__env->yieldContent('meta_og_url'); ?>" ],
      "description": "<?php echo $__env->yieldContent('meta_description'); ?>",
      "sku": "Treklanders Adventures",
      "mpn": "Treklanders Adventures",
      "brand": {
        "@type": "Brand",
        "name": "Treklanders Adventures"
      },
      "review": {
        "@type": "Review",
        "reviewRating": {
          "@type": "Rating",
          "ratingValue": "4",
          "bestRating": "5"
        },
        "author": {
          "@type": "Person",
          "name": "Treklanders Adventures"
        }
      },
      "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "5",
        "reviewCount": "<?php echo e($trip->reviews_count); ?>"
      },
      "offers": {
        "@type": "Offer",
        "url": "<?php echo e(route('front.trips.show', ['slug' => $trip->slug])); ?>",
        "priceCurrency": "USD",
        "price": "<?php echo e(($trip->offer_price)); ?>",
        "priceValidUntil": "2030-11-20",
        "itemCondition": "https://schema.org/UsedCondition",
        "availability": "https://schema.org/InStock"
      }
    }
    </script>
    <?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>

    <!-- Hero -->
    <section class="relative hero">
        <div id="hero-slider" class="hero-slider">
            <?php if(iterator_count($trip->trip_galleries)): ?>
                <?php $__currentLoopData = $trip->trip_galleries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gallery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="slide">
                        <img src="<?php echo e($gallery->imageUrl); ?>" class="block w-full min-h-[30rem] aspect-[2/1] object-cover" alt="">
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <div class="slide">
                    <img src="<?php echo e(asset('assets/front/img/hero.jpg')); ?>" class="block w-full min-h-[30rem] aspect-[2/1] object-cover" alt="">
                </div>
            <?php endif; ?>
        </div>

        <div class="absolute bottom-0 w-full bg-gradient-to-t from-primary-dark/60 to-primary-dark/0">
            <div class="container flex flex-wrap items-end justify-between gap-10 lg:flex-nowrap">
                <div class="py-10">
                    <h1 class="mb-4 text-4xl font-bold text-white font-display lg:text-7xl hero-title drop-shadow-lg">
                        <span><?php echo e($trip->name); ?></span>
                    </h1>

                    <div class="hidden breadcrumb-wrapper md:block">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb fs-sm wrap">
                                <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a></li>
                                <li class="breadcrumb-item"><a href="<?php echo e(route('front.trips.listing')); ?>">Trips</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><?php echo e($trip->name); ?></li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="hidden pb-10 lg:block">
                    <div class="px-6 py-4 text-white rounded-lg ratings d-flex align-items-center bg-primary text-secondary">
                        <div class="flex">
                            <?php for($i = 0; $i < $trip->rating; $i++): ?>
                                <svg class="w-6 h-6 text-accent">
                                    <use xlink:href="<?php echo e(asset('assets/front/img/sprite.svg')); ?>#star" />
                                </svg>
                            <?php endfor; ?>
                            <?php for($i = 0; $i < 5 - $trip->rating; $i++): ?>
                                <svg class="w-6 h-6 text-accent" viewbox="0 0 20 20" stroke="currentColor" fill="none">
                                    <path stroke-linecap="round" stroke-width="1.5"
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                            <?php endfor; ?>
                        </div>
                        <div class="text-xs text-center">from <?php echo e($trip->reviews_count); ?> reviews</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="absolute hidden hero-slider-controls md:block">
            <div class="container flex">
                <button>
                    <svg class="w-6 h-6">
                        <use xlink:href="<?php echo e(asset('assets/front/img/sprite.svg#arrownarrowleft')); ?>" />
                    </svg>
                </button>
                <button>
                    <svg class="w-6 h-6">
                        <use xlink:href="<?php echo e(asset('assets/front/img/sprite.svg#arrownarrowright')); ?>" />
                    </svg>
                </button>
            </div>
        </div>

    </section>

    <div id="heroBottomObserver"></div>
    <section>
        <!-- Sticky Nav -->
        <div class="sticky top-0 z-10 text-white tdb bg-primary">
            <div id="stickyNavTop" class="hidden bg-white">
                <div class="container justify-between gap-10 py-4 lg:flex">
                    <div>
                        <span class="text-lg font-bold lg:text-3xl text-primary font-display"><?php echo e($trip->name); ?></span>
                        <span class="text-gray-600 lg:text-lg">- <?php echo e($trip->duration); ?> days</span>
                    </div>
                    <div class="flex gap-2">
                        <a href="/" class="btn btn-sm btn-primary">Chat via WhatsApp</a>
                        <a href="/" class="btn btn-sm btn-primary">Get a trip Quote</a>
                    </div>
                </div>
            </div>
            <div class="container flex items-center justify-center">
                <nav class="flex items-center justify-center tour-details-tabs" id="secondnav">
                    <ul class="flex flex-wrap gap-1 py-1 nav">
                        <li>
                            <a href="#overview" class="flex items-center p-2 hover:bg-white hover:text-primary">
                                <svg class="w-6 h-6 md:mr-2">
                                    <use xlink:href="<?php echo e(asset('assets/front/img/sprite.svg')); ?>#viewgrid" />
                                </svg>
                                <span class="hidden md:block">Overview</span>
                            </a>
                        </li>
                        <?php if(!$trip->trip_itineraries->isEmpty()): ?>
                            <li>
                                <a href="#itinerary" class="flex items-center p-2 hover:bg-white hover:text-primary">
                                    <svg class="w-6 h-6 md:mr-2">
                                        <use xlink:href="<?php echo e(asset('assets/front/img/sprite.svg')); ?>#clock" />
                                    </svg>
                                    <span class="hidden md:block">Itinerary</span></a>
                            </li>
                        <?php endif; ?>

                        <?php if($trip->trip_include_exclude): ?>
                            <li>
                                <a href="#inclusions" class="flex items-center p-2 hover:bg-white hover:text-primary">
                                    <svg class="w-6 h-6 md:mr-2">
                                        <use xlink:href="<?php echo e(asset('assets/front/img/sprite.svg')); ?>#archive" />
                                    </svg>
                                    <span class="hidden md:block">Inclusions</span>
                                </a>
                            </li>
                        <?php endif; ?>

                        <?php if(!$trip->trip_departures->isEmpty()): ?>
                            <li>
                                <a href="#date-price" class="flex items-center p-2 hover:bg-white hover:text-primary">
                                    <svg class="w-6 h-6 md:mr-2">
                                        <use xlink:href="<?php echo e(asset('assets/front/img/sprite.svg')); ?>#calendar" />
                                    </svg>
                                    <span class="hidden md:block">Date & Price</span>
                                </a>
                            </li>
                        <?php endif; ?>

                        <li>
                            <a href="#reviews" class="flex items-center p-2 hover:bg-white hover:text-primary">
                                <svg class="w-6 h-6 md:mr-2">
                                    <use xlink:href="<?php echo e(asset('assets/front/img/sprite.svg')); ?>#chat" />
                                </svg>
                                <span class="hidden md:block">Review</span>
                            </a>
                        </li>

                        <?php if($trip->trip_seo?->about_leader): ?>
                            <li>
                                <a href="#equipment-list" class="flex items-center p-2 hover:bg-white hover:text-primary">
                                    <svg class="w-6 h-6 md:mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z">
                                        </path>
                                    </svg>
                                    <span class="hidden md:block">Equipment List</span>
                                </a>
                            </li>
                        <?php endif; ?>

                        <?php if(!$trip->trip_faqs->isEmpty()): ?>
                            <li>
                                <a href="#faqs" class="flex items-center p-2 hover:bg-white hover:text-primary">
                                    <svg class="w-6 h-6 md:mr-2">
                                        <use xlink:href="<?php echo e(asset('assets/front/img/sprite.svg')); ?>#questionmarkcircle" />
                                    </svg>
                                    <span class="hidden md:block">FAQs</span>
                                </a>
                            </li>
                        <?php endif; ?>

                    </ul>
                </nav>
            </div>
            <div id="tourDetailsBarIO"></div>
        </div><!-- Sticky Nav -->

        <div class="container grid gap-10 py-20 mt-2 lg:grid-cols-3 xl:gap-16">

            <div class="tour-details lg:col-span-2">

                <div class="lg:none">
                    <?php echo $__env->make('front.elements.price_card', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>

                <div id="overview" class="mb-4 tds">
                    <div>

                        <div class="grid gap-2 p-4 mb-6 lg:gap-4 md:grid-cols-2 lg:grid-cols-3 bg-sky-50">

                            <?php $__currentLoopData = $trip_infos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="flex items-start border border-gray-200 rounded-lg p-2 bg-white <?php echo e(array_key_exists('span', $info) ? 'lg:col-span-' . $info['span'] : ''); ?>">
                                    <div class="flex items-start flex-shrink-0 p-3 rounded-lg bg-amber-100">
                                        <svg class="w-6 h-6 text-gray-600 lg:w-8 lg:h-8">
                                            <use xlink:href="<?php echo e(asset('assets/front/img/sprite.svg')); ?>#<?php echo e($info['icon']); ?>" />
                                        </svg>
                                    </div>
                                    <div class="flex-grow px-6 py-2">
                                        <div class=" font-display text-primary">
                                            <?php echo e($info['key']); ?>

                                        </div>
                                        <div class="text-sm text-gray-600 lg:text-base">
                                            <?php echo $info['value']; ?>

                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </div>

                        <div>

                            <h2 class="mb-2 text-2xl font-display text-primary">Highlights</h2>
                            <div class="prose highlights">
                                <?php echo $trip->trip_info ? $trip->trip_info->highlights : ''; ?>

                            </div>

                            <div id="overview-text" x-data="{ expanded: false }" class="relative mb-4 prose ">
                                <h2 class="sr-only">Overview</h2>
                                <div x-show="expanded" class="pb-20" x-collapse.min.200px><?= $trip->trip_info ? $trip->trip_info->overview : '' ?></div>
                                <div class="absolute bottom-0 flex justify-center w-full py-4" style="background: linear-gradient(to top, rgba(255,255,255,1), rgba(255,255,255,0));"><button
                                        class="px-4 py-2 text-xs rounded-full bg-light" x-on:click="expanded=!expanded" x-text="expanded?'Show less':'Show more'">Show more</button></div>
                            </div>

                            <?php if(trim($trip->trip_info?->important_note) !== ''): ?>
                                <div class="p-4 mb-3 prose bg-light">
                                    <h3 class="mb-2 text-xl font-display text-primary"> Important Note</h3>
                                    <p class="">
                                        <?php echo $trip->trip_info ? $trip->trip_info->important_note : ''; ?>

                                    </p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>


                </div>

                <!--<div class='mb-4 embed-container'><iframe src='https://www.youtube.com/embed//dFLxa0VwY-E' frameborder='0' allowfullscreen></iframe></div>-->

                <?php if(!$trip->trip_itineraries->isEmpty()): ?>
                    <div id="itinerary" class="pt-10 pb-4 mb-4 bg-white tds " x-data="{
                        day1Open: true,
                        <?php for($i = 1; $i < $trip->trip_itineraries->count() ; $i++): ?>
                        day<?php echo e($i + 1); ?>Open:false, <?php endfor; ?>
                    }">
                        <div class="flex flex-wrap items-end justify-between gap-4 mb-4">
                            <h2 class="text-3xl font-display text-primary">Trip Itinerary</h2>
                            <div>
                                <button class="mb-2 btn btn-sm btn-primary expand-all"
                                    @click="
                                <?php for($i = 0; $i < $trip->trip_itineraries->count() ; $i++): ?>
                                    day<?php echo e($i + 1); ?>Open = <?php endfor; ?>
                                true">Expand
                                    All</button>
                                <button class="mb-2 btn btn-sm btn-primary collapse-all"
                                    @click="
                                <?php for($i = 0; $i < $trip->trip_itineraries->count() ; $i++): ?>
                                    day<?php echo e($i + 1); ?>Open = <?php endfor; ?>
                                false">Collapse
                                    All</button>
                            </div>
                        </div>
                        <div class="mb-4 itinerary">
                            <?php $__currentLoopData = $trip->trip_itineraries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $itinerary): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="mb-2">
                                    <button class="flex items-center w-full p-2 text-left text-primary bg-sky-50" :aria-expanded="day<?php echo e($i + 1); ?>Open" aria-controls="day<?php echo e($i + 1); ?>"
                                        x-on:click="day<?php echo e($i + 1); ?>Open=!day<?php echo e($i + 1); ?>Open">
                                        <div class="flex items-center mr-4">
                                            <div class="mr-2 text-sm">Day</div>
                                            <div class="text-2xl font-display text-primary">
                                                <?php echo e($itinerary->day); ?>

                                            </div>
                                        </div>
                                        <div class="flex justify-between flex-grow-1">
                                            <h3 class="text-xl text-gray-600 font-display"><?php echo e($itinerary->name); ?></h3>
                                            <svg class="flex-shrink-0 w-6 h-6" x-cloak x-show="!day<?php echo e($i + 1); ?>Open">
                                                <use xlink:href="<?php echo e(asset('assets/front/img/sprite.svg')); ?>#plus" />
                                            </svg>
                                            <svg class="flex-shrink-0 w-6 h-6" x-cloak x-show="day<?php echo e($i + 1); ?>Open">
                                                <use xlink:href="<?php echo e(asset('assets/front/img/sprite.svg')); ?>#minus" />
                                            </svg>
                                        </div>
                                    </button>
                                    <div id="day<?php echo e($i + 1); ?>" class="border-l border-r border-gray-100" x-cloak x-collapse x-show="day<?php echo e($i + 1); ?>Open">
                                        <div class="<?php echo e(isset($itinerary->image_name) && !empty($itinerary->image_name) ? 'grid gap-4 xl:grid-cols-2' : ''); ?>">
                                            <?php if(isset($itinerary->image_name) && !empty($itinerary->image_name)): ?>
                                                <div class="p-4 <?php echo e($i % 2 == 0 ? 'xl:order-1' : ''); ?>">
                                                    <img src="<?php echo e($itinerary->imageUrl); ?>" alt="" class="object-cover w-full h-full" loading="lazy">
                                                </div>
                                            <?php endif; ?>
                                            <div class="p-8">
                                                <div class="prose"><?php echo $itinerary->description; ?></div>
                                            </div>
                                        </div>
                                        
                                        <?php if($itinerary->max_altitude || $itinerary->accomodation || $itinerary->meals): ?>
                                            <div class="flex flex-col justify-between gap-4 bg-gray-50 md:flex-row">
                                                <?php if($itinerary->max_altitude): ?>
                                                    <div class="flex gap-2 p-4">
                                                        <img src="<?php echo e(asset('assets/front/img/elevation.png')); ?>" alt="" class="w-10 h-10" loading="lazy">
                                                        <div>
                                                            <h4 class="text-sm font-bold">Max. altitude</h4>
                                                            <div><?php echo e($itinerary->max_altitude); ?></div>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if($itinerary->accomodation): ?>
                                                    <div class="flex gap-2 p-4">
                                                        <img src="<?php echo e(asset('assets/front/img/accomodation.png')); ?>" alt="" class="w-10 h-10" loading="lazy">
                                                        <div>
                                                            <h4 class="text-sm font-bold">Accomodation</h4>
                                                            <div><?php echo e($itinerary->accomodation); ?></div>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if($itinerary->meals): ?>
                                                    <div class="flex gap-2 p-4">
                                                        <img src="<?php echo e(asset('assets/front/img/meal.png')); ?>" alt="" class="w-10 h-10" loading="lazy">
                                                        <div>
                                                            <h4 class="text-sm font-bold">Meals</h4>
                                                            <div><?php echo e($itinerary->meals); ?></div>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                                
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="items-center justify-between p-4 lg:flex bg-light">
                            <div>
                                Not satisfied with this itinerary? <b class="text-primary">Make your own</b>.
                            </div>
                            <a href="<?php echo e(route('front.plantrip.createfortrip', $trip->slug)); ?>" class="btn btn-sm btn-primary">Plan My Trip</a>
                        </div>
                    </div>
                <?php endif; ?>
                
                 
                 <?php echo $__env->make('front.elements.elevation_chart', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <div id="inclusions" class="pt-10 pb-4 mb-4 tds">
                    <div class="grid gap-10 lg:grid-cols-2">
                        <?php if($trip->trip_include_exclude): ?>
                            
                            <div class="prose">
                                <h2 class="text-3xl font-display text-primary">Includes</h2>
                                <div class="includes">
                                    <?= $trip->trip_include_exclude->include ?>
                                </div>
                            </div>

                            <div class="prose">
                                <h2 class="text-3xl font-display text-primary">Doesn't Include</h2>
                                <div class="excludes">
                                    <?= $trip->trip_include_exclude->exclude ?>
                                </div>
                            </div>
                            
                        <?php endif; ?>
                    </div>
                </div>

                
            <?php if(!$trip->trip_departures->isEmpty()): ?>
            <div id="date-price" class="mb-10 tds">
                <div class="flex flex-wrap items-center justify-between gap-10 mb-4">
                    <h2 class="mb-6 text-2xl uppercase lg:text-3xl font-display text-primary">Upcoming Departure Dates
                    </h2>
                    <div class="flex gap-2">
                        <button id="group-departure" class="flex items-center gap-2 p-2 text-sm bg-white border border-gray-200 rounded hover:text-primary hover:border-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 h-4" viewBox="0 0 16 16">
                                <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022ZM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4" />
                            </svg>
                            Group departures
                        </button>
                        <button id="private-departure" class="flex items-center gap-2 p-2 text-sm border rounded hover:text-primary hover:border-primary border-primary text-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 h-4" viewBox="0 0 16 16">
                                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664z" />
                            </svg>
                            Private departures
                        </button>
                    </div>
                </div>
                <?php
                $currentYear = date('Y');
                $currentMonth = date('n');
                $monthsArray = [];
                for ($i = 0; $i < 24; $i++) {
                    $year = $currentYear;
                    if ($currentMonth > 12) {
                        $currentMonth -= 12;
                        $year++;
                        $currentYear = $year;
                    }
                    $monthsArray[] = strtotime("$year-$currentMonth-01");
                    $currentMonth = $currentMonth + 1;
                }
                ?>

                <div id="all-dates-block" class="grid grid-cols-4 gap-2 mb-4 md:grid-cols-6 lg:grid-cols-9">
                    <button id="all-departure-filter" class="p-2 px-4 py-2 font-semibold text-center text-white border rounded departure-date-active border-primary bg-primary">
                        All <br>Dep
                    </button>
                    <?php $__currentLoopData = $monthsArray; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $month): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <button data-date="<?php echo e($month); ?>" class="p-2 px-4 py-2 font-semibold text-center text-gray-500 bg-white border border-gray-200 rounded select-date-departure hover:border-primary hover:text-primary"><?php echo e(Str::replaceFirst('-', '<br>', date('M Y', $month))); ?>

                    </button>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="grid gap-4 mb-6">
                    <?php
                    $trip_departures = $trip->trip_departures;
                    ?>
                    <div id="departure-filter-block" class="grid gap-4">
                        <?php $__currentLoopData = $trip->trip_departures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $departure): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="grid grid-cols-2 gap-4 px-4 py-3 bg-white border-2 border-gray-100 rounded-lg lg:px-10 lg:grid-cols-5 hover:border-primary">
                            <div>
                                <div class="font-semibold"><?php echo e(formatDate($departure->from_date)); ?></div>
                                <span class="text-sm text-gray-500">From <?php echo e($trip->starting_point); ?></span>
                            </div>
                            <div>
                                <div class="font-semibold"><?php echo e(formatDate($departure->to_date)); ?></div>
                                <span class="text-sm text-gray-500">To <?php echo e($trip->ending_point); ?></span>
                            </div>
                            <div>
                                <div class="font-semibold"><?php echo e($departure->seats); ?></div>
                                <div class="text-sm text-gray-500">seats left</div>
                            </div>
                            <div>
                                <div class="text-sm font-semibold">From <span class="text-red-500"><s><?php echo e(number_format($trip->cost)); ?></s></span></div>
                                <div class="font-semibold">US$ <?php echo e(number_format($departure->price)); ?></div>
                                <div class="text-sm text-green-600">Saving US$ <?php echo e(number_format($trip->cost - $departure->price)); ?></div>
                            </div>
                            <div class="self-center col-span-2 lg:col-span-1">
                                 <a href="<?php echo e(route('front.trips.departure-booking', ['slug' => $trip->slug, 'id' => $departure->id])); ?>"
                                 class="inline-block w-full px-3 py-2 text-sm text-center transition border rounded border-primary hover:bg-primary hover:text-white">Join Now</a>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>


                
                <div style=" display: flex; justify-content: center;">
                    <button id="show-more-departure-button" style="display: none;" class="px-4 py-2 text-xs rounded-full bg-light">Show more</button>
                </div>
            </div>
            <?php endif; ?>
            

                <?php if(iterator_count($trip->trip_reviews)): ?>
                    <div id="reviews" class="max-w-3xl pt-10 pb-4 mb-4 bg-white tds">
                        <div class="items-center justify-between mb-4 lg:flex">
                            <h2 class="text-3xl font-display text-primary">Reviews
                            </h2>
                        </div>
                        <div class="grid gap-2 lg:grid-cols-1 lg:gap-3">

                            <?php $__currentLoopData = $trip->trip_reviews()->where('status', 1)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="mb-4 review">
                                    <div class="mb-4 prose review__content">
                                        <h3 class="mb-2 text-2xl text-gray-600 font-display"><?php echo e($review->title); ?></h3>
                                        <p><?php echo e($review->review); ?></p>
                                    </div>
                                    <div class="flex items-center gap-4">
                                        <img src="<?php echo e($review->thumbImageUrl); ?>" alt="" loading="lazy" class="rounded-full">
                                        <div>
                                            <div class="font-bold"><?php echo e($review->review_name); ?></div>
                                            <div class="text-sm text-gray"><?php echo e($review->review_country); ?></div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                        <a href="<?php echo e(route('front.reviews.index')); ?>" class="btn btn-sm btn-primary">See more reviews
                        </a>
                        <a href="<?php echo e(route('front.reviews.create')); ?>" class="btn btn-accent btn-sm">
                            Write a review</a>
                    </div>
                <?php endif; ?>

                
                <?php if($trip->trip_seo?->about_leader): ?>
                    <div id="equipment-list" class="pt-10 pb-4 mb-4 bg-white tds">
                        <h2 class="mb-4 text-3xl font-display text-primary">Equipment List</h2>
                        <div class="prose">
                            <?php echo $trip->trip_seo->about_leader; ?>

                        </div>
                    </div>
                <?php endif; ?>
                

                <?php if(!$trip->trip_faqs->isEmpty()): ?>
                    <div id="faqs" class="pt-10 pb-4 mb-4 tds">
                        <h2 class="mb-4 text-3xl font-display text-primary">Frequently Asked Questions</h2>

                        <div class="mb-4" x-data="{ active: 'none' }">
                            <?php $__currentLoopData = $trip->trip_faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="mb-1">
                                    <button class="flex items-center justify-between w-full p-2 text-left focus:border-light"
                                        @click="active = (active === <?php echo e($i); ?> ? 'none' : <?php echo e($i); ?>)">
                                        <h3 class="text-xl text-gray-600 font-display"><?php echo e($faq->title); ?></h3>

                                        <svg class="flex-shrink-0 w-6 h-6 text-primary" x-cloak x-show="active!==<?php echo e($i); ?>">
                                            <use xlink:href="<?php echo e(asset('assets/front/img/sprite.svg')); ?>#plus" />
                                        </svg>
                                        <svg class="flex-shrink-0 w-6 h-6 text-primary" x-cloak x-show="active===<?php echo e($i); ?>">
                                            <use xlink:href="<?php echo e(asset('assets/front/img/sprite.svg')); ?>#minus" />
                                        </svg>
                                    </button>
                                    <div class="p-4 border-t border-gray-200" x-cloak x-show="active===<?php echo e($i); ?>">
                                        <div class="prose"><?php echo $faq->description; ?></div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                        <a href="#" class="btn btn-sm btn-primary">Read more FAQs</a>
                    </div>
                <?php endif; ?>
            </div>

            
            <aside>
                <div class="h-full md:max-w-[20rem] mx-auto md:ml-auto">

                    <?php echo $__env->make('front.elements.price_card', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    

                    <?php echo $__env->make('front.elements.enquiry', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <!-- Route Map -->
                    <?php if($trip->map_file_name): ?>
                        <div class="mb-8">
                            <div class="card-header">
                                <h2 class="mb-2 text-2xl font-display text-primary">Map & Route</h2>
                            </div>
                            <div class="p-0 card-body">
                                <!-- Link to open the modal -->
                                <a href="#ex1" rel="modal:open" class="cursor-zoom-in">
                                    <img class="img-fluid" src="<?php echo e($trip->mapImageUrl); ?>" alt="<?php echo e($trip->name); ?>" loading="lazy">
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if(!empty($trip->iframe)): ?>
                        <div class="mb-8">
                            <div class="card-header">
                                <h2 class="mb-2 text-2xl uppercase font-display text-primary">Map</h2>
                            </div>
                            <div class="p-0 card-body">
                                <!-- Link to open the modal -->
                                <div class="trip-map-iframe">
                                    <?php echo $trip->iframe; ?>

                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php echo $__env->make('front.elements.experts-card', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <?php echo $__env->make('front.elements.essential_trip_information', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <?php if(iterator_count($trip->addon_trips)): ?>
                        <div class="mb-8">
                            <h2 class="mb-2 text-xl font-display text-primary">Additional Tours</h2>
                            <?php $__empty_1 = true; $__currentLoopData = $trip->addon_trips; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $addon_trip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <?php echo $__env->make('front.elements.addon_trip', ['trip' => $addon_trip], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <div class="sticky hidden lg:block top-48">
                        <?php echo $__env->make('front.elements.price_card', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>

            </aside>
        </div>

        <!-- Similar -->
        <?php if(!$trip->similar_trips->isEmpty()): ?>
            <div class="py-20 bg-gray-200">
                <div class="container">
                    <h2 class="mb-4 text-3xl font-display text-primary">Similar Tours</h2>
                    <div class="grid gap-10 md:grid-cols-2 lg:grid-cols-3">
                        <?php $__empty_1 = true; $__currentLoopData = $trip->similar_trips; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <?php echo $__env->make('front.elements.tour-card', ['tour' => $trip], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div> <!-- Similar -->
        <?php endif; ?>
    </section>

    

    <div id="ex1" class="modal" style="max-width: 70%;">
        <p>
            <img class="map-image-modal" src="<?php echo e($trip->mapImageUrl); ?>" alt="route map of <?php echo e($trip->name); ?>" loading="lazy">
        </p>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <!--<script src="<?php echo e(asset('assets/front/js/tour-details.js')); ?>"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/wheelzoom@4.0.1/wheelzoom.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tiny-slider@2.9.3/dist/tiny-slider.min.js"></script>
    
    <script>
        // wheelzoom(document.querySelector('.wheelzoom'))
    </script>
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            const heroSlider = tns({
                container: '.hero-slider',
                nav: false,
                controlsContainer: '.hero-slider-controls > div',
                autoplay: true,
                autoplayButtonOutput: false
            })

            const heroBottomObserver = new IntersectionObserver((entries, observer) => {
                const stickyNavTop = document.querySelector('#stickyNavTop')
                if (entries) {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            stickyNavTop.classList.add('hidden')
                        } else {
                            stickyNavTop.classList.remove('hidden')
                        }
                    })
                }
            }, {
                rootMargin: "0px 0px 0px 0px"
            });
            heroBottomObserver.observe(document.querySelector('#heroBottomObserver'))

            // For scrollspy functionality
            const tdb = document.querySelector('.tdb')
            if (tdb) {
                const sections = document.querySelectorAll('.tds')
                const sectionScrollObserver = new IntersectionObserver((entries, observer) => {
                    if (entries) {
                        entries.forEach(entry => {
                            const link = tdb.querySelector(`[href="#${entry.target.id}"]`)
                            if (link != null) {
                                if (entry.isIntersecting) {
                                    link.classList.add('bg-accent')
                                } else {
                                    link.classList.remove('bg-accent')
                                }
                            }
                        })
                    }
                }, {
                    rootMargin: "-19% 0px -80% 0px"
                })
                sections.forEach(section => {
                    sectionScrollObserver.observe(section)
                })
            }

        })
        window.onload = function() {

            var session_success_message = '<?php echo e($session_success_message ?? ''); ?>';
            var session_error_message = '<?php echo e($session_error_message ?? ''); ?>';
            if (session_success_message) {
                toastr.success(session_success_message);
            }

            if (session_error_message) {
                toastr.danger(session_error_message);
            }

            // Hero Slider
            //   $(".tour-details-hero .owl-carousel").owlCarousel({
            //     items: 1,
            //     dots: false,
            //     // autoplay: true,
            //     // autoplayTimeout: 8000,
            //     loop: true,
            //     animateOut: 'fadeOut'
            //   });

            // $("#review-modal").modal('show');

            //Display user image upon select
            const showImage = (src, target) => {
                var fr = new FileReader();
                // when image is loaded, set the src of the image where you want to display it
                fr.onload = function(e) {
                    target.src = this.result;
                };
                src.addEventListener("change", function() {
                    // fill fr with image data
                    fr.readAsDataURL(src.files[0]);
                });
            }
            const src = document.getElementById("photo-input");
            const target = document.getElementById("write-review-photo");
            //   showImage(src, target);

            //Control ratings
            //   const stars = document.querySelectorAll('.select-ratings i')
            //   const ratingsInput = document.querySelector('#ratings-input')
            //   stars.forEach((star, index) => {
            //     star.addEventListener('click', () => {
            //       ratingsInput.value = index + 1
            //       console.log(ratingsInput.value)
            //       stars.forEach((star, indexx) => {
            //         star.classList.remove('active')
            //         if (indexx <= index) star.classList.add('active')
            //       })
            //     })
            //   })
        }
        $(function() {
            $('#ex1').on($.modal.OPEN, function(event, modal) {
                setTimeout(function() {
                    $('.map-image-modal').attr('src', "<?php echo e($mapImageUrl); ?>");
                    $('.map-image-modal').show();
                    wheelzoom($('.map-image-modal'));
                }, 500);
            });

            $('#ex1').on($.modal.AFTER_CLOSE, function(event, modal) {
                $('.map-image-modal').attr('src', "");
                $('.map-image-modal').hide();
                $('.map-image-modal').trigger('wheelzoom.reset');
            });
            $('#map-modal').on('show.bs.modal', function(e) {
                setTimeout(function() {
                    let img = '<img class="img-fluid map-image-modal" src="<?php echo e($mapImageUrl); ?>" alt="">';
                    $("#map-modal").find(".modal-body").html(img);
                    wheelzoom($('.map-image-modal'));
                }, 500);
            });
            // $(".similar-trip-rating").rating();
            // $("#review-rating").rating();
        });
    </script>
    <script>
        $(function() {
            var enquiry_validator = $("#enquiry-form").validate({
                ignore: "",
                rules: {
                    'name': 'required',
                    'email': 'required',
                    'country': 'required',
                    'phone': 'required',
                    'message': 'required',
                },
                errorPlacement: function(error, element) {
                    error.insertAfter(element.closest('.flex'));
                    // error.append(element.closest('.form-group'));
                },
                submitHandler: function(form, event) {
                    event.preventDefault();
                    $(form).find('#redirect-url').val('<?php echo route('front.trips.show', $trip->slug); ?>');
                    if (grecaptcha.getResponse(0)) {
                        var btn = $(form).find('button[type=submit]').attr('disabled', true).html('Sending...');
                        setTimeout(() => {
                            form.submit();
                        }, 500);
                    } else {
                        grecaptcha.reset(enquiry_captcha);
                        grecaptcha.execute(enquiry_captcha);
                    }
                },
            });
        });

        function onSubmitReview(token) {
            $("#review-form").submit();
            return true;
        }

        function onSubmitEnquiry(token) {
            $("#enquiry-form").submit();
            return true;
        }

        let enquiry_captcha;
        let review_captcha;
        var CaptchaCallback = function() {
            enquiry_captcha = grecaptcha.render('inquiry-g-recaptcha', {
                'sitekey': '<?php echo config('constants.recaptcha.sitekey'); ?>'
            });
            // review_captcha = grecaptcha.render('review-g-recaptcha', {'sitekey' : '<?php echo config('constants.recaptcha.sitekey'); ?>'});
        };

        $(function() {
            let groupDepartureStatus = true;
            let privateDepartureList = [];
            let groupDepartureList = [];
            $(".select-date-departure").on('click', function(event) {
                const dateStr = $(this).data('date');
                filterDepartureByMonth(dateStr);
                removeDateActive();
                $(this).addClass('departure-date-active bg-primary text-white');
                $(this).removeClass('hover:text-primary bg-white');
            });

            function removeDateActive() {
                var parentDiv = document.getElementById('all-dates-block');
                var childDivs = parentDiv.getElementsByTagName('button');
                for (var i = 0; i < childDivs.length; i++) {
                    if (childDivs[i].classList.contains('departure-date-active')) {
                        childDivs[i].classList.remove('departure-date-active', 'bg-primary', 'text-white');
                        childDivs[i].classList.add('hover:text-primary', 'bg-white');
                    }
                }
            }
            const trip_departures = <?php echo json_encode($trip_departures ?? [], 15, 512) ?>;
            const trip = <?php echo json_encode($trip, 15, 512) ?>;

            $("#group-departure").on('click', function(event) {
                document.getElementById("private-departure").classList.remove('text-primary', 'border-primary');
                document.getElementById("group-departure").classList.add('text-primary', 'border-primary');
                showGroupDeparture();
                groupDepartureStatus = true;
            });

            $("#private-departure").on('click', function(event) {
                document.getElementById("group-departure").classList.remove('text-primary', 'border-primary');
                document.getElementById("private-departure").classList.add('text-primary', 'border-primary');
                const currentDate = new Date();
                const currentMonthIndex = currentDate.getMonth();
                const currentMonth = currentMonthIndex + 1;
                const currentYear = currentDate.getFullYear();
                showPrivateDeparture(currentMonth, currentYear);
                groupDepartureStatus = false;
            });

            function showGroupDeparture() {
                $('#show-more-departure-button').hide();
                let html = "";
                let filteredDepartures = trip_departures;
                if (filteredDepartures.length > 0) {
                    groupDepartureList = trip_departures;
                    $("#departure-filter-block").html(html);
                    displayMoreGroupDepartureItems(groupDepartureList, 10);
                } else {
                    html = "No departures found.";
                    $("#departure-filter-block").html(html);
                }
            }

            function showPrivateDeparture(month = 1, year) {
                const trip_days = <?php echo json_encode($trip->duration); ?>;
                const dateList = [];
                let next = true;
                const currentDate = new Date();
                const currentMonthIndex = currentDate.getMonth();
                const currentMonth = currentMonthIndex + 1;
                let currentDay = '01';
                if (month == currentMonth) {
                    currentDay = currentDate.getDate().toString().padStart(2, '0');
                }
                let startDate = convertToTimestamp(`${year}-0${month}-${currentDay}`);
                while (next) {
                    const generateDate = getDateRangeForGap(startDate, parseInt(trip_days));
                    dateList.push(generateDate);
                    startDate = getNextDayTimestamp(generateDate.start);
                    if (!isTimestampInMonth(startDate, month)) {
                        next = false;
                    }
                }
                privateDepartureList = dateList;
                let html = "";
                $("#departure-filter-block").html(html);
                displayMorePrivateDepartureItems(privateDepartureList, 10);
            }

            function getAllPrivateDeparture(month = 1, year) {
                const trip_days = <?php echo json_encode($trip->duration); ?>;
                const dateList = [];
                let next = true;
                const currentDate = new Date();
                const currentMonthIndex = currentDate.getMonth();
                const currentMonth = currentMonthIndex + 1;
                let currentDay = '01';
                if (month == currentMonth) {
                    currentDay = currentDate.getDate().toString().padStart(2, '0');
                }
                let startDate = convertToTimestamp(`${year}-0${month}-${currentDay}`);
                while (next) {
                    const generateDate = getDateRangeForGap(startDate, parseInt(trip_days));
                    dateList.push(generateDate);
                    startDate = getNextDayTimestamp(generateDate.start);
                    if (!isTimestampInMonth(startDate, month)) {
                        next = false;
                    }
                }
                return dateList;
            }

            function displayMoreGroupDepartureItems(items, limit) {
                const itemsContainer = document.getElementById('departure-filter-block');
                // Display the first 'limit' items
                for (let i = 0; i < limit && i < items.length; i++) {
                    const item = items[i];
                    let urlroute = `<?php echo e(route('front.trips.departure-booking', ['slug' => 'TRIP_SLUG', 'id' => 'DEPARTURE_ID'])); ?>`;
                    urlroute = urlroute.replace('TRIP_SLUG', trip.slug);
                    urlroute = urlroute.replace('DEPARTURE_ID', item.id);
                    listItem = `<div class="relative grid grid-cols-2 gap-4 px-4 py-3 bg-white border-2 border-gray-100 rounded-lg lg:px-10 lg:grid-cols-5 hover:border-primary">
                            <div class="absolute top-0 px-1 text-xs text-gray-400 bg-white border border-gray-100 rounded-full left-4" style="translate: 0 -50%;">Group</div>
                            <div class="absolute top-0 right-0 w-10 h-10 overflow-hidden rounded">
                                <div class="w-16 px-1 pt-4 text-xs text-center text-white bg-red-600" style="rotate: 45deg; margin-top: -8px">${Math.floor((trip.cost - trip.offer_price)/trip.cost * 100)}%</div>
                            </div>
                            <div>
                                <div class="font-bold">${formatDate(item.from_date)}</div>
                                <div class="text-sm text-gray-500">From ${trip.starting_point}</div>
                            </div>
                            <div>
                                <div class="font-bold">${formatDate(item.to_date)}</div>
                                <div class="text-sm text-gray-500">To ${trip.ending_point}</div>
                            </div>
                            <div>
                                <div class="font-semibold">${item.seats}</div>
                                <div class="text-sm text-gray-500">seats left</div>
                            </div>
                            <div>
                                <div class="text-sm font-semibold">From <span class="text-red-500"><s>US$ ${numberFormatFromString(trip.cost)}</s></span></div>
                                <div class="font-semibold">US$ US$ ${numberFormatFromString(item.price)}</div>
                                <div class="text-sm text-green-600">Saving US$ ${numberFormatFromString(trip.cost - item.price)}</div>
                            </div>
                            <div class="flex items-center">
                                <a href="${urlroute}" class="px-3 py-2 text-sm border rounded border-primary text-primary hover:bg-primary hover:text-white">Book Now</a>
                            </div>
                        </div>`;
                    $(itemsContainer).append(listItem);
                }

                // If there are more items, add a "Show More" button
                if (items.length > limit) {
                    groupDepartureList = groupDepartureList.slice(limit);
                    $('#show-more-departure-button').show();
                } else {
                    $('#show-more-departure-button').hide();
                }
            }

            function displayMorePrivateDepartureItems(items, limit) {
                const itemsContainer = document.getElementById('departure-filter-block');
                // Display the first 'limit' items
                for (let i = 0; i < limit && i < items.length; i++) {
                    const item = items[i];
                    let urlroute = `<?php echo e(route('front.trips.booking', ['slug' => 'TRIP_SLUG', 'date' => 'DEPARTURE_DATE'])); ?>`;
                    urlroute = urlroute.replace('TRIP_SLUG', trip.slug);
                    urlroute = urlroute.replace('DEPARTURE_DATE', item.start);
                    const listItem = `<div class="relative grid grid-cols-2 gap-4 px-4 py-3 bg-white border-2 border-gray-100 rounded-lg lg:px-10 lg:grid-cols-5 hover:border-primary">
                            <div class="absolute top-0 px-1 text-xs text-gray-400 bg-white border border-gray-100 rounded-full left-4" style="translate: 0 -50%;">Private</div>
                            <div class="absolute top-0 right-0 w-10 h-10 overflow-hidden rounded">
                                <div class="w-16 px-1 pt-4 text-xs text-center text-white bg-red-600" style="rotate: 45deg; margin-top: -8px">-${Math.floor((trip.cost - trip.offer_price)/trip.cost * 100)}%</div>
                            </div>
                            <div>
                                <div class="font-bold">${convertToFormattedDate(item.start)}</div>
                                <div class="text-sm text-gray-400">From ${trip.starting_point}</div>
                            </div>
                            <div>
                                <div class="font-bold">${convertToFormattedDate(item.end)}</div>
                                <div class="text-sm text-gray-400">To ${trip.ending_point}</div>
                            </div>
                            <div>
                            </div>
                            <div>
                                <div class="text-sm font-semibold">From <span class="text-red-500"><s>US$ ${numberFormatFromString((trip.offer_price != "") ? trip.cost : '')}</s></span></div>
                                <div class="font-semibold">US$ ${numberFormatFromString((trip.offer_price != "") ? trip.offer_price : trip.cost)}</div>
                                <div class="text-sm text-green-600">${trip.offer_price != "" ? `Saving US$ ${numberFormatFromString(trip.cost - trip.offer_price)}` : ''}</div>
                            </div>
                            <div class="flex items-center">
                                <a href="${urlroute}" class="px-3 py-2 text-sm border rounded border-primary text-primary hover:bg-primary hover:text-white">Book Now</a>
                            </div>
                        </div>`;
                    $(itemsContainer).append(listItem);
                }

                // If there are more items, add a "Show More" button
                if (items.length > limit) {
                    privateDepartureList = privateDepartureList.slice(limit);
                    $('#show-more-departure-button').show();
                } else {
                    $('#show-more-departure-button').hide();
                }
            }

            $("#show-more-departure-button").on('click', function(event) {
                if (groupDepartureStatus) {
                    displayMoreGroupDepartureItems(groupDepartureList, 10); // Display the next set of items
                } else {
                    displayMorePrivateDepartureItems(privateDepartureList, 10); // Display the next set of items
                }
            });

            $("#private-departure").click();

            function isTimestampInMonth(timestamp, targetMonth) {
                const date = new Date(timestamp * 1000);
                const month = date.getMonth() + 1; // Adding 1 to match the input targetMonth (1-based)

                return month === targetMonth;
            }

            function getNextDayTimestamp(timestamp) {
                const currentDate = new Date(timestamp * 1000);
                const nextDate = new Date(currentDate);
                nextDate.setDate(currentDate.getDate() + 1);

                const nextDayTimestamp = Math.floor(nextDate.getTime() / 1000);
                return nextDayTimestamp;
            }

            function convertToTimestamp(dateString) {
                const timestamp = Math.floor(Date.parse(dateString) / 1000);
                return timestamp;
            }

            function convertToFormattedDate(timestamp) {
                const date = new Date(timestamp * 1000); // Convert timestamp to milliseconds
                const options = {
                    day: 'numeric',
                    month: 'short',
                    year: 'numeric'
                };
                return date.toLocaleDateString('en-US', options);
            }

            function getDateRangeForGap(startTimestamp, gap) {
                const startDateObj = new Date(startTimestamp * 1000);
                const endDateObj = new Date(startDateObj.getFullYear(), startDateObj.getMonth(), startDateObj.getDate() + gap - 1);

                const startTimestampResult = Math.floor(startDateObj.getTime() / 1000);
                const endTimestampResult = Math.floor(endDateObj.getTime() / 1000);

                return {
                    start: startTimestampResult,
                    end: endTimestampResult
                };
            }

            $("#all-departure-filter").on('click', function(event) {
                handleFilterDpartureClick();
                $(this).addClass('departure-date-active');
            });

            function handleFilterDpartureClick() {
                filterDepartureByMonth("all");
                removeDateActive();
            }

            handleFilterDpartureClick();

            function filterDepartureByMonth(dateStr) {
                let html = "";

                let filteredDepartures = trip_departures;
                // Get the month from the startTimestamp
                if (groupDepartureStatus) {
                    if (dateStr !== "all") {
                        const startMonth = new Date(dateStr * 1000).getMonth() + 1; // Adding 1 because months are zero-based
                        // Filter the array based on the start date in PHP strtotime format
                        filteredDepartures = trip_departures.filter(departure => {
                            const departureMonth = new Date(departure.from_date.replace(/-/g, '/')).getMonth() + 1; // Adding 1 because months are zero-based
                            return departureMonth === startMonth
                        });
                    }
                    if (filteredDepartures.length > 0) {
                        $.each(filteredDepartures, (i, departure) => {
                            let urlroute = "<?php echo e(route('front.trips.departure-booking', ['slug' => 'TRIP_SLUG', 'id' => 'DEPARTURE_ID'])); ?>";
                            urlroute = urlroute.replace('TRIP_SLUG', trip.slug);
                            urlroute = urlroute.replace('DEPARTURE_ID', departure.id);
                            html += `<div class="relative grid grid-cols-2 gap-4 px-4 py-3 bg-white border-2 border-gray-100 rounded-lg lg:px-10 lg:grid-cols-5 hover:border-primary">
                                <div class="absolute top-0 px-1 text-xs text-gray-400 bg-white border border-gray-100 rounded-full left-4" style="translate: 0 -50%;">Group</div>
                                <div class="absolute top-0 right-0 w-10 h-10 overflow-hidden rounded">
                                    <div class="w-16 px-1 pt-4 text-xs text-center text-white bg-red-600" style="rotate: 45deg; margin-top: -8px">-10%</div>
                                </div>
                                <div>
                                    <div class="font-bold">${formatDate(departure.from_date)}</div>
                                    <div class="text-sm text-gray-400">From ${trip.starting_point}</div>
                                </div>
                                <div>
                                    <div class="font-bold">${formatDate(departure.to_date)}</div>
                                    <div class="text-sm text-gray-400">To ${trip.ending_point}</div>
                                </div>
                                <div>
                                    <div class="font-bold">${departure.seats}</div>
                                    <div class="text-sm text-gray-400">people booked</div>
                                </div>
                                <div>
                                    <div class="font-bold">From <span class="text-red"><s>US $ ${numberFormatFromString(trip.cost)}</s></span></div>
                                    <div class="text-lg font-bold">US$ ${numberFormatFromString(departure.price)}</div>
                                    <div class="text-sm"><span class="text-sm text-green-600">Saving </span>US$ ${numberFormatFromString(trip.cost - departure.price)}</div>
                                </div>
                                <div class="flex items-center">
                                    <a href="${urlroute}" class="px-3 py-2 text-sm border rounded border-primary text-primary hover:bg-primary hover:text-white">Book Now</a>
                                </div>
                            </div>`;
                        })
                    } else {
                        html = "No departures found.";
                    }
                    $("#departure-filter-block").html(html);
                } else {
                    // private
                    if (dateStr !== "all") {
                        const startMonth = new Date(dateStr * 1000).getMonth() + 1;
                        const currentYear = new Date(dateStr * 1000).getFullYear();
                        showPrivateDeparture(startMonth, currentYear);
                    } else {
                        privateDepartureList = [];
                        const currentDate = new Date();
                        let currentMonth = currentDate.getMonth();
                        let currentYear = currentDate.getFullYear();
                        currentMonth = currentMonth + 1;
                        for (let i = 0; i < 24; i++) {
                            let year = currentYear;
                            if (currentMonth > 12) {
                                currentMonth -= 12;
                                year++;
                                currentYear = year;
                            }
                            let dateList = getAllPrivateDeparture(currentMonth, currentYear);
                            privateDepartureList = privateDepartureList.concat(dateList);
                            currentMonth = currentMonth + 1;
                        }
                        let html = "";
                        $("#departure-filter-block").html(html);
                        displayMorePrivateDepartureItems(privateDepartureList, 10);
                    }
                }
            }

            function formatDate(date) {
                return new Date(date.replace(/-/g, '/')).toLocaleDateString('en-GB', {
                    day: '2-digit',
                    month: 'short',
                    year: 'numeric'
                });
            }

            function numberFormatFromString(price) {
                return parseInt(price, 10).toLocaleString();
            }
            var enquiry_validator = $("#enquiry-form").validate({
                ignore: "",
                rules: {
                    'name': 'required',
                    'email': 'required',
                    'country': 'required',
                    'phone': 'required',
                    'message': 'required',
                },
                errorPlacement: function(error, element) {
                    error.insertAfter(element.closest('.flex'));
                    // error.append(element.closest('.form-group'));
                },
                submitHandler: function(form, event) {
                    event.preventDefault();
                    $(form).find('#redirect-url').val('<?php echo route('front.trips.show', $trip->slug); ?>');
                    if (grecaptcha.getResponse(0)) {
                        var btn = $(form).find('button[type=submit]').attr('disabled', true).html('Sending...');
                        setTimeout(() => {
                            form.submit();
                        }, 500);
                    } else {
                        grecaptcha.reset(enquiry_captcha);
                        grecaptcha.execute(enquiry_captcha);
                    }
                },
            });
        });
    </script>
 
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.front_inner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/tlanders/public_html/resources/views/front/trips/show.blade.php ENDPATH**/ ?>
<!DOCTYPE html>
<html lang="en-US" class="<?php echo e(request()->routeIs('front.blogs.show') ? 'scroll-pt-28' : ''); ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo e(Setting::get('homePageSeo')['meta_title'] ?? ''); ?></title>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    
    <meta name="description" content="<?php echo e(Setting::get('homePageSeo')['og_description'] ?? ''); ?>" />
    <meta name="keywords" content="<?php echo e(Setting::get('homePageSeo')['meta_keywords'] ?? ''); ?>" />
    <link rel="canonical" href="<?php echo e(url('/')); ?>" />
    <meta property="og:title" content="<?php echo e(Setting::get('homePageSeo')['og_title'] ?? ''); ?>" />
    <meta property="og:url" content="" />
    <meta property="og:site_name" content="<?php echo $__env->yieldContent('meta_og_site_name', Setting::get('site_name') ?? ''); ?>" />
    <meta property="og:image" content="<?php echo e(Setting::getSiteSettingImage(Setting::get('homePageSeo')['og_image'] ?? null)); ?>" />
    <meta property="og:description" content="<?php echo e(Setting::get('homePageSeo')['og_description'] ?? ''); ?>" />
    <meta property="fb:app_id" content="<?php echo e(Setting::get('site_name')); ?>" />
    <meta property="og:image" content="<?php echo $__env->yieldContent('meta_og_image'); ?>" />
    <meta property="og:description" content="<?php echo $__env->yieldContent('meta_og_description'); ?>" />
    <meta name="IndexType" content="trekking in Nepal" />
    <meta name="language" content="EN-US" />
    <meta name="type" content="Trekking" />
    <meta name="classification" content="<?php echo e(Setting::get('site_name')); ?>" />
    <meta name="company" content="<?php echo e(Setting::get('site_name')); ?>" />
    <meta name="author" content="<?php echo e(Setting::get('site_name')); ?>" />
    <meta name="contact person" content="<?php echo e(Setting::get('site_name')); ?>" />
    <meta name="copyright" content="<?php echo e(Setting::get('site_name')); ?>" />
    <meta name="security" content="public" />
    <meta content="all" name="robots" />
    <meta name="document-type" content="Public" />
    <meta name="category" content="Trekking in Nepal" />
    <meta name="robots" content="all,index" />
    <meta name="googlebot" content="INDEX, FOLLOW" />
    <meta name="YahooSeeker" content="INDEX, FOLLOW" />
    <meta name="msnbot" content="INDEX, FOLLOW" />
    <meta name="allow-search" content="Yes" />
    <meta name="doc-rights" content="<?php echo e(Setting::get('site_name')); ?>" />
    <meta name="doc-publisher" content="<?php echo e(Setting::get('site_name')); ?>" />
    <meta name="p:domain_verify" content="" />
    
    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link rel="preconnect" href="https://code.jquery.com">
    <link rel="preconnect" href="https://www.google.com">
    <link rel="preconnect" href="https://www.googletagmanager.com">
    <link rel="preconnect" href="https://www.gstatic.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo e(asset('/apple-touch-icon.png')); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo e(asset('/favicon-32x32.png')); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(asset('/favicon-16x16.png')); ?>">
    <link rel="manifest" href="<?php echo e(asset('/site.webmanifest')); ?>">

    
    
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/smartmenus@1.1.1/dist/css/sm-core-css.css" as="style">
    <link rel="preload" href="<?php echo e(asset('assets/front/css/tw.css')); ?>" type="text/css" as="style">
    <link rel="preload" href="<?php echo e(asset('assets/front/css/app.css')); ?>" type="text/css" as="style">
    <link rel="preload" href="<?php echo e(asset('assets/front/css/front-style.css')); ?>" type="text/css" as="style">

    <link rel="preload" href="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js" type="text/javascript" as="script">
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/smartmenus@1.1.1/dist/jquery.smartmenus.min.js" type="text/javascript" as="script">
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.12.2/dist/cdn.min.js" type="text/javascript" as="script">
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/alpinejs@3.12.2/dist/cdn.min.js" type="text/javascript" as="script">
    <link rel="preload" href="<?php echo e(asset('assets/vendors/general/toastr/build/toastr.min.js')); ?>" type="text/javascript" as="script">
    <link rel="preload" href="<?php echo e(asset('assets/js/toastr-option.js')); ?>" type="text/javascript" as="script">

    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,700;1,400&family=Exo:wght@700&family=Solitreo&display=swap" rel="stylesheet">

    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/smartmenus@1.1.1/dist/css/sm-core-css.css" type="text/css">

    <link rel="stylesheet" href="<?php echo e(asset('assets/front/css/tw.css')); ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo e(asset('assets/front/css/front-style.css')); ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo e(asset('assets/front/css/app.css')); ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendors/general/toastr/build/toastr.min.css')); ?>" type="text/css">

    <?php echo $__env->yieldPushContent('styles'); ?>

    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebSite",
      "url": "<?php echo e(route('home')); ?>,
      "potentialAction": {
        "@type": "SearchAction",
        "target": {
          "@type": "EntryPoint",
          "urlTemplate": "<?php echo e(route('home')); ?>/search?q={search_term_string}"
        },
        "query-input": "required name=search_term_string"
      }
    }
    </script>
    <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-SNMSC12C7K"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-SNMSC12C7K');
</script>

    <style>
        [x-cloak] {
            display: none;
        }
    </style>
</head>

<body class="font-body">
    <!-- scrollspy for tour-details page -->

    <!-- Header -- Topbar & Navbar-->
    <?php echo $__env->make('front.elements.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    

    <div id="topIO"></div>

    <?php echo $__env->yieldContent('content'); ?>

    <!-- Footer -->
    <?php echo $__env->make('front.elements.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    

    <?php echo $__env->make('front.elements.scroll-to-top', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Scripts -->
    <!-- App.js -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/smartmenus@1.1.1/dist/jquery.smartmenus.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.12.2/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.2/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/perfect-scrollbar@1.5.0/dist/perfect-scrollbar.min.js"></script>
    <script src="<?php echo e(asset('assets/vendors/general/toastr/build/toastr.min.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('assets/js/toastr-option.js')); ?>" type="text/javascript"></script>
    <script>
        // Initialize jQuery Smartmenus
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    var status = jqXHR.status;
                    if (status == 404) {
                        toastr.warning("Element not found.");
                    } else if (status == 422) {
                        toastr.info(jqXHR.responseJSON.message);
                    }
                }
            });
        });
    </script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
    <script>
        const header = document.querySelector('header')
        
        const headerScrollObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    header.classList.remove('scrolled')
                } else {
                    header.classList.add('scrolled')
                }
            })
        }, {
            rootMargin: "40px 0px 0px 0px"
        })
        headerScrollObserver.observe(document.querySelector('#topIO'))
    </script>

    
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/5979e72c0d1bb37f1f7a61c3/1h1gd9jag';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
    
</body>

</html>
<?php /**PATH E:\xampp\htdocs\laravelapps\laravel5\treklander\resources\views/layouts/front.blade.php ENDPATH**/ ?>
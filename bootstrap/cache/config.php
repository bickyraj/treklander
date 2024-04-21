<?php return array (
  'app' => 
  array (
    'name' => 'Trek Landers',
    'env' => 'local',
    'debug' => true,
    'url' => 'http://127.0.0.1',
    'asset_url' => NULL,
    'timezone' => 'UTC',
    'locale' => 'en',
    'fallback_locale' => 'en',
    'faker_locale' => 'en_US',
    'key' => 'base64:N6aOBafB5/gDaYfahqO284NHCa0EDDsIWJFaEs85zUE=',
    'cipher' => 'AES-256-CBC',
    'providers' => 
    array (
      0 => 'Illuminate\\Auth\\AuthServiceProvider',
      1 => 'Illuminate\\Broadcasting\\BroadcastServiceProvider',
      2 => 'Illuminate\\Bus\\BusServiceProvider',
      3 => 'Illuminate\\Cache\\CacheServiceProvider',
      4 => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
      5 => 'Illuminate\\Cookie\\CookieServiceProvider',
      6 => 'Illuminate\\Database\\DatabaseServiceProvider',
      7 => 'Illuminate\\Encryption\\EncryptionServiceProvider',
      8 => 'Illuminate\\Filesystem\\FilesystemServiceProvider',
      9 => 'Illuminate\\Foundation\\Providers\\FoundationServiceProvider',
      10 => 'Illuminate\\Hashing\\HashServiceProvider',
      11 => 'Illuminate\\Mail\\MailServiceProvider',
      12 => 'Illuminate\\Notifications\\NotificationServiceProvider',
      13 => 'Illuminate\\Pagination\\PaginationServiceProvider',
      14 => 'Illuminate\\Pipeline\\PipelineServiceProvider',
      15 => 'Illuminate\\Queue\\QueueServiceProvider',
      16 => 'Illuminate\\Redis\\RedisServiceProvider',
      17 => 'Illuminate\\Auth\\Passwords\\PasswordResetServiceProvider',
      18 => 'Illuminate\\Session\\SessionServiceProvider',
      19 => 'Illuminate\\Translation\\TranslationServiceProvider',
      20 => 'Illuminate\\Validation\\ValidationServiceProvider',
      21 => 'Illuminate\\View\\ViewServiceProvider',
      22 => 'Intervention\\Image\\ImageServiceProvider',
      23 => 'Maatwebsite\\Excel\\ExcelServiceProvider',
      24 => 'Barryvdh\\DomPDF\\ServiceProvider',
      25 => 'Bickyraj\\Hbl\\HblServiceProvider',
      26 => 'App\\Providers\\AppServiceProvider',
      27 => 'App\\Providers\\AuthServiceProvider',
      28 => 'App\\Providers\\EventServiceProvider',
      29 => 'App\\Providers\\RouteServiceProvider',
      30 => 'App\\Providers\\ComposerServiceProvider',
      31 => 'App\\Providers\\SettingServiceProvider',
    ),
    'aliases' => 
    array (
      'App' => 'Illuminate\\Support\\Facades\\App',
      'Arr' => 'Illuminate\\Support\\Arr',
      'Artisan' => 'Illuminate\\Support\\Facades\\Artisan',
      'Auth' => 'Illuminate\\Support\\Facades\\Auth',
      'Blade' => 'Illuminate\\Support\\Facades\\Blade',
      'Broadcast' => 'Illuminate\\Support\\Facades\\Broadcast',
      'Bus' => 'Illuminate\\Support\\Facades\\Bus',
      'Cache' => 'Illuminate\\Support\\Facades\\Cache',
      'Config' => 'Illuminate\\Support\\Facades\\Config',
      'Cookie' => 'Illuminate\\Support\\Facades\\Cookie',
      'Crypt' => 'Illuminate\\Support\\Facades\\Crypt',
      'DB' => 'Illuminate\\Support\\Facades\\DB',
      'Eloquent' => 'Illuminate\\Database\\Eloquent\\Model',
      'Event' => 'Illuminate\\Support\\Facades\\Event',
      'File' => 'Illuminate\\Support\\Facades\\File',
      'Gate' => 'Illuminate\\Support\\Facades\\Gate',
      'Hash' => 'Illuminate\\Support\\Facades\\Hash',
      'Lang' => 'Illuminate\\Support\\Facades\\Lang',
      'Log' => 'Illuminate\\Support\\Facades\\Log',
      'Mail' => 'Illuminate\\Support\\Facades\\Mail',
      'Notification' => 'Illuminate\\Support\\Facades\\Notification',
      'Password' => 'Illuminate\\Support\\Facades\\Password',
      'Queue' => 'Illuminate\\Support\\Facades\\Queue',
      'Redirect' => 'Illuminate\\Support\\Facades\\Redirect',
      'Redis' => 'Illuminate\\Support\\Facades\\Redis',
      'Request' => 'Illuminate\\Support\\Facades\\Request',
      'Response' => 'Illuminate\\Support\\Facades\\Response',
      'Route' => 'Illuminate\\Support\\Facades\\Route',
      'Schema' => 'Illuminate\\Support\\Facades\\Schema',
      'Session' => 'Illuminate\\Support\\Facades\\Session',
      'Storage' => 'Illuminate\\Support\\Facades\\Storage',
      'Str' => 'Illuminate\\Support\\Str',
      'URL' => 'Illuminate\\Support\\Facades\\URL',
      'Validator' => 'Illuminate\\Support\\Facades\\Validator',
      'View' => 'Illuminate\\Support\\Facades\\View',
      'Image' => 'Intervention\\Image\\Facades\\Image',
      'Setting' => 'App\\Helpers\\Setting',
      'Excel' => 'Maatwebsite\\Excel\\Facades\\Excel',
      'PDF' => 'Barryvdh\\DomPDF\\Facade',
    ),
  ),
  'auth' => 
  array (
    'defaults' => 
    array (
      'guard' => 'web',
      'passwords' => 'users',
    ),
    'guards' => 
    array (
      'web' => 
      array (
        'driver' => 'session',
        'provider' => 'users',
      ),
      'api' => 
      array (
        'driver' => 'token',
        'provider' => 'users',
        'hash' => false,
      ),
    ),
    'providers' => 
    array (
      'users' => 
      array (
        'driver' => 'eloquent',
        'model' => 'App\\User',
      ),
    ),
    'passwords' => 
    array (
      'users' => 
      array (
        'provider' => 'users',
        'table' => 'password_resets',
        'expire' => 60,
        'throttle' => 60,
      ),
    ),
    'password_timeout' => 10800,
  ),
  'broadcasting' => 
  array (
    'default' => 'log',
    'connections' => 
    array (
      'pusher' => 
      array (
        'driver' => 'pusher',
        'key' => '',
        'secret' => '',
        'app_id' => '',
        'options' => 
        array (
          'cluster' => 'mt1',
          'useTLS' => true,
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
      ),
      'log' => 
      array (
        'driver' => 'log',
      ),
      'null' => 
      array (
        'driver' => 'null',
      ),
    ),
  ),
  'cache' => 
  array (
    'default' => 'file',
    'stores' => 
    array (
      'apc' => 
      array (
        'driver' => 'apc',
      ),
      'array' => 
      array (
        'driver' => 'array',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'cache',
        'connection' => NULL,
      ),
      'file' => 
      array (
        'driver' => 'file',
        'path' => 'E:\\xampp\\htdocs\\laravelapps\\laravel5\\treklander\\storage\\framework/cache/data',
      ),
      'memcached' => 
      array (
        'driver' => 'memcached',
        'persistent_id' => NULL,
        'sasl' => 
        array (
          0 => NULL,
          1 => NULL,
        ),
        'options' => 
        array (
        ),
        'servers' => 
        array (
          0 => 
          array (
            'host' => '127.0.0.1',
            'port' => 11211,
            'weight' => 100,
          ),
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'cache',
      ),
      'dynamodb' => 
      array (
        'driver' => 'dynamodb',
        'key' => '',
        'secret' => '',
        'region' => 'us-east-1',
        'table' => 'cache',
        'endpoint' => NULL,
      ),
    ),
    'prefix' => 'trek_landers_cache',
  ),
  'constants' => 
  array (
    'default_image_url' => '/img/default-sm.gif',
    'default_large_image_url' => '/img/default.gif',
    'default_hero_banner' => '/img/hero.jpg',
    'google_recaptcha' => '6Lc12L4UAAAAAIfI7dV4SxDrX1ZrmtZMjbe9YjVw',
    'recaptcha' => 
    array (
      'sitekey' => '6Lc12L4UAAAAAIfI7dV4SxDrX1ZrmtZMjbe9YjVw',
      'secret' => '6Lc12L4UAAAAAAERNEm9ChpTh0MVKZArWh-9RF4Z',
    ),
  ),
  'database' => 
  array (
    'default' => 'mysql',
    'connections' => 
    array (
      'sqlite' => 
      array (
        'driver' => 'sqlite',
        'url' => NULL,
        'database' => 'laravel_treklander',
        'prefix' => '',
        'foreign_key_constraints' => true,
      ),
      'mysql' => 
      array (
        'driver' => 'mysql',
        'url' => NULL,
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'laravel_treklander',
        'username' => 'root',
        'password' => '',
        'unix_socket' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'prefix_indexes' => true,
        'strict' => true,
        'engine' => NULL,
        'options' => 
        array (
        ),
      ),
      'pgsql' => 
      array (
        'driver' => 'pgsql',
        'url' => NULL,
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'laravel_treklander',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        'prefix' => '',
        'prefix_indexes' => true,
        'schema' => 'public',
        'sslmode' => 'prefer',
      ),
      'sqlsrv' => 
      array (
        'driver' => 'sqlsrv',
        'url' => NULL,
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'laravel_treklander',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        'prefix' => '',
        'prefix_indexes' => true,
      ),
    ),
    'migrations' => 'migrations',
    'redis' => 
    array (
      'client' => 'phpredis',
      'options' => 
      array (
        'cluster' => 'redis',
        'prefix' => 'trek_landers_database_',
      ),
      'default' => 
      array (
        'url' => NULL,
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => '6379',
        'database' => 0,
      ),
      'cache' => 
      array (
        'url' => NULL,
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => '6379',
        'database' => 1,
      ),
    ),
  ),
  'dompdf' => 
  array (
    'show_warnings' => false,
    'orientation' => 'portrait',
    'defines' => 
    array (
      'font_dir' => 'E:\\xampp\\htdocs\\laravelapps\\laravel5\\treklander\\storage\\fonts/',
      'font_cache' => 'E:\\xampp\\htdocs\\laravelapps\\laravel5\\treklander\\storage\\fonts/',
      'temp_dir' => 'C:\\Users\\bicky\\AppData\\Local\\Temp',
      'chroot' => 'E:\\xampp\\htdocs\\laravelapps\\laravel5\\treklander',
      'enable_font_subsetting' => false,
      'pdf_backend' => 'CPDF',
      'default_media_type' => 'screen',
      'default_paper_size' => 'a4',
      'default_font' => 'serif',
      'dpi' => 96,
      'enable_php' => false,
      'enable_javascript' => true,
      'enable_remote' => true,
      'font_height_ratio' => 1.1,
      'enable_html5_parser' => false,
    ),
  ),
  'filesystems' => 
  array (
    'default' => 'local',
    'cloud' => 's3',
    'disks' => 
    array (
      'local' => 
      array (
        'driver' => 'local',
        'root' => 'E:\\xampp\\htdocs\\laravelapps\\laravel5\\treklander\\storage\\app',
      ),
      'public' => 
      array (
        'driver' => 'local',
        'root' => 'E:\\xampp\\htdocs\\laravelapps\\laravel5\\treklander\\storage\\app/public',
        'url' => 'http://127.0.0.1/storage',
        'visibility' => 'public',
      ),
      's3' => 
      array (
        'driver' => 's3',
        'key' => '',
        'secret' => '',
        'region' => 'us-east-1',
        'bucket' => '',
        'url' => NULL,
      ),
    ),
  ),
  'hashing' => 
  array (
    'driver' => 'bcrypt',
    'bcrypt' => 
    array (
      'rounds' => 10,
    ),
    'argon' => 
    array (
      'memory' => 1024,
      'threads' => 2,
      'time' => 2,
    ),
  ),
  'hbl' => 
  array (
    'OfficeId' => '9104236864',
    'EndPoint' => 'https://core.paco.2c2p.com/',
    'EncryptionKeyId' => '19f84b5655f04e25a99b09f1ee2fac78',
    'AccessToken' => '9f004c69909541bbaeff506191fa662d',
    'TokenType' => 'JWT',
    'JWSAlgorithm' => 'PS256',
    'JWEAlgorithm' => 'RSA-OAEP',
    'JWEEncrptionAlgorithm' => 'A128CBC-HS256',
    'MerchantSigningPrivateKey' => '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',
    'PacoEncryptionPublicKey' => 'MIICIjANBgkqhkiG9w0BAQEFAAOCAg8AMIICCgKCAgEA6ZLups2K0iYEMxQqgASX8gY6tWhNVCp08YuDgjCsOVrGVgUHD0dh0TWFNJ7Lq2Jp0SOsGgi54+hrjwPOL2CCZxw8pKUlL57UksoD9oWUrK/KkSvEAwPU4cZqzxIXyhBcZb8O96iN4WQJILkRTg+DXLkML6qisO496fPGIs+vCoc87toucy5O9fRfaYSjcqjreyi8JDkvVJM/BeNtOEM2a0b/lcWa67RH+tN97H25k+Qez7QthLru6oBfWBgD6iIwhV+ICqLWHmp6fQ+DHQk/o+OO3yFiY9OAvMiy8MOTinvkBlFwYgYNznG3/w0Xh8U5vtudUXPDNUO6ddf4y99+6LlWDiKgJn/Th93YUg+gFH4LUJHyPrSY2JuC+Q8kksp2xyiZDTHGzi96kturwrqCui6TytCHcU4UB0VRMR+M7VRl3S2YPhcxv5U8Fh2PITqydZE5vv1Va06qhegjOlSZnEUl2xKPm5k/u+UHvUP/oq04fQLTlYqyA3JYDCe4z5Ea2SOgjeVl+qTatWYzmkUXyCONLZ4UaRrgbYCp0nCPHoTFgRQdChu8ezDbnYY9IW7cT/s2fEi5N7X1XrQttiEP4rbn0y0qVYYjN86+elfhtYGHidZTUSUS5RSTHqOkj59p5LIGwFF9iTXzCjfUqq8clnfOk76qSLY1+Kj+SMMe6Z8CAwEAAQ==',
    'PacoSigningPublicKey' => 'MIICIjANBgkqhkiG9w0BAQEFAAOCAg8AMIICCgKCAgEAr0XW6QacR8GilY4nZrJZW40wnFeYu7h9aXUSqxCP6djurCWZmLqnrsYWP7/HR8WOulYPHTVpfqJesTOdVqPgY6p10H811oRbJG9jvsG8j8kn/Bk8b2wZ9qelNqdNJMDbR5WUyaytaDWW6QdI4+clqjFfwCOw76noDSe+R4pDSzgMiyCk5R4m2ECT1fv/4Axz2bvLN+DRTg5DPPIMLWpA87lgjxeaDlGyJqZCbkJozW7JX0AJVc0X7YR9kzbiTi3LVOInSKY+VHT8yCARIdvXtKc6+IWSbVQqgpNIBB8GN0OvU8xedjPNCMGZnnMtgd7XLTf/okyadbdNLAqQLTbDs/5HnIVx8FyfgiOS/zsim5ivi3ljVAW3T3ePGjkY0q1DMzr5iJ4m/WTL2d1TArlfHyQhkSpFpQPOO+pJyVQqttHJo99vMirQogdSx4lIu//aod0yJyJLpjCeiqb2Fz3Qk0AZ4S78QKeeGsxTRchTP6Wsb6okaZd+cFi6z8qbP0z/Y3xRZO7vOLB/whkqS+pMVKBQ42YzgQPRzbXXmgCkf1nCqgrD9bnIB5ovdRGfDXW86GKY8XwGVjb4BoMvql+HsbonKHAO+eGfQulpB5YfQGQU3ZXdMdfCLAk8FuqemH4k7S7diLzVvRCuisHsEx6qJ4ewxzNCvW7OGVinTR9NSQUCAwEAAQ==',
    'MerchantDecryptionPrivateKey' => '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',
    'InputCurrencty' => 'USD',
    'Input3DS' => 'Y',
  ),
  'image' => 
  array (
    'driver' => 'gd',
  ),
  'logging' => 
  array (
    'default' => 'stack',
    'channels' => 
    array (
      'stack' => 
      array (
        'driver' => 'stack',
        'channels' => 
        array (
          0 => 'daily',
        ),
        'ignore_exceptions' => false,
      ),
      'single' => 
      array (
        'driver' => 'single',
        'path' => 'E:\\xampp\\htdocs\\laravelapps\\laravel5\\treklander\\storage\\logs/laravel.log',
        'level' => 'debug',
      ),
      'daily' => 
      array (
        'driver' => 'daily',
        'path' => 'E:\\xampp\\htdocs\\laravelapps\\laravel5\\treklander\\storage\\logs/laravel.log',
        'level' => 'debug',
        'days' => 14,
      ),
      'slack' => 
      array (
        'driver' => 'slack',
        'url' => NULL,
        'username' => 'Laravel Log',
        'emoji' => ':boom:',
        'level' => 'critical',
      ),
      'papertrail' => 
      array (
        'driver' => 'monolog',
        'level' => 'debug',
        'handler' => 'Monolog\\Handler\\SyslogUdpHandler',
        'handler_with' => 
        array (
          'host' => NULL,
          'port' => NULL,
        ),
      ),
      'stderr' => 
      array (
        'driver' => 'monolog',
        'handler' => 'Monolog\\Handler\\StreamHandler',
        'formatter' => NULL,
        'with' => 
        array (
          'stream' => 'php://stderr',
        ),
      ),
      'syslog' => 
      array (
        'driver' => 'syslog',
        'level' => 'debug',
      ),
      'errorlog' => 
      array (
        'driver' => 'errorlog',
        'level' => 'debug',
      ),
      'null' => 
      array (
        'driver' => 'monolog',
        'handler' => 'Monolog\\Handler\\NullHandler',
      ),
    ),
  ),
  'mail' => 
  array (
    'driver' => 'sendmail',
    'host' => 'localhost',
    'port' => '2525',
    'from' => 
    array (
      'address' => 'hello@example.com',
      'name' => 'Example',
    ),
    'encryption' => NULL,
    'username' => NULL,
    'password' => NULL,
    'sendmail' => '/usr/sbin/sendmail -bs',
    'markdown' => 
    array (
      'theme' => 'default',
      'paths' => 
      array (
        0 => 'E:\\xampp\\htdocs\\laravelapps\\laravel5\\treklander\\resources\\views/vendor/mail',
      ),
    ),
    'log_channel' => NULL,
  ),
  'queue' => 
  array (
    'default' => 'sync',
    'connections' => 
    array (
      'sync' => 
      array (
        'driver' => 'sync',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'jobs',
        'queue' => 'default',
        'retry_after' => 90,
      ),
      'beanstalkd' => 
      array (
        'driver' => 'beanstalkd',
        'host' => 'localhost',
        'queue' => 'default',
        'retry_after' => 90,
        'block_for' => 0,
      ),
      'sqs' => 
      array (
        'driver' => 'sqs',
        'key' => '',
        'secret' => '',
        'prefix' => 'https://sqs.us-east-1.amazonaws.com/your-account-id',
        'queue' => 'your-queue-name',
        'region' => 'us-east-1',
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
        'queue' => 'default',
        'retry_after' => 90,
        'block_for' => NULL,
      ),
    ),
    'failed' => 
    array (
      'driver' => 'database',
      'database' => 'mysql',
      'table' => 'failed_jobs',
    ),
  ),
  'services' => 
  array (
    'mailgun' => 
    array (
      'domain' => NULL,
      'secret' => NULL,
      'endpoint' => 'api.mailgun.net',
    ),
    'postmark' => 
    array (
      'token' => NULL,
    ),
    'ses' => 
    array (
      'key' => '',
      'secret' => '',
      'region' => 'us-east-1',
    ),
  ),
  'session' => 
  array (
    'driver' => 'file',
    'lifetime' => '120',
    'expire_on_close' => false,
    'encrypt' => false,
    'files' => 'E:\\xampp\\htdocs\\laravelapps\\laravel5\\treklander\\storage\\framework/sessions',
    'connection' => NULL,
    'table' => 'sessions',
    'store' => NULL,
    'lottery' => 
    array (
      0 => 2,
      1 => 100,
    ),
    'cookie' => 'trek_landers_session',
    'path' => '/',
    'domain' => NULL,
    'secure' => false,
    'http_only' => true,
    'same_site' => NULL,
  ),
  'view' => 
  array (
    'paths' => 
    array (
      0 => 'E:\\xampp\\htdocs\\laravelapps\\laravel5\\treklander\\resources\\views',
    ),
    'compiled' => 'E:\\xampp\\htdocs\\laravelapps\\laravel5\\treklander\\storage\\framework\\views',
  ),
  'flare' => 
  array (
    'key' => NULL,
    'reporting' => 
    array (
      'anonymize_ips' => true,
      'collect_git_information' => true,
      'report_queries' => true,
      'maximum_number_of_collected_queries' => 200,
      'report_query_bindings' => true,
      'report_view_data' => true,
      'grouping_type' => NULL,
    ),
    'send_logs_as_events' => true,
  ),
  'ignition' => 
  array (
    'editor' => 'phpstorm',
    'theme' => 'light',
    'enable_share_button' => true,
    'register_commands' => false,
    'ignored_solution_providers' => 
    array (
      0 => 'Facade\\Ignition\\SolutionProviders\\MissingPackageSolutionProvider',
    ),
    'enable_runnable_solutions' => NULL,
    'remote_sites_path' => '',
    'local_sites_path' => '',
    'housekeeping_endpoint_prefix' => '_ignition',
  ),
  'excel' => 
  array (
    'exports' => 
    array (
      'chunk_size' => 1000,
      'pre_calculate_formulas' => false,
      'strict_null_comparison' => false,
      'csv' => 
      array (
        'delimiter' => ',',
        'enclosure' => '"',
        'line_ending' => '
',
        'use_bom' => false,
        'include_separator_line' => false,
        'excel_compatibility' => false,
        'output_encoding' => '',
        'test_auto_detect' => true,
      ),
      'properties' => 
      array (
        'creator' => '',
        'lastModifiedBy' => '',
        'title' => '',
        'description' => '',
        'subject' => '',
        'keywords' => '',
        'category' => '',
        'manager' => '',
        'company' => '',
      ),
    ),
    'imports' => 
    array (
      'read_only' => true,
      'ignore_empty' => false,
      'heading_row' => 
      array (
        'formatter' => 'slug',
      ),
      'csv' => 
      array (
        'delimiter' => NULL,
        'enclosure' => '"',
        'escape_character' => '\\',
        'contiguous' => false,
        'input_encoding' => 'UTF-8',
      ),
      'properties' => 
      array (
        'creator' => '',
        'lastModifiedBy' => '',
        'title' => '',
        'description' => '',
        'subject' => '',
        'keywords' => '',
        'category' => '',
        'manager' => '',
        'company' => '',
      ),
    ),
    'extension_detector' => 
    array (
      'xlsx' => 'Xlsx',
      'xlsm' => 'Xlsx',
      'xltx' => 'Xlsx',
      'xltm' => 'Xlsx',
      'xls' => 'Xls',
      'xlt' => 'Xls',
      'ods' => 'Ods',
      'ots' => 'Ods',
      'slk' => 'Slk',
      'xml' => 'Xml',
      'gnumeric' => 'Gnumeric',
      'htm' => 'Html',
      'html' => 'Html',
      'csv' => 'Csv',
      'tsv' => 'Csv',
      'pdf' => 'Dompdf',
    ),
    'value_binder' => 
    array (
      'default' => 'Maatwebsite\\Excel\\DefaultValueBinder',
    ),
    'cache' => 
    array (
      'driver' => 'memory',
      'batch' => 
      array (
        'memory_limit' => 60000,
      ),
      'illuminate' => 
      array (
        'store' => NULL,
      ),
    ),
    'transactions' => 
    array (
      'handler' => 'db',
      'db' => 
      array (
        'connection' => NULL,
      ),
    ),
    'temporary_files' => 
    array (
      'local_path' => 'E:\\xampp\\htdocs\\laravelapps\\laravel5\\treklander\\storage\\framework/cache/laravel-excel',
      'remote_disk' => NULL,
      'remote_prefix' => NULL,
      'force_resync_remote' => NULL,
    ),
  ),
  'trustedproxy' => 
  array (
    'proxies' => NULL,
    'headers' => 30,
  ),
  'tinker' => 
  array (
    'commands' => 
    array (
    ),
    'dont_alias' => 
    array (
      0 => 'App\\Nova',
    ),
  ),
);

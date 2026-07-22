<?php
return [
    'name' => 'HànNgữ - Học tiếng Trung',
    'url' => 'http://localhost/do-an-tot-nghiep',
    'env' => 'development',
    'debug' => true,
    'timezone' => 'Asia/Ho_Chi_Minh',
    'locale' => 'vi',
    'charset' => 'utf8mb4',

    'session' => [
        'lifetime' => 86400 * 30,
        'name' => 'PHPSESSID',
        'path' => '/',
        'domain' => '',
        'secure' => false,
        'httponly' => true,
        'samesite' => 'Lax',
    ],

    'pagination' => [
        'per_page' => 20,
    ],

    'upload' => [
        'max_size' => 10 * 1024 * 1024,
        'allowed_extensions' => ['jpg','jpeg','png','gif','mp3','wav','ogg','mp4','svg','pdf','doc','docx'],
        'path' => __DIR__ . '/../storage/uploads',
    ],

    'mail' => [
        'driver' => 'smtp',
        'host' => getenv('SMTP_HOST') ?: '',
        'port' => (int) (getenv('SMTP_PORT') ?: 587),
        'username' => getenv('SMTP_USER') ?: '',
        'password' => getenv('SMTP_PASS') ?: '',
        'encryption' => getenv('SMTP_ENCRYPTION') ?: 'tls',
        'from_address' => getenv('SMTP_FROM') ?: 'noreply@hanngu.local',
        'from_name' => getenv('SMTP_FROM_NAME') ?: 'HànNgữ',
    ],

    'auth' => [
        'password_min_length' => 6,
        'rate_limit' => [
            'max_attempts' => 5,
            'decay_minutes' => 10,
        ],
        'remember_lifetime' => 86400 * 30,
    ],

    'cache' => [
        'driver' => 'file',
        'path' => __DIR__ . '/../storage/cache',
        'lifetime' => 3600,
    ],

    'view' => [
        'paths' => [
            __DIR__ . '/../app/Views',
        ],
        'layout' => 'main',
    ],

    'providers' => [
        App\Helpers\Database::class,
        App\Helpers\Session::class,
        App\Helpers\View::class,
        App\Auth\Auth::class,
        App\Router::class,
    ],
];

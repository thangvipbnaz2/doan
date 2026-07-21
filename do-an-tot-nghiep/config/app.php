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
    ],

    'pagination' => [
        'per_page' => 20,
    ],

    'upload' => [
        'max_size' => 10 * 1024 * 1024,
        'allowed_extensions' => ['jpg','jpeg','png','gif','mp3','wav','ogg','mp4','svg'],
        'path' => __DIR__ . '/../storage/uploads',
    ],
];

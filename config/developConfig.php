<?php
//develop环境的常用配置
define('PROJECT_VERSION', rand());
return [
    'app_debug'=>true,
    'queue'=>[
        'connector'=>'database',
        'dsn'=>'mysql://root:root@127.0.0.1:3306/shop#utf8',
        'table'=>'sp_jobs'
    ],
    //'api_host'=>'https://mprogram.jetsum.com/api.php/',
        'api_host'=>'https://yhgc555.vip/api.php/',
    
//     'program' => [
//         'appid' => 'wx6db09e3ffd69d504',
//         'appkey' => '12db39f354789a658e9674d95ad0ac4c',
//         'payid' => '1471175702',
//         'paykey' => 'bUxJeoC3Zfrns9FyDQGGNakH1SiFuhZ4'
//     ],
];
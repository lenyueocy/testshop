<?php
//product环境的常用配置
define('PROJECT_VERSION', 'V1.0.1');
return [
    'app_debug'=>true,
    'queue'=>[
        'connector'=>'database',
        'dsn'=>'mysql://root:root@127.0.0.1:3306/shop#utf8',
        'table'=>'sp_jobs'
    ],
    //'api_host'=>'https://mprogram.jetsum.com/api.php/',
     'api_host'=>'https://yhgc555.vip/api.php/',
];
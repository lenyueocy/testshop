<?php
/**
* 这里会根据不同的环境加载不同的配置
* 所以evn.php一定要设置对
*/


$config = [
    //'app_debug'              => true,
    // 应用Trace
   // 'app_trace'              => true,
    'web_host'=>'https://yhgc555.vip',
    //'web_host'=>'https://mprogram.jetsum.com',
    'session' => [
        'id' => '',
        'var_session_id' => '',
        'prefix' => '',
        'type' => '',
        'auto_start' => true
    ],
    
    'template' => [
        'view_base' => ROOT_PATH . 'template' . DS
    ],
    
    'log' => [
        'type' => 'File',
        'level' => [
            'error'
        ]
    ],
    // Cookie设置
    'cookie' => [
        'prefix' => '',
        'expire' => 0,
        'path' => '/',
        'domain' => '',
        'secure' => false,
        'httponly' => '',
        'setcookie' => true
    ],
    
    'cache' => [
        'type' => 'File',
        'path' => CACHE_PATH,
        'prefix' => '',
        'expire' => 0,
        'cache_subdir' => false
    ],
    
    'app_namespace' => 'app',
    
    'qiniu' => [
        'domain' => '七牛域名',
        'bucket' => '七牛存储空间名',
        'ak' => '七牛ak',
        'sk' => '七牛sk'
    ],
    
    // 当图片不存在时默认显示的图片
    'resourceDefault' => '/not_find.png',
    
    'program' => [
        'appid' => 'wx6912b2471c1cf37c',//'wx0301503f4ae3459a',
        'appkey' => '802b09c743cbdc9534f1c3e198551e76',//'ed5047c9315c8a93d4893a9a25ab7d58',
        'payid' => '1519829481',
        'paykey' => '802b09c743cbdc9534f1c3e198551888'
    ],
];

$evn = require realpath(ROOT_PATH) . '/evn.php';
$evnConfig = require realpath(ROOT_PATH) . "/config/{$evn}Config.php";
return array_merge($config, $evnConfig);

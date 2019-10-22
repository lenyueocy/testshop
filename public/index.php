<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
//--
// [ 应用入口文件 ]
define('CONF_PATH', __DIR__.'/../config/');

//绑定模块
define('BIND_MODULE','index');

define('TEMP_PATH', __DIR__.'/../runtime/index/temp/');
define('LOG_PATH', __DIR__.'/../runtime/index/log/');

// 定义应用目录
define('APP_PATH', __DIR__ . '/../application/');
define('TEMPLATE_PATH',  __DIR__ . '/../template/');

// 加载框架引导文件
require __DIR__ . '/../thinkphp/start.php';

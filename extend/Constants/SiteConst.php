<?php
namespace Constants;

class SiteConst
{    
    const ADMIN_SITE_TITLE = '商城后台系统';
    
    //常用的
    const YES_VALUE = 1;
    const NO_VALUE = 2;
    
    const STATUS_NORMAL = 1;
    const STATUS_DISABLED = 2;
    
    const ANDROID = 1;
    const IOS = 2;
    const MP = 3;
    const WAP = 4;
    const WEB = 5;
    const GAME = 6;
    const PROGRAM = 7;
    
    //系统配置缓存key
    const CACHE_SYSTEM_CONFIG = 'system_config';
    
    //数据版本缓存key
    const CACHE_DATA_VERSION = 'data_version';
    
    const DEFAULT_VERSION = 'v1.0.0';
    
    const API_TIME_OUT = 600;
    
    const BOX_RESERVE_TIMEOUT = 900;
    
    const USER_TYPE_USER = 1;
    const USER_TYPE_PARCHSE = 2;
    
    const GOODS_STATUS_DOWN = 1;
    const GOODS_STATUS_UP = 2;
    
    const IMAGE_ATLAS = 'atlas';
    const IMAGE_SINGLE = 'single';
    
    const INCOME_ORDER_SCALE = 0.1;
    //取消订单任务时长
    const ORDER_TIMEOUT = 1800;
    
    const ORDER_STATUS_CANCEL = -1;
    const ORDER_STATUS_PEDDING = 1;
    const ORDER_STATUS_PAY = 2;
    const ORDER_STATUS_SEND = 3;
    const ORDER_STATUS_RECIEVE = 4;
    const ORDER_STATUS_COMMENT = 5;

    const USER_ACCOUNT_TYPE_INCOME = 1;
    const USER_ACCOUNT_TYPE_BILL= 2;
    
}
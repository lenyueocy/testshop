<?php
return [
    // 应用ID
    'appid' => config('program.appid'),
    // 商户号
    'mch_id' => config('program.payid'),
    // 商户秘钥
    'mch_key' => config('program.paykey'),
    // 通知地址
    'notify_url' => config('api_host') . 'notify/goods',
    // 商品描述
    'body' => '商品购买',
    // 终端IP 1
    'spbill_create_ip' => $_SERVER['REMOTE_ADDR'],
    // 用户标识 1|2
    'openid' => '',
    // 商户订单号 1
    'out_trade_no'=>'',
    // 标价金额 1
    'total_fee'=>'',
];
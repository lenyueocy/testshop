<?php
namespace Logic\Pay\Wechat;

use Logic\Pay\WechatPay;
use Common\Functions;
class MiniApp extends WechatPay
{
    public function __construct(){
        $this->trade_type = 'JSAPI';
    }
    
    protected function payReturn($prePayId) {
        $return = [
            'appId' => $this->config['appid'],
            'timeStamp' => time()."",
            'nonceStr' => Functions::randStr(32,''),
            'package' => 'prepay_id='.$prePayId,
            'signType' => 'MD5',
        ];
        $return['paySign'] = $this->getSign($return);
        return ['pay'=>$return,'payno'=>$prePayId];
    }
}
<?php
namespace app\api\controller;

use think\Exception;
use Common\Error;
use WeixinSdk\Weixin;

class Wechat extends Common
{
    public function wxconfig()
    {
        try {
            $this->protectNumber = true;
            $data = Weixin::init()->wxConfigSign(
                $this->EN('url')
            );
        } catch (Exception $e) {
            return $this->apiError(Error::backMsg($e->getCode()));
        }
        return $this->apiSuccess($data);
    }
}
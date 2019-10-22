<?php
namespace app\api\controller;

use think\Exception;
use Logic\ContentLogic;
class Content extends Common
{
    public function swiper() {
        try {
            $data = ContentLogic::swiper();
        } catch (Exception $e) {
            return $this->apiError($e->getCode());
        }
        return $this->apiSuccess($data);
    }
}
<?php
namespace app\api\controller;

use think\Exception;
use Logic\PayLogic;
class Payment extends Common
{
    public function goods() {
        try {
            $this->load(['orderid'=>['intval',0]]);
            $data = PayLogic::goodsPay();
        } catch (Exception $e) {
            return $this->apiError($e->getCode());
        }
        return $this->apiSuccess($data);
    }
}
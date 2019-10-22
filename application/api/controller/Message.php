<?php
namespace app\api\controller;

use think\Exception;
use Logic\MessageLogic;
class Message extends Common
{
    public function notice() {
        try {
            $data = MessageLogic::listMessage();
        } catch (Exception $e) {
            return $this->apiError($e->getCode());
        }
        return $this->apiSuccess($data);
    }
    
    public function read() {
        try {
            $this->load(['msgid'=>['intval',0]]);
            $data = MessageLogic::readMessage();
        } catch (Exception $e) {
            return $this->apiError($e->getCode());
        }
        return $this->apiSuccess($data);
    }
}
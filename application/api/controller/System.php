<?php
namespace app\api\controller;

use think\Exception;
use Logic\Device\ZhongjiTask;
use Logic\QrfireRequest;
use Logic\CommonLogic;
class System extends Common
{
    protected $beforeUri = [];
    
    public function getbasic()
    {
        try {
            $data = CommonLogic::getConfig('system');
            $data['shareImage']='https://'.$_SERVER['HTTP_HOST'].$data['shareImage'];
        } catch (Exception $e) {
            return $this->apiError($e->getCode());
        }
        return $this->apiSuccess($data);
    }
    //72 75
    public function del() {
        $arr = [2,3,5,10,11,12,14,16,19,24,25,26,35,38,46,72,75,91,94,95,104,106,112,114,115,116,119,122,125,126,144,148];
        sort($arr);
        $rep = [31,43,44,45,49,54,55,56,61,62,63,65,66,67,73,74,75,76,89,121];
        $this->apiSuccess(array_unique($arr));
        
    }
    
    public function task() {
        try {
            $this->load([
                'MachineID'=>['trim',''],
                'FunCode'=>['intval',''],
                'SlotNo'=>['trim',''],
                'TradeNo'=>['trim',''],
            ]);
            $result = ZhongjiTask::init()->run();
        } catch (Exception $e) {
            $result = ['Status'=>0];
        }
        return $this->ajaxMsg($result);
    }
    
    public function erdfire() {
        try {
            $this->load([
                'method'=>['trim','']
            ]);
            $data = QrfireRequest::init()->run();
        } catch (Exception $e) {
            throw $e;
            $data = [
                'code' => 0,
                'errorCode' => 10007,
                'message' => '服务器错误，请稍后重试',
                'data' => []
            ];
        }
        return $this->ajaxMsg($data);
    }
}
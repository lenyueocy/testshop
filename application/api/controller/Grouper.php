<?php
namespace app\api\controller;

use think\Exception;
use Logic\GroupLogic;
use Logic\OrderLogic;
use WeixinSdk\Program;
use Common\Data;
class Grouper  extends Common
{
    public function info() {
        try {
            $data = GroupLogic::myInfo(); 
        } catch (Exception $e) {
            return $this->apiError($e->getCode());
        }
        return $this->apiSuccess($data);
    }
    
    public function order() {

        try {
            $this->load([
                'num'=>['intval',0],
                'status'=>['trim',''],
                 'p'=>['intval',1],
            ]);
            $data = GroupLogic::grouperOrder();
        } catch (Exception $e) {
            return $this->apiError($e->getCode());
        }
        return $this->apiSuccess($data);
    }

    //测试接口
    public function orderTest() {

        try {
            $this->load([
                'num'=>['intval',0],
                'status'=>['trim',''],
                'p'=>['intval',1],
                //userid
                'userid'=>['intval',0],
            ]);
            $data = GroupLogic::grouperOrderTest();
        } catch (Exception $e) {
            return $this->apiError($e->getCode());
        }
        return $this->apiSuccess($data);
    }

    /**
     * 根据取货码查询待提货订单和暂不可提订单
     */
    public function search() {
        try {
            $this->load([
                'code'=>['intval',0]
            ]);
            $data = GroupLogic::grouperSearch();
        } catch (Exception $e) {
            return $this->apiError($e->getCode());
        }
        return $this->apiSuccess($data);
    }
    
    public function recieve() {
        try {
            $this->load([
                'orderid'=>['intval',0]
            ]);
            $data = OrderLogic::grouperRecieve();
        } catch (Exception $e) {
            return $this->apiError($e->getCode());
        }
        return $this->apiSuccess($data);
    }
    
    public function edit() {
        try {
            $this->load([
                'realname'=>['trim',''],
                'mobile'=>['trim',''],
                'email'=>['trim',''],
                'ext'=>['trim','']
            ]);
            $data = GroupLogic::editInfo();
        } catch (Exception $e) {
            return $this->apiError($e->getCode());
        }
        return $this->apiSuccess($data);
    }
    
    public function account() {
        try {
            $this->load([
                'start'=>['trim',0],
                'end'=>['trim',0],
            ]);
            $data = GroupLogic::grouperAccount();
        } catch (Exception $e) {
            throw $e;
            return $this->apiError($e->getCode());
        }
        return $this->apiSuccess($data);
    }
    //commission
    public function commission() {
        try {
            $data = GroupLogic::grouperCommission();
        } catch (Exception $e) {
            throw $e;
            return $this->apiError($e->getCode());
        }
        return $this->apiSuccess($data);
    }
    public function qrcode() {
        try {

            $result = Program::init()->qrcode('pages/grant/grant', Data::$user['id']);
            header('Content-type: image/jpg');
            return $this->apiSuccess($result);
            echo $result;
        } catch (Exception $e) {
            echo 'Not Found';
        }
        die;
    }
}
<?php
namespace app\api\controller;

use think\Exception;
use Logic\OrderLogic;
class Order extends Common
{
    public function temp() {
        try {
            $this->load([
                'cart'=>['trim',''],
                'type'=>['intval',1],
                'goodsid'=>['intval',0],
                'skuid'=>['intval',0],
                'num'=>['intval',0]
            ]);
            $data = OrderLogic::addTemp();
        } catch (Exception $e) {
            return $this->apiError($e->getCode());
        }
        return $this->apiSuccess($data);
    }
    
    public function confirm(){
        try {
            $this->load([
                'tempid'=>['intval',0]
            ]);
            $data = OrderLogic::confirmInfo();
        } catch (Exception $e) {
            throw $e;
            return $this->apiError($e->getCode());
        }
        return $this->apiSuccess($data);
    }


    /**
     * 提交订单
     */
    public function add() {
        try {
            $this->load([
                'tempid'=>['intval',0],
                'name'=>['trim',''],
                'mobile'=>['trim',''],
                'mark'=>['trim','']
            ]);
            $data = OrderLogic::addOrder();
        } catch (Exception $e) {
            throw $e;
            return $this->apiError($e->getCode());
        }
        return $this->apiSuccess($data);
    }

    /**
     * 订单列表
     */
    public function myorder() {
        try {
            $this->load([
                'status'=>['trim',0],
                'p'=>['intval',1],
                'num'=>['intval',10],
            ]);
            $data = OrderLogic::userOrder();
        } catch (Exception $e) {
            return $this->apiError($e->getCode());
        }
        return $this->apiSuccess($data);
    }
    /**
     * 搜索订单
     */
    public function searchorder() {
        try {
            $this->load([
                'keyword'=>['trim',''],
                'status'=>['trim',0],
                'p'=>['intval',1],
                'num'=>['intval',0],
            ]);
            $data = OrderLogic::searchOrder();
        } catch (Exception $e) {
            return $this->apiError($e->getCode());
        }
        return $this->apiSuccess($data);
    }

    /**
     * 确认收货
     */
    public function recieve() {
        try {
            $this->load([
                'orderid'=>['intval',0]
            ]);
            $data = OrderLogic::userRecieve();
        } catch (Exception $e) {
            return $this->apiError($e->getCode());
        }
        return $this->apiSuccess($data);
    }

    /**
     * 取消订单
     */
    public function cancel(){
        try {
            $this->load([
                'orderid'=>['intval',0]
            ]);
            $data = OrderLogic::userCancel();
        } catch (Exception $e) {
            return $this->apiError($e->getCode());
        }
        return $this->apiSuccess($data);

    }


    /**
     * 确认到达提货点
     */
    public function ztrecieve() {
        try {
            $this->load([
                'orderid'=>['intval',0]
            ]);
            $data = OrderLogic::ztuserRecieve();
        } catch (Exception $e) {
            return $this->apiError($e->getCode());
        }
        return $this->apiSuccess($data);
    }

    /**
     * 删除订单
     *
     */
    public function del() {
        try {
            $this->load([
                'orderid'=>['intval',0]
            ]);
            $data = OrderLogic::delOrder();
        } catch (Exception $e) {
            return $this->apiError($e->getCode());
        }
        return $this->apiSuccess($data);
    }
}
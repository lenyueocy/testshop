<?php
namespace app\api\controller;

use think\Exception;
use Logic\CartLogic;
class Cart extends Common
{
    /**
     * 购物车列表
     * @param int userid
     */
    public function lists() {
        try {
            $data = CartLogic::lists();
        } catch (Exception $e) {
            return $this->apiError($e->getCode());
        }
        return $this->apiSuccess($data);
    }
    
    /**
     * 单个添加购物车
     * @param int goodsid
     * @param int skuid
     * @param int num
     */
    public function add() {
        try {
            $this->load([
                'goodsid'=>['intval',0],
                'skuid'=>['intval',0],
                'num'=>['intval',0],
            ]);
            $data = CartLogic::add();
        } catch (Exception $e) {
            return $this->apiError($e->getCode());
        }
        return $this->apiSuccess($data);
    }
    
    /**
     * 批量添加购物车
     * @param string info
     */
    public function batch() {
        try {
            $this->load(['info'=>['json_decode',[]]]);
            $data = CartLogic::batch();
        } catch (Exception $e) {
            return $this->apiError($e->getCode());
        }
        return $this->apiSuccess($data);
    }
    
    /**
     * 删除购物车商品
     * @param int|string cartid 
     */
    public function del() {
        try {
            $this->load(['cartid'=>['trim',0]]);
            $data = CartLogic::del();
        } catch (Exception $e) {
            return $this->apiError($e->getCode());
        }
        return $this->apiSuccess($data);
    }
    
    /**
     * 编辑购物车商品数量
     * @param int cartid
     * @param int num
     */
    public function edit() {
        try {
            $this->load([
                'cartid'=>['intval',0],
                'num'=>['intval',0]
            ]);
            $data = CartLogic::edit();
        } catch (Exception $e) {
            return $this->apiError($e->getCode());
        }
        return $this->apiSuccess($data);
    }
    
    /**
     * 获取购物车商品数量
     * @param int userid
     */
    public function count() {
        try {
            $data = [];
        } catch (Exception $e) {
            return $this->apiError($e->getCode());
        }
        return $this->apiSuccess($data);
    }
}
<?php
namespace app\api\controller;

use think\Exception;
use Logic\GoodsLogic;
use WeixinSdk\Program;
use Common\Data;
class Goods extends Common
{
    public function lists() {
        try {
            $this->load([
                'where'=>['',[]],
                'order'=>['',[]],
                'p'=>['intval',1],
                'num'=>['intval',10]
            ]);

            $return = GoodsLogic::listGoods();
        } catch (Exception $e) {
            return $this->apiError($e->getCode());
        }
        return $this->apiSuccess($return);
    }

    /**
     * 首页商品以及加载更多
     * 搜索商品以及加载更多
     *
     */
    public function goodsLists() {
        try {
            $this->load([
                'keyword'=>['trim',''],
                'cid'=>['intval',0],
                'p'=>['intval',1],
                'num'=>['intval',10]
            ]);

            $return = GoodsLogic::searchGoods();
        } catch (Exception $e) {
            return $this->apiError($e->getCode());
        }
        return $this->apiSuccess($return);
    }
    public function goods() {
        try {
            $this->load([
                'keyword'=>['trim',''],
                'cid'=>['intval',0],
                'p'=>['intval',1],
                'num'=>['intval',10]
            ]);
            $return = GoodsLogic::searchGoods();
            $c=array_rand($return,3);
            $return = [$return[$c[0]],$return[$c[1]],$return[$c[2]]];
        } catch (Exception $e) {
            return $this->apiError($e->getCode());
        }
        return $this->apiSuccess($return);
    }


    
    public function detail() {
        try {
            $this->load([
                'goodsid'=>['intval',0]
            ]);

            $return = GoodsLogic::goodsDetail();

        } catch (Exception $e) {
            return $this->apiError($e->getCode());
        }
        return $this->apiSuccess($return);
    }
    public function qrcode() {
        try {
            $this->load([
                'goodsid'=>['intval',0]
            ]);

            $result = Program::init()->goodsqrcode('pages/detail/detail', Data::$user['id'],Data::instance()->goodsid);
            header('Content-type: image/jpg');
            return $this->apiSuccess($result);
            echo $result;
        } catch (Exception $e) {
            echo 'Not Found';
        }
        die;
    }

    
    public function category() {
        try {
            $data = GoodsLogic::categoryGoods();
        } catch (Exception $e) {
            return $this->apiError($e->getCode());
        }
        return $this->apiSuccess($data);
    }
    
    public function record() {
        try {
            $this->load([
                'goodsid'=>['intval',0],
            ]);
            $data = GoodsLogic::buyRecord();
        } catch (Exception $e) {
            throw $e;
            return $this->apiError($e->getCode());
        }
        return $this->apiSuccess($data);
    }

    /**
     * 查询最新订单首页滚动展示
     */
    public function order(){
        try{

            $data = GoodsLogic::order();
        }catch(Exception $e){
            throw $e;
            return $this->apiError($e->getCode);
        }
        return $this->apiSuccess($data);



    }


}
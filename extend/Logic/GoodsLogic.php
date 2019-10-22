<?php
namespace Logic;

use Model\GoodsModel;
use Common\Data;
use Model\CategoryModel;
use Model\OrderGoodsModel;
use Model\OrderModel;


class GoodsLogic extends BasicLogic
{
    public static function listGoods() {
        $goodsMod = new GoodsModel();
        return $goodsMod->pageGoods(Data::instance()->where,Data::instance()->order,Data::instance()->p,Data::instance()->num);
    }

    /**
     * 根据条件搜索商品
     */
    public static function searchGoods(){
        $goodsMod = new GoodsModel();
        return $goodsMod->getGoods(Data::instance()->keyword,Data::instance()->cid,Data::instance()->p,Data::instance()->num);
    }
    
    public static function goodsDetail() {
        if (!Data::instance()->goodsid) {
            self::error(10001);
        }

        $goodsMod = new GoodsModel();
        //增加浏览量
        $goodsMod->savehits(Data::instance()->goodsid);
        $info = $goodsMod->detail(Data::instance()->goodsid);
        $sku = [];

        return ['info'=>$info,'sku'=>$sku];
    }
    
    public static function categoryGoods() {
        $goodsMod = new GoodsModel();
        $categoryMod = new CategoryModel();
        $category = $categoryMod->lists();
        return $category;
        /*$cateGuds = $goodsMod->selectWithCategory();
        $return = [];
        foreach ($category as $cate) {
            if (!isset($cateGuds[$cate['id']])) {
                continue;
            }
            $return[] = [
                'category'=>$cate,
                'gudsList'=>$cateGuds[$cate['id']],
            ];
        }
        return $return;*/
    }
    
    public static function buyRecord() {
        $orderGoodsMod = new OrderGoodsModel();
        $recodeList = $orderGoodsMod->getBuyRecord(Data::instance()->goodsid);
        if (Data::instance()->goodsid) {
            /*$userids=[];
            $return=array();
            foreach ($recodeList as $guds) {
                if(!empty($userids)&&in_array($guds['id'],$userids)){
                    continue ;
                }
                $return[]=$guds;
                $userids[] =$guds['id'];
            }
            return $return;*/
            return $recodeList;
        }
        $return = [];
        $userids = array();


        foreach ($recodeList as $guds) {
            if(!empty($userids[$guds['goodsid']])&&in_array($guds['id'],$userids[$guds['goodsid']])){
                continue ;
            }
            if (!empty($return[$guds['goodsid']])&&!isset($return[$guds['goodsid']])) {
                $return[$guds['goodsid']] = [];
            }

            $userids[$guds['goodsid']][] =$guds['id'];
            $return[$guds['goodsid']][] = [
                'timeStr' => date('Y年m月d日H:i:s',strtotime($guds['addtime'])),
                'headpic' => $guds['headpic'],
                'nickname' => mb_substr($guds['nickname'],0,4,"utf-8"),//substr($guds['nickname'],1,10),
                'buyNum' => $guds['buyNum']
            ];


        }
        return $return;
    }

    /**
     * 查询最新的订单首页滚动展示
     */
    public static function order(){
        $ordersMod = new OrderModel();
        $recodeList = $ordersMod->getNewOrder();
        return $recodeList['rows'];

    }


}
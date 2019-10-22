<?php
namespace Logic;

use Model\CartModel;
use Common\Data;
use Model\GoodsModel;
use Constants\SiteConst;

class CartLogic extends CommonLogic
{
    public static function lists()
    {
        $cartMod = new CartModel();
        $cartGoods = $cartMod->userAll(Data::$user['id']);
        if (! $cartGoods || empty($cartGoods)) {
            return [];
        }
        $goodsMod = new GoodsModel();
        $goodsidList = array_unique(array_column($cartGoods, 'goodsid'));
        $where = [
            'id' => [ 'in' ,$goodsidList ],
            'status' => [ '>', 0 ]
        ];
        $goodsList = $goodsMod->pageGoods($where, [], 1, count($goodsidList));

        $temp = [];
        foreach ($goodsList as $key => $guds) {
            $temp[$guds['id']] = $guds;
        }
        $return = [];
        foreach ($cartGoods as $guds) {
            $goods = isset($temp[$guds['goodsid']]) ? $temp[$guds['goodsid']] : [];
            $guds['status'] = self::cartGoodsStatus($guds, $goods);
            $return[] = [
                'info' => $guds,
                'goods' => $goods,
                'sku' => []
            ];
        }
        return $return;
    }

    public static function add()
    {
        if (!Data::instance()->goodsid) {
            self::error(10001);
        }
        if (!Data::instance()->num || Data::instance()->num<0) {
            self::error(30004);
        }
        $goodsMod = new GoodsModel();
        $goods = $goodsMod->detail(Data::instance()->goodsid);
        
        //如果存在sku
        if ($goods['hasSku'] > 0 && !Data::instance()->skuid) {
            self::error(30002);
        }
        
        $cartMod = new CartModel();
        $cartMod->addSingle(Data::$user['id'], Data::instance()->goodsid, Data::instance()->skuid, Data::instance()->num);
        return self::lists();
    }

    public static function batch()
    {
        if (!Data::instance()->info || empty(Data::instance()->info)) {
            self::error(10001);
        }
        foreach (Data::instance()->info as $goods) {
            Data::instance()->goodsid = $goods['goodsid'];
            Data::instance()->goodsid = isset($goods['skuid']) ? $goods['skuid'] : 0;
            Data::instance()->goodsid = $goods['num'];
            self::add();
        }
        return self::lists();
    }

    public static function edit()
    {
        if (!Data::instance()->cartid) {
            self::error(10001);
        }
        if (!Data::instance()->num || Data::instance()->num <= 0) {
            self::error(30004);
        }
        $cartMod = new CartModel();
        $cartMod->updateNum(Data::instance()->cartid, Data::instance()->num);
        return self::lists();
    }
    
    public static function del() {
        if (!Data::instance()->cartid) {
            self::error(10001);
        }
        $cartMod = new CartModel();
        $cartMod->delCart(Data::$user['id'], Data::instance()->cartid);
        return self::lists();
    }

    private static function cartGoodsStatus($cart, $guds)
    {
        if ($cart['status'] == SiteConst::STATUS_NORMAL && isset($guds['status']) && $guds['status'] == SiteConst::GOODS_STATUS_UP && isset($guds['leftnum']) && $guds['leftnum'] > 0) {
            return SiteConst::STATUS_NORMAL;
        }
        return SiteConst::STATUS_DISABLED;
    }
}
<?php
namespace Logic;

use think\Exception;
use Logic\Pay\WechatPay;
use Model\OrderModel;
use Common\Data;
use Model\UserPlatformModel;
use Model\UserAccountModel;
use Common\Functions;
use Model\OrderGoodsModel;
class PayLogic extends BasicLogic
{
    public static function goodsPay()
    {
        if (!Data::instance()->orderid) {
            self::error(10001);
        }
        $orderMod = new OrderModel();
        $order = $orderMod->findById(Data::instance()->orderid);
        
        if (!$order) {
            self::error(50005);
        }
        $plateMod = new UserPlatformModel();
        $plate = $plateMod->findOpenid($order['userid']);
        
        $config = require CONF_PATH . '/pay/default.php';
        $config['out_trade_no'] = $order['orderno'];//Functions::orderno();
        //TODO 改为原价
        $config['total_fee'] = $order['orderfee'];// 0.01;//
        $config['openid'] = $plate['openid'];
        try {
            $data = WechatPay::miniApp($config)->pay();
            $orderMod->setPayno(Data::instance()->orderid,$config['out_trade_no'],$data['payno']);
        } catch (Exception $e) {
            throw $e;
        }
        return $data['pay'];
    }
    
    public static function goodsNotify() {
        $config = require CONF_PATH . '/pay/default.php';
        $result = WechatPay::miniApp($config)->notify();
        
        try{
            self::startTrans();
            $orderMod = new OrderModel();
            $order = $orderMod->findByOrderno($result['out_trade_no']);
            
            $orderGoodsMod = new OrderGoodsModel();
            
            $income = $orderGoodsMod->getIncome($order['id']);
            
            $orderMod->setPay($order['id'], $result['transaction_id'],$income);
            
            $accountMod = new UserAccountModel();
            $accountMod->add($order['fromid'], $order['id'], $order['orderfee'], 0, $income, $order['userid']);
            
            self::commit();
        } catch (Exception $e) {
            self::rollback();
            throw $e;
        }
        return [
            'return_code'=>'SUCCESS',
            'return_msg'=>'OK',
        ];
    }
}
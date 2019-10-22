<?php
namespace Logic;

use Model\OrderModel;
use Common\Data;
use Model\OrderGoodsModel;
use Constants\SiteConst;
use Model\UserAccountModel;
use Model\UserAreaModel;
use Model\UserModel;
class GroupLogic extends BasicLogic
{

    public static function myInfo()
    {
        $count = [];
        $orderMod = new OrderModel();
        foreach (self::getCountItem() as $type=>$item) {
            $count[$type] = $orderMod->countByfrom(Data::$user['id'],$item['timeStart'],$item['timeEnd']);
        }
        return $count;
    }

    private static function getCountItem()
    {
        $countItem = [
            1=>[
                'title' => '本月',
                'timeStart' => date('Y-m-01 00:00:00'),
                'timeEnd' => date('Y-m-d H:i:s')
            ],
            2=>[
                'type' => '上月',
                'timeStart' => date('Y-m-01 00:00:00',strtotime('-1 month')),
                'timeEnd' => date('Y-m-01 00:00:00')
            ],
            3=>[
                'type' => '累计',
                'timeStart' => Data::$user['addtime'],
                'timeEnd' => date('Y-m-d H:i:s')
            ]
        ];
        return $countItem;
    }
    
    public static function grouperOrder() {
        if (! Data::instance()->status) {
            self::error(10001);
        }
        $orderMod = new OrderModel();
        $userOrder = $orderMod->grouperOrder(Data::$user['id'], Data::instance()->status,Data::instance()->p,Data::instance()->num);
        if (empty($userOrder)) {
            return [];
        }
        
        $orders = array_column($userOrder, 'id');
        $orderGoodsMod = new OrderGoodsModel();
        $orderGoods = $orderGoodsMod->selectByOrder($orders);
        $return = [];
        foreach ($userOrder as $order) {
            $return[] = [
                'order' => $order,
                'guds' => isset($orderGoods[$order['id']]) ? $orderGoods[$order['id']] : []
            ];
        }
        return $return;
    }
//测试接口
    public static function grouperOrderTest() {
        if (! Data::instance()->status) {
            self::error(10001);
        }
        $orderMod = new OrderModel();
        $userOrder = $orderMod->grouperOrder(Data::instance()->userid, Data::instance()->status,Data::instance()->p,Data::instance()->num);
        if (empty($userOrder)) {
            return [];
        }

        $orders = array_column($userOrder, 'id');
        $orderGoodsMod = new OrderGoodsModel();
        $orderGoods = $orderGoodsMod->selectByOrder($orders);
        $return = [];
        foreach ($userOrder as $order) {
            $return[] = [
                'order' => $order,
                'guds' => isset($orderGoods[$order['id']]) ? $orderGoods[$order['id']] : []
            ];
        }
        return $return;
    }


    /**
     *根据取货码查询订单
     */
    public static function grouperSearch(){
        if (! Data::instance()->code) {
            return ['state'=>0,'msg'=>'请输入提货码'];
        }
        $code = Data::instance()->code;
        //根据提货码查询用户信息
        $userMod = new UserModel();
        $userinfo = $userMod->findByCode($code);
        if(empty($userinfo)){
            return ['state'=>0,'msg'=>'提货码错误'];
        }
        //团长ID
        $gid = Data::$user['id'];
        //更近团长ID和用户ID查询订单
        $orderMod = new OrderModel();
        $userOrder = $orderMod->grouperCodeOrder($gid, $userinfo['id']);
        $orderGoodsMod = new OrderGoodsModel();
        $nztreturn = $ztreturn = [];
        if(!empty($userOrder['ztinfo'])){
            $orderszt = array_column($userOrder['ztinfo'], 'id');
            $orderGoodszt = $orderGoodsMod->selectByOrder($orderszt);
            foreach ($userOrder['ztinfo'] as $order) {
                $ztreturn[] = [
                    'order' => $order,
                    'guds' => isset($orderGoodszt[$order['id']]) ? $orderGoodszt[$order['id']] : []
                ];
            }
            unset($order);
        }

        if(!empty($userOrder['noinfo'])){
            $ordersno = array_column($userOrder['noinfo'], 'id');
            $orderGoodsno = $orderGoodsMod->selectByOrder($ordersno);
            foreach ($userOrder['noinfo'] as $order1) {
                $nztreturn[] = [
                    'order' => $order1,
                    'guds' => isset($orderGoodsno[$order1['id']]) ? $orderGoodsno[$order1['id']] : []
                ];
            }
            unset($order1);
        }
        $return=['ztreturn'=>$ztreturn,'nztreturn'=>$nztreturn];
        return $return;




    }
    
    public static function grouperAccount() {
        if (Data::$user['type'] != SiteConst::USER_TYPE_PARCHSE) {
            self::error(20006);
        }
        $start = Data::instance()->start?strtotime(Data::instance()->start):0;
        $end = Data::instance()->end?strtotime(Data::instance()->end):0;

        if($start>$end){
            return ['state'=>0,'lists'=>[],'msg'=>'开始时间不能大于结束时间'];
        }

        $accountMod = new UserAccountModel();
        $res=$accountMod->srlists(Data::$user['id'],Data::instance()->start,Data::instance()->end);
        return ['state'=>1,'lists'=>$res];
    }
    //grouperCommission
    public static function grouperCommission() {
        if (Data::$user['type'] != SiteConst::USER_TYPE_PARCHSE) {
            self::error(20006);
        }
        $accountMod = new UserAccountModel();
        return $accountMod->commisstion(Data::$user['id']);

    }
    public static function editInfo() {
        if (!Data::instance()->realname) {
            self::error(10001);
        }
        if (!Data::instance()->mobile) {
            self::error(10001);
        }
        if (!Data::instance()->email) {
            self::error(10001);
        }
        $userMod = new UserModel();
        $userMod->editInfo(Data::$user['id'], Data::instance()->realname, Data::instance()->mobile, Data::instance()->email);
        
        $userAddrMod = new UserAreaModel();
        $userAddrMod->setExt(Data::$user['id'], Data::instance()->ext);
        return true;
    }
}
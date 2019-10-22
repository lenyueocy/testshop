<?php
namespace Logic;

use Common\Data;
use Model\CartModel;
use Model\GoodsModel;
use Model\OrderTempModel;
use Model\UserAreaModel;
use Model\UserModel;
use think\Exception;
use Model\OrderModel;
use Model\OrderGoodsModel;
use Constants\SiteConst;
use app\job\CancelOrderJob;
use Model\UserPlatformModel;
use WeixinSdk\Program;
use think\Db;

class OrderLogic extends BasicLogic
{

    public static function addTemp()
    {
        if (Data::$user['type']!= SiteConst::USER_TYPE_PARCHSE && ! Data::$user['fromid']) {
            self::error(20005);
        }
        $fromid = Data::$user['type'] == SiteConst::USER_TYPE_PARCHSE ? Data::$user['id'] : Data::$user['fromid'];
        if (Data::instance()->type == 1) {
            $add = self::addTempByCart();
        } elseif (Data::instance()->type == 2) {
            $add = self::addTempByGuds();
        } else {
            self::error(10005);
        }
        $tempMod = new OrderTempModel();
        $data = $tempMod->add(Data::$user['id'], $add['cartid'], $add['guds'], $fromid);
        return [
            'tempid' => $data['id']
        ];
    }

    public static function confirmInfo()
    {
        if (! Data::instance()->tempid) {
            self::error(10001);
        }
        $tempMod = new OrderTempModel();
        $tempOrder = $tempMod->findById(Data::instance()->tempid);
        if (! $tempOrder) {
            self::error(50002);
        }
        $info = self::tempOrderGoods($tempOrder['guds']);
        // $info['address'] = self::getAddress($tempOrder['fromid']);
        return $info;
    }

    /**
     * 提交订单
     */
    public static function addOrder()
    {
        if (! Data::instance()->tempid) {
            self::error(10001);
        }
        
        if (! Data::instance()->name) {

            self::error(50002);
        }
        
         if (! Data::instance()->mobile) {
             self::error(50003);
         }
        
        $tempMod = new OrderTempModel();
        $tempOrder = $tempMod->findById(Data::instance()->tempid);
        if (! $tempOrder) {
            self::error(50002);
        }
        $info = self::tempOrderGoods($tempOrder['guds']);
        $fromid = Data::$user['type'] == SiteConst::USER_TYPE_PARCHSE ? Data::$user['id'] : Data::$user['fromid'];
        $address = self::getAddress($fromid);
        try {
            self::startTrans();
            $orderMod = new OrderModel();
            $goodsMod = new GoodsModel();
            $goodsNum = array_sum(array_column($info['goodsList'], 'buyNum'));
            $order = $orderMod->add(Data::$user['id'], $goodsNum,$info['price'],$info['cash'],$info['downpoint'],$info['giftpoint'], Data::instance()->name, Data::instance()->mobile, $address, $fromid,Data::instance()->mark);
            $goodsAdd = [];
            $content='';
            foreach ($info['goodsList'] as $guds) {
                if (! empty($guds['sku'])) {
                    if ($guds['buyNum'] > $guds['sku']['leftnum']) {
                        return [
                            'state' => 0,'msg'=> $guds['goods']['title'].'-库存不足！'
                        ];
                        //self::error(50004);
                    }
                } else {
                    if ($guds['buyNum'] > $guds['goods']['leftnum']) {
                        //self::error(50004);
                        return [
                            'state' => 0,'msg'=> $guds['goods']['title'].'-库存不足！'
                        ];
                    }
                    $goodsMod->stockNum($guds['goods']['id'], 0 - $guds['buyNum']);
                }
                $goodsAdd[] = [
                    'orderid' => $order['id'],
                    'orderno' => $order['orderno'],
                    'goodsid' => $guds['goods']['id'],
                    'skuid' => empty($guds['sku']) ? 0 : $guds['sku']['id'],
                    'title' => $guds['goods']['title'],
                    'image' => $guds['goods']['imageUrl'],
                    'point' => $guds['point'],//单件赠送积分
                    'downpoint' => $guds['down'],//单件抵扣积分
                    'couponfee' => $guds['cash'],//单件优惠金额
                    'coupontotal' => $guds['totalcash'],//总优惠
                    'pointtotal' => $guds['totalpoint'],//总抵扣积分
                    'num' => $guds['buyNum'],
                    'price' => $guds['goods']['price'],
                    'totalprice' => $guds['buyNum'] * $guds['goods']['price'],
                    'attrs' => '[]'
                ];
                $content.='商品：'.$guds['goods']['title'].'-数量：'.$guds['buyNum'].'-抵扣积分：'.$guds['down'];
            }
            $goodsOrderMod = new OrderGoodsModel();
            $goodsOrderMod->addBatch($goodsAdd);
            //更新积分数据
            if($info['downpoint']>0){
                $userMod = new UserModel();
                $userMod->savePoint(Data::$user['id'],'积分抵钱-订单号：'.$order['orderno'],-$info['downpoint'],$info['point'],'积分抵钱-订单号：'.$order['orderno'].'-'.$content);
            }

            $cartMod = new CartModel();
            $cartMod->delCart(Data::$user['id'], $tempOrder['cartid']);
            
            //添加取消订单任务
            CancelOrderJob::add($order['id']);
            
            self::commit();
        } catch (Exception $e) {
            self::rollback();
            throw $e;
        }
        return [
            'state' => 1,
            'orderid' => $order['id']
        ];
    }

    public static function userOrder()
    {
        if (! Data::instance()->status) {
            self::error(10001);
        }
        $orderMod = new OrderModel();
        $userOrder = $orderMod->userOrder(Data::$user['id'], Data::instance()->status);
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
    public static function searchOrder()
    {
        if (! Data::instance()->status) {
            self::error(10001);
        }
        $orderMod = new OrderModel();
        $userOrder = $orderMod->searchOrder(Data::$user['id'], Data::instance()->status,Data::instance()->keyword,Data::instance()->p,Data::instance()->num);
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

    public static function userRecieve(){
        if (!Data::instance()->orderid) {
            self::error(10001);
        }

        $orderMod = new OrderModel();
        $order = $orderMod->findById(Data::instance()->orderid);
        if (!$order || $order['status'] != SiteConst::ORDER_STATUS_RECIEVE) {
            self::error(50005);
        }
        
        if ($order['userid'] != Data::$user['id'] && $order['fromid'] != Data::$user['id'] ) {
            self::error(50005);
        }
        //订单完成赠送积分
        if($order['giftpoint']>0){
            $userMod = new UserModel();
            $point = $userMod->getPoint($order['userid']);
            $userMod->savePoint($order['userid'],'购物赠送-订单号：'.$order['orderno'],$order['giftpoint'],$order['giftpoint']+$point,'购物赠送积分-订单号：'.$order['orderno']);
        }

        return $orderMod->setUserRevieve(Data::instance()->orderid);
    }

    public static function userCancel(){
        if (!Data::instance()->orderid) {
            self::error(10001);
        }
        $orderid=Data::instance()->orderid;
        $orderMod = new OrderModel();
        $userMod = new UserModel();
        $order = $orderMod->findById(Data::instance()->orderid);
       // if (!$order || !in_array($order['status'],array(1,2,3,4))) {
        if (!$order || !in_array($order['status'],array(1,2))) {
            return ['state'=>0,'msg'=>'订单不存，请刷新重试！'];
        }
        try {
            self::startTrans();
            $orderMod->setCancel($orderid);
            $orderGoodsMod = new OrderGoodsModel();
            $orderGoods = $orderGoodsMod->selectForCancel($orderid);
            $goodsMod = new GoodsModel();
            foreach ($orderGoods as $guds) {
                $goodsMod->stockNum($guds['goodsid'], $guds['num']);
            }
            //取消订单 积分退还 ($userid,$tite,$downpoint,$totalpoint,$content){
            if($order['downpoint']>0){
                $point = $userMod->getPoint($order['userid']);
                $totalpoint = $point+$order['downpoint'];
                $userMod->savePoint($order['userid'],'取消订单-订单号：'.$order['orderno'],$order['downpoint'],$totalpoint,'取消订单退换积分，订单号：'.$order['orderno']);
            }
            //if(in_array($order['status'],array(2,3,4))){
                if(in_array($order['status'],array(2))){
                //退款到微信
                $tkdata=array();
                $tkdata['orderno']=$orderno='RW'.date("YmdHis",time()) . rand(10000, 99999);
                $tkdata['uid']=$order['userid'];
                $tkdata['title']=$title="取消订单退款";
                $tkdata['addtime']=time();
                $tkdata['status']=0;
                $tkdata['orderid']=$orderid;
                $tkdata['money']=$order['orderfee'];
                $tuiorderinfo = Db::table('sp_order_refund')->field('id,status')->where(array('uid'=>$order['userid'],'orderid'=>$orderid))->find();
                if(empty($tuiorderinfo)){
                    ///生成新订单
                    $refundid = Db::table('sp_order_refund')->insertGetId($tkdata);
                }else{
                    if($tuiorderinfo['status']==1){
                        return ['state'=>0,'msg'=>'订单已退款成功，不要重复操作'];
                    }else{
                        Db::table('sp_order_refund')->where(array('id'=>$tuiorderinfo['id']))->update($tkdata);
                        $refundid = $tuiorderinfo['id'];
                    }
                }
                $notify_str = md5(rand(1000,9999));
                $pdata=array();
                $pdata['appid']=config('program.appid');
                $pdata['mch_id']=config('program.payid');
                $pdata['nonce_str']=$notify_str;
                $pdata['transaction_id']=$order['transid'];
                $pdata['out_refund_no']=$orderno;
                $pdata['total_fee']=intval($order['orderfee']*100);
                $pdata['refund_fee']=intval($order['orderfee']*100);
                $pdata['refund_desc']=$title;
                ksort($pdata);// 对数据进行排序
                $str = self::ToUrlParams($pdata,config('program.paykey'));//对数据拼接成字符串
                $sign = strtoupper(md5($str));
                $pdata['sign']=$sign;

                $urls= "https://api.mch.weixin.qq.com/secapi/pay/refund";
                $pxml = '<xml>'.
                    '<appid>'.config('program.appid').'</appid>'.
                    '<mch_id>'.config('program.payid').'</mch_id>'.
                    '<nonce_str>'.$notify_str.'</nonce_str>'.
                    '<transaction_id>'.$order['transid'].'</transaction_id>'.
                    '<out_refund_no>'.$orderno.'</out_refund_no>'.
                    '<total_fee>'.intval($order['orderfee']*100).'</total_fee>'.
                    '<refund_fee>'.intval($order['orderfee']*100).'</refund_fee>'.
                    '<refund_desc>'.$title.'</refund_desc>'.
                    '<sign>'.$sign.'</sign>'.
                    '</xml>';
                $wechatdata = self::run_curl_post_ssl($urls,$pxml);
                $res = json_decode(json_encode(simplexml_load_string($wechatdata, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
                if($res["return_code"]=="FAIL"){
                    return ['state'=>0,'msg'=>$res["return_msg"]];
                }
                if($res["result_code"]=="FAIL"){
                    if($res["err_code"]=="NOTENOUGH"){
                        return ['state'=>0,'msg'=>'订单已发货，如需退款退货请联系团长处理'];

                    }else{
                        return ['state'=>0,'msg'=>$res["err_code_des"]];
                    }
                }

                //退款成功 更改支付订单状态 更改退款订单状态 更改押金状态  微信退款单号 refund_id
                Db::table('sp_order_refund')->where(array('id'=>$refundid))->update(array('status'=>1));
                //保存订单退款状态
                $orderMod->setRefund($orderid,$refundid);
            }

            self::commit();
        } catch (Exception $e) {
            self::rollback();
            throw $e;
        }
        return ['state'=>1,'msg'=>'ok'];

    }
    /*
     * 测试后台退款功能
     */
    public static function Cancel($orderid){
        if (!$orderid) {
            self::error(10001);
        }
        $orderMod = new OrderModel();
        $userMod = new UserModel();
        $order = $orderMod->findById($orderid);
         if (!$order || !in_array($order['status'],array(1,2,3,4,5))) {

             return ['state'=>0,'msg'=>'订单不存，请刷新重试！'];
        }
        try {
            self::startTrans();
            $orderMod->setCancel($orderid);
            $orderGoodsMod = new OrderGoodsModel();
            $orderGoods = $orderGoodsMod->selectForCancel($orderid);
            $goodsMod = new GoodsModel();
            foreach ($orderGoods as $guds) {
                $goodsMod->stockNum($guds['goodsid'], $guds['num']);
            }
            //取消订单 积分退还 ($userid,$tite,$downpoint,$totalpoint,$content){
            if($order['downpoint']>0){
                $point = $userMod->getPoint($order['userid']);
                $totalpoint = $point+$order['downpoint'];
                $userMod->savePoint($order['userid'],'取消订单-订单号：'.$order['orderno'],$order['downpoint'],$totalpoint,'取消订单退换积分，订单号：'.$order['orderno']);
            }
            if(in_array($order['status'],array(2,3,4,5))){
           // if(in_array($order['status'],array(2))){
                //退款到微信
                $tkdata=array();
                $tkdata['orderno']=$orderno='RW'.date("YmdHis",time()) . rand(10000, 99999);
                $tkdata['uid']=$order['userid'];
                $tkdata['title']=$title="取消订单退款";
                $tkdata['addtime']=time();
                $tkdata['status']=0;
                $tkdata['orderid']=$orderid;
                $tkdata['money']=$order['orderfee'];
                $tuiorderinfo = Db::table('sp_order_refund')->field('id,status')->where(array('uid'=>$order['userid'],'orderid'=>$orderid))->find();
                if(empty($tuiorderinfo)){
                    ///生成新订单
                    $refundid = Db::table('sp_order_refund')->insertGetId($tkdata);
                }else{
                    if($tuiorderinfo['status']==1){
                        return ['state'=>0,'info'=>'订单已退款成功，不要重复操作'];
                    }else{
                        Db::table('sp_order_refund')->where(array('id'=>$tuiorderinfo['id']))->update($tkdata);
                        $refundid = $tuiorderinfo['id'];
                    }
                }
                $notify_str = md5(rand(1000,9999));
                $pdata=array();
                $pdata['appid']=config('program.appid');
                $pdata['mch_id']=config('program.payid');
                $pdata['nonce_str']=$notify_str;
                $pdata['transaction_id']=$order['transid'];
                $pdata['out_refund_no']=$orderno;
                $pdata['total_fee']=intval($order['orderfee']*100);
                $pdata['refund_fee']=intval($order['orderfee']*100);
                $pdata['refund_desc']=$title;
                ksort($pdata);// 对数据进行排序
                $str = self::ToUrlParams($pdata,config('program.paykey'));//对数据拼接成字符串
                $sign = strtoupper(md5($str));
                $pdata['sign']=$sign;

                $urls= "https://api.mch.weixin.qq.com/secapi/pay/refund";
                $pxml = '<xml>'.
                    '<appid>'.config('program.appid').'</appid>'.
                    '<mch_id>'.config('program.payid').'</mch_id>'.
                    '<nonce_str>'.$notify_str.'</nonce_str>'.
                    '<transaction_id>'.$order['transid'].'</transaction_id>'.
                    '<out_refund_no>'.$orderno.'</out_refund_no>'.
                    '<total_fee>'.intval($order['orderfee']*100).'</total_fee>'.
                    '<refund_fee>'.intval($order['orderfee']*100).'</refund_fee>'.
                    '<refund_desc>'.$title.'</refund_desc>'.
                    '<sign>'.$sign.'</sign>'.
                    '</xml>';
                $wechatdata = self::run_curl_post_ssl($urls,$pxml);
                $res = json_decode(json_encode(simplexml_load_string($wechatdata, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
                if($res["return_code"]=="FAIL"){
                    return ['state'=>0,'info'=>$res["return_msg"]];
                }
                if($res["result_code"]=="FAIL"){
                    if($res["err_code"]=="NOTENOUGH"){
                        return ['state'=>0,'info'=>'微信账号余额不足'];

                    }else{
                        return ['state'=>0,'info'=>$res["err_code_des"]];
                    }
                }

                //退款成功 更改支付订单状态 更改退款订单状态 更改押金状态  微信退款单号 refund_id
                Db::table('sp_order_refund')->where(array('id'=>$refundid))->update(array('status'=>1));
                //保存订单退款状态
                $orderMod->setRefund($orderid,$refundid);
            }

            self::commit();
        } catch (Exception $e) {
            self::rollback();
            throw $e;
        }
        //此status不是订单的状态而是后台提交后ajax的状态
        return ['state'=>1,'msg'=>'操作成功','status'=>1];

    }

    protected static function run_curl_post_ssl($url, $vars, $second=30,$aHeader=array())
    {
        $ch = curl_init();
        //超时时间
        curl_setopt($ch,CURLOPT_TIMEOUT,$second);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
        //这里设置代理，如果有的话
        //curl_setopt($ch,CURLOPT_PROXY, '10.206.30.98');
        //curl_setopt($ch,CURLOPT_PROXYPORT, 8080);
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);

        //以下两种方式需选择一种

        //第一种方法，cert 与 key 分别属于两个.pem文件
        //默认格式为PEM，可以注释
        curl_setopt($ch,CURLOPT_SSLCERTTYPE,'PEM');
        curl_setopt($ch,CURLOPT_SSLCERT,getcwd().'/cert/apiclient_cert.pem');
        //默认格式为PEM，可以注释
        curl_setopt($ch,CURLOPT_SSLKEYTYPE,'PEM');
        curl_setopt($ch,CURLOPT_SSLKEY,getcwd().'/cert/apiclient_key.pem');

        //第二种方式，两个文件合成一个.pem文件
        // curl_setopt($ch,CURLOPT_SSLCERT,getcwd().'/all.pem');

        if( count($aHeader) >= 1 ){
            curl_setopt($ch, CURLOPT_HTTPHEADER, $aHeader);
        }

        curl_setopt($ch,CURLOPT_POST, 1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$vars);
        $data = curl_exec($ch);
        if($data){
            curl_close($ch);
            return $data;
        }
        else {
            $error = curl_errno($ch);
            echo "call faild, errorCode:$error\n";
            curl_close($ch);
            return false;
        }
    }

    private static function ToUrlParams($arr,$key)
    {
        $weipay_key =$key;//微信的key,这个是微信支付给你的key，不要瞎填。
        $buff = "";
        foreach ($arr as $k => $v)
        {
            if($k != "sign" && $v != "" && !is_array($v)){
                $buff .= $k . "=" . $v . "&";
            }
        }

        $buff = trim($buff, "&");
        return $buff.'&key='.$weipay_key;
    }
    /**
     * 到达自提点给客户发送模板消息
     */
    public static function ztuserRecieve(){
        if (!Data::instance()->orderid) {
            self::error(10001);
        }

        $orderMod = new OrderModel();
        $order = $orderMod->findById(Data::instance()->orderid);
        if (!$order || $order['status'] != SiteConst::ORDER_STATUS_SEND) {
            self::error(50005);
        }
        if ($order['fromid'] != Data::$user['id'] ) {
            self::error(50005);
        }
        //查询商品
        $orderGoodsMod = new OrderGoodsModel();
        $orderGoods = $orderGoodsMod->selectForGoods($order['id']);


        $goods='';
        foreach($orderGoods as $item){
            $goods.=$item['title'].",";
        }

        $goods = rtrim($goods,',');

        //发送模板消息
        //查询opeid
        $plateMod = new UserPlatformModel();
        $plateinfo = $plateMod->findOpenid($order['userid']);

        //待提货发送模板消息
        $data_msg=array(
            "touser"=>$plateinfo['openid'],//openid
            "template_id"=>"J3DIGGtzkeJDUKaOReAc5OV4WdOD0pJKDXnQk4dOyV0",
            "page"=>"pages/index/index",
            "form_id"=>$order['payno'],
            "data"=>array(
                "keyword1"=>array("value"=>$order['grouparea'],"color"=>"#000"),
                "keyword2"=>array("value"=>$goods,"color"=>"#000"),
                "keyword3"=>array("value"=>$order['orderno'],"color"=>"#000"),
                "keyword4"=>array("value"=>$order['address'],"color"=>"#000"),
                "keyword5"=>array("value"=>$order['groupermobile'],"color"=>"#000"),
                "keyword6"=>array("value"=>"拼团","color"=>"#000"),
                "keyword7"=>array("value"=>"店铺提货时请出示提货码给工作人员，谢谢。","color"=>"#000")
            )
        );


        $res = Program::init()->curl_post_send_information(json_encode($data_msg));


        return $orderMod->setZtRevieve(Data::instance()->orderid);
    }


    
    public static function grouperRecieve(){
        if (!Data::instance()->orderid) {
            self::error(10001);
        }
        if (Data::$user['type'] != SiteConst::USER_TYPE_PARCHSE) {
            self::error(20006);
        }
        $orderMod = new OrderModel();
        $order = $orderMod->findById(Data::instance()->orderid);
        if (!$order || $order['status'] != SiteConst::ORDER_STATUS_SEND || $order['fromid'] != Data::$user['id']) {
            self::error(50005);
        }
        return $orderMod->setGrouperRevieve(Data::instance()->orderid);
    }
    
    public static function delOrder() {
        if (!Data::instance()->orderid) {
            self::error(10001);
        }
        $orderMod = new OrderModel();
        $order = $orderMod->findById(Data::instance()->orderid);
        if (!$order || $order['userid'] != Data::$user['id']) {
            self::error(50005);
        }
        if (!in_array($order['status'], [SiteConst::ORDER_STATUS_PEDDING,SiteConst::ORDER_STATUS_COMMENT])) {
            self::error(50006);
        }
        return $orderMod->delById(Data::instance()->orderid);
    }
    
    /**
     * 
     * @param unknown $orderid
     * 1订单状态置为-1
     * 2商品库存修改
     */
    public static function cancelOrder($orderid){
        $orderMod = new OrderModel();
       $userMod = new UserModel();
        $order = $orderMod->findById($orderid);
        if ($order['status'] != SiteConst::ORDER_STATUS_PEDDING) {
            return true;
        }
        try {
            self::startTrans();
            $orderMod->setCancel($orderid);
            $orderGoodsMod = new OrderGoodsModel();
            $orderGoods = $orderGoodsMod->selectForCancel($orderid);
            $goodsMod = new GoodsModel();
            foreach ($orderGoods as $guds) {
                $goodsMod->stockNum($guds['goodsid'], $guds['num']);
            }

            //取消订单 积分退还 ($userid,$tite,$downpoint,$totalpoint,$content){
            if($order['downpoint']>0){
                $point = $userMod->getPoint($order['userid']);
                $totalpoint = $point+$order['downpoint'];
                $userMod->savePoint($order['userid'],'取消订单-订单号：'.$order['orderno'],$order['downpoint'],$totalpoint,'取消订单退换积分，订单号：'.$order['orderno']);
            }

            self::commit();
        } catch (Exception $e) {
            self::rollback();
            throw $e;
        }
        return true;
    }

    private static function getAddress($fromid)
    {
        $areaMod = new UserAreaModel();
        return $areaMod->getAddress($fromid);
    }

    private static function tempOrderGoods($guds)
    {
        $guds = json_decode($guds, true);
        if (! $guds) {
            self::error(10007);
        }
        //查询用户可用积分
        $userMod = new UserModel();
        $point = $userMod->getPoint(Data::$user['id']);
        $gudsId = array_column($guds, 'goodsid');
        $skuId = array_column($guds, 'skuid');
        $goodsMod = new GoodsModel();
        $goodsList = $goodsMod->selectById($gudsId);
        $skuList = $goodsMod->goodsSku($skuId);
        $retrun = [];
        $totalPrice = $downpoint =$cash=$giftpoint=$totalnum= 0;
        foreach ($guds as $goods) {
            if (! isset($goodsList[$goods['goodsid']])) {
                continue;
            }
            $goodsinfo = $goodsList[$goods['goodsid']];
            $price = $goodsList[$goods['goodsid']]['price'];
            if ($goods['skuid']) {
                if (! isset($skuList[$goods['skuid']])) {
                    continue;
                }
                $price = $skuList[$goods['skuid']]['price'];
            }
            $totalPrice += $price * $goods['num'];
            $totalnum +=$goods['num'];
            $giftpoint +=$goodsinfo['gift']* $goods['num'];
            //判断当前商品可抵扣多少积分
            $youhui = $totalpoint = 0;
            if($goodsinfo['isopen']==1){
                for($i=0;$i<$goods['num'];$i++){
                    if($point>$goodsinfo['down']){
                        $downpoint+=$goodsinfo['down'];
                        $point-=$goodsinfo['down'];
                        $cash+=$goodsinfo['cash'];
                        $youhui+=$goodsinfo['cash'];
                        $totalpoint+=$goodsinfo['down'];
                    }
                }
            }

            $retrun[] = [
                'cash' => $goodsinfo['cash'],//单件优惠金额
                'down' => $goodsinfo['down'],//单件抵扣积分
                'totalcash' => $youhui,//总优惠
                'totalpoint' => $totalpoint,//总抵扣积分
                'point'=>$goodsinfo['gift'],//单件赠送积分
                'buyNum' => $goods['num'],
                'goods' => $goodsList[$goods['goodsid']],
                'sku' => isset($skuList[$goods['skuid']]) ? $skuList[$goods['skuid']] : []
            ];
        }
        return [
            'goodsList' => $retrun,
            'price' => $totalPrice,
            'cash' => $cash,
            'realprice' => round($totalPrice-$cash,2),
            'downpoint' => $downpoint,
            'point' => $point,
             'giftpoint' => $giftpoint,//赠送积分
            'totalnum'=>$totalnum//商品数量
        ];
    }

    private static function addTempByCart()
    {
        if (! Data::instance()->cart || empty(Data::instance()->cart)) {
            self::error(50001);
        }
        $cart = explode(',', Data::instance()->cart);
        if (empty($cart)) {
            self::error(50001);
        }
        $cartMod = new CartModel();
        $cartGoods = $cartMod->selectById(Data::$user['id'], $cart);
        return [
            'cartid' => Data::instance()->cart,
            'guds' => $cartGoods
        ];
    }

    private static function addTempByGuds()
    {
        if (! Data::instance()->goodsid || ! Data::instance()->num) {
            self::error(10005);
        }
        $goodsMod = new GoodsModel();
        $goods = $goodsMod->detail(Data::instance()->goodsid, false);
        if ($goods['hasSku'] > 0 && ! Data::instance()->skuid) {
            self::error(30002);
        }
        $guds = [
            [
                'goodsid' => Data::instance()->goodsid,
                'skuid' => Data::instance()->skuid,
                'num' => Data::instance()->num
            ]
        ];
        return [
            'cartid' => '',
            'guds' => $guds
        ];
    }
}
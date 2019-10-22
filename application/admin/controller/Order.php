<?php
namespace app\admin\controller;

use Constants\TBS;
use ExportExcel\ExportOrder;
use Constants\SiteConst;
use Logic\OrderLogic;
class Order extends Common
{
    public function order_list() {
        if ($this->isAjax) {
            $data = $this->input;
            $data['p'] = isset($data['p']) && $data['p'] ? $data['p'] : 1;
            $data['num'] = isset($data['num']) && $data['num'] ? $data['num'] : 10;
            $this->input['where']['isdel']=2;
            $sqlObj = $this->tb(TBS::ORDER)
                ->alias('a')
                ->join(TBS::USER.' b','a.userid=b.id','left')
                ->field('b.nickname,b.headpic,a.id,a.orderno,a.orderfee,a.status,a.addtime,a.groupername,a.groupermobile,a.grouparea,a.name,a.mobile,a.address,a.refundstate,a.comm_mark')
                ->where($this->input['where'])
                ->order('a.id desc')->page($data['p'],$data['num'])
                ->select();
            $count = $this->tb(TBS::ORDER)
                ->alias('a')
                ->join(TBS::USER.' b','a.userid=b.id','left')
                ->where($this->input['where'])->count();
            $return = [
                'p'=>$data['p'],
                'num'=>$data['num'],
                'total'=>$count,
                'rows'=>$sqlObj
            ];
            $this->ajaxMsg($return);
        }
        //查询管理员信息
        $admin =  $this->tb(TBS::ADMIN_USER)->where(['id'=>session('admin-userid') ])->find();
        $this->assign('admin',$admin);
        $groups = $this->tb(TBS::USER)
            ->where(['type'=>SiteConst::USER_TYPE_PARCHSE])
            ->field('id,realname')
            ->select();
        $this->assign('groups',$groups);
        
        return $this->fetch('order/order/list');
    }
    
    public function order_detail() {
        $detail = $this->detail(TBS::ORDER);
        $this->assign('detail',$detail);
        
        $goods = $this->tb(TBS::ORDER_GOODS)
            ->where(['orderid'=>$this->input['id']])
            ->select();
        $this->assign('guds',$goods);
        
        $orderStatus = [
            -1=>'<span class="layui-badge layui-bg-black">已取消</span>',
            1=>'<span class="layui-badge layui-bg-gray">待付款</span>',
            2=>'<span class="layui-badge">待发货</span>',
            3=>'<span class="layui-badge layui-bg-orange">已发货</span>',
            4=>'<span class="layui-badge layui-bg-blue">待提货</span>',
            5=>'<span class="layui-badge layui-bg-green">已完成</span>',
        ];
        $this->assign('status',$orderStatus);
        
        return $this->fetch('order/order/detail');
        
    }
    
    public function order_send() {
        //判断订单是不是都可以发货
        $dataIds = $this->input['dataId'];
        if(empty($dataIds)){
            $return =  ['status'=>-1,'info'=>'请选择已发货的订单'];
            $this->ajaxMsg($return);
        }
        foreach($dataIds as $orderid){
           $order =  $this->tb(TBS::ORDER)->where(['id'=>$orderid])->find();
           if($order['status']==1){
               $return =  ['status'=>-1,'info'=>'订单'.$order['orderno'].'待付款，不能发货'];
               $this->ajaxMsg($return);
           }elseif($order['status']==3){
               $return =  ['status'=>-1,'info'=>'订单'.$order['orderno'].'已经发货，勿重复提交'];
               $this->ajaxMsg($return);
           }elseif($order['status']==4){
               $return =  ['status'=>-1,'info'=>'订单'.$order['orderno'].'已经到达自提点，勿重复提交'];
               $this->ajaxMsg($return);
           }elseif($order['status']==5){
               $return =  ['status'=>-1,'info'=>'订单'.$order['orderno'].'已经完成，勿重复提交'];
               $this->ajaxMsg($return);
           }elseif($order['status']==-1){
               $return =  ['status'=>-1,'info'=>'订单'.$order['orderno'].'已取消，不能发货'];
               $this->ajaxMsg($return);
           }
        }

        $return = $this->doDeal(TBS::ORDER,['status'=>2]);
        $this->ajaxMsg($return);
    }

    /*
     * 订单备注
     */
    public function order_make(){
        if ($this->isAjax) {
            $return = $this->doUpdate(TBS::ORDER,$this->input);
            $this->ajaxMsg($return);
        }
        $detail = $this->detail(TBS::ORDER);
        $this->assign('order',$detail);

        return $this->fetch('order/order/make');
    }

//    /*
//     * 后台订单退款
//     */
//    public function order_refund(){
//        //判断订单是不是都可以退款
//        $dataIds = $this->input['dataId'];
//        if(empty($dataIds)){
//            $return =  ['status'=>-1,'info'=>'请选择已退款的订单'];
//            $this->ajaxMsg($return);
//        }
//        foreach($dataIds as $orderid){
//            $order =  $this->tb(TBS::ORDER)->where(['id'=>$orderid])->find();
//            if($order['status']==1){
//                $return =  ['status'=>-1,'info'=>'订单'.$order['orderno'].'待付款，不能退款'];
//                $this->ajaxMsg($return);
//            }elseif($order['status']==-1){
//                $return =  ['status'=>-1,'info'=>'订单'.$order['orderno'].'已取消，不能退款'];
//                $this->ajaxMsg($return);
//            }
//        }
//        $return =  OrderLogic::Cancel($orderid);
//        $this->ajaxMsg($return);
//    }
    /*
     * 订单导出
     */
    public function order_export() {
        $where = isset($this->input['where']) ? $this->input['where'] : [];
        $order = $this->tb(TBS::ORDER)
                ->alias('a')
                ->join(TBS::USER.' b','a.userid=b.id','left')
                ->field('b.nickname,a.id,a.orderno,a.orderfee,a.status,a.refundstate,a.addtime,a.name,a.mobile,a.address,a.groupername,a.groupermobile,a.mark')
                ->order('a.id desc')
                ->where($where)
                ->select();
        
        if (empty($order)) {
            $this->errorMsg('没有可导出结果');
        }
        /*$orderStatus = [
            '-1'=>'已取消',
            1=>'待付款',
            2=>'待发货',
            3=>'已发货',
            4=>'已完成',
            5=>'已完成',
        ];
        $refundStatus = [
            '0'=>'',
            1=>'-已退款',
        ];
        foreach ($order as $key=>$ord) {
            $ord['status'] = $orderStatus[$ord['status']].$refundStatus[$ord['refundstate']];
            $order[$key] = $ord;
        }*/

       /* $export = new ExportOrder();
        $this->successMsg($export->exportNew($order));*/


        $orderIdArr = array_column($order, 'id');
        $orderGudsTemp = $this->tb(TBS::ORDER_GOODS)
            ->alias('a')
            ->join(TBS::GOODS.' b','a.goodsid=b.id','left')
            ->field('a.title,a.orderid,b.send,a.num,a.totalprice')
            ->where(['orderid'=>['in',$orderIdArr]])
            ->select();
        
        $orderGuds = [];
        foreach ($orderGudsTemp as $guds) {
            if (!isset($orderGuds[$guds['orderid']])) {
                $orderGuds[$guds['orderid']] = [];
            }
            $orderGuds[$guds['orderid']][] = $guds;
        }
        $orderStatus = [
            '-1'=>'已取消',
            1=>'待付款',
            2=>'待发货',
            3=>'已发货',
            4=>'待自提',
            5=>'已完成',
        ];
        $refundStatus = [
            '0'=>'',
            1=>'-已退款',
        ];
        
        foreach ($order as $key=>$ord) {
            $ord['gudsList'] = $orderGuds[$ord['id']];
            $ord['inc'] = $key+1;
            $ord['status'] = $orderStatus[$ord['status']].$refundStatus[$ord['refundstate']];
            $order[$key] = $ord;
        }
        
        $export = new ExportOrder();
        $this->successMsg($export->exportTwo($order));
    }
}
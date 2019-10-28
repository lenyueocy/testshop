<?php
namespace app\admin\controller;

use Constants\TBS;
use ExportExcel\ExportOrder;
use Constants\SiteConst;
use Logic\OrderLogic;
use Model\OrderModel;
class Order extends Common
{

    /**
     * 订单列表功能
     * @author: Leny
     * @date: 2019/01/01 00:00:00
     */
    public function index(){
        return $this->fetch('order/index');
    }

    /**
     * 获取订单列表数据
     * @author: Leny
     * @date: 2019/01/01 00:00:00
     */
    public function getData(){
        $page = $this->input['page'];
        $limit = $this->input['limit'];
        $orderData = $this->table('order')
            ->alias('o')
            ->field("o.id,o.orderno,o.mobile,o.create_time,o.pay_type,o.status,o.mark,u.nickname as user_name")
            ->join("sp_user u","u.id=o.user_id",'left')
            ->limit($page,$limit)
            ->order('o.create_time desc')
            ->select();
        $count = $this->table('order')
            ->alias('o')
            ->field("o.orderno,u.nickname")
            ->join("sp_user u","u.id=o.user_id",'left')
            ->count();
        $this->_return(0,'获取数据成功',$orderData,$count);
    }
    /**
     * 订单编辑功能
     * @author: Leny
     * @date: 2019/01/01 00:00:00
     */
    public function edit(){
        if(isset($this->input['id'])){
            $id = $this->input['id'];
            if($this->isAjax){
                $updateData = [
                    'user_id'=>$this->input['user_id'],
                    'mobile'=>$this->input['mobile'],
                    'pay_type'=>$this->input['pay_type'],
                    'status'=>$this->input['status'],
                    'mark'=>$this->input['mark'],
                ];
                $res = $this->table('order')->where(['id'=>$id])->update($updateData);
                if($res){
                    $this->_return(0,'操作成功');
                }
                $this->_return(-1,'操作失败');
            }
            $orderData = $this->table('order')
                ->alias('o')
                ->field("o.id,o.user_id,o.orderno,o.mobile,o.create_time,o.pay_type,o.status,o.mark,u.nickname as user_name")
                ->join("sp_user u","u.id=o.user_id",'left')
                ->where(['o.id'=>$id])
                ->find();
            $this->assign('orderData',$orderData);
        }else{
            if($this->isAjax){
                $insertData = [
                    'orderno'=>"order_".time().rand(10000,99999),
                    'user_id'=>$this->input['user_id'],
                    'pay_type'=>$this->input['pay_type'],
                    'status'=>$this->input['status'],
                    'mobile'=>$this->input['mobile'],
                    'mark'=>$this->input['mark'],
                    'create_time'=>time()
                ];
                $res = $this->table('order')->insert($insertData);
                if($res){
                    $this->_return(0,'操作成功');
                }
                $this->_return(-1,'操作失败');
            }
        }
        $userData = $this->table('user')->field('id,nickname')->select();
        $this->assign('userData',$userData);
        return $this->fetch('order/edit');
    }
    /**
     * 订单删除功能
     * @author: Leny
     * @date: 2019/01/01 00:00:00
     */
    public function delete(){
        if(!isset($this->input['id'])) $this->_return(-1,'请选择你要删除的数据');
        $id = $this->input['id'];
        $res = $this->table('order')->where(['id'=>$id])->delete();
        if($res){
            $this->_return(0,'删除成功');
        }
        $this->_return(-1,'删除失败');
    }

}
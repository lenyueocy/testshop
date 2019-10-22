<?php
namespace Model;

use Constants\TBS;
use Common\Functions;
use Constants\SiteConst;

class OrderModel extends BasicModel
{

    protected $table = TBS::ORDER;

    public function add($userid, $num, $fee,$cash,$downpoint,$giftpoint,$name, $mobile, $address, $fromid,$mark = "")
    {
        return $this->insert([
            'orderno' => Functions::orderno(),
            'userid' => $userid,
            'orderfee' => round($fee-$cash,2),
            'goodsfee' => $fee,
            'couponfee'=>$cash,
            'downpoint'=>$downpoint,
            'giftpoint'=>$giftpoint,
            'goodsnum'=>$num,
            'name' => $name,
            'mobile' => $mobile,
            'address' => $address['ext'] ? $address['address'] . '(' . $address['ext'] . ')' : $address['address'],
            'groupername' => $address['realname'],
            'groupermobile' => $address['mobile'],
            'grouparea' => $address['title'],
            'addtime' => Functions::date(),
            'updatetime' => Functions::date(),
            'mark'=>$mark,
            'fromid' => $fromid
        ]);
    }

    public function findById($orderid)
    {
        return $this->find(['id'=>$orderid,'isdel'=>SiteConst::NO_VALUE]);
    }

    public function findByOrderno($orderno)
    {
        return $this->find([
            'orderno' => $orderno
        ]);
    }

    public function setPayno($orderid, $orderno,$payno)
    {
        return $this->update([
            'id' => $orderid
        ], [
            'payno' => $payno,
            'orderno'=>$orderno,
            'updatetime' => Functions::date()
        ]);
    }

    public function getNewOrder() {
        $where = ['b.status'=>['>',SiteConst::ORDER_STATUS_PEDDING]];
        return $this->init('b')
            ->join(TBS::USER, 'c', 'c.id=b.userid')
            ->where($where)
            ->field('b.addtime,c.nickname,c.headpic')
            ->order('b.addtime desc')->page(1,10);

    }

    public function setPay($orderid, $transid)
    {
        return $this->update([
            'id' => $orderid
        ], [
            'status' => SiteConst::ORDER_STATUS_PAY,
            'transid' => $transid,
            'updatetime' => Functions::date()
        ]);
    }


    public function setRefund($orderid, $refundid)
    {
        return $this->update([
            'id' => $orderid
        ], [
            'refundstate' => 1,
            'refundid' => $refundid
        ]);
    }
    
    public function setCancel($orderid)
    {
        return $this->update([
            'id' => $orderid
        ], [
            'status' => SiteConst::ORDER_STATUS_CANCEL,
            'updatetime' => Functions::date()
        ]);
    }
    
    public function setUserRevieve($orderid) {
        return $this->update([
            'id' => $orderid
        ], [
            'status' => SiteConst::ORDER_STATUS_COMMENT,
            'updatetime' => Functions::date()
        ]);
    }

    public function setZtRevieve($orderid) {
        return $this->update([
            'id' => $orderid
        ], [
            'status' => SiteConst::ORDER_STATUS_RECIEVE

        ]);
    }
    
    public function setGrouperRevieve($orderid) {
        return $this->update([
            'id' => $orderid
        ], [
            'status' => SiteConst::ORDER_STATUS_RECIEVE,
            'updatetime' => Functions::date()
        ]);
    }
    
    public function userOrder($userid,$status) {
        return $this->init()
            ->where([
                'status'=>['in',$status],
                'userid'=>$userid,
                'isdel'=>SiteConst::NO_VALUE
            ])
            ->field('payno,transid,type,updatetime,siteid,isdel,fromid,userid,refundstate',true)
            ->order('id desc')
            ->result('select');
    }

    public function searchOrder($userid,$status,$keyword='',$p,$num) {

        $sqlObj= $this->init()
            ->where([
                //'status'=>['gt',-1],
                'userid'=>$userid,
                'orderno'=>['like','%'.$keyword.'%'],
                'isdel'=>SiteConst::NO_VALUE
            ])
            ->field('payno,transid,type,updatetime,siteid,isdel,fromid,userid',true)
            ->order('id desc');
           if ($num) {
               return $sqlObj->page($p, $num,false);
           }
        return $sqlObj->result('select');

    }
    
    public function grouperOrder($fromid,$status,$p, $num){

        $sqlObj = $this->init()
            ->where([
                'status'=>['in',$status],
                'fromid'=>$fromid,
                'isdel'=>SiteConst::NO_VALUE
            ])
            ->field('payno,transid,type,updatetime,siteid,isdel,fromid,userid',true)
            ->order('id desc');
            if ($num) {
                return $sqlObj->page($p, $num,false);
        }
        return $sqlObj->result('select');
    }




    /**
     * 查询待自提和暂不可提
     */
    public function grouperCodeOrder($fromid,$userid){
        $ztinfo = $this->init()
            ->where([
                'status'=>['in',"4"],
                'fromid'=>$fromid,
                'userid'=>$userid,
                'isdel'=>SiteConst::NO_VALUE
            ])
            ->field('payno,transid,type,updatetime,siteid,isdel,fromid,userid',true)
            ->order('id desc')->result('select');

        $noinfo = $this->init()
            ->where([
                'status'=>['in',"2,3"],
                'fromid'=>$fromid,
                'userid'=>$userid,
                'isdel'=>SiteConst::NO_VALUE
            ])
            ->field('payno,transid,type,updatetime,siteid,isdel,fromid,userid',true)
            ->order('id desc')->result('select');

        return array('noinfo'=>$noinfo,'ztinfo'=>$ztinfo);
    }


    
    public function countByfrom($userid,$start,$end) {
        $count = $this->init()
            ->where([
                'fromid'=>$userid,
                'addtime'=>['between',[$start,$end]],
                'status'=>['>',1]
            ])
            ->field('count(id) as orderNum,sum(orderfee) as saleFee,sum(goodsnum) as goodsTotal')
            ->result('find');
        $countField = ['orderNum','saleFee','goodsTotal'];
        foreach ($countField as $field) {
            if (!isset($count[$field])) {
                $count[$field] = 0;
            }
        }
        $count['incomeFee'] = $count['saleFee']*SiteConst::INCOME_ORDER_SCALE;
        $count['start'] = date('Y年m月d日H:i:s',strtotime($start));
        $count['end'] = date('Y年m月d日H:i:s',strtotime($end));
        return $count;
    }
    
    public function getOrderInfo($orders) {
        return $this->init('a')
            ->join(TBS::USER, 'b', 'a.userid=b.id')
            ->where([
                'id'=>['in',$orders],
                'status'=>['>',SiteConst::ORDER_STATUS_PEDDING]
            ])
            ->field('a.addtime,b.nickname.b.headpic')
            ->result('select');
    }
    
    public function delById($orderid) {
        return $this->update([
            'id' => $orderid
        ], [
            'isdel' => SiteConst::YES_VALUE,
            'updatetime' => Functions::date()
        ]);
    }
}
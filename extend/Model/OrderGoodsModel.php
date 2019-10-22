<?php
namespace Model;

use Constants\TBS;
use Constants\SiteConst;

class OrderGoodsModel extends BasicModel
{

    protected $table = TBS::ORDER_GOODS;

    public function addBatch($orderGoods)
    {
        return $this->getTb()->insertAll($orderGoods);
    }
    
    public function selectForCancel($orderid) {
        return $this->init()
            ->where(['orderid'=>$orderid])
            ->field('goodsid,num')
            ->result('select');
    }
    public function selectForGoods($orderid) {
        return $this->init()
            ->where(['orderid'=>$orderid])
            ->field('goodsid,num,title')
            ->result('select');
    }
    
    public function selectByOrder($orderId){
        $orderGoods = $this->init()
            ->where(['orderid'=>['in',$orderId]])
            ->field('orderno,id,goodsno,fromid,weight,totalweight',true)
            ->result('select');
        $return = [];
        foreach ($orderGoods as $guds) {
            if (!isset($return[$guds['orderid']])) {
                $return[$guds['orderid']] = [];
            }
            $return[$guds['orderid']][] = $guds;
        }
        return $return;
    }
    
    public function getBuyRecord($goodsid) {
        $where = ['b.status'=>['>',SiteConst::ORDER_STATUS_PEDDING]];
        if ($goodsid) {
            $where['a.goodsid'] = ['in',$goodsid];
        }
        return $this->init('a')
            ->join(TBS::ORDER, 'b', 'a.orderid=b.id')
            ->join(TBS::USER, 'c', 'c.id=b.userid','inner')
            ->where($where)
            ->field('a.goodsid,b.addtime,c.id,c.nickname,c.headpic,a.num as buyNum')
            ->order('b.addtime desc')
            ->result('select');
    }


    
    public function getIncome($orderid) {
        $list = $this->init('a')
            ->join(TBS::GOODS, 'b', 'a.goodsid=b.id')
            ->field('a.totalprice,b.scale')
            ->where(['a.orderid'=>$orderid])
            ->result('select');
        $total = 0;
        foreach ($list as $row) {
            $total += $row['totalprice']*($row['scale']/100);
        }
        return round($total,2);
    }
}
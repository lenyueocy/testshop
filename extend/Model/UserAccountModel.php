<?php
namespace Model;

use Constants\TBS;
use Common\Functions;
use think\Db;
class UserAccountModel extends BasicModel
{

    protected $table = TBS::USER_ACCOUNT;

    public function add($userid, $orderid, $orderfee, $scale, $scalefee, $from)
    {
        return $this->insert([
            'userid' => $userid,
            'orderid' => $orderid,
            'orderfee' => $orderfee,
            'scale' => $scale,
            'scalefee' => $scalefee,
            'fromid' => $from,
            'addtime' => Functions::date()
        ]);
    }
    
    public function lists($userid) {
        return $this->init('a')
            ->join(TBS::ORDER, 'b', 'a.orderid=b.id')
            ->where(['a.userid'=>$userid])
            ->field('a.id,a.orderfee,a.scale,a.scalefee,a.addtime,b.orderno,a.type')
            ->order('a.addtime desc')
            ->result('select');
    }

    public function srlists($userid,$start,$end) {
        if($end>0&&$end>=$start){
           // searchWhere['a.addtime'] = ['between', [field.start + ' 00:00:00', field.end + ' 23:59:59']];
            return $this->init('a')
                ->join(TBS::ORDER, 'b', 'a.orderid=b.id')
                ->where(['a.userid'=>$userid,'a.addtime'=>['between', [$start.' 00:00:00', $end. ' 23:59:59']]])
                ->field('a.id,a.orderfee,a.scale,a.scalefee,a.addtime,b.orderno,a.type')
                ->order('a.addtime desc')
                ->result('select');
        }
        return $this->init('a')
            ->join(TBS::ORDER, 'b', 'a.orderid=b.id')
            ->where(['a.userid'=>$userid])
            ->field('a.id,a.orderfee,a.scale,a.scalefee,a.addtime,b.orderno,a.type')
            ->order('a.addtime desc')
            ->result('select');
    }
    //commisstion
    public function commisstion($userid){
        $totalinfo = Db::table($this->table)->field('sum(scalefee) as t')->where(['userid'=>$userid,'type'=>1])->find();
        $total =round($totalinfo['t'],2);
        $withdrawinfo = Db::table($this->table)->field('sum(scalefee) as t')->where(['userid'=>$userid,'type'=>2])->find();
        $withdraw =round($withdrawinfo['t'],2);
        $price = round($total-$withdraw,2);
        return ['total'=>$total,'withdraw'=>$withdraw,'price'=>$price];
    }

}
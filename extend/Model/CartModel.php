<?php
namespace Model;

use Constants\TBS;
use Common\Functions;
use Constants\SiteConst;

class CartModel extends BasicModel
{

    protected $table = TBS::CART;
    
    public function selectById($userid,$cart) {
        return $this->init()
            ->where([
                'userid'=>$userid,
                'status'=>SiteConst::STATUS_NORMAL,
                'id'=>['in',$cart]
            ])
            ->field('goodsid,skuid,num')
            ->result('select');
    }
    
    public function userAll($userid) {
        return $this->init()
            ->where([
                'userid'=>$userid,
                'status'=>SiteConst::STATUS_NORMAL
            ])
            ->field('id,goodsid,skuid,num,status')
            ->result('select');
    }
    
    public function addSingle($userid,$goodsid,$skuid,$num) {
        $exit = $this->cartExit($userid, $goodsid, $skuid);
        if ($exit) {
            return $this->updateNum($exit['id'], $exit['num']+$num);
        }
        return $this->insert([
            'userid'=>$userid,
            'goodsid'=>$goodsid,
            'skuid'=>$skuid,
            'num'=>$num,
            'addtime'=>Functions::date(),
        ]);
    }
    
    public function updateNum($cartid,$num) {
        return $this->update([
            'id'=>$cartid
        ], [
            'num'=>$num
        ]);
    }
    
    public function delCart($userid,$cartid) {
        return $this->update([
                'userid'=>$userid,
                'id'=>['in',$cartid]
            ], [
                'status'=>SiteConst::STATUS_DISABLED
            ]);
    }
    
    protected function cartExit($userid,$goodsid,$skuid) {
        return $this->init()
            ->where([
                'userid'=>$userid,
                'goodsid'=>$goodsid,
                'skuid'=>$skuid,
                'status'=>SiteConst::STATUS_NORMAL
            ])
            ->result('find');
    }
}
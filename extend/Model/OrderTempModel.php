<?php
namespace Model;

use Constants\TBS;
use Common\Functions;

class OrderTempModel extends BasicModel
{

    protected $table = TBS::ORDER_TEMP;
    
    public function add($userid,$cart,$guds,$fromid) {
        return $this->insert([
            'userid'=>$userid,
            'cartid'=>$cart,
            'guds'=>json_encode($guds),
            'fromid'=>$fromid,
            'addtime'=>Functions::date()
        ]);
    }
    
    public function findById($tempid) {
        return $this->find($tempid);
    }
}
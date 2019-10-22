<?php
namespace Model;

use Constants\TBS;

class AreaModel extends BasicModel
{

    protected $table = TBS::AREA;
    
    public function selectToCount() {
        return $this->init('a')
            ->join(TBS::USER_AREA, 'b', 'a.id=b.areaid','right')->where(['a.status'=>1])
            ->join(TBS::USER, 'c', 'c.id=b.userid')
            ->field('a.lat,a.lng,a.title,a.address,b.userid,c.realname,c.headpic')
            ->result('select');
    }

}
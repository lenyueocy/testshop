<?php
namespace Model;

use Constants\TBS;

class UserAreaModel extends BasicModel
{

    protected $table = TBS::USER_AREA;
    
    public function getAddress($userid) {
        return $this->init('a')
            ->join(TBS::AREA, 'b', 'a.areaid=b.id')
            ->join(TBS::USER,'c','c.id=a.userid')
            ->where(['a.userid'=>$userid])
            ->field('b.id,b.title,b.address,b.lat,b.lng,a.ext,c.realname,c.mobile')
            ->result('find');
    }
    
    public function setExt($userid,$ext) {
        return $this->update(['userid'=>$userid], ['ext'=>$ext]);
    }
}
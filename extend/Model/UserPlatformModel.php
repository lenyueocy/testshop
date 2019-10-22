<?php
namespace Model;

use Constants\TBS;
use Common\Data;
class UserPlatformModel extends BasicModel
{
    protected $table = TBS::USER_PLATFORM;
    
    public function findByOpenid($openid) {
        return $this->find(['openid'=>$openid]);
    }
    
    public function findByUnionid($unionid) {
        return $this->find(['unionid'=>$unionid]);
    }
    
    public function findOpenid($userid) {
        return $this->find(['userid'=>$userid,'site'=>Data::instance()->site]);
    }
    
    public function findByUserid($userid,$site) {
        return $this->find(['userid'=>$userid,'site'=>$site]);
    }
    
    public function createPlate($userid,$openid,$unionid) {
        $add = [
            'userid'=>$userid,
            'unionid'=>$unionid,
            'openid'=>$openid,
            'site'=>Data::instance()->site,
        ];

        return $this->insert($add);
    }
}
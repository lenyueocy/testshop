<?php
namespace Model;

use Constants\TBS;
use Common\Data;
use Common\Functions;
class UserSessionModel extends BasicModel
{
    protected $table = TBS::USER_SESSION;
    
    public function findSession() {
        $find = false;
        if (!Data::instance()->session) {
            $find = $this->find(['sessionkey'=>Data::instance()->_s]);
        }
        if ($find) {
            Data::instance()->{'session'.$find['userid']} = $find;
            Data::instance()->session = $find;
        }
        return Data::instance()->session;
    }
    
    public function findByUserid($userid) {
        if (!Data::instance()->{'session'.$userid}) {
            Data::instance()->{'session'.$userid} = $this->find(['userid'=>$userid]);
        }
        return Data::instance()->{'session'.$userid};
    }
    
    public function createSession($userid) {
        $add = [
            'userid'=>$userid,
            'sessionkey'=>'sess_'.Functions::randStr(32,''),
            'addtime'=>Functions::date(),
            'updatetime'=>Functions::date(),
        ];
        return $this->insert($add);
    }
    
    public function getSession($userid) {
        $find = $this->findSession();
        if ($find) {
            return $find['sessionkey'];
        }
        $userSession = $this->findByUserid($userid);
        if (!$userSession) {
            $userSession = $this->createSession($userid);
        }
        return $userSession['sessionkey'];
    }
}
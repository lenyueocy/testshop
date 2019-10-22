<?php
namespace Model;

use Constants\TBS;
use Constants\SiteConst;
use Common\Functions;

class UserMessageModel extends BasicModel
{

    protected $table = TBS::USER_MESSAGE;
    
    public function userMessage($userid) {
        return $this->init()
            ->where(['userid'=>$userid])
            ->result('column','messageid');
    }
    
    public function setRead($userid,$msgid) {
        return $this->insert([
            'userid'=>$userid,
            'messageid'=>$msgid,
            'isread'=>SiteConst::YES_VALUE,
            'addtime'=>Functions::date(),
            'updatetime'=>Functions::date(),
        ]);
    }
}
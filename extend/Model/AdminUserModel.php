<?php
namespace Model;

use Constants\TBS;
use Constants\SiteConst;

class AdminUserModel extends BasicModel
{

    protected $table = TBS::ADMIN_USER;
    
    public function selectAll() {
        return $this->getTb()
            ->where(['status'=>SiteConst::STATUS_NORMAL])
            ->column('id,mobile');
    }
}
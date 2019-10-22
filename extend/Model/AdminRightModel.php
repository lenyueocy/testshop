<?php
namespace Model;

use Constants\TBS;

class AdminRightModel extends BasicModel
{

    protected $table = TBS::ADMIN_RIGHT;

    public function getRightByRole($roleid)
    {
        return $this->getTb()
            ->where(['roleid'=>$roleid])
            ->column('nodeid');
    }
}
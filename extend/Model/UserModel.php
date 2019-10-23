<?php
namespace Model;
use think\Db;
use Constants\TBS;
use Common\Data;
use QiniuSdk\Qiniu;
use Common\Functions;
use Constants\SiteConst;

class UserModel extends BasicModel
{

    protected $table = TBS::USER;

    public function add($userid)
    {

    }


}
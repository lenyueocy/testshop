<?php
namespace Model;

use Constants\TBS;

class AdminNodeModel extends BasicModel
{

    protected $table = TBS::ADMIN_NODE;
    
    public function selectNodeByIn($in) {
        return $this->getTb()
            ->where(['id'=>['in',$in]])
            ->field('id,title,type,parentid,sort,controller,action')
            ->order('sort asc,id desc')
            ->select();
    }
    
    public function selectAllNode() {
        return $this->getTb()
            ->field('id,title,type,parentid,sort,controller,action,1 as hasRight,LOWER(CONCAT_WS("/", `controller`, `action`)) AS uri')
            ->order('sort asc,id desc')
            ->select();
    }
}
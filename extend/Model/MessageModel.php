<?php
namespace Model;

use Constants\TBS;

class MessageModel extends BasicModel
{

    protected $table = TBS::MESSAGE;
    
    public function selectList() {
        return $this->init()
            ->where(['type'=>1])
            ->field('id,title,content,addtime')->order('addtime desc')
            ->result('select');
    }
}
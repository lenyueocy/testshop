<?php
namespace Model;

use Constants\TBS;

class CategoryModel extends BasicModel
{

    protected $table = TBS::CATEGORY;
    
    public function lists() {
        return $this->getTb()
            ->field('id,title')->order('sort asc')
            ->select();
    }
    
}
<?php 
namespace Model;

use Constants\TBS;
class SwiperModel extends BasicModel{
    protected $table = TBS::SWIPER;
    
    public function getList() {
        return $this->init()
            ->field('title,type,params,sign')
            ->result('select');
    }
}
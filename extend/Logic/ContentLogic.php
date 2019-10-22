<?php
namespace Logic;

use Model\SwiperModel;
use Constants\SiteConst;
class ContentLogic extends BasicLogic
{
    public static function swiper() {
        $swiperMod = new SwiperModel();
        $swiper = $swiperMod->getList();
        foreach ($swiper as $key=>$sp) {
            $sp['imageUrl'] = CommonLogic::findResource($sp['sign'], SiteConst::IMAGE_SINGLE);
            $swiper[$key] = $sp;
        }
        return $swiper;
    }
}
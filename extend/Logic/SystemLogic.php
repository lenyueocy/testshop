<?php
namespace Logic;

use Common\Data;
use Model\AppModel;
use Constants\SiteConst;

class SystemLogic extends BasicLogic
{
    public static function checkApp() {
        if (Data::instance()->v != SiteConst::DEFAULT_VERSION) {
            self::error(10003);
        }
        if (Data::instance()->timestamp < (time()-SiteConst::API_TIME_OUT)) {
            self::error(10004);
        }
        $appMod = new AppModel();
        Data::$app = $appMod->findByAppId(Data::instance()->appid);
        if (!Data::$app) {
            self::error(10005);
        }
        return true;
    }
    
}
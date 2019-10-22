<?php
namespace Logic\Device;

use Constants\SiteConst;
use Common\Functions;
class PinyuanMachine extends DeviceDriver
{
    public function general($machineid, $num, $machineCode ,$addid){
        $boxAdd = [];
        for ($i = 1; $i <= $num; $i++) {
            $boxAdd[] = [
                'machineid' => $machineid,
                'machineid'=>$machineCode,
                'title' => $i,
                'code' => $i,
                'group' => 1,
                'open' => SiteConst::NO_VALUE,
                'status' => SiteConst::BOX_STATUS_EMPTY,
                'addtime' => Functions::date(),
                'addid' => $addid,
                'updatetime' => Functions::date(),
                'updateid' => $addid
            ];
        }
        return $this->model->batchAdd($boxAdd);
    }
    
    public function fitup($box,$codeno) {
        return true;
    }
    
    public function codeDinner($box,$codeno) {
        return true;
    }
}
<?php
namespace Logic\Device;

use Constants\SiteConst;
use Common\Functions;
use Model\MachineTaskModel;

class ZhongjiMachine extends DeviceDriver
{

    public function general($machineid, $num,$machineCode, $addid)
    {
        $groupNum = $num / SiteConst::ZHONGJI_GROUP_NUM;
        $boxAdd = [];
        for ($i = 1; $i <= $groupNum; $i ++) {
            for ($j = 1; $j <= SiteConst::ZHONGJI_GROUP_NUM; $j ++) {
                $code = $i . str_pad($j, 2, "0", STR_PAD_LEFT);
                $boxAdd[] = [
                    'machineid' => $machineid,
                    'machineno'=>$machineCode,
                    'title' => $code,
                    'code' => $code,
                    'group' => $i,
                    'open' => SiteConst::NO_VALUE,
                    'status' => SiteConst::BOX_STATUS_EMPTY,
                    'addtime' => Functions::date(),
                    'addid' => $addid,
                    'updatetime' => Functions::date(),
                    'updateid' => $addid
                ];
            }
        }
        return $this->model->batchAdd($boxAdd);
    }
    
    public function fitup($box,$codeno) {
        return $this->addTask($box);
    }
    
    public function codeDinner($box,$codeno) {
        return $this->addTask($box);
    }
    
    private function addTask($boxes,$after = '') {
        $task = [];
        foreach ($boxes as $box) {
            $task[] = [
                'machineid'=>$box['machineid'],
                'machinecode'=>$box['machineno'],
                'cupboardid'=>$box['id'],
                'cupboardcode'=>$box['code'],
                'status'=>SiteConst::TASK_STATUS_PEDDING,
                'after'=>$after,
                'addtime'=>Functions::date(),
                'updatetime'=>Functions::date(),
            ];
        }
        $taskMod = new MachineTaskModel();
        return $taskMod->addTask($task);
    }
}
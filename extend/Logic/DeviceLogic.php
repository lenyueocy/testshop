<?php
namespace Logic;

use Common\Data;
use Model\GroupModel;
use Model\MachineModel;
use Constants\SiteConst;
use Model\AdminUserModel;
use Model\MachineCupboardModel;
use Logic\Device\ZhongjiMachine;
use Logic\Device\PinyuanMachine;

class DeviceLogic extends BasicLogic
{

    public static function position()
    {
        if (! Data::$app['groups'] || empty(Data::$app['groups'])) {
            return [];
        }
        // 获取点位
        $groupMod = new GroupModel();
        $groups = $groupMod->selectById(Data::$app['groups']);
        
        // 获取机器
        $machineMod = new MachineModel();
        $machines = $machineMod->selectByGroupId(Data::$app['groups']);
        
        // 获取后台用户
        $adminUserMod = new AdminUserModel();
        $users = $adminUserMod->selectAll();
        
        // 拼装返回
        $return = [];
        foreach ($groups as $g) {
            $people = explode(',', $g['users']);
            $g['contact'] = [];
            foreach ($people as $p) {
                if ($users[$p]) {
                    $g['contact'][] = $users[$p];
                }
            }
            $return[] = [
                'posid' => $g['id'],
                'title' => $g['title'],
                'location' => $g['location'],
                'devices' => isset($machines[$g['id']]) ? $machines[$g['id']] : [],
                'contact' => $g['contact']
            ];
        }
        return $return;
    }

    public static function machineInfo()
    {
        $machineMod = new MachineModel();
        return $machineMod->info(Data::instance()->deviceid);
    }

    public static function machineBox()
    {
        $cupboardMod = new MachineCupboardModel();
        return $cupboardMod->selectByMid(Data::instance()->deviceid);
    }

    public static function generalBox($machineid, $machineType, $num, $addid)
    {
        return self::typeMachine($machineType)->general($machineid, $num, $addid);
    }

    public static function reGeneralBox($machineid, $machineType, $num, $machineCode ,$addid)
    {
        $model = new MachineCupboardModel();
        $model->delByMachineId($machineid);
        return self::typeMachine($machineType)->general($machineid, $num, $machineCode ,$addid);
    }

    public static function adminDel($dataId)
    {
        $machineMod = new MachineModel();
        $boxMod = new MachineCupboardModel();
        $machine = $machineMod->selectToDel($dataId);
        if (empty($machine)) {
            return true;
        }
        $machineMod->delAdmin($machine);
        $boxMod->delByMachineId($machine);
        return true;
    }

    public static function typeMachine($machineType)
    {
        if ($machineType == SiteConst::MACHINE_TYPE_ZHONGJI) {
            return new ZhongjiMachine();
        }
        if ($machineType == SiteConst::MACHINE_TYPE_PINYUAN) {
            return new PinyuanMachine();
        }
        self::error(30001);
    }
}
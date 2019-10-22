<?php
namespace Logic;

use Common\Data;
use think\Exception;
use Model\MachineModel;
use app\job\MachineJop;
use Constants\SiteConst;
use Model\MachineCupboardModel;

class BoxLogic extends BasicLogic
{
    public static function boxInfo() {
        $boxMod = new MachineCupboardModel();
        $info = $boxMod->findById(Data::instance()->boxid);
        if (!$info) {
            self::error(30002);
        }
        return $info;
    }
    
    public static function boxReserve() {
        $boxid = explode(',', Data::instance()->boxid);
        if (empty($boxid)) {
            self::error(10001);
        }
        $boxMod = new MachineCupboardModel();
        $boxes = $boxMod->selectById($boxid);
        if (count($boxid) != count($boxes)) {
            self::error(30002);
        }
        $machines = array_unique(array_column($boxes, 'machineid'));
        if (count($machines) != 1) {
            self::error(30004);
        }
        foreach ($boxes as $box) {
            if ($box['status'] != SiteConst::BOX_STATUS_EMPTY) {
                self::error(30003);
            }
        }
        $boxMod->boxReserve($boxid, Data::instance()->owner);
        MachineJop::add($boxid);
        return true;
    }
    
    public static function boxFitup() {
        $boxid = explode(',', Data::instance()->boxid);
        if (empty($boxid)) {
            self::error(10001);
        }
        $boxMod = new MachineCupboardModel();
        $boxes = $boxMod->selectById($boxid);
        if (count($boxid) != count($boxes)) {
            self::error(30002);
        }
        $machines = array_unique(array_column($boxes, 'machineid'));
        if (count($machines) != 1) {
            self::error(30004);
        }
        foreach ($boxes as $box) {
            if (!in_array($box['status'], [SiteConst::BOX_STATUS_EMPTY,SiteConst::BOX_STATUS_RESERVE])) {
                self::error(30005);
            }
            if ($box['status'] == SiteConst::BOX_STATUS_RESERVE) {
                if ($box['owner'] != Data::instance()->owner) {
                    self::error(30006);
                }
            }
        }
        $machineMod = new MachineModel();
        $machine = $machineMod->info($machines['0']);
        try {
            self::startTrans();
            $codeno = CommonLogic::codeno();
            DeviceLogic::typeMachine($machine['type'])->fitup($boxes, $codeno);
            $boxMod->boxFitup($boxid,$codeno);
            self::commit();
        } catch (Exception $e) {
            self::rollback();
            throw $e;
        }
        return ['codeno'=>$codeno];
    }
    
    public static function codeDinner() {
        $boxMod = new MachineCupboardModel();
        $boxes = $boxMod->selectByCodeno(Data::instance()->codeno);
        if (empty($boxes)) {
            self::error(30007);
        }
        $machineMod = new MachineModel();
        $machine = $machineMod->info($boxes['0']['machineid']);
        try {
            self::startTrans();
            DeviceLogic::typeMachine($machine['type'])->codeDinner($boxes, Data::instance()->codeno);
            $boxMod->codeDinner(Data::instance()->codeno);
            self::commit();
        } catch (Exception $e) {
            self::rollback();
            throw $e;
        }
        return [];
    }
    
    public static function cancelReserve($box) {
        $boxMod = new MachineCupboardModel();
        $boxes = $boxMod->selectById($box);
        $temp = [];
        foreach ($boxes as $bx) {
            if ($bx['status'] == SiteConst::BOX_STATUS_RESERVE && $bx['expiretime'] <= time()) {
                $temp[] = $bx['id'];
            }
        }
        if (!empty($temp)) {
            $boxMod->cancelReserve($temp);
        }
        return true;
    }
}
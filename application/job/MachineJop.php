<?php
namespace app\job;

use think\queue\Job;
use think\Exception;
use think\Queue;
use Constants\SiteConst;
use Logic\BoxLogic;
class MachineJop
{
    public static function add($boxid) {
        Queue::later(SiteConst::BOX_RESERVE_TIMEOUT+1, 'MachineJop',$boxid);
        return true;
    }
    
    public function fire(Job $job, $data){
        try {
            BoxLogic::cancelReserve($data);
        } catch (Exception $e) {
            
        }
        $job->delete();
    }
    
    public function failed($data){
    
        // ...任务达到最大重试次数后，失败了
    }
}
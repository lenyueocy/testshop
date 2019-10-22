<?php
namespace app\job;

use think\queue\Job;
use think\Exception;
use think\Queue;
use Constants\SiteConst;
use Logic\OrderLogic;
use Common\Functions;
class CancelOrderJob
{
    public static function add($orderid) {
        Queue::later(SiteConst::ORDER_TIMEOUT+1, 'CancelOrderJob',$orderid);
        return true;
    }
    
    public function fire(Job $job, $data){
        //file_put_contents($_SERVER['DOCUMENT_ROOT']."/test.txt", json_encode($job).'===='.json_encode($data), FILE_APPEND);
        try {
            OrderLogic::cancelOrder($data);
            $job->delete();
        } catch (Exception $e) {
            Functions::record('任务执行报错', ['错误'=>$e]);
            $job->release(SiteConst::ORDER_TIMEOUT);
        }
    }
    public function failed($data){
        
    }
}
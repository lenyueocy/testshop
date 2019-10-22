<?php
namespace Logic\Device;

use think\Exception;
use Logic\BasicLogic;
use Common\Data;
use Model\MachineTaskModel;
class ZhongjiTask extends BasicLogic
{
    private static $handle;
    
    private $machine;
    private $task;
    
    const CODE_TO_FUNC = [
        '1000' => 'asynStock', // 库存同步
        '4000' => 'openClose', // 任务
        '5000' => 'backUp', // 上货反馈
        '5001' => 'backDown'
    ];

    public function __construct()
    {
    }

    public static function init()
    {
        if (! self::$handle) {
            self::$handle = new self();
        }
        return self::$handle;
    }
    
    public function run() {
        $funcs = self::CODE_TO_FUNC;
        $func = $funcs[Data::instance()->FunCode];
        if (!$func) {
            self::error(30009);
        }
        return $this->{$func}();
    }
    
    /**
     * 库存同步
     */
    private function asynStock() {
        return [
            'Status' => "0",
            'SlotNo' => Data::instance()->SlotNo,
            'TradeNo' => Data::instance()->TradeNo,
            'Err' => '成功'
        ];
    }
    
    /**
     * 打开
     */
    private function openClose(){
        $taskMod = new MachineTaskModel();
        $this->task = $taskMod->findToExce(Data::instance()->MachineID);
        if (!$this->task) {
            self::error(30008);
        }
        try {
            self::startTrans();
            //1设置任务为已执行
            $taskMod->setDeal($this->task['id']);
            
            //2执行任务后置方法
            if ($this->task['after'] && method_exists($this, $this->task['after'])) {
                $this->{$this->task['after']}();
            }
            self::commit();
        } catch (Exception $e) {
            self::rollback();
            throw $e;
        }
        return [
            'Status' => '0',
            'MsgType' => '0',
            'TradeNo' => date('YmdHis') . rand(10000, 99999),
            'SlotNo' => $this->task['cupboardcode'],
            'ProductId' => '1',
            'Err' => '成功'
        ];
    }
    
    /**
     * 上货反馈
     */
    private function backUp(){
        return [
            'Status' => '0',
            'SlotNo' => Data::instance()->SlotNo,
            'TradeNo' => Data::instance()->TradeNo,
            'Err' => '成功'
        ];
    }
    
    /**
     * 出货反馈
     */
    private function backDown(){
        return [
            'Status' => '0',
            'SlotNo' => Data::instance()->SlotNo,
            'Err' => '成功'
        ];
    }
}
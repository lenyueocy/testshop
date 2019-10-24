<?php
namespace app\admin\controller;

use Logic\AdminLogic;
use Common\Functions;
use Constants\TBS;
class System extends Common
{
    
    const CONFIG_ITEM = [
        [
            'title'=>'系统',
            'file'=>"system/config/system",
            'sign'=>'system'
        ]
    ];
    
    public function config_list() {

        if ($this->isAjax) {
            $RegExp = '/^((0\d{2,3}\d{7,8})|(1[345789]\d{9}))$/';
            if(!preg_match($RegExp,$_POST['mobile'])){
                return ['status'=>-1,'info'=>'客服热线不正确'];
            }

            $result = AdminLogic::updateConfig($_POST);
            $this->successMsg($result);

        }
        $items = AdminLogic::allConfig();
        $this->assign('configs',$items);
        $this->assign('configItem',self::CONFIG_ITEM);
        return $this->fetch('system/config/list');
    }


    /**
     * 日志管理
     */
    public function config_log(){
        if ($this->isAjax) {
            $data = $this->input;
            $data['p'] = isset($data['p']) && $data['p'] ? $data['p'] : 1;
            $data['num'] = isset($data['num']) && $data['num'] ? $data['num'] : 10;
            $count = $this->tb(TBS::ADMIN_LOG)->count();
            $list = $this->tb(TBS::ADMIN_LOG)
                ->order('id desc')
                ->page($data['p'],$data['num'])
                ->select();
            $return = [
                'p'=>$data['p'],
                'num'=>$data['num'],
                'total'=>$count,
                'rows'=>$list
            ];
            $this->ajaxMsg($return);
        }

        return $this->fetch('system/config/log');

    }
    public function area_list(){
        if ($this->isAjax) {
            $sqlObj = $this->tb(TBS::AREA)->where($this->input['where'])->order('id desc');
            $return = $this->jsonData($sqlObj);
            $this->ajaxMsg($return);
        }
        return $this->fetch('system/area/list');
    }
    
    public function area_add(){
        if ($this->isAjax) {
            //查询小区是否存在
            $info = $this->tb(TBS::AREA)->field('id')->where(['title'=>$this->input['title']])->find();
            if(!empty($info)){
                return ['status'=>-1,'info'=>'小区已经存在，勿重复添加'];
            }

            $return = $this->doAdd(TBS::AREA, $this->input);
            $this->ajaxMsg($return);
        }
        return $this->fetch('system/area/add');
    }
    
    public function area_edit(){
        if ($this->isAjax) {
            //查询小区是否存在
            $map=array('title'=>$this->input['title']);
            $map['id']  = array('neq',$this->input['id']);
            $info = $this->tb(TBS::AREA)->field('id')->where($map)->find();
            if(!empty($info)){
                return ['status'=>-1,'info'=>'小区已经存在，勿重复添加'];
            }

            $return = $this->doUpdate(TBS::AREA, $this->input);
            $this->ajaxMsg($return);
        }
        $detail = $this->detail(TBS::AREA);
        $this->assign('detail',$detail);
    
        return $this->fetch('system/area/edit');
    }
    public function area_deal(){
        $return = $this->doDeal(TBS::AREA);
        $this->ajaxMsg($return);
    }
}
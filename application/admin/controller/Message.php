<?php
namespace app\admin\controller;

use Constants\TBS;
class Message extends Common
{
    public function notice_list() {
        if ($this->isAjax) {
            $sqlObj = $this->tb(TBS::MESSAGE)->where($this->input['where'])->order('addtime desc');
            $data = $this->jsonData($sqlObj);
            $this->ajaxMsg($data);
        }
        return $this->fetch('message/notice/list');
    }
    
    public function notice_add() {
        if ($this->isAjax) {
            $return = $this->doAdd(TBS::MESSAGE, $this->input);
            $this->ajaxMsg($return);
        }
        return $this->fetch('message/notice/add');
    }
    
    public function notice_edit() {
        if ($this->isAjax) {
            $return = $this->doUpdate(TBS::MESSAGE, $this->input);
            $this->ajaxMsg($return);
        }
        $detail = $this->detail(TBS::MESSAGE);
        $this->assign('detail',$detail);
        return $this->fetch('message/notice/edit');
    }
    
    public function notice_del() {
        $return = $this->doDel(TBS::MESSAGE);
        $this->ajaxMsg($return);
    }
}
<?php
namespace Model;

use Constants\TBS;
use Common\Functions;
class ConfigModel extends BasicModel
{
    protected $table = TBS::CONFIG;
    
    protected function beforeUpdate($where,$data) {
        $data['updatetime']=Functions::date();
        $data['updateid'] = session('admin-userid');
        return [$where,$data];
    }
    
    protected function beforeInsert($data) {
        $data['addtime']=Functions::date();
        $data['addid'] = session('admin-userid');
        $data['updatetime']=Functions::date();
        $data['updateid'] = session('admin-userid');
        return $data;
    }
    
    public function updateConfig($sign,$key,$params) {
        $data = $where = ['sign'=>$sign,'key'=>$key];
        $data['params'] = $params;
        return $this->insertOrUpdate($where, $data);
    }
    
    public function selectAll() {
        return $this->getTb()->field('sign,key,params')->select();
    }
    public function selects($id) {
        return $this->getTb()->where(['id'=>$id])->field('id,salestart,saleend,isopen,images')->select();

    }
    public function edit_config($id,$data) {
        return $this->update([
            'id'=>$id
        ],$data);
    }
}
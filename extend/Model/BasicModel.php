<?php
namespace Model;

use think\Db;
use Common\Error;
class BasicModel
{
    protected $table = '';
    
    protected $sqlObj;
    
    protected function init($alias = false){
        $this->sqlObj = null;
        $this->sqlObj = $this->getTb($alias);
        return $this;
    }
    
    /**
     * 更新之前的操作
     * 可以统一修改where条件和更新的数据
     * @param array $where
     * @param array $data
     */
    protected function beforeUpdate($where,$data) {
        return [$where,$data];
    }
    
    /**
     * 更新数据的快捷方法
     * @param unknown $where
     * @param unknown $data
     */
    protected function update($where,$data) {
        if(method_exists($this,'beforeUpdate')){
            list($where,$data) = call_user_func_array(array($this, 'beforeUpdate'), [$where,$data]);
        }
        return $this->getTb()->where($where)->update($data);
    }
    
    /**
     * 新增之前的操作
     * 可以统一修改新增的数据
     * @param array $where
     * @param array $data
     */
    protected function beforeInsert($data) {
        return $data;
    }
    
    /**
     * 新增的快捷方法
     * @param array $data
     */
    protected function insert($data) {
        if(method_exists($this,'beforeInsert')){
            $data = call_user_func_array(array($this, 'beforeInsert'), [$data]);
        }
        $id = $this->getTb()->insertGetId($data);
        $data['id'] = $id;
        return $data;
    }
    
    protected function insertOrUpdate($where,$params){
        $find = $this->find($where,'id');
        if ($find) {
            return $this->update(['id'=>$find['id']], $params);
        }
        return $this->insert($params);
    }
    
    /**
     * 查询单条数据的快捷方法
     * @param array||string $where 可以是数组或数字
     * @param string $field
     */
    protected function find($where,$field = '') {
        $tb = $this->getTb()->field($field);
        if (is_array($where)) {
            return $tb->where($where)->find();
        }else{
            return $tb->where(['id'=>$where])->find();
        }
    }
    
    /**
     * 获取db操作对象
     * @param string $alias 别名
     */
    protected function getTb($alias = false) {
        if ($alias === false) {
            return Db::table($this->table);
        }else{
            return Db::table($this->table)->alias($alias);
        }
    }
    
    /**
     * 设置where条件
     * @param array $where
     */
    protected function where($where){
        $this->sqlObj->where($where);
        return $this;
    }
    
    /**
     * 关联表，默认left join
     * @param string $table 表名
     * @param string $alias 别名
     * @param string $on on条件
     * @param string $join 关联方式
     */
    protected function join($table,$alias,$on,$join = 'left'){
        $this->sqlObj->join($table.' '.$alias,$on,$join);
        return $this;
    }
    
    /**
     * 设置选择字段
     * @param array||string $field
     */
    protected function field($field,$nofield = false) {
        if ($nofield === false) {
            $this->sqlObj->field($field);
        }else{
            $this->sqlObj->field($field,true);
        }
        return $this;
    }
    
    /**
     * 设置别名
     * @param unknown $alias
     */
    protected function alias($alias) {
        $this->sqlObj->alias($alias);
        return $this;
    }
    
    /**
     * 排序
     * @param array||string $order
     */
    protected function order($order) {
        $this->sqlObj->order($order);
        return $this;
    }
    
    /**
     * 获取结果
     * @param string $func tp5支持的获取结果的方法名，select,find,column,value什么的都可以
     * @param string $arg 获取结果的参数
     * @example $this->result('column','id,name,addtime');
     */
    protected function result($func,$arg='') {
        if ($arg === '') {
            return $this->sqlObj->{$func}();
        }
        return $this->sqlObj->{$func}($arg);
    }
    
    protected function page($p,$num,$info = true,$debug=false){
        $p = $p ? $p : 1;
        $num = $num ? $num : 10;
        $sql = $this->sqlObj->buildSql();
        $list = Db::table($sql.' as temp')->page($p,$num)->select();
        if($info){
            $count = Db::table($sql.' as temp')->count();
            $total = ceil($count/$num);
            return [
                'page'=>$p,
                'total'=>$count,
                'totalPage'=>$total,
                'rows'=>$list
            ];
        }
        return $list;
    }
    
    /**
     * 抛错
     * @param 错误码 $code
     */
    protected static function error($code) {
        return Error::errMsg($code);
    }
}
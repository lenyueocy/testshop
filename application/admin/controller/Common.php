<?php
namespace app\admin\controller;

use think\Db;
use think\Session;
use think\Request;
use think\Controller;
use think\Exception;
use QiniuSdk\Qiniu;
use Helper\Html;
use Logic\AdminLogic;
use Common\Functions;
use Logic\CommonLogic;
use Constants\SiteConst;
use Rbac\RbacLib;
class Common extends Controller{
    
    protected $beforeActionList  = [
        'checkLogin'=>['except'=>['login','initdb']],
        'checkRight'=>['except'=>['initdb']]
    ];
    
    protected $input = null;
    
    protected $isAjax = false;
    
    protected $adminid = 0;
    
    protected $rbac;
    
    /**
     * 初始化
     * @see \think\Controller::_initialize()
     */
    public function _initialize() {
        parent::_initialize();
        $this->rbac = new RbacLib();
        
        $this->adminid = Session::get('admin-userid');
        
        $request = Request::instance();
        $this->input = $request->param();
        $ctrl = strtolower($request->controller());
        $action = strtolower($request->action());
        $this->isAjax = $request->isAjax() || $request->isPost();
        
        if($request->isGet()){
            $this->assign('imageUrl','');
            $this->assign('html',new Html());
            $this->assign('siteTitle',SiteConst::ADMIN_SITE_TITLE);
        }
        
        $exp = explode('_', $action);
        $this->assign('ctrl',$ctrl);
        $this->assign('action',$exp['0']);
    }
    
    protected function checkRight() {
        $request = Request::instance();
        $ctrl = strtolower($request->controller());
        $action = strtolower($request->action());
        if (!$this->rbac->check($ctrl.'/'.$action)) {
            if ($this->isAjax) {
                $this->errorMsg('您没有该操作权限');
            }else{
                return $this->redirect('index/noright');
            }
        }
        $this->assign('rbac',$this->rbac);
        return true;
    }
    
    protected function checkLogin() {
        if(!$this->adminid){
            return $this->redirect('Index/login');
        }
        return true;
    }
    
    protected function tb($table){
        return Db::table($table);
    }
    
    /**
     * 返回json
     * @param unknown $data
     * @param unknown $info
     * @param unknown $code
     */
    protected function msgReturn($data,$info,$code) {
        $return  = array('data'=>$data,'info'=>$info,'status'=>$code);
        $this->ajaxMsg($return);
    }
    
    protected function ajaxMsg($return){
        header('Content-Type:application/json;charset=UTF-8;');
        echo json_encode($return,JSON_UNESCAPED_UNICODE);die;
    }
    
    /**
     * 成功返回快捷方法
     * @param string $data
     * @param string $code
     */
    protected function successMsg($data,$code = 1) {
        return $this->msgReturn($data, '',$code);
    }
    
    /**
     * 失败返回快捷方法
     * @param string $info
     * @param string $code
     */
    protected function errorMsg($info,$code = -1) {
        return $this->msgReturn('',$info, $code);
    }
    
    /**
     * 添加表数据
     * @param string $table 表名
     * @param array $params 参数
     * @param array $upload 文件上传
     * @throws Exception
     */
    protected function doAdd($table,$params,$upload=[]) {
        try {
            Db::startTrans();
            $params['addtime'] = date('Y-m-d H:i:s');
            $params['addid'] = $this->adminid;
            $params['updatetime'] = date('Y-m-d H:i:s');
            $params['updateid'] = $this->adminid;

            if (!empty($upload)) {
                $params['sign'] = $this->randSign();
            }
            
            $id = $this->tb($table)
                ->strict(false)
                ->data($params)
                ->insertGetId($params);
            if (!empty($upload)) {
                foreach ($upload as $field) {
                    $this->dealUpload($params['sign'],$field);
                }
            }
            
            Db::commit();
        } catch (Exception $e) {
            Db::rollback();
            $msg = $e->getMessage() ? $e->getMessage() :'服务器正忙，请稍后重试';
            return ['status'=>-1,'info'=>$msg];
        }
        return ['status'=>1,'data'=>$id];
        
    }
    
    protected function detail($table,$upload = false){
        $detail = $this->tb($table)->where(['id'=>$this->input['id']])->find();
        if ($upload && !empty($upload)) {
            if (is_array($upload)) {
                foreach ($upload as $field) {
                    $detail[$field] = CommonLogic::findResourceList($detail['sign'], $field);
                }
            }else{
                $detail[$upload] = CommonLogic::findResourceList($detail['sign'], $upload);
            }
        }

        return $detail;
    }
    
    /**
     * 更新表数据
     * @param string $table 表名
     * @param array $params 参数
     * @throws Exception
     */
    protected function doUpdate($table,$params,$upload=[]) {
        try {
            Db::startTrans();
            $params['updatetime'] = date('Y-m-d H:i:s');
            $params['updateid'] = $this->adminid;

            $id = $params['id'];
            unset($params['id']);
            if(!$id){
                throw new Exception('参数错误');
            }
            
            if (!empty($upload) && !$params['sign']) {
                $params['sign'] = $this->randSign();
            }
            
            $result = $this->tb($table)
                ->strict(false)
                ->where(['id'=>$id])
                ->update($params);
            if (!empty($upload)) {
                foreach ($upload as $field) {
                    $this->dealUpload($params['sign'],$field);
                }
            }
            
            Db::commit();
        } catch (Exception $e) {
            Db::rollback();
            $msg = $e->getMessage() ? $e->getMessage() :'服务器正忙，请稍后重试';
            return ['status'=>-1,'info'=>$msg];
        }
       // file_put_contents($_SERVER['DOCUMENT_ROOT']."/test.txt", $result, FILE_APPEND);
        return ['status'=>1,'data'=>$id];
    
    }


    /**
     * 修改积分
     * @param string $table 表名
     * @param array $params 参数
     * @throws Exception
     */
    protected function pointedit($table,$params,$upload=[]) {
        try {

            Db::startTrans();
            $data = array();
            $data['addtime'] = time();
            //用户ID
            $id = $params['id'];
            unset($params['id']);
            if(!$id){
                throw new Exception('参数错误');
            }
            //积分数量
            $num = intval($params['num']);

            if($num<0){
                throw new Exception('积分不能小于0');
            }
            if($num>9999){
                throw new Exception('积分不能大于9999');
            }
            //查询现有积分
            $point = $this->tb($table)->where(['userid'=>$id])->field('id,total')->order(['id'=>'desc'])->find();
            $total  = intval($point['total']);

            if($num!=$total){
                //增加一条积分记录
                $data['title']='系统修改';
                $data['userid']=$id;
                $data['num']=$num-$total;
                $data['total']=$num;

                $result = $this->tb($table)->insert($data);
            }

            Db::commit();
        } catch (Exception $e) {
            Db::rollback();
            $msg = $e->getMessage() ? $e->getMessage() :'服务器正忙，请稍后重试';
            return ['status'=>-1,'info'=>$msg];
        }
        // file_put_contents($_SERVER['DOCUMENT_ROOT']."/test.txt", $result, FILE_APPEND);
        return ['status'=>1,'data'=>$id];

    }
    
    /**
     * 开启、禁用
     * @param string $table 表名
     * @param string $field 控制的状态的字段
     * @throws Exception
     */
    protected function doDeal($table,$where = [],$field = 'status') {
        try {
            $data = $this->input;
            $params['updatetime'] = date('Y-m-d H:i:s');
            $params['updateid'] = $this->adminid;
            $params[$field] = $data['value'];
            
            if(!$data['dataId']){
                throw new Exception('参数错误');
            }
            $where['id'] = ['in',$data['dataId']];
            $this->tb($table)
                ->strict(false)
                ->where($where)
                ->update($params);
        } catch (Exception $e) {
            $msg = $e->getMessage() ? $e->getMessage() :'服务器正忙，请稍后重试';
            return ['status'=>-1,'info'=>$msg];
        }
        return ['status'=>1,'data'=>$data['dataId']];
        
    }
    
    protected function doDel($table,$where = []) {
        try {
            $data = $this->input;
            if(!$data['dataId']){
                throw new Exception('请选择要操作的选项');
            }
            $where['id'] = ['in',$data['dataId']];
            $this->tb($table)->where($where)->delete();
            
        } catch (Exception $e) {
            $msg = $e->getMessage() ? $e->getMessage() :'服务器正忙，请稍后重试';
            return ['status'=>-1,'info'=>$msg];
        }
        return ['status'=>1,'data'=>$data['dataId']];
    }
    
    /**
     * 获取分页列表数据，为了更加灵活，传入sql对象，
     * 第一步用sql对象获取一条原生sql,
     * 第二步使用子查询查询出结果集总数，这样可以更加完美的获取结果集总数，比如sql对象存在group by
     * 第三步同样使用子查询查询分页结果集
     * @param Object $sqlObj 
     * @return multitype:number float mixed \think\mixed
     */
    protected function jsonData($sqlObj,$debug = false,$page = false){
        
        $data = $this->input;
        $data['p'] = isset($data['p']) && $data['p'] ? $data['p'] : 1;
        $data['num'] = isset($data['num']) && $data['num'] ? $data['num'] : 10;
        
        $sql = $sqlObj->buildSql();
        $count = $this->tb($sql.' as temp')->count();
        if ($page === true) {
            $list = $this->tb($sql.' as temp')->select();
        }else{
            $list = $this->tb($sql.' as temp')
                ->page($data['p'],$data['num'])
                ->select();
        }
        
        
        $return = [
            'p'=>$data['p'],
            'num'=>$data['num'],
            'total'=>$count,
            'rows'=>$list
        ];
        if ($debug === true) {
            $return['sql']=$sql;
        }
        return $return;
    }
    
    protected function randSign() {
        return Functions::randStr(20);
    }
    
    /**
     * 上传处理
     * @param unknown $sign
     * @param unknown $imgs
     * @param unknown $table
     * @param string $field
     */
    protected function dealUpload($sign,$field='single'){
        if (!isset($this->input[$field])) {
            $this->input[$field] = [];
        }
        return AdminLogic::fileUpload($sign, $field,$this->input[$field] );
    }
    
    protected function updateDataVer() {
        CommonLogic::dataVersion(true);
        return true;
    }
}
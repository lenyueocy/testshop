<?php
namespace app\admin\controller;

use Constants\TBS;
use Rbac\RbacLib;
use Common\Functions;

class Rbac extends Common
{
    /**
     * 节点列表
     */
    public function node_list()
    {
        $nodes = $this->tb(TBS::ADMIN_NODE)
            ->field('id,title,sort,parentid')
            ->order('sort asc,id desc')
            ->select();
        if ($this->isAjax) {
            $this->successMsg($nodes);
        }
        $this->assign('category',$nodes);
        return $this->fetch('rbac/node/list');
    }

    /**
     * 节点添加
     */
    public function node_add()
    {
        $data = $this->input;
        if ($this->isAjax) {
            $json = $this->doAdd(TBS::ADMIN_NODE, $data);
            $this->ajaxMsg($json);
        }
        $parent = '';
        if(isset($data['pid']) && $data['pid']){
            $parent = $this->tb(TBS::ADMIN_NODE)->where(['id'=>$data['pid']])->find();
        }
        $this->assign('parent',$parent);
        
        $rbac = new RbacLib();
        $classAction = $rbac->actions();
        $this->assign('classAction',$classAction);
        $this->assign('ctrls',RbacLib::CHECK_CONTROLLER);
        
        return $this->fetch('rbac/node/add');
    }

    /**
     * 节点编辑
     */
    public function node_edit()
    {
        $data = $this->input;
        if ($this->isAjax) {
            $json = $this->doUpdate(TBS::ADMIN_NODE, $data);
            $this->ajaxMsg($json);
        }
        $detail = $this->detail(TBS::ADMIN_NODE);
        $this->assign('detail',$detail);
        
        $parent = '';
        if(isset($detail['parentid'])){
            $parent = $this->tb(TBS::ADMIN_NODE)->where(['id'=>$detail['parentid']])->find();
        }
        $this->assign('parent',$parent);
        
        $rbac = new RbacLib();
        $classAction = $rbac->actions();

        $this->assign('classAction',$classAction);
        $this->assign('ctrls',RbacLib::CHECK_CONTROLLER);
        
        return $this->fetch('rbac/node/edit');
    }

    /**
     * 节点删除
     */
    public function node_del()
    {
        $json = $this->doDel(TBS::ADMIN_NODE);
        $this->ajaxMsg($json);
    }
    
    public function node_sort() {
        foreach ($this->input['sort'] as $item) {
            $this->doUpdate(TBS::ADMIN_NODE, [
                'id'=>$item['id'],
                'sort'=>$item['sort']
            ]);
        }
        $nodes = $this->tb(TBS::ADMIN_NODE)
            ->field('id,title,sort,parentid')
            ->order('sort asc,id desc')
            ->select();
        $this->successMsg($nodes);
    }

    /**
     * 角色列表
     */
    public function role_list()
    {
        if ($this->isAjax) {
            $sqlObj = $this->tb(TBS::ADMIN_ROLE)
                ->field('id,title,desc,status,addtime')
                ->where($this->input['where'])
                ->order('addtime desc');
            $jsonData = $this->jsonData($sqlObj);
            $this->ajaxMsg($jsonData);
        }
        return $this->fetch('rbac/role/list');
    }
    
    /**
     * 角色添加
     */
    public function role_add()
    {
        if ($this->isAjax) {
            if(!isset($this->input['nodes'])){
                $this->ajaxMsg(['status'=>-1,'info'=>'请勾选权限']);
            }

            $info = $this->tb(TBS::ADMIN_ROLE)->where(['title'=>$this->input['title']])->find();
            if(!empty($info)){
                $this->ajaxMsg(['status'=>-1,'info'=>'角色名称已存在']);
            }
            $return = $this->doAdd(TBS::ADMIN_ROLE, $this->input);
            if ($return['status'] == 1) {
                $rightAdd = [];
                foreach ($this->input['nodes'] as $node) {
                    $rightAdd[] = [
                        'roleid'=>$return['data'],
                        'nodeid'=>$node,
                        'addtime'=>Functions::date(),
                        'addid'=>$this->adminid,
                        'updatetime'=>Functions::date(),
                        'updateid'=>$this->adminid,
                    ];
                }
                $this->tb(TBS::ADMIN_RIGHT)->insertAll($rightAdd);
            }
            $this->ajaxMsg($return);
        }
        $nodes = $this->tb(TBS::ADMIN_NODE)
            ->field('id,title,parentid,type')
            ->order('sort asc,id desc')
            ->select();
        foreach ($nodes as $key=>$node) {
            $node['name'] = $node['title'];
            $node['pId'] = $node['parentid'];
            $node['isParent'] = $node['type'] == 3 ? 0 : 1;
            $node['open'] = true;
            $nodes[$key] = $node;
        }
        $this->assign('nodes',$nodes);
        return $this->fetch('rbac/role/add');
    }

    /**
     * 角色编辑
     */
    public function role_edit()
    {
        if ($this->isAjax) {
            $return = $this->doUpdate(TBS::ADMIN_ROLE, $this->input);

            if ($return['status'] == 1) {
                $rightAdd = [];
                foreach ($this->input['nodes'] as $node) {
                    $rightAdd[] = [
                        'roleid'=>$return['data'],
                        'nodeid'=>$node,
                        'addtime'=>Functions::date(),
                        'addid'=>$this->adminid,
                        'updatetime'=>Functions::date(),
                        'updateid'=>$this->adminid,
                    ];
                }
                $this->tb(TBS::ADMIN_RIGHT)->where(['roleid'=>$return['data']])->delete();
                $this->tb(TBS::ADMIN_RIGHT)->insertAll($rightAdd);
            }
            $this->ajaxMsg($return);
        }
        $detail = $this->detail(TBS::ADMIN_ROLE);
        $this->assign('detail',$detail);
        
        $rights = $this->tb(TBS::ADMIN_RIGHT)->where(['roleid'=>$this->input['id']])->column('nodeid');
        
        $nodes = $this->tb(TBS::ADMIN_NODE)
            ->field('id,title,parentid,type')
            ->order('sort asc,id desc')
            ->select();
        foreach ($nodes as $key=>$node) {
            $node['name'] = $node['title'];
            $node['pId'] = $node['parentid'];
            $node['isParent'] = $node['type'] == 3 ? 0 : 1;
            $node['open'] = true;
            $node['checked'] = in_array($node['id'], $rights);
            $nodes[$key] = $node;
        }
        $this->assign('nodes',$nodes);
        return $this->fetch('rbac/role/edit');
    }

    /**
     * 角色删除
     */
    public function role_del()
    {

        $info = $this->tb(TBS::ADMIN_ROLE)->where(['title'=>'超级管理员','id'=>['in',$this->input['dataId']]])->find();
        if($info){
            $this->ajaxMsg(['status'=>-1,'info'=>'超级管理员不能删除']);
        }
        $info1 = $this->tb(TBS::ADMIN_USER)->where(['roleid'=>['in',$this->input['dataId']]])->find();
        if($info1){
            $this->ajaxMsg(['status'=>-1,'info'=>'该角色已被引用，无法被删除']);
        }

        $json = $this->doDel(TBS::ADMIN_ROLE);
        if ($json['status'] == 1) {
            $this->tb(TBS::ADMIN_RIGHT)->where(['roleid'=>['in',$this->input['dataId']]])->delete();
        }
        $this->ajaxMsg($json);
    }

    /**
     * 后台用户列表
     */
    public function admin_list()
    {
        if ($this->isAjax) {
            $sqlObj = $this->tb(TBS::ADMIN_USER)
                ->alias('a')
                ->join(TBS::ADMIN_ROLE.' b', 'a.roleid = b.id', 'left')
                ->join(TBS::USER.' c', 'a.groupid = c.id', 'left')
                ->field('a.id,a.username,a.nickname,a.sex,a.roleid,a.lastlogin,a.status,b.title as rolename,c.nickname as groupnickname,c.realname as grouprealname')
                ->where($this->input['where'])
                ->order('a.addtime desc');

            $jsonData = $this->jsonData($sqlObj);
            $this->ajaxMsg($jsonData);
        }
        return $this->fetch('rbac/admin/list');
    }

    /**
     * 后台用户添加
     */
    public function admin_add()
    {
        if ($this->isAjax) {
            $data = $this->input;
            $data['password'] = md5($data['password']);
            $data['lastlogin']=date('Y-m-d H:i:s');
            $info = $this->tb(TBS::ADMIN_USER)->where(['username'=>$data['username']])->find();
            if(!empty($info)){
                $this->ajaxMsg(['status'=>-1,'info'=>'用户名已存在']);
            }
            $json = $this->doAdd(TBS::ADMIN_USER, $data);
            $this->ajaxMsg($json);
        }
        
        $role = $this->tb(TBS::ADMIN_ROLE)
              ->field('id,title')
              ->select();
        $group = $this->tb(TBS::USER)
            ->field('id,CONCAT(nickname," / ",realname) as realname ')->where(['type'=>2])
            ->select();
        $this->assign('role',$role);
        $this->assign('group',$group);
        
        return $this->fetch('rbac/admin/add');
    }

    /**
     * 后台用户编辑
     */
    public function admin_edit()
    {
        if($this->isAjax){
            if (trim($this->input['password'])) {
                $this->input['password'] = md5($this->input['password']);
            }else{
                unset($this->input['password']);
            }
            $json = $this->doUpdate(TBS::ADMIN_USER, $this->input);
            $this->ajaxMsg($json);
        }
        $this->assign('detail',$this->detail(TBS::ADMIN_USER));

        $role = $this->tb(TBS::ADMIN_ROLE)
              ->field('id,title')
              ->select();
        $this->assign('role',$role);
        $group = $this->tb(TBS::USER)
            ->field('id,CONCAT(nickname," / ",realname) as realname ')->where(['type'=>2])
            ->select();
        $this->assign('group',$group);
        return $this->fetch('rbac/admin/edit');
    }

    /**
     * 后台用户删除
     * 超级管理员不能删除
     */
    public function admin_del()
    {
        $info = $this->tb(TBS::ADMIN_USER)->where(['roleid'=>0,'id'=>['in',$this->input['dataId']]])->find();
        if($info){
            $this->ajaxMsg(['status'=>-1,'info'=>'系统默认超级管理员无法被删除']);
        }
        $json = $this->doDel(TBS::ADMIN_USER, ['roleid'=>['>',0]]);
        $this->ajaxMsg($json);
    }
}
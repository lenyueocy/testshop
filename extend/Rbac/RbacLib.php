<?php
namespace Rbac;

use Model\AdminRightModel;
use Model\AdminNodeModel;
class RbacLib
{
    const CHECK_CONTROLLER = [
        'Goods','File','System','Rbac','Order','Member','Message','Content','Count','Tools'
    ];
    
    private $roleRight = '';
    
    private $allNode = '';
    
    public function actions() {
        $namespace = '\app\admin\controller\\';
        $return = [];
        foreach (self::CHECK_CONTROLLER as $ctrl) {
            $return[$ctrl] = [];
            $class = $namespace.$ctrl;
            $new = new $class();
            $actions = get_class_methods($class);

            foreach ($actions as $act) {
                if (! strpos($act, '_') && $act != 'choose') {
                    continue;
                }
                $return[$ctrl][]= $act;
            }
        }
        return $return;
    }
    
    protected function menu() {
        $evn = require ROOT_PATH.'/evn.php';
        if ($evn === 'develop') {
            return $this->developMenu();
        }
        $html = '';
        foreach ($this->allNode as $node) {
            if ($node['type'] != 1 || $node['hasRight'] != 1) {
                continue;
            }
            $html.='<ul class="m-left-menu"><li class="m-top-title">'.$node['title'].'</li>';
            foreach ($this->allNode as $child) {
                if ($child['parentid'] != $node['id'] || $node['type'] != 1 || $node['hasRight'] != 1) {
                    continue;
                }
                $html.='<li class="m-child-title" data-url="'.url($child['controller']."/".$child['action']).'">'.$child['title'].'</li>';
            }
        }
        return $html;
    }
    
    protected function check($uri) {
        if (!session('admin-roleid')) {
            return true;
        }
        $uri = strtolower($uri);
        $allUri = array_column($this->allNode, 'uri');
        if (!in_array($uri, $allUri)) {
            return true;
        }
        foreach ($this->allNode as $node) {
            if ($node['uri'] != $uri){
                continue;
            }
            if ($node['hasRight'] == 1) {
                return true;
            }else{
                return false;
            }
        }
        return false;
    }
    
    private function getRights() {
        if ($this->roleRight !== '' && $this->allNode !== '') {
            return true;
        }
        $nodeMod = new AdminNodeModel();
        $this->allNode = $nodeMod->selectAllNode();
        
        if (session('admin-roleid')) {
            $rightMod = new AdminRightModel();
            $rightIds = $rightMod->getRightByRole(session('admin-roleid'));
            foreach ($this->allNode as $key=>$node) {
                if (!in_array($node['id'], $rightIds)) {
                    $node['hasRight'] = 0;
                }
                $this->allNode[$key] = $node;
            }
        }
        return true;
    }
    
    private function developMenu() {
        return '<ul class="m-left-menu">
					<li class="m-top-title">商品中心</li>
					<li class="m-child-title" data-url="'.url("goods/goods_list").'">商品管理</li>
					<li class="m-child-title" data-url="'.url("goods/attr_list").'">属性管理</li>
				    <li class="m-child-title" data-url="'.url("goods/brand_list").'">品牌管理</li>
			        <li class="m-child-title" data-url="'.url("goods/category_list").'">分类管理</li>
				</ul>
			    <ul class="m-left-menu">
					<li class="m-top-title">订单中心</li>
					<li class="m-child-title" data-url="'.url("order/order_list").'">订单管理</li>
					<li class="m-child-title" data-url="'.url("order/transfee_list").'">运费规则</li>
				    <li class="m-child-title" data-url="'.url("order/address_list").'">地址管理</li>
				</ul>
		        <ul class="m-left-menu">
					<li class="m-top-title">用户中心</li>
					<li class="m-child-title" data-url="'.url("member/user_list").'">用户管理</li>
				    <li class="m-child-title" data-url="'.url("member/grouper_list").'">团长管理</li>
				</ul>
				<ul class="m-left-menu">
					<li class="m-top-title">消息中心</li>
					<li class="m-child-title" data-url="'.url("message/notice_list").'">团长公告</li>
				</ul>
				<ul class="m-left-menu">
					<li class="m-top-title">内容中心</li>
					<li class="m-child-title" data-url="'.url("content/swiper_list").'">轮播管理</li>
				</ul>
				<ul class="m-left-menu">
					<li class="m-top-title">组织管理</li>
					<li class="m-child-title" data-url="'.url("rbac/node_list").'">节点管理</li>
					<li class="m-child-title" data-url="'.url("rbac/role_list").'">角色管理</li>
					<li class="m-child-title" data-url="'.url("rbac/admin_list").'">用户管理</li>
				</ul>
				<ul class="m-left-menu">
					<li class="m-top-title">系统管理</li>
					<li class="m-child-title" data-url="'.url("system/area_list").'">小区管理</li>
				    <li class="m-child-title" data-url="'.url("count/count_index").'">数据统计</li>
					<li class="m-child-title" data-url="'.url("system/config_list").'">系统配置</li>
					<li class="m-child-title" data-url="'.url("file/choose").'">文件管理</li>
					<li class="m-child-title" data-url="'.url("system/table_refresh").'">更新表名</li>
				</ul>';
    }
    
    public function __call($method,$args) {
        $this->getRights();
        return call_user_func_array([$this,$method], $args);
    }
}
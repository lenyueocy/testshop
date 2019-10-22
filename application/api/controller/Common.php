<?php
namespace app\api\controller;

use think\Controller;
use Common\Error;
use Common\Data;
use think\Exception;
use Logic\SystemLogic;
use think\Request;
use Logic\UcenterLogic;
use Constants\SiteConst;
use Common\Functions;
class Common extends Controller
{
    protected $data = null;
    
    protected $protectNumber = true;
    
    protected $beforeUri = [
        'checkUser'=>[
            'ucenter'=>['login','register','testlogin'],
            'goods'=>['lists','detail','record'],
            'notify'=>['goods'],
            'content'=>['swiper']
        ]
    ];
    
    public function _initialize() {

        parent::_initialize();

        $this->data = Data::instance();
        $this->load(['site'=>['intval',SiteConst::PROGRAM]]);
        $ctrl = strtolower(Request::instance()->controller());
        $action = strtolower(Request::instance()->action());

        if ($this->beforeUri && is_array($this->beforeUri)) {

            foreach ($this->beforeUri as $func=>$opt) {
                if (!method_exists($this, $func) && isset($opt[$ctrl]) && !in_array($action, $opt[$ctrl])) {
                    continue;
                }
                if (!isset($opt[$ctrl]) || !in_array($action, $opt[$ctrl])) {
                    $this->{$func}();
                }
            }
        }

    }
    
    protected function load($fieldArr) {
        return $this->data->load($fieldArr);
    }
    
    protected function ajaxMsg($result) {
        header('Content-Type:application/json;charset=UTF-8;');
        if ($this->protectNumber === true) {
            echo json_encode($result,JSON_UNESCAPED_UNICODE);die;
        }
//         echo json_encode($result,JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK);die;
    }
    
    protected function apiSuccess($data,$code=1,$info = 'success') {
        return $this->ajaxMsg(['status'=>$code,'data'=>$data,'info'=>$info]);
    }
    
    protected function apiError($code) {
        $arr = Error::backMsg($code);
        return $this->ajaxMsg(['status'=>$arr['code'],'info'=>$arr['msg'],'data'=>[]]);
    }
    
    protected function checkUser() {
        $this->load([
            '_s'=>['trim',''],
            '_u'=>['intval',0]
        ]);
        try {
            UcenterLogic::checkUser();
        } catch (Exception $e) {
            return $this->apiError($e->getCode());
        }
        return true;
    }
    
    protected function checkApp() {
        try {
            SystemLogic::checkApp();
        } catch (Exception $e) {
            return $this->apiError($e->getCode());
        }
        return true;
    }
}
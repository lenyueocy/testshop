<?php
namespace app\api\controller;

use Model\ConfigModel;
use think\Exception;
use Logic\UcenterLogic;
use Common\Functions;
use think\Request;


class Ucenter extends Common
{
    /**
     * wx.login拿到的code登录
     */
    public function login()
    {
        try {
            $this->data->load(['code'=> ['trim','']]);

            $data = UcenterLogic::codeLogin();
        } catch (Exception $e) {
            Functions::record('登录失败', ['错误信息'=>$e->getMessage(),'错误'=>$e]);
            return $this->apiError($e->getCode());
        }
        return $this->apiSuccess($data);
    }

    public  function  testlogin(){
        $userid = $_GET['userid'];
        $data = UcenterLogic::testLogin($userid);
        var_dump($data);
    }
    
    /**
     * 上面那个失败后用的
     */
    public function register()
    {

        try {
            $this->data->load([
                'code' => ['trim',''],
                'mobile'=>['trim','13888888888'],
                'iv' => ['trim',''],
                'encryptedData' => ['trim',''],
                'from'=>['intval',0]
            ]);
            $data = UcenterLogic::register();
        } catch (Exception $e) {
            Functions::record('注册失败', ['错误信息'=>$e->getMessage(),'错误'=>$e]);
            return $this->apiError($e->getCode());
        }
        return $this->apiSuccess($data);
    }

    /**
     * 获取用户绑定手机号
     */
    public function getphone()
    {

        try {

            $this->data->load([
                'code' => ['trim',''],
                'iv' => ['trim',''],
                'encryptedData' => ['trim','']
            ]);

            $data = UcenterLogic::getphone();
        } catch (Exception $e) {
            Functions::record('绑定手机号失败', ['错误信息'=>$e->getMessage(),'错误'=>$e]);
            return $this->apiError($e->getCode());
        }
        return $this->apiSuccess($data);
    }

    
    /**
     * session获取用户信息
     */
    public function info()
    {
        try {
            $data = UcenterLogic::sessionInfo();
        } catch (Exception $e) {
            return $this->apiError($e->getCode());
        }
        return $this->apiSuccess($data);
    }
    
    public function addr() {
        try {
            $this->load(['ext'=>['trim','']]);
            $data = UcenterLogic::addressExt();
        } catch (Exception $e) {
            return $this->apiError($e->getCode());
        }
        return $this->apiSuccess($data);
    }
    
    public function grouper() {
        try {
            $data = UcenterLogic::grouperInfo();
        } catch (Exception $e) {
            return $this->apiError($e->getCode());
        }
        return $this->apiSuccess($data);
    }

    /**
     * 普通用户我的资料
     */
    public function getUser() {
        try {
            $data = UcenterLogic::getUser();
        } catch (Exception $e) {
            return $this->apiError($e->getCode());
        }
        return $this->apiSuccess($data);
    }

    /**
     * 单独添加更新用户个人资料
     */
    public function edit() {
        try {
            $this->load([
                'realname'=>['trim',''],
                'mobile'=>['trim',''],
                'title'=>['trim',''],
                'address'=>['trim','']
            ]);
            $data = UcenterLogic::editInfo();
        } catch (Exception $e) {
            return $this->apiError($e->getCode());
        }
        return $this->apiSuccess($data);
    }

    public function from() {
        try {
            $this->load([
                'lat'=>['trim',''],
                'lng'=>['trim','']
            ]);
            $data = UcenterLogic::getUserFrom();
        } catch (Exception $e) {
            return $this->apiError($e->getCode());
        }
        return $this->apiSuccess($data);
    }


    /**
     * 获取用户提货码
     */
    public function code(){
        try{

            $data = UcenterLogic::getCode();

        }catch(Exception $e){
            return $this->apiError($e->getCode());
        }
        return $this->apiSuccess($data);

    }
/**
 * 获取用户积分详情
 *
 */
    public  function total(){
        try{
            $data = UcenterLogic::getTotal();
        }catch (Exception $e){
            return $this->apiError($e->getCode());
        }
       if(!empty($data)){
           //循环修改时间戳
           foreach ($data  as &$v){
               $v['addtime'] =date('Y-m-d H:i:s', $v['addtime']);
           }
           unset($v);
       }
        return $this->apiSuccess($data);
    }
    /**
     * 获取用户现有积分
     *
     */
    public  function newTotal(){
        try{
            $data = UcenterLogic::newTotal();
        }catch (Exception $e){
            return $this->apiError($e->getCode());
        }
        return $this->apiSuccess($data);
    }

    /**
     * 获取现可用团长信息列表
     *
     */
    public function get_area(){

        try{
            $this->load([
                'lat'=>['trim',''],
                'lng'=>['trim','']
            ]);
            $data = UcenterLogic::getFrom();
        }catch (Exception $e){
            return $this->apiError($e->getCode());
        }
        return $this->apiSuccess($data);
    }
    /**
     * 更新用户的团长信息，切换团长
     */
    public function editFrom() {
        try {
            $this->load([
                'fromid'=>['trim','']
            ]);
            $data = UcenterLogic::editArea();
        } catch (Exception $e) {
            return $this->apiError($e->getCode());
        }
        return $this->apiSuccess($data);
    }

    /**
     * 获取休市时间状态
     */
//    public function closeTime() {
//        try {
//            $this->load([
//                'id'=>['trim',2]
//            ]);
//            $data =  UcenterLogic::getClose();
//        } catch (Exception $e) {
//            return $this->apiError($e->getCode());
//        }
//        return $this->apiSuccess($data);
//    }


}

<?php
namespace Logic;

use Common\Data;
use CurlLib\Curlopt;
use Model\ConfigModel;
use Model\UserPointModel;
use think\Exception;
use Model\UserModel;
use Common\Functions;
use Model\UserPlatformModel;
use Model\UserSessionModel;
use Constants\SiteConst;
use Model\UserAreaModel;
use Model\AreaModel;


class UcenterLogic extends BasicLogic
{
    public static function codeLogin() {
        if (!Data::instance()->code) {
            self::error(10002);
        }
        $token = self::code2accessToken();
        $plateMod = new UserPlatformModel();
        $userMod = new UserModel();
        
        $plate = $plateMod->findByOpenid($token['openid']);
        $openidFind = 1; 
        if (!$plate && isset($token['unionid'])) {
            $plate = $plateMod->findByUnionid($token['unionid']);
            $openidFind = 2;
        }
        if (!$plate) {
            self::error(20002);
        }
        $user = $userMod->findById($plate['userid']);
        if (!$user) {
            self::error(20003);
        }
        if ($openidFind === 2) {
            $plateMod->createPlate($plate['userid'], $token['openid'], Functions::is_set($token, 'uinionid', ''));
        }
        return $userMod->userInfo($user);
    }

    public static  function  testLogin($userid){
        $userMod = new UserModel();
        $user = $userMod->findById($userid);
        return $userMod->userInfo($user);
    }

    public static function register() {

        if (!Data::instance()->code) {
            self::error(10002);
        }

        if (!Data::instance()->iv || !Data::instance()->encryptedData) {
            self::error(10001);
        }

        $token = self::code2accessToken(true);

        $info = Functions::decryptData($token['session_key'], Data::instance()->iv, Data::instance()->encryptedData);

        if (!$info) {
            self::error(20001);
        }
        $userMod = new UserModel();
        $plateMod = new UserPlatformModel();

        $plate = $plateMod->findByOpenid($info['openId']);

        if ($plate) {
            return $userMod->userInfo($userMod->findById($plate['userid']));
        }

        try {
            self::startTrans();

            $user = $userMod->createUser($info, Data::instance()->mobile);

            $res =$plateMod->createPlate($user['id'], $info['openId'], Functions::is_set($info, 'unionId', ''));

            $userInfo = $userMod->reuserInfo($user);

            self::commit();
        } catch (Exception $e) {
            self::rollback();
            throw $e;
        }
        return $userInfo;
    }


    public static function getphone() {

        if (!Data::instance()->code) {
            self::error(10002);
        }

        if (!Data::instance()->iv || !Data::instance()->encryptedData) {
            self::error(10001);
        }
        Data::instance()->encryptedData = str_ireplace(" ","+",Data::instance()->encryptedData);
        $token = self::code2accessToken(true);
        $info = Functions::decryptData($token['session_key'], Data::instance()->iv, Data::instance()->encryptedData);

        if (!$info||empty($info['phoneNumber'])) {
           return array('info'=>0,'msg'=>"微信未绑定手机号");
        }

        $userMod = new UserModel();
        $plateMod = new UserPlatformModel();

        $plate = $plateMod->findByOpenid($token['openid']);

        if (!$plate) {
            return array('info'=>-1,'msg'=>'用户信息不存在');
        }
        try {
            self::startTrans();
            //保存手机号
            $user = $userMod->savephone($plate['userid'], $info['phoneNumber']);

            $userInfo = array('info'=>1,'msg'=>'绑定成功','user'=>$user['user']);
            self::commit();
        } catch (Exception $e) {
            self::rollback();
            throw $e;
        }
        return $userInfo;
    }
    
    public static function sessionInfo() {
        $userMod = new UserModel();
        return $userMod->userInfo(Data::$user);
    }
    
    public static function checkUser() {
        if (!Data::instance()->_s && !Data::instance()->_u) {
            self::error(20001);
        }
        
        $userMod = new UserModel();
        if (Data::instance()->_s) {
            $sessMod = new UserSessionModel();
            $session = $sessMod->findSession();

            if (!$session) {
                self::error(20001);
            }
            Data::$user = $userMod->findById($session['userid']);
        }
        if (!Data::$user && Data::instance()->_u) {
            Data::$user = $userMod->findById(Data::instance()->_u);
        }

        if (!Data::$user) {
            self::error(20001);
        }
        return true;
    }
    
    public static function addressExt(){
        if (Data::$user['type'] != SiteConst::USER_TYPE_PARCHSE) {
            self::error(20006);
        }
        $userAddrMod = new UserAreaModel();
        return $userAddrMod->setExt(Data::$user['id'], Data::instance()->ext);
    }
    
    public static function grouperInfo() {
        $groupId = Data::$user['type'] == SiteConst::USER_TYPE_PARCHSE ? Data::$user['id'] : Data::$user['fromid'];

        $userMod = new UserModel();
         $info = $userMod->groupInfo($groupId);
         //查询购买指数 粉丝指数
        if(!empty($info)){
            $buynum = $userMod->getBuyNum($groupId);
            $teamnum = $userMod->getTeamNum($groupId);
            $info['buynum'] = $buynum;//购买指数
           $info['teamnum'] = $teamnum;//粉丝指数
        }

        return $info;
    }


    /**
     * 普通用户我的资料
     */
    public static function getUser() {
        $groupId =  Data::$user['id'];
        $userMod = new UserModel();
        $info = $userMod->user($groupId);
        //查询购买指数 粉丝指数
        return $info;
    }

    /**
     * @return bool g更新个人资料
     */
    public static function editInfo() {
        if (!Data::instance()->realname) {
            self::error(10001);
        }
        if (!Data::instance()->mobile) {
            self::error(10001);
        }
        if (!Data::instance()->title) {
            self::error(10001);
        }
        if (!Data::instance()->address) {
            self::error(10001);
        }
        $userMod = new UserModel();
        $userMod->edit_Info(Data::$user['id'], Data::instance()->realname, Data::instance()->mobile,Data::instance()->title,Data::instance()->address);

        return true;
    }
    /**
     * @return bool 更新个人团长资料
     */
    public static function editArea() {
        if (!Data::instance()->fromid) {
            self::error(10001);
        }
        $userMod = new UserModel();
        $userMod->setFromid(Data::$user['id'], Data::instance()->fromid);

        return true;
    }

    /**
     * 获取提货码
     *
     */
    public static function getCode(){
        $userMod = new UserModel();
        $info = $userMod->getInfo(Data::$user['id']);
        if(empty($info)){
            self::error(10001);
        }
        if(empty($info['code'])||empty($info['codetime'])||date('Y-m-d')!=date('Y-m-d',$info['codetime'])){
            //生成新的取货码 保存数据库
            $code = $userMod->get_order_sn();
            $data = array('code'=>(string)$code,'codetime'=>time());
            $userMod->setCode(Data::$user['id'], $data);
            return $data;
        }else{
            return $info;
        }

    }

    /**
     * @return array 获取用户积分详情
     */
    public static function getTotal(){
        $userPointMod = new UserPointModel();
        $info= $userPointMod -> user_point(Data::$user['id']);
        if(empty($info)){
//            self::error(10001);
            return $info = "";
        }
        return $info;

    }
    /**
     * @return array 获取现有用户积分
     */
    public static function newTotal(){
        $userPointMod = new UserPointModel();
        $info= $userPointMod -> last_total(Data::$user['id']);
        if(empty($info)){
//            self::error(10001);
            return $info = "";
        }
        return $info;

    }

    public static function getUserFrom() {
        if (!Data::instance()->lat || !Data::instance()->lng) {
            self::error(10001);
        }

        if (Data::$user['fromid']) {
            return ['fromid'=>Data::$user['fromid']];
        }
        $areaMod = new AreaModel();
        $areaList = $areaMod->selectToCount();
        $countDistance = false;
        $fromid = 0;

        foreach ($areaList as $area) {
            if (!$area['lat']|| !$area['lng']) {
                continue;
            }
            $distance = Functions::getDistance(Data::instance()->lat, Data::instance()->lng, $area['lat'], $area['lng']);

            if ($countDistance === false || $distance<$countDistance) {
                $countDistance = $distance;
                $fromid= $area['userid'];
            }

        }

        if ($fromid == 0) {
            self::error(20007);
        }
        $userMod = new UserModel();
        $userMod->setFromid(Data::$user['id'], $fromid);
        return ['fromid'=>$fromid];
    }
    /**
     * 获取现有团长信息列表
     *
     */
    public static function getFrom() {
        if (!Data::instance()->lat || !Data::instance()->lng) {
            self::error(10001);
        }
        $areaMod = new AreaModel();
        $areaList = $areaMod->selectToCount();
        $newarr=array();
        foreach ($areaList as &$area) {
            if (!$area['lat']|| !$area['lng']) {
                continue;
            }
            $distance = Functions::getDistance(Data::instance()->lat, Data::instance()->lng, $area['lat'], $area['lng']);
            $area['distancesort']=$area['distance']=$distance;
            if($distance>=1000){
                $area['distance']=round($distance/1000,2)."Km";
            }else{
                $area['distance']=$distance."m";
            }
            array_push ($newarr,$area);


        }
        $person = my_sort($newarr,'distancesort');

          return $person;
    }
    
    private static function code2accessToken($del = false){
        $cache = cache('code2token');
        if (isset($cache[Data::instance()->code])) {
            $token = $cache[Data::instance()->code];
//             if ($del === true) {
//                 unset($cache[Data::instance()->code]);
//             }
//             cache('code2token',$cache);
            return $token;
        }
        $url = 'https://api.weixin.qq.com/sns/jscode2session';
        $params = [
            'appid'=>config('program.appid'),
            'secret'=>config('program.appkey'),
            'js_code'=>Data::instance()->code,
            'grant_type'=>'authorization_code',
        ];
        
        $result = Curlopt::init($url)->get($params)->asArray();

        if (isset($result['errcode']) && $result['errcode'] != 0) {
            self::error(10003);
        }
        $cache[Data::instance()->code] = $result;
        cache('code2token',$cache);
        return $result;
    }

    /**
     * @return array 获取休市时间
     */
    public static function getClose(){
        $config = new ConfigModel();
        $data= $config -> selects(Data::instance()->id);
        if(empty($data)){
            self::error(10001);

        }
        $data[0]['start']=date('m-d H:i',strtotime($data[0]['salestart']));
        $data[0]['end']=date('m-d H:i',strtotime($data[0]['saleend']));
        return $data;

    }
}
//用于切换团长时团长列表按照距离由近到远排序
function my_sort($arrays,$sort_key,$sort_order=SORT_ASC,$sort_type=SORT_NUMERIC ){
    if(is_array($arrays)){
        foreach ($arrays as $array){
            if(is_array($array)){
                $key_arrays[] = $array[$sort_key];
            }else{
                return false;
            }
        }
    }else{
        return false;
    }
    array_multisort($key_arrays,$sort_order,$sort_type,$arrays);
    return $arrays;
}


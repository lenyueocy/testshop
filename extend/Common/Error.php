<?php
namespace Common;

use think\Exception;
class Error
{
    private static $codeToMsg = [
        //通用
        10001 => ['code' => -10001,'msg' => '参数错误'],
        10002 => ['code' => -10002,'msg' => '签名错误'],
        10003 => ['code' => -10003,'msg' => '版本填写错误'],
        10004 => ['code' => -10004,'msg' => '接口请求超时'],
        10005 => ['code' => -10005,'msg' => '不存在的应用'],
        10006 => ['code' => -10006,'msg' => '不存在的请求'],
        10007 => ['code' => -10007,'msg' => '服务器错误，请稍后重试'],
        
        //用户中心
        20001 => ['code' => -20001,'msg' => '请先登录'],
        20002 => ['code' => -20002,'msg' => '请先注册'],
        20003 => ['code' => -20003,'msg' => '用户不存在'],
        20004 => ['code' => -20004,'msg' => '请先绑定手机号'],
        20005 => ['code' => -20005,'msg' => '请先选择团长'],
        20006 => ['code' => -20006,'msg' => '该操作只有团长可以使用'],
        20007 => ['code' => -20007,'msg' => '未找到相关小区，请联系客服'],
        
        //商品中心
        30001 => ['code' => -30001,'msg' => '不存在的商品'],
        30002 => ['code' => -30002,'msg' => '请选择商品属性'],
        30003 => ['code' => -30003,'msg' => '商品库存不够了'],
        30004 => ['code' => -30004,'msg' => '请选择商品数量'],
        30005 => ['code' => -30005,'msg' => '不可上货的格子'],
        30006 => ['code' => -30006,'msg' => '不是该用户预约的格子'],
        30007 => ['code' => -30007,'msg' => '不存在的取餐码'],
        30008 => ['code' => -30008,'msg' => '没有可执行的任务'],
        30009 => ['code' => -30009,'msg' => '不存在的功能码'],
        
        //账户中心
        40001 => ['code' => -40001,'msg' => '您的豆数量不够'],
        40002 => ['code' => -40002,'msg' => '您的钻石数量不够'],
        
        //订单中心
        50001 => ['code' => -50001,'msg' => '请选择商品'],
        50002 => ['code' => -50002,'msg' => '请填写姓名'],
        50003 => ['code' => -50003,'msg' => '请输入手机号'],
        50004 => ['code' => -50004,'msg' => '商品库存不足，请返回购物车重新下单'],
        50005 => ['code' => -50005,'msg' => '不存在的订单'],
        50006 => ['code' => -50006,'msg' => '该订单不能删除'],
        
        //支付中心
        60001 => ['code' => -60001,'msg' => '支付请求失败，请稍后重试'],
        60002 => ['code' => -60002,'msg' => '通知结果错误'],
        60003 => ['code' => -60003,'msg' => '邮件物品已领取'],
        60004 => ['code' => -60004,'msg' => '没有可领取的物品'],
        
        //微信
        70001 => ['code' => -70001,'msg' => '微信请求失败，请重启小程序后重试'],
    ];
    
    const DEFAULT_MSG = ['msg'=>'服务器错误，请稍后重试','code'=>-1];
    
    public static function errMsg($code){
        $codeMsg = isset(self::$codeToMsg[$code]) ? self::$codeToMsg[$code] : self::DEFAULT_MSG;
        throw new Exception($codeMsg['msg'], $codeMsg['code']);
    }
    
    public static function backMsg($code) {
        $code = $code < 0 ? (0-$code) : $code;
        return isset(self::$codeToMsg[$code]) ? self::$codeToMsg[$code] : self::DEFAULT_MSG;
    }
}
<?php
namespace app\api\controller;

use Logic\PayLogic;
use think\Exception;
use Common\Functions;
class Notify extends Common
{
    public function goods() {
        //file_put_contents($_SERVER['DOCUMENT_ROOT']."/uploads/test.txt", 'test', FILE_APPEND);

        try {
            $data = PayLogic::goodsNotify();
        } catch (Exception $e) {
            Functions::record('支付异步通知错误', ['错误'=>$e]);
            $data = [
                'return_code'=>'FAIL',
                'return_msg'=>'支付结果错误',
            ];
        }
       // file_put_contents($_SERVER['DOCUMENT_ROOT']."/uploads/test1.txt", json_encode($data), FILE_APPEND);

        echo Functions::toXml($data);die;
    }
}
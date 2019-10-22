<?php
namespace WeixinSdk;

use CurlLib\Curlopt;
use think\Exception;
/**
 * 微信小游戏SDK
 * @author Administrator
 *
 */
class Program
{
    private $appid = '';
    private $appkey = '';
    
    private $accessToken = '';
    
    const TOKEN_URL = 'https://api.weixin.qq.com/cgi-bin/token';
    
    const QRCODE_URL = 'https://api.weixin.qq.com/wxa/getwxacodeunlimit';
    
    public function __construct() {
        $this->appid = config('program.appid');
        $this->appkey = config('program.appkey');
    }
    
    private static $handle;
    public static function init() {
        if (!self::$handle) {
            self::$handle = new self();
        }
        return self::$handle;
    }
    
    public function getUserInfo($token) {
        
    }
    
    public function qrcode1111($page,$scene) {
        $param = [
            'scene'=>$scene,
            'page'=>$page,
            'auto_color'=>true,
            'width'=>400
        ];
        $url = self::QRCODE_URL.'?access_token='.$this->getToken();
        $result = Curlopt::init($url)->post($param,true)->getResult();
        return $result;
    }
    /**
     * 推广二维码
     */
    public function qrcode($page,$scene){
            $token = $this->getToken();
            $url = 'https://api.weixin.qq.com/wxa/getwxacode?access_token='.$token;
            $arr = array("path"=>$page.'?scene='.$scene,"width"=>430,"auto_color"=>false,"line_color"=>array("r"=>16,"g"=>78,"b"=>139));
            $qrcode = $this->getqrcode($url,$arr);
            $filename='uploads/qrcode/tg'.$scene.'.png';
            file_put_contents($filename, $qrcode);
            $qrcode = "https://".$_SERVER['HTTP_HOST']."/".$filename;
            return $qrcode;
           /* $headimg = $this->getheadimg($member['user_id'],$member['head_pic']);
            $head = "https://".$_SERVER['HTTP_HOST']."/".$headimg;*/
            //return json(array('state'=> 1, 'res' => 'ok!','qrcode'=>$qrcode));

    }

    /**
     * 商品二维码
     */
    public function goodsqrcode($page,$scene,$goodsid){
        $token = $this->getToken();
        $url = 'https://api.weixin.qq.com/wxa/getwxacode?access_token='.$token;
        $arr = array("path"=>$page.'?gudsid='.$goodsid.'&scene='.$scene,"width"=>430,"auto_color"=>false,"line_color"=>array("r"=>16,"g"=>78,"b"=>139));
        $qrcode = $this->getqrcode($url,$arr);
        $filename='uploads/qrcode/goods'.$goodsid.'.png';
        file_put_contents($filename, $qrcode);
        $qrcode = "https://".$_SERVER['HTTP_HOST']."/".$filename;
        return $qrcode;
    }


    /**
     * 生成二维码方法
     */
    private function getqrcode($url,$arr){

        $json =json_encode($arr);
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); //信任任何证书
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($json))
        );
        $responseText = curl_exec($curl);
        curl_close($curl);
        return $responseText;

    }

    /**
     *
     * 发送模板消息
     */
    public function curl_post_send_information($vars,$second=120,$aHeader=array())
    {
        $token = $this->getToken();
        $ch = curl_init();
        //超时时间
        curl_setopt($ch,CURLOPT_TIMEOUT,$second);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
        //这里设置代理，如果有的话
        curl_setopt($ch,CURLOPT_URL,'https://api.weixin.qq.com/cgi-bin/message/wxopen/template/send?access_token='.$token);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
        if( count($aHeader) >= 1 ){
            curl_setopt($ch, CURLOPT_HTTPHEADER, $aHeader);
        }
        curl_setopt($ch,CURLOPT_POST, 1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$vars);
        $data = curl_exec($ch);
        if($data){
            curl_close($ch);
            return $data;
        }
        else {
            $error = curl_errno($ch);
            curl_close($ch);
            return $error;
        }
    }



    private function getToken() {
        if ($this->accessToken) {
            return $this->accessToken;
        }
        $cache = cache('access_token_game');
        if ($cache) {
            return $cache;
        }
        $param = [
            'grant_type'=>'client_credential',
            'appid'=>$this->appid,
            'secret'=>$this->appkey
        ];
        $result = Curlopt::init(self::TOKEN_URL)->get($param)->asArray();
        if (isset($result['errcode'])) {
            throw new Exception('微信access_token请求失败');
        }
        $this->accessToken = $result['access_token'];
        $re = cache('access_token_game',$result['access_token'],2 * 3500);
        return $this->accessToken;
        
    }
}
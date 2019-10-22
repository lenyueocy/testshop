<?php
namespace Logic\Pay;

use Logic\BasicLogic;
use Logic\Pay\Wechat\MiniApp;
// use CurlLib\Curlopt;
use Common\Functions;

class WechatPay extends BasicLogic
{

    private static $handle;

    protected $payData = [];
    
    protected $config = [];
    
    protected $mch_key = '';
    
    protected $trade_type = '';
    
    const UNIFIED_ORDER_URL = 'https://api.mch.weixin.qq.com/pay/unifiedorder';

    public static function miniApp($config)
    {
        if (!self::$handle) {
            self::$handle = new MiniApp();
        }
        self::$handle->config = $config;
        self::$handle->mch_key = $config['mch_key'];
        return self::$handle;
    }
    
    public function pay(){
        $this->getPayData();
        $this->payData['sign'] = $this->getSign($this->payData);
        $xml = Functions::toXml($this->payData);
        $result = $this->postXmlCurl($xml, self::UNIFIED_ORDER_URL);
        $result = Functions::fromXml($result);
        if ($result['return_code'] !== 'SUCCESS' || $result['result_code'] !== 'SUCCESS') {
            self::error(60001);
        }
        return $this->payReturn($result['prepay_id']);
    }
    
    private function postXmlCurl($xml, $url, $useCert = false, $second = 30)
    {
        $curl = curl_init();
        $optArray = [
            CURLOPT_TIMEOUT => $second,
            CURLOPT_URL => $url,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HEADER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $xml
        ];
//         if ($useCert == true) {
//             $optArray[CURLOPT_SSLCERTTYPE] = 'PEM';
//             $optArray[CURLOPT_SSLCERT] = $this->certPath.'/apiclient_cert.pem';
//             $optArray[CURLOPT_SSLKEYTYPE] = 'PEM';
//             $optArray[CURLOPT_SSLKEY] = $this->certPath.'/apiclient_key.pem';
//         }
        curl_setopt_array($curl, $optArray);
        $data = curl_exec($curl);
        curl_close($curl);
        // 返回结果
        if ($data) {
            return $data;
        }
        self::error(60001);
    }
    
    public function notify() {
        $xml = file_get_contents('php://input');
        $result = Functions::fromXml($xml);
        Functions::record('微信支付异步通知参数', ['xml'=>$xml,'参数'=>$result]);
        if ($result['return_code'] !== 'SUCCESS' || $result['result_code'] !== 'SUCCESS') {
            self::error(60002);
        }
        return $result;
    }
    
    protected function getPayData() {
        foreach ($this->config as $key=>$val) {
            if (!in_array($key, self::INVALITE_PAY_FIELD)) {
                continue;
            }
            $this->payData[$key] = $val;
        }
        $this->payData['nonce_str'] = Functions::randStr(32,'');
        $this->payData['trade_type'] = $this->trade_type;
        $this->payData['total_fee'] = $this->payData['total_fee']*100;
    }
    
    protected function getSign($data){
        $buff = '';
        ksort($data);
        foreach ($data as $k=>$v) {
            $buff .= ($k != 'sign' && $v != '' && ! is_array($v)) ? $k . '=' . $v . '&' : '';
        }
        $string = md5($buff. 'key=' . $this->mch_key);
        return strtoupper($string);
    }
    
    const INVALITE_PAY_FIELD = [
        // 应用id 1
        'appid',
        // 商户id 1
        'mch_id',
        // 设备号 2
        'device_info',
        // 随机字符串 1
        'nonce_str',
        // 签名 1
        'sign',
        // 签名类型 2
        'sign_type',
        // 商品描述 1
        'body',
        // 商品详情 2
        'detail',
        // 附加数据 2
        'attach',
        // 商户订单号 1
        'out_trade_no',
        // 标价币种 2
        'fee_type',
        // 标价金额 1
        'total_fee',
        // 终端IP 1
        'spbill_create_ip',
        // 交易起始时间 2
        'time_start',
        // 交易结束时间 2
        'time_expire',
        // 订单优惠标记 2
        'goods_tag',
        // 通知地址 1
        'notify_url',
        // 交易类型 1
        'trade_type',
        // 商品ID 2
        'product_id',
        // 指定支付方式 2
        'limit_pay',
        // 用户标识 1|2
        'openid'
    ];
}
<?php
namespace Common;

/**
 * 一些功能函数，所有方法以静态呈现
 *
 * @author kenny
 *        
 */
class Functions
{

    /**
     * 删除字符串的emoji
     *
     * @param string $str            
     * @return string
     */
    public static function delSpecial($str)
    {
        return preg_replace_callback('/./u', function (array $match) {
            return strlen($match[0]) >= 4 ? '' : $match[0];
        }, $str);
    }

    /**
     * 简化获取格式datetime
     *
     * @param string $time            
     */
    public static function date($time = false)
    {
        $time = $time === false ? time() : $time;
        return date('Y-m-d H:i:s', $time);
    }

    /**
     * 随机字符串
     *
     * @param number $length            
     * @param string $special            
     */
    public static function randStr($length = 16, $special = '~!@#$%^&*-')
    {
        $str = 'abcdefghijklmnopqrstuvwxyz1234567890' . $special;
        $randStr = '';
        for ($i = 0; $i < $length; $i ++) {
            $randStr .= $str[rand(1, strlen($str) - 1)];
        }
        return $randStr;
    }

    /**
     * 获取毫秒级时间戳
     */
    public static function millisecond()
    {
        list ($t1, $t2) = explode(' ', microtime());
        return (float) sprintf('%.0f', (floatval($t1) + floatval($t2)) * 1000);
    }

    /**
     * 保留两位小数
     *
     * @param unknown $float            
     */
    public static function floatTwo($float)
    {
        return sprintf("%.2f", $float);
    }

    public static function record($title, $log)
    {
        $str = "########**{$title}***记录开始【" . date('Y-m-d H:i:s') . "】############\r\n";
        foreach ($log as $key => $val) {
            $str .= "{$key}:" . print_r($val, true) . "\r\n";
        }
        $str .= "########调试日志记录结束【" . date('Y-m-d H:i:s') . "】############\r\n";
        trace($str, 'error');
    }

    public static function orderno()
    {
        return 'sp_' . date('YmdHis') . rand(100000, 999999);
    }

    public static function is_set($arr, $attr, $default)
    {
        return isset($arr[$attr]) ? $arr[$attr] : $default;
    }

    public static function decryptData($sessionKey, $iv, $encryptedData)
    {

        $aesKey = base64_decode($sessionKey);
        $aesIV = base64_decode($iv);
        $aesCipher = base64_decode($encryptedData);
        
        $result = openssl_decrypt($aesCipher, "AES-128-CBC", $aesKey, 1, $aesIV);

        $dataObj = json_decode($result, true);
        return $dataObj;
    }

    public static function humpToLine($str)
    {
        $str = preg_replace_callback('/([A-Z]{1})/', function ($matches) {
            return '_' . strtolower($matches[0]);
        }, $str);
        return $str;
    }

    public static function convertUnderline($str)
    {
        $str = preg_replace_callback('/([-_]+([a-z]{1}))/i', function ($matches) {
            return strtoupper($matches[2]);
        }, $str);
        return ucfirst($str);
    }

    public static function toXml($data, $start = true)
    {
        if ($start === true) {
            $xml = "<xml>";
        }
        foreach ($data as $key => $val) {
            if (is_array($val)) {
                $xml .= "<" . $key . ">" . self::toXml($val, false) . "</" . $key . ">";
            } elseif (is_numeric($val)) {
                $xml .= "<" . $key . ">" . $val . "</" . $key . ">";
            } else {
                $xml .= "<" . $key . "><![CDATA[" . $val . "]]></" . $key . ">";
//                 $xml .= "<" . $key . ">".$val."</" . $key . ">";
            }
        }
        if ($start === true) {
            $xml .= "</xml>";
        }
        return $xml;
    }

    public static function fromXml($xml)
    {
        libxml_disable_entity_loader(true);
        return json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
    }

    public static function getDistance($lat1, $lng1, $lat2, $lng2)
    {
        $earthRadius = 6367000;
        $lat1 = ($lat1 * pi()) / 180;
        $lng1 = ($lng1 * pi()) / 180;
        $lat2 = ($lat2 * pi()) / 180;
        $lng2 = ($lng2 * pi()) / 180;
        $calcLongitude = $lng2 - $lng1;
        $calcLatitude = $lat2 - $lat1;
        $stepOne = pow(sin($calcLatitude / 2), 2) + cos($lat1) * cos($lat2) * pow(sin($calcLongitude / 2), 2);
        $stepTwo = 2 * asin(min(1, sqrt($stepOne)));
        $calculatedDistance = $earthRadius * $stepTwo;
        return round($calculatedDistance,5);
    }
}
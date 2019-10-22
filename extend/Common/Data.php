<?php
namespace Common;

use think\Request;
class Data
{
    public static $user;
    
    public static $app = null;
    
    const COMMON_DATA = [
        'appid','v','timestamp'
    ];
    
    private static $handle;
    public static function instance() {
        if (!self::$handle) {
            self::$handle = new self();
        }
        return self::$handle;
    }
    
    /**
     * 
     * @param array $fieldArr ['userid'=>['intval',0]]
     */
    public function load($fieldArr) {

        $input = Request::instance()->param();
        foreach ($fieldArr as $field=>$val) {
            if (isset($input[$field])) {
                $func = $val['0'];
                if ($func && function_exists($func)) {
                    if(trim($func) == 'json_decode'){
                        $value = json_decode($input[$field],true);
                    }else{
                        $value = $func($input[$field]);
                    }
                    $this->{$field} = $value ? $value : $val['1'];
                }else{
                    $this->{$field} = $this->{$field} ? $this->{$field} : $val['1'];
                }
            }else{
                $this->{$field} = $val['1'];
            }
        }
    }
    
    public function checkSign($fieldArr) {
        $this->load($fieldArr);
        $field = array_keys($fieldArr);
        $dataArray = array_merge($field,self::COMMON_DATA);
        $dataTemp = [];
        foreach ($dataArray as $fld) {
            if (!$this->{$fld}) {
                Error::errMsg(10001);
            }
            $dataTemp[$fld] = $this->{$fld};
        }
        ksort($dataTemp);
        $buff = '';
        foreach ($dataTemp as $k => $v) {
            $buff .= ($k != 'sign' && $v != '' && ! is_array($v)) ? $k . '=' . $v . '&' : '';
        }
        $buff.='appkey='.self::$app['appkey'];
        $sign = strtoupper(md5($buff));
        if ($sign != $this->sign) {
            Error::errMsg(10002);
        }
        return true;
    }
    
    public function __set($name,$value) {
        $this->$name = $value;
    }
    
    public function __get($name) {
        return isset($this->$name) ? $this->$name : null;
    }
}
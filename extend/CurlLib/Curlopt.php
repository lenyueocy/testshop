<?php
namespace CurlLib;

/**
 * curl操作类
 */
use think\Exception;
use Common\Functions;

class Curlopt
{
    // 调试开关
    private $debug = false;
    
    // 请求地址
    private $url = '';
    
    // 操作句柄
    private static $handle;
    
    // curl属性数组
    private $opt = [];
    
    // 头信息
    private $header = [
        'charset=utf-8'
    ];
    
    // 头信息
    private $timeout = 30;
    
    // 请求结果
    private $result = null;

    public function __construct($url = '', $debug, $timeout = 30)
    {
        $this->debug = $debug;
        $this->url = $url;
        $this->timeout = $timeout;
    }

    /**
     * 初始化
     *
     * @param string $url
     *            请求url
     * @param number $timeout
     *            超时时间，默认30秒
     * @param string $debug
     *            调试，默认false
     * @throws Exception
     */
    public static function init($url, $debug = false, $timeout = 30)
    {
        if (! $url) {
            throw new Exception('请求url都不给，你想干啥？');
        }
        self::$handle = new Curlopt($url, $debug, $timeout);
        return self::$handle;
    }

    /**
     * 设置头信息，一般没啥鬼用
     *
     * @param array $header            
     * @throws Exception
     */
    public function setHeader(array $header)
    {
        if (! is_array($header)) {
            throw new Exception('头信息设置错误');
        }
        $this->header = array_merge($this->header, $header);
        return self::$handle;
    }

    /**
     * get方式请求
     *
     * @param unknown $params            
     * @return \CurlLib\Curlopt
     */
    public function get($params)
    {
        $str = $this->queryStr($params);
        $url = $this->url;
        if ($str) {
            if (strpos($this->url,'?')) {
                $url = $this->url . '&' . $str;
            } else {
                if ($str) {
                    $url = $this->url . '?' . $str;
                } else {
                    $url = $this->url;
                }
            }
        }
        $this->opt = [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => $this->timeout,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => $this->header
        ];
        $this->isHttps();
        $this->execute();
        return self::$handle;
    }

    /**
     * post方式请求
     *
     * @param unknown $params            
     * @param string $postJosn            
     */
    public function post($params, $postJosn = false)
    {
        $postStr = $this->queryStr($params, $postJosn);
        $this->opt = [
            CURLOPT_URL => $this->url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 'POST',
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $postStr,
            CURLOPT_HTTPHEADER => $this->header,
            CURLOPT_VERBOSE=>true
        ];
        $this->isHttps();
        $this->execute();
        return self::$handle;
    }

    /**
     * 文件上传请求
     *
     * @param array $parmas 类似 getFileData所返回的
     */
    public function file($parmas)
    {
        $this->methed = 'file';
        $this->opt = [
            CURLOPT_URL => $this->url,
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CONNECTTIMEOUT => $this->timeout,
            CURLOPT_POSTFIELDS => $parmas
        ];
        $this->isHttps();
        $this->execute();
        return self::$handle;
    }

    /**
     * 获取文件信息，用来curl文件上传
     *
     * @param unknown $filepath            
     * @throws Exception
     * @return multitype:number Ambigous <string, \CURLFile> unknown
     */
    public function getFileData($filepath)
    {
        if (! file_exists($filepath)) {
            throw new Exception('文件不存在');
        }
        if (class_exists('\CURLFile')) {
            $file = new \CURLFile($filepath);
        } else {
            $file = '@' . $filepath;
        }
        // 文件类型
        $finfo = finfo_open(FILEINFO_MIME);
        $mimetype = finfo_file($finfo, $filepath);
        finfo_close($finfo);
        $typeArr = explode(';', $mimetype);
        return [
            'file' => $file,
            'type' => $mimetype,
            'size' => filesize($filepath)
        ];
    }

    /**
     * 下载文件
     *
     * @param string $path 保存路径，如:Upload/
     * @param string $name 文件名，不给随机取
     * @param string $ext 扩展名
     */
    public function downloadFile($path, $name = '', $ext = '')
    {
        if (! file_exists($path)) {
            throw new Exception('文件保存目录不存在');
        }
        if (! $name) {
            $name = 'kenny_' . Functions::randStr(20, '');
        }
        
        $this->opt = [
            CURLOPT_URL => $this->url,
            CURLOPT_TIMEOUT => $this->timeout,
            CURLOPT_RETURNTRANSFER => true
        ];
        
        $this->isHttps();
        $this->execute();
        $ext = $this->getExt($ext);
        $filename = $path . $name . $ext;
        if (@file_put_contents($filename, $this->result)) {
            $this->result = $name . $ext;
        } else {
            throw new Exception('文件下载失败');
        }
        return self::$handle;
    }

    /**
     * 获取扩展名
     *
     * @return string
     */
    private function getExt($ext)
    {
        if ($ext) {
            return (strpos('.', $ext) === false) ? ('.' . $ext) : $ext;
        }
        $exp = explode('/', $this->info['content_type']);
        return '.'.$exp['1'];
    }

    /**
     * 是否是htts请求,自动判断
     */
    private function isHttps()
    {
        if (false !== strpos($this->url,'https')) {
            $this->opt[CURLOPT_SSL_VERIFYPEER] = false;
            $this->opt[CURLOPT_SSL_VERIFYHOST] = false;
        }
    }

    /**
     * 组装请求参数，偶尔会要直接post JSON
     *
     * @param unknown $params            
     * @param string $postJosn            
     * @return string|unknown
     */
    public function queryStr($params, $postJosn = false)
    {
        if ($postJosn) {
            if (is_array($params)) {
                $str = json_encode($params, JSON_UNESCAPED_UNICODE);
            } else {
                $str = $params;
            }
            return $str;
        }
        if (is_array($params)) {
            $str = http_build_query($params);
        } else {
            $str = $params;
        }
        
        return $str;
    }
    
    /**
     * 发送异步请求
     * TODO 直接发json收不到
     * @param string $method 请求方法，post或get
     * @param string $json
     */
    public function sync($method,$json=false){
        $host = parse_url($this->url, PHP_URL_HOST);
        $port = parse_url($this->url, PHP_URL_PORT);
        $port = $port ? $port : 80;
        $scheme = parse_url($this->url, PHP_URL_SCHEME);
        $path = parse_url($this->url, PHP_URL_PATH);
        $query = parse_url($this->url, PHP_URL_QUERY);
        if ($query) {
            $path .= '?' . $query;
        }
        if ($scheme == 'https') {
            $host = 'ssl://' . $host;
        }
        $fp = fsockopen($host, $port, $error_code, $error_msg, 1);
        if (!$fp) {
            return false;
        }
        $method = strtoupper($method);
        stream_set_blocking($fp, true); // 开启了手册上说的非阻塞模式
        stream_set_timeout($fp, 1); // 设置超时
        $header = "{$method} $path HTTP/1.1\r\n";
        $header .= "Host: $host\r\n";
        if ($json) {
            $header .= "Content-Type: application/json\r\n\r\n$json\r\n";
        }
        $header .= "Connection: close\r\n\r\n";
        fwrite($fp, $header);
        usleep(1000);
        fclose($fp);
        return true;
    }

    private $info;

    /**
     * 执行请求
     *
     * @throws Exception
     */
    private function execute()
    {
        $curl = curl_init();
        curl_setopt_array($curl, $this->opt);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        if ($this->debug) {
            Functions::record('curl请求调试', [
                'url' => $this->url,
                '参数' => $this->opt,
                '结果' => $response
            ]);
        }
        if ($err) {
            throw new Exception($err);
        }
        $this->result = $response;
        $this->info = curl_getinfo($curl);
        curl_close($curl);
        return true;
    }

    /**
     * 直接获取执行结果
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * 获取结果数组
     *
     * @param string $deep            
     */
    public function asArray($deep = true)
    {
        if ($this->isJson()) {
            return json_decode($this->result, $deep);
        } else {
            return $this->result;
        }
    }

    /**
     * 判断是否是json
     */
    public function isJson()
    {
        if (is_array($this->result)) {
            return false;
        } else {
            return preg_match('/[^,:{}\\[\\]0-9.\-+Eaeflnr-u \n\r\t]/', $this->result);
        }
    }
}
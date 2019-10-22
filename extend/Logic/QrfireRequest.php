<?php
namespace Logic;

use Common\Data;
use CurlLib\Curlopt;
use Constants\SiteConst;
use think\Request;

class QrfireRequest extends BasicLogic
{

    const METHOD_TO_URL = [
        // 获取格子信息列表
        'com.dfire.open.device.box.list' => [
            'uri' => 'device/box',
            'func' => 'box'
        ],
        
        // 格子上货
        'com.dfire.open.device.box.delivery' => [
            'uri' => 'box/fitup',
            'func' => 'boxfitup'
        ],
        
        // 格子取货
        'com.dfire.open.device.box.takeout' => [
            'uri' => 'box/codeno',
            'func' => 'boxcodeno'
        ],
        
        // 查询单个格子
        'com.dfire.open.device.box.query' => [
            'uri' => 'box/info',
            'func' => 'boxinfo'
        ],
        
        // 预约格子
        '' => [
            'uri' => 'box/reserve',
            'func' => 'boxreserve'
        ],
        
        // 应用点位
        '' => [
            'uri' => 'device/position',
            'func' => 'position'
        ],
        
        // 单个机器信息
        '' => [
            'uri' => 'device/info',
            'func' => 'info'
        ]
    ];

    private $isResult = false;

    private $data = [];

    private static $handle;

    public function __construct()
    {}

    public static function init()
    {
        if (! self::$handle) {
            self::$handle = new self();
        }
        return self::$handle;
    }

    public function run()
    {
        $methodToUrl = self::METHOD_TO_URL;
        if (! isset($methodToUrl[Data::instance()->method])) {
            return [
                'code' => 0,
                'errorCode' => 10006,
                'message' => '不存在的请求',
                'data' => []
            ];
        }
        $uriAndFunc = $methodToUrl[Data::instance()->method];
        $params = $this->{$uriAndFunc['func']}();
        
        $url = config('api_host') . $uriAndFunc['uri'];
        $params = $this->sign($params);
        $result = Curlopt::init($url)->post($params)->asArray();
        if ($result['status'] > 0) {
            $this->isResult = true;
            $this->data = $result['data'];
            return [
                'code' => 1,
                'errorCode' => 0,
                'message' => 'success',
                'data' => $this->{$uriAndFunc['func']}()
            ];
        } else {
            return [
                'code' => 0,
                'errorCode' => $result['status'],
                'message' => $result['info'],
                'data' => []
            ];
        }
    }

    private function sign($params)
    {
        $appConfig = config('qr_fire');
        $params['appid'] = $appConfig['appid'];
        $params['v'] = SiteConst::DEFAULT_VERSION;
        $params['timestamp'] = time();
        ksort($params);
        $buff = '';
        foreach ($params as $k => $v) {
            $buff .= ($k != 'sign' && $v != '' && ! is_array($v)) ? $k . '=' . $v . '&' : '';
        }
        $buff .= 'appkey=' . $appConfig['appkey'];
        $params['sign'] = strtoupper(md5($buff));
        return $params;
    }

    private function position()
    {
        if ($this->isResult === false) {
            return [];
        }
        $return = [];
        foreach ($this->data as $data) {
            $return[] = [
                'posId'=>$data['posid'],
                'title'=>$data['title'],
                'location'=>$data['location'],
                'devices'=>$data['devices'],
                'contact'=>$data['contact']
            ];
        }
        return $return;
    }

    private function info()
    {
        if ($this->isResult === false) {
            return [
                'deviceid' => Request::instance()->param('deviceId', 0, 'intval')
            ];
        }
        return $this->data;
    }

    private function box()
    {
        if ($this->isResult === false) {
            return [
                'deviceid' => Request::instance()->param('deviceId', 0, 'intval')
            ];
        }
        $return = [];
        foreach ($this->data as $box) {
            $return[] = [
                'boxId' => $box['boxid'],
                'title' => $box['title'],
                'open' => $box['open'],
                'status' => $box['status'],
                'owner' => $box['owner'],
                'expiretime' => strtotime($box['expiretime'])
            ];
        }
        return $return;
    }

    private function boxinfo()
    {
        if ($this->isResult === false) {
            return [
                'boxid' => Request::instance()->param('boxId', 0, 'intval')
            ];
        }
        return [
            'boxId' => $this->data['boxid'],
            'title' => $this->data['title'],
            'open' => $this->data['open'],
            'status' => $this->data['status'],
            'owner' => $this->data['owner'],
            'expiretime' => strtotime($this->data['expiretime'])
        ];
    }

    private function boxreserve()
    {
        if ($this->isResult === false) {
            return [
                'boxid' => Request::instance()->param('boxId', '', 'trim'),
                'owner' => Request::instance()->param('owner', '', 'trim')
            ];
        }
        return $this->data;
    }

    private function boxfitup()
    {
        if ($this->isResult === false) {
            return [
                'boxid' => Request::instance()->param('boxId', '', 'trim'),
                'owner' => Request::instance()->param('owner', '', 'trim')
            ];
        }
        return [
            'codeNo' => $this->data['codeno']
        ];
    }

    private function boxcodeno()
    {
        if ($this->isResult === false) {
            return [
                'codeno' => Request::instance()->param('codeNo', '', 'trim')
            ];
        }
        return $this->data;
    }
}
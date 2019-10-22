<?php
namespace app\index\controller;

use think\Controller;
use Constants\SiteConst;
use Test\BasicTest;
use think\Request;
class Index extends Controller
{    
    public function index()
    {
        echo \Logic\CommonLogic::codeno();die;
    }
    
    public function test() {
        if (!Request::instance()->get('key') || Request::instance()->get('key') != config('test_secret')) {
            die('<h1>what you want?</h1>');
        }
        $showHtml = BasicTest::init()->run();
        echo '<!DOCTYPE html>
            <html>
            <head>
            	<meta charset="utf-8">
            	<title>测试结果</title>
            	<style type="text/css">
            		*{
            			padding: 0;
            			margin:0;
            		}
            		.list-box{
            			margin:10px;
            		}
            		.list-item-box{
            			border: solid 2px;
            			margin-bottom: 20px;
            			border-radius: 5px;
            			background-color: #efefef;
            		}
            		.item-box{
            			display: flex;
            			border-bottom: solid 1px;
            		}
            		.item-box:last-child{
            			border-bottom: none;
            		}
            		.item-label{
            			width: 200px;
            			padding: 5px;
            			border-right: solid 1px;
            		}
            		.item-show{
            			padding: 5px;
                        flex:1;
                        word-break: break-all;
                        max-height: 200px;
                        overflow: hidden;
            		}
                    .result{
            			padding: 3px 6px;
            			border-radius: 3px;
            			color:#fff;
            		}
            		.yes{
            			background-color: green;
            
            		}
            		.no{
            			background-color: red;
            		}
            	</style>
            </head>
            <body>
            	<div class="list-box">'.$showHtml.'</div>
            </body>
            </html>';
                    die;
    }
    
    private function sign($params) {
        $params['appid'] = self::TEST_APPID;
        $params['v'] = SiteConst::DEFAULT_VERSION;
        $params['timestamp'] = time();
        ksort($params);
        $buff = '';
        foreach ($params as $k => $v) {
            $buff .= ($k != 'sign' && $v != '' && ! is_array($v)) ? $k . '=' . $v . '&' : '';
        }
        $buff.='appkey='.self::TEST_APPKEY;
        $params['sign'] = strtoupper(md5($buff));
        return $params;
    }
}

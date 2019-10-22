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
        echo "<pre>";
        print_r('test');
        exit;
    }
}

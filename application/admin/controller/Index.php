<?php
namespace app\admin\controller;

use think\Session;
use Constants\TBS;
use think\Request;
use Ip2Region\Ip2Region;
use Constants\SiteConst;
class Index extends Common
{
    public function index()
    {
        $productEvn = is_numeric(PROJECT_VERSION) ? 1 : 2;
        $this->assign('productEvn',$productEvn);
        return $this->fetch('/base');
    }
    
    public function noright() {
        return $this->fetch();
    }
    
    public function main() {

        return $this->fetch('main');
    }
    
    public function login() {

        if ($this->isAjax) {
            $input = $this->input;
            if(!$input['username'] || !$input['password']){
                $this->errorMsg('用户名密码不能为空');
            }
            $input['password'] = md5($input['password']);
            $user = $this->tb(TBS::ADMIN_USER)->where([
                'username'=>$input['username'],
                'password'=>$input['password']
            ])->find();
            
            if(!$user){
                $this->errorMsg('用户名或密码错误');
            }
            Session::set('admin-userid',$user['id']);
            Session::set('admin-roleid',$user['roleid']);
            Session::set('admin-nickname',$user['nickname']);
            Session::set('admin-username',$user['username']);
            $this->tb(TBS::ADMIN_USER)
                ->where([
                    'id'=>$user['id']
                ])
                ->update([
                    'lastlogin'=>date('Y-m-d H:i:s')
                ]);
            //记录登录日志
            $request = Request::instance();
            $ip = $request->ip();
            $ip2regionObj = new Ip2Region(false);
            $data = $ip2regionObj->btreeSearch($ip);
            $region=$data['region'];
            $this->tb(TBS::ADMIN_LOG)->insert(['user'=>$user['username'],'ip'=>$ip,'address'=>$region,'logintime'=>date('Y-m-d H:i:s')]);
            $this->successMsg([]);
            
        }
        if($this->adminid){
            return $this->redirect('index/index');
        }
        return $this->fetch();
    }
    
    public function logout() {
        Session::destroy();
        $this->redirect('index/login');
    }
    
    public function edit() {
        if ($this->isAjax) {
            $data = $this->input;
            $data['id'] = $this->adminid;
            $data['password'] = md5($data['password']);
            $json = $this->doUpdate(TBS::ADMIN_USER, $data);
            $this->ajaxMsg($json);
        }
        $this->input['id'] = $this->adminid;
        $detail = $this->detail(TBS::ADMIN_USER);
        $this->assign('detail',$detail);
        return $this->fetch();
    }
    
    /**
     * 富文本编辑器上传文件
     */
    public function upload (){
        $root = ROOT_PATH.'public';
        $tempPath = '/Upload/';
        @mkdir($root.$tempPath);
        $name = uniqid(true);
        
        $tempfile = $root.$tempPath.$name.'.tmp';
        
        if(isset($_SERVER['HTTP_CONTENT_DISPOSITION'])&&preg_match('/attachment;\s+name="(.+?)";\s+filename="(.+?)"/i',$_SERVER['HTTP_CONTENT_DISPOSITION'],$info)){//HTML5上传
            file_put_contents($tempfile,file_get_contents("php://input"));
            $localName=urldecode($info[2]);
        }else{
            $upfile=@$_FILES['filedata'];
            if(!isset($upfile)){
                $err='文件域的name错误';
            }elseif(!empty($upfile['error'])){
                switch($upfile['error']){
                    case '1':
                        $err = '文件大小超过了php.ini定义的upload_max_filesize值';
                        break;
                    case '2':
                        $err = '文件大小超过了HTML定义的MAX_FILE_SIZE值';
                        break;
                    case '3':
                        $err = '文件上传不完全';
                        break;
                    case '4':
                        $err = '无文件上传';
                        break;
                    case '6':
                        $err = '缺少临时文件夹';
                        break;
                    case '7':
                        $err = '写文件失败';
                        break;
                    case '8':
                        $err = '上传被其它扩展中断';
                        break;
                    case '999':
                    default:
                        $err = '无有效错误代码';
                }
            }elseif(empty($upfile['tmp_name']) || $upfile['tmp_name'] == 'none'){
                $err = '无文件上传';
            }else{
                move_uploaded_file($upfile['tmp_name'],$tempfile);
                $localName=$upfile['name'];
            }
        }
        if($err==''){
            //本地上传
             $fileInfo=pathinfo($localName);
             $extension=$fileInfo['extension'];
            
             $fileName = $name.'.'.$extension;
             $targetName = $root.$tempPath.$fileName;
            
             rename($tempfile,$targetName);
             @chmod($targetName,0755);
             $msg = ['url'=>'http://'.$_SERVER['HTTP_HOST'].$tempPath.$fileName,'localname'=>$localName,'id'=>rand(0, 99999)];
             @unlink($tempfile);
            
            //七牛上传
            /*$init = \QiniuSdk\Qiniu::init();
            $re = $init->uploadFile($tempfile);
            $msg = ['url'=>$init::getDomain().$re['key'],'localname'=>$localName,'id'=>rand(0, 99999)];
            @unlink($tempfile);*/
            //config('qiniuConfig.domain')
        }
        $re = ['err'=>$err,'msg'=>$msg];
        $this->ajaxMsg($re);
    }
}







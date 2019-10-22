<?php
namespace app\admin\controller;

use app\admin\controller\Common;
use Constants\TBS;
class File extends Common
{
    /**
     * 自定义文件上传
     * perry
     * 2018.11.14
     */
    public function custom_file_add()
    {
        $input = $this->input;
        if (is_array($input) && ! empty($input)) {
            $data = [];
            $adminid = \think\Session::get('admin-userid');
            $file = $input['files'];

                $data[] = [
                    'filekey' => str_replace("\\","/",$file['url']),
                    'groupid' => $input['id'],
                    'filename' => $file['filename'],
                    'filesize' => $file['filesize'],
                    'filetype' => $file['filetype'],
                    'addtime' => date('Y-m-d H:i:s', time()),
                    'addid' => $adminid,
                    'updatetime'=>date('Y-m-d H:i:s', time()),
                ];

            $this->tb(TBS::FILE_UPLOAD)->insertAll($data);
        }
        return $this->successMsg([]);
    }



    /**
     * 文件上传
     */
    public function file_add()
    {
        $input = $this->input;
        if (is_array($input) && ! empty($input)) {
            $data = [];
            $adminid = \think\Session::get('admin-userid');
            foreach ($input['files'] as $k => $file) {
                $data[] = [
                    'filekey' => $file['key'],
                    'groupid' => $file['groupid'],
                    'filename' => $file['x:name'],
                    'filesize' => $file['x:size'],
                    'filetype' => $file['x:type'],
                    'addtime' => date('Y-m-d H:i:s', time()),
                    'addid' => $adminid,
                    'updatetime'=>date('Y-m-d H:i:s', time()),
                    'addid' => $adminid,
                ];
            }
            $this->tb(TBS::FILE_UPLOAD)->insertAll($data);
        }
        return $this->successMsg([]);
    }

    public function uploadimg(){
        $oldname = $_FILES['addImg2']['name'];

        // 获取表单上传文件 例如上传了001.jpg
        $file = request()->file('addImg2');
        $filepath = ROOT_PATH . 'public/uploads/images/';
        $file1 = '/uploads/images/';
        dir_create($filepath);
        // 移动到框架应用根目录/public/uploads/ 目录下
        if($file){
            $info = $file->move($filepath);

            if($info){

                $resinfo  =['url'=>$file1.$info->getSaveName(), 'filename' => $oldname,
                    'filesize' => $_FILES['addImg2']['size'],
                    'filetype' => $_FILES['addImg2']['type']];
                return json(array("code"=>1,'url'=>$resinfo));

            }else{
                // 上传失败获取错误信息
                return json(array("code"=>0,'url'=>$file->getError()));

            }
        }


    }

    /**
     * 选择文件，作为弹窗使用
     * @return \think\mixed
     */
    public function choose(){
        if ($this->isAjax) {
            $data = $this->input;
            if ($data['gid']) {
                $where['groupid']=$data['gid'];
            }else{
                $where['groupid']=0;
            }
            $list = $this->tb(TBS::FILE_UPLOAD)
                ->field('id,filekey,filename')
                ->where($where)
                ->order('addtime desc')
                ->select();
            $this->ajaxMsg(['status'=>1,'data'=>$list]);
        }
        $groups = $this->tb(TBS::FILE_GROUP)
            ->field('id,name,parentid as pId')
            ->where(['status'=>1])
            ->select();
        foreach ($groups as $key=>$grp) {
            $grp['isParent'] = 1;
            $grp['open'] = true;
            $groups[$key] = $grp;
        }
        $this->assign('groups',$groups);
        $this->assign('action',isset($this->input['action']) ? $this->input['action'] : 0);
        $upload = new \QiniuSdk\Qiniu();
        $opt = $upload->getOpt();
        $this->assign('qiniu',$opt);

        return $this->fetch();
    }
    
    public function file_del() {
        $json = $this->doDel(TBS::FILE_UPLOAD);
        $this->tb(TBS::FILE_RESOURCE)->where(['fid'=>['in',$this->input['dataId']]])->delete();
        $this->ajaxMsg($json);
    }
    
    public function rename() {
        $data = $this->input;
        $return = $this->doUpdate(TBS::FILE_GROUP, $data);
        $this->ajaxMsg($return);
    }
    
    public function delgroup() {
        $this->tb(TBS::FILE_GROUP)->where(['id'=>$this->input['id']])->delete();
        $this->tb(TBS::FILE_UPLOAD)->where(['groupid'=>$this->input['id']])->update(['groupid'=>0]);
        $this->successMsg([]);
    }
    
    public function addgroup() {
        $data = $this->input;
        $return = $this->doAdd(TBS::FILE_GROUP, $data);
        $this->ajaxMsg($return);
    }
}

function dir_create($path, $mode = 0777) {
    if(is_dir($path)) return TRUE;
    $ftp_enable = 0;
    $path = dir_path($path);
    $temp = explode('/', $path);
    $cur_dir = '';
    $max = count($temp) - 1;
    for($i=0; $i<$max; $i++) {
        $cur_dir .= $temp[$i].'/';
        if (@is_dir($cur_dir)) continue;
        @mkdir($cur_dir, 0777,true);
        @chmod($cur_dir, 0777);
    }
    return is_dir($path);
}
function dir_path($path) {
    $path = str_replace('\\', '/', $path);
    if(substr($path, -1) != '/') $path = $path.'/';
    return $path;
}
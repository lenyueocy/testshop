<?php
namespace app\admin\controller;

use Constants\TBS;
use Constants\SiteConst;
use Common\Functions;
use ExportExcel\ExportUser;
class Member extends Common
{

    /**
     * 用户列表
     */
    public function user_list() {
        if ($this->isAjax) {
            $data = $this->input;
            $data['p'] = isset($data['p']) && $data['p'] ? $data['p'] : 1;
            $data['num'] = isset($data['num']) && $data['num'] ? $data['num'] : 10;
            $sqlObj = $this->tb(TBS::USER)
            ->field('id,headpic,nickname,sex,addtime,mobile as phone,realname,mobile')
            ->where($this->input['where'])
            ->order(['id'=>'desc'])->page($data['p'],$data['num'])
                ->select();
            $count =$this->tb(TBS::USER)
                ->field('id,headpic,nickname,sex,addtime,realname,mobile')
                ->where($this->input['where'])->count();
            $return = [
                'p'=>$data['p'],
                'num'=>$data['num'],
                'total'=>$count,
                'rows'=>$sqlObj
            ];
            $this->ajaxMsg($return);
        }
        return $this->fetch('member/user/list');
    }
    /**
     * 导出
     */
    public function user_export() {
        $where = isset($this->input['where']) ? $this->input['where'] : [];
        $user = $this->tb(TBS::USER)
            ->field('id,headpic,nickname,sex,addtime,mobile as phone,realname,mobile')
            ->order('id desc')
            ->where($where)
            ->select();

        if (empty($user)) {
            $this->errorMsg('没有可导出结果');
        }


        $export = new ExportUser();
        $this->successMsg($export->export($user));
    }

    /**
     * 修改信息
     */
    public function user_change() {
        if ($this->isAjax) {
            $return = $this->doUpdate(TBS::USER,$this->input);
            $this->ajaxMsg($return);
        }
        $detail = $this->detail(TBS::USER);
        $this->assign('user',$detail);

        return $this->fetch('member/user/change');
    }

    /**
     * @param $data
     * @return array
     *
     */
    public function user_add(){
        if ($this->isAjax) {
            $goods = $this->table('user')->where(['nickname'=>$this->input['nickname']])->find();
            if (!$this->input['mobile']) $this->_return(-1,'请填写手机号');
            if(!empty($goods)) $this->_return(-1,'昵称重复');
            if(empty($this->input['headpic'])) $this->_return(-1,'请上图片');
            if(empty($this->input['address'])) $this->_return(-1,'请填写地址');
            $insertData = [

                'nickname'=>$this->input['nickname'],
                'mobile'=>$this->input['mobile'],
                'headpic'=>$this->input['headpic'],
                'address'=>$this->input['address'],
                'addtime'=>date("Y-m-d H:i:s"),
            ];
            $res = $this->table('user')->insert($insertData);
            if($res){
                $this->_return(1,'添加成功');
            }
            $this->_return(-1,'失败');
        }


        return $this->fetch('member/user/add');
    }
    public function sortt($data) {
        if (count ( $data ) <= 1) {
            return $data;
        }
        $tem = $data [0]['addtime'];
        $leftarray = array ();
        $rightarray = array ();
        for($i = 1; $i < count ( $data ); $i ++) {
            if ($data [$i]['addtime'] >= $tem ) {
                $leftarray[] = $data[$i];
            } else {
                $rightarray[] = $data[$i];
            }
        }
        $leftarray=self::sortt($leftarray);
        $rightarray=self::sortt($rightarray);
        $sortarray = array_merge ( $leftarray, array ($data[0]), $rightarray );
        return $sortarray;
    }


    /**
     * ajax上传图片
     * @author: Leny
     * @date: 2019/01/01 00:00:00
     */
    public function ajaxUploadImage(){
        $file =request()->file("file");
        $uploadDir = ROOT_PATH.'/public/uploads/images/';
        $info = $file->validate(['ext'=>'jpeg,jpg,png,gif'])->move($uploadDir);
        if($info){
            $imgUrl = "/uploads/images/" . $info->getSaveName();
            die(json_encode(['status'=>1,'info'=>'上传图片成功','data'=>['url'=>$imgUrl]]));
        }else{
            die(json_encode(['status'=>-1,'info'=>'上传图片错误']));
        }
    }
}


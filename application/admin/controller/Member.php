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


    
}


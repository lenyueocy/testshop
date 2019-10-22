<?php
namespace app\admin\controller;

use Constants\TBS;
use Constants\SiteConst;
use Common\Functions;
use ExportExcel\ExportUser;
class Member extends Common
{
    public function user_list() {
        if ($this->isAjax) {

            $data = $this->input;
            $data['p'] = isset($data['p']) && $data['p'] ? $data['p'] : 1;
            $data['num'] = isset($data['num']) && $data['num'] ? $data['num'] : 10;
            $sqlObj = $this->tb(TBS::USER)
            ->alias('a')
            ->join(TBS::USER.' b','a.fromid=b.id','left')
            ->field('a.id,a.headpic,a.nickname,a.sex,a.addtime,a.mobile as phone,b.realname,b.mobile')
            ->where($this->input['where'])
            ->order(['a.id'=>'desc'])->page($data['p'],$data['num'])
                ->select();
            $count =$this->tb(TBS::USER)
                ->alias('a')
                ->join(TBS::USER.' b','a.fromid=b.id','left')
                ->field('a.id,a.headpic,a.nickname,a.sex,a.addtime,b.realname,b.mobile')
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

    public function user_export() {
        $where = isset($this->input['where']) ? $this->input['where'] : [];

        $user = $this->tb(TBS::USER)
            ->alias('a')
            ->join(TBS::USER.' b','a.fromid=b.id','left')
            ->field('a.id,a.nickname,a.sex,a.addtime,a.mobile,b.realname as groupername,b.mobile as groupermobile')
            ->order('a.id desc')
            ->where($where)
            ->select();

        if (empty($user)) {
            $this->errorMsg('没有可导出结果');
        }


        $export = new ExportUser();
        $this->successMsg($export->export($user));
    }


    /**
     * 用户积分管理
     * perry
     * 2018/11/15
     *
     *
     */
    public function user_point(){

        if ($this->isAjax) {
            $data = $this->input;
            $data['p'] = isset($data['p']) && $data['p'] ? $data['p'] : 1;
            $data['num'] = isset($data['num']) && $data['num'] ? $data['num'] : 10;
            //查询所有用户信息
            $sqlObj = $this->tb(TBS::USER)->field('id,nickname')->where($this->input['where'])->select();

            //查询每个用户积分
            $list=array();
            if(!empty($sqlObj)){
                foreach($sqlObj as $k=>$item){

                    $point = $this->getpoint($item['id']);

                    $sqlObj[$k]['total']=$point['total'];
                    $sqlObj[$k]['addtime']=$point['addtime'];
                    $sqlObj[$k]['datetime']=$point['addtime']?date('Y-m-d H:i:s',$point['addtime']):'未领取';
                }

                //排序
                $sqlObj=$this->sortt($sqlObj);

                //获取分页数据
                $list = array_slice($sqlObj,($data['p']-1)*$data['num'],$data['num']);
            }
            $count = $this->tb(TBS::USER)->where($this->input['where'])->count();
            $return = [
                'p'=>$data['p'],
                'num'=>$data['num'],
                'total'=>$count,
                'rows'=>$list
            ];
            $this->ajaxMsg($return);
        }
        return $this->fetch('member/user/point');

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
     * 获取用户最新一条积分记录
     */
    public function getpoint($id){
        $info = $this->tb(TBS::USER_POINT)->field('addtime,total')->where(['userid'=>$id])->order('addtime','desc')->find();
        return $info;
    }

    /**
     *用户积分记录
     * perry
     * 2018/11/15
     */
    public function user_pointlog(){
        if ($this->isAjax) {
            $data = $this->input;
            $data['p'] = isset($data['p']) && $data['p'] ? $data['p'] : 1;
            $data['num'] = isset($data['num']) && $data['num'] ? $data['num'] : 10;
            //查询记录信息
            $sqlObj = $this->tb(TBS::USER_POINT)->field('id,title,num,addtime,total')->where($this->input['where'])->order(['addtime'=>'desc'])->select();
            $list=array();
            if(!empty($sqlObj)){
                //获取分页数据
                $list = array_slice($sqlObj,($data['p']-1)*$data['num'],$data['num']);
                foreach($list as &$item){
                    $item['addtime'] = date('Y-m-d H:i:s',$item['addtime']);
                }
            }

            $count = $this->tb(TBS::USER_POINT)->where($this->input['where'])->count();
            $return = [
                'p'=>$data['p'],
                'num'=>$data['num'],
                'total'=>$count,
                'rows'=>$list
            ];
            $this->ajaxMsg($return);
        }
        return $this->fetch('member/user/pointlog');

    }
    //升级团长
    public function user_upgrade() {
        if ($this->isAjax) {
            $return = $this->doUpdate(TBS::USER, [
                'id'=>$this->input['id'],
                'type'=>SiteConst::USER_TYPE_PARCHSE,
                'fromid'=>$this->input['id'],
                'mobile'=>$this->input['mobile'],
                'realname'=>$this->input['realname']
            ]);
            $this->tb(TBS::USER_AREA)->insert([
                'userid'=>$this->input['id'],
                'areaid'=>$this->input['area']
            ]);
            $this->ajaxMsg($return);
        }
        $detail = $this->detail(TBS::USER);
        $this->assign('user',$detail);
        $userarea = $this->tb(TBS::USER_AREA)
            ->field('id,areaid')
            ->select();
        $areaids=array();
        $where =[
            'status'=>SiteConst::STATUS_NORMAL
        ];
        if(!empty($userarea)){
            foreach($userarea as $item){
                $areaids[] = $item['areaid'];
            }
            $where['id']=array('not in',$areaids);
        }

        $area = $this->tb(TBS::AREA)
            ->where($where)
            ->field('id,title')
            ->select();
        $this->assign('area',$area);
        
        return $this->fetch('member/user/upgrade');
    }


    /**
     * 积分修改
     */
    public function user_pointedit() {
        if ($this->isAjax) {
            $return = $this->pointedit(TBS::USER_POINT,$this->input);

            $this->ajaxMsg($return);
        }
        //查询用户信息
        $detail = $this->detail(TBS::USER);
        $this->assign('user',$detail);
        //查询目前积分

        $point = $this->tb(TBS::USER_POINT)->where(['userid'=>$this->input['id']])->field('id,total')->order(['id'=>'desc'])->find();
        $point['total']  = intval($point['total']);
        $this->assign('point',$point);

        return $this->fetch('member/user/pointedit');
    }

    public function user_change() {
        if ($this->isAjax) {
            $return = $this->doUpdate(TBS::USER,$this->input);
            $this->ajaxMsg($return);
        }
        $detail = $this->detail(TBS::USER);
        $this->assign('user',$detail);
        
        $groups = $this->tb(TBS::USER)->where(['type'=>SiteConst::USER_TYPE_PARCHSE])->field('id,realname')->select();
        $this->assign('groups',$groups);
        
        return $this->fetch('member/user/change');
    }

    
    
    public function grouper_list() {
        if ($this->isAjax) {
            $sqlObj = $this->tb(TBS::USER)
                ->alias('a')
                ->join(TBS::USER_AREA.' b','b.userid=a.id')
                ->where($this->input['where'])
                ->field('a.id,a.nickname,a.headpic,a.realname,a.sex,a.addtime,a.mobile,b.areaid')
                ->order('a.addtime desc');
            $return = $this->jsonData($sqlObj);
            $this->ajaxMsg($return);
        }
        $areas = $this->tb(TBS::AREA)->column('id,title');
        $this->assign('areas',$areas);
        
        return $this->fetch('member/grouper/list');
    }
    //团长降级
    public function grouper_down() {
        if ($this->isAjax) {
            //设为用户
            $this->tb(TBS::USER)->where([
                'id'=>$this->input['id']
            ])->update([
                'type'=>SiteConst::USER_TYPE_USER
            ]);
            
            //替换团长
            $this->tb(TBS::USER)->where([
                'fromid'=>$this->input['id']
            ])->update([
                'fromid'=>$this->input['groupid']
            ]);
            
            //删除关联地址
            $this->tb(TBS::USER_AREA)->where([
                'userid'=>$this->input['id']
            ])->delete();
            $this->successMsg([]);
        }
        $detail = $this->detail(TBS::USER);
        $this->assign('user',$detail);
        
        $groups = $this->tb(TBS::USER)->where([
                'type'=>SiteConst::USER_TYPE_PARCHSE,
                'id'=>['<>',$this->input['id']]
            ])
            ->field('id,realname')
            ->select();
        $this->assign('groups',$groups);
        
        return $this->fetch('member/grouper/down');
    }
    //团长佣金明细
    public function grouper_income() {
        if ($this->isAjax) {
            $sqlObj = $this->tb(TBS::USER_ACCOUNT)
                ->alias('a')
                ->join(TBS::ORDER.' b','a.orderid=b.id','left')
                ->join(TBS::USER.' c','c.id=a.fromid','left')
                ->field('a.id,a.orderfee,a.scale,a.scalefee,a.addtime,b.orderno,c.nickname,a.type')
                ->where($this->input['where'])
                ->order('a.id desc');
            $data = $this->jsonData($sqlObj);
            $this->ajaxMsg($data);
        }
        return $this->fetch('member/grouper/income');
    }
    //团长结算
    public function grouper_bill() {
        if ($this->isAjax) {
            $add = [];
            foreach ($this->input['bill'] as $userid=>$money) {
                if ($money<=0) {
                    continue;
                }
                $add[] = [
                    'userid'=>$userid,
                    'scalefee'=>$money,
                    'type'=>SiteConst::USER_ACCOUNT_TYPE_BILL,
                    'addtime'=>Functions::date(),
                ];
            }
            if (!empty($add)) {
                $this->tb(TBS::USER_ACCOUNT)->insertAll($add);
            }
            $this->successMsg([]);
        }
        $incomeData = $this->tb(TBS::USER_ACCOUNT)
            ->group('userid')
            ->where(['type'=>SiteConst::USER_ACCOUNT_TYPE_INCOME])
            ->column('userid,sum(scalefee) as income');
        
        $billData = $this->tb(TBS::USER_ACCOUNT)
            ->group('userid')
            ->where(['type'=>SiteConst::USER_ACCOUNT_TYPE_BILL])
            ->column('userid,sum(scalefee) as bill');
        
        $grouper = $this->tb(TBS::USER)
            ->where(['type'=>SiteConst::USER_TYPE_PARCHSE])
            ->field('id,mobile,realname')
            ->select();
        
        foreach ($grouper as $key=>$g) {
            $g['income'] = isset($incomeData[$g['id']]) ? round($incomeData[$g['id']],2) : 0;
            $g['bill'] = isset($billData[$g['id']]) ? round($billData[$g['id']],2) : 0;
            $g['pedding'] = round($g['income'] - $g['bill'],2);
            $grouper[$key] = $g;
        }
        $this->assign('grouper',$grouper);
        return $this->fetch('member/grouper/bill');
    }
    
}


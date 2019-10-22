<?php
namespace Model;
use think\Db;
use Constants\TBS;
use Common\Data;
use QiniuSdk\Qiniu;
use Common\Functions;
use Constants\SiteConst;

class UserModel extends BasicModel
{

    protected $table = TBS::USER;

    public function findById($userid)
    {
        if (! Data::instance()->{'userInfo' . $userid}) {
            Data::instance()->{'userInfo' . $userid} = $this->find([
                'id' => $userid
            ]);
        }
        return Data::instance()->{'userInfo' . $userid};
    }
    /**
     * 根据取货码查询用户
     */
    public function findByphone($userid)
    {
        $info = Db::table(TBS::USER)->field('*')->where(array('id'=>$userid))->find();
        return $info;
    }
    /**
     * 根据取货码查询用户
     */
    public function findByCode($code)
    {
        $info = Db::table(TBS::USER)->field('id')->where(array('code'=>$code))->find();
        return $info;
    }

    /**
     * 获取用户积分
     */
    public function getPoint($userid){

       $info =  Db::table(TBS::USER_POINT)->field('sum(num) as s')->where(array('userid'=>$userid))->find();
       return $info['s']?$info['s']:0;
    }

    /**
     * 下单购买更新用户积分
     */
      public function savePoint($userid,$tite,$downpoint,$totalpoint,$content){
          Db::table(TBS::USER_POINT)->insert(['title'=>$tite,'userid'=>$userid,'num'=>$downpoint,'addtime'=>time(),'total'=>$totalpoint,'content'=>$content]);
      }

    public function userInfo($user)
    {

        $sessionMod = new UserSessionModel();
        $info = [
            'userid' => $user['id'],
            'nickname' => $user['nickname'],
            'sex' => $user['sex'],
            'realname'=> $user['realname'],
            'title' => $user['title'],
            'address' => $user['address'],
            'headpic' => $user['headpic'],
            'mobile'=>$user['mobile'],
            // 'address'=>$user['address'],
            'type'=>isset($user['type']) ? $user['type'] : SiteConst::USER_TYPE_USER,
            'fromid'=>$user['fromid'],
            'sessionkey' => $sessionMod->getSession($user['id'])
        ];
        return [
            'user' => $info,
            'nowTime' => time()
        ];
    }

    public function reuserInfo($user)
    {

        $sessionMod = new UserSessionModel();
        $info = [
            'userid' => $user['id'],
            'nickname' => $user['nickname'],
            'sex' => $user['sex'],
            'headpic' => $user['headpic'],
            'mobile'=>$user['mobile'],
            // 'address'=>$user['address'],
            'type'=>isset($user['type']) ? $user['type'] : SiteConst::USER_TYPE_USER,
            'fromid'=>$user['fromid'],
            'sessionkey' => $sessionMod->getSession($user['id'])
        ];
        return [
            'user' => $info,
            'nowTime' => time()
        ];
    }

    public function savephone($userid,$phone){
        $this->update(['id'=>$userid], ['mobile'=>$phone]);
        $user =$this->findByphone($userid);
        return $this->reuserInfo($user);
    }

    public function createUser($info,$mobile)
    {

       // $up = Qiniu::init()->uploadByUrl($info['avatarUrl']);
       // $info['avatarUrl'] = Qiniu::getDomain() . $up['key'];
        $info['nickName'] = Functions::delSpecial($info['nickName']);
        //查询from是否团长
        $from = Data::instance()->from;
        if($from>0){
            //查询是否团长
            $finfo =$this->getTb($this->table)->where(['id'=>$from])->field('headpic,mobile,title,address,realname,email,type')->find();
            if(empty($finfo)||$finfo['type']==1){ //type=1 普通用户 2 团长
                $from=0;
            }

        }else{
            $from=0;
        }


        $add = [
            'nickname' => $info['nickName'],
            'sex' => $info['gender'],
            'headpic' => $info['avatarUrl'],
            'fromid' => $from,
            'mobile'=>$mobile,
            'addtime' => Functions::date(),
        ];

        return $this->insert($add);
    }
    
    public function setFromid($userid,$fromid){
        return $this->update(['id'=>$userid], ['fromid'=>$fromid]);
    }

    public function setCode($userid,$data){
        return $this->update(['id'=>$userid], $data);
        return $this->update(['id'=>$userid], $data);
    }
    
    public function groupInfo($userid) {
        return $this->init('a')
            ->join(TBS::USER_AREA, 'b', 'a.id=b.userid')
            ->join(TBS::AREA, 'c', 'c.id=b.areaid')
            ->where(['a.id'=>$userid])
            ->field('a.headpic,a.nickname,a.mobile,c.title,b.ext,c.address,c.status,a.realname,a.email,a.type')
            ->result('find');
    }

    /**
     * 普通用户我的资料
     */
    public function user($userid) {
        return $this->getTb($this->table)->where(['id'=>$userid])->field('id,headpic,mobile,title,address,nickname,realname,email,type')->find();
    }

    /**
     * 查询提货码时间
     */
    public function getInfo($userid){

        return $this->getTb($this->table)->where(['id'=>$userid])->field('code,codetime')->find();

    }


    /**
     * 生成提货码
     * @return string
     */
    public function get_order_sn()
    {
        $code = null;
        // 保证不会有重复订单号存在
        while(true){
            $code = rand(100000,999999); // 订单编号
            $code_count = $this->getTb($this->table)->where(["code"=>$code])->count();
            if($code_count == 0)
                break;
        }

        return $code;
    }

    /**
     * 购买指数
     */
    public function getBuyNum($userid){
        $info =$this->getTb('a')->join(TBS::ORDER.' b','a.id=b.userid','right')->field('a.id')->where(['a.fromid'=>$userid])->group('a.id')->select();
        return count($info);
    }

    /**
     * 粉丝指数
     */
    public function getTeamNum($userid){
        $info = $this->getTb($this->table)->field('count(id) as c')->where(['fromid'=>$userid])->find();
        return $info['c'];
    }
    
    public function editInfo($userid,$realname,$mobile,$email) {
        return $this->update([
            'id'=>$userid
        ], [
            'realname'=>$realname,
            'mobile'=>$mobile,
            'email'=>$email
        ]);
    }

    /*
     * 更新个人资料 edit_Area
     */
    public function edit_Info($userid,$realname,$mobile,$title,$address) {
        return $this->update([
            'id'=>$userid
        ], [
            'realname'=>$realname,
            'mobile'=>$mobile,
            'title'=>$title,
            'address'=>$address,
        ]);
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: lwen_phper@163.com
 * Date: 2018/11/30
 * Time: 11:29
 */

namespace Model;

use Constants\TBS;
use Common\Data;
use QiniuSdk\Qiniu;
use Common\Functions;
use Constants\SiteConst;

class UserPointModel extends BasicModel
{
    protected $table = TBS::USER_POINT;
    /**
     * 查询积分表
     */
    public function user_point($userid){

        //获取所有积分记录
        $info = $this->getTb($this->table)->field('id,title,num,addtime,total')->where(['userid'=>$userid])->order(['addtime'=>'desc'])->select();
        return $info;
    }
    public function last_total($userid){

         //查询现有积分
        $point = $this->getTb($this->table)->where(['userid'=>$userid])->field('id,total')->order(['id'=>'desc'])->find();
         //最后一条积分信息
        //$info = $this->getTb($this->table)->field('title,num,addtime,total')->where(['userid'=>$userid])->order('addtime','desc')->find();
        return $point;

    }
}
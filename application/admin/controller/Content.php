<?php
namespace app\admin\controller;

use Constants\TBS;
use Constants\SiteConst;
class Content extends Common
{
    public function swiper_list() {
        $imgs = $this->tb(TBS::FILE_RESOURCE)
            ->where(['field'=>SiteConst::IMAGE_SINGLE])
            ->column('sign,filekey');

        if ($this->isAjax) {

            $sqlObj = $this->tb(TBS::SWIPER)->where($this->input['where']);
            $data = $this->jsonData($sqlObj);
            if(!empty($data['rows'])){
                foreach ($data['rows'] as &$v){
                   @ $v['img'] = $imgs[$v['sign']];
                }
                unset($v);
            }

            $this->ajaxMsg($data);
        }

     //   $this->assign('banners',$imgs);

        $goods = $this->tb(TBS::GOODS)
        ->where(['status'=>SiteConst::GOODS_STATUS_UP])
        ->column('id,title');
        $this->assign('goods',$goods);
        
        return $this->fetch('content/swiper/list');
    }
    
    public function swiper_add() {

        if ($this->isAjax) {
            $num = $this ->tb(TBS::SWIPER)->count();

            if ($num >= 3){
                $return = ['status'=>-1,'info'=>'轮播图超过三张'];
                $this->ajaxMsg($return);
            }
            $return = $this->doAdd(TBS::SWIPER, $this->input,[SiteConst::IMAGE_SINGLE]);
            $this->ajaxMsg($return);
        }
        $goods = $this->tb(TBS::GOODS)
        ->where(['status'=>SiteConst::GOODS_STATUS_UP])
        ->field('id,title')
        ->select();
        $this->assign('goods',$goods);
        return $this->fetch('content/swiper/add');
    }
    
    public function swiper_edit() {
        if ($this->isAjax) {
            $return = $this->doUpdate(TBS::SWIPER, $this->input,[SiteConst::IMAGE_SINGLE]);
            $this->ajaxMsg($return);
        }
        $detail = $this->detail(TBS::SWIPER,SiteConst::IMAGE_SINGLE);
        $this->assign('detail',$detail);
        
        $goods = $this->tb(TBS::GOODS)
        ->where(['status'=>SiteConst::GOODS_STATUS_UP])
        ->field('id,title')
        ->select();
        $this->assign('goods',$goods);
        
        return $this->fetch('content/swiper/edit');
    }
    
    public function swiper_del() {
        $return = $this->doDel(TBS::SWIPER);
        $this->ajaxMsg($return);
    }
}
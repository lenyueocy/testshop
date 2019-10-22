<?php
namespace Model;
use think\Db;
use Constants\TBS;
use Constants\SiteConst;
use Logic\CommonLogic;

class GoodsModel extends BasicModel
{

    protected $table = TBS::GOODS;
    
    public function pageGoods($where,$order,$p,$num) {

        if (!isset($where['status'])) {
            $where['status'] = SiteConst::GOODS_STATUS_UP;
        }
        $order['sort'] = 'desc';
        $order['id'] = 'desc';
        $pageData = $this->init()
            ->where($where)
            ->order($order)
            ->field('entitle,desc,status,uptime,addtime,addid,updatetime,updateid',true)
            ->result('select');


        $goodsId = array_column($pageData, 'id');
        $hasSku = $this->getHasSku($goodsId);
        
        foreach ($pageData as $key=>$guds) {

            $guds['hasSku'] = isset($hasSku[$guds['id']]) && $hasSku[$guds['id']]>0 ? SiteConst::YES_VALUE : 0;
            $guds['imageUrl'] = CommonLogic::findResource($guds['sign'], 'single');
            $guds['sendTime'] = date('Y/m/d H:i:s',strtotime($guds['send']));
            $pageData[$key] = $guds;
        }
        return $pageData;
    }

    /**
     * 根据条件查询商品
     */
    public function getGoods($keyword,$cid,$p,$num)
    {
        $where = $order=array();
        $where['status'] = SiteConst::GOODS_STATUS_UP;
        if($keyword){
            $where['title']=array('like','%'.$keyword.'%');
        }
        $where['saleend']=array('gt',date('Y-m-d',time()));
        if($cid>0){
            //查询分类
            $cateinfo =  Db::table(TBS::GOODS_CATEGORY)->field('goodsid')->where(array('categoryid'=>$cid))->select();
            if(!empty($cateinfo)){
                $goodsids = array();
                foreach($cateinfo as $item){
                    $goodsids[]=$item['goodsid'];
                }
                $where['id']  = array('in',$goodsids);
            }else{
                return [];
            }
        }
        $order['sort'] = 'desc';
        $order['updatetime'] = 'desc';
        $pageData = $this->getTb()
            ->where($where)
            ->order($order)
            ->page($p,$num)
            ->select();
        $res = $this->getTb()->getLastSql();

        $goodsId = array_column($pageData, 'id');
        $hasSku = $this->getHasSku($goodsId);

        foreach ($pageData as $key=>$guds) {
            $guds['hasSku'] = isset($hasSku[$guds['id']]) && $hasSku[$guds['id']]>0 ? SiteConst::YES_VALUE : 0;
            $guds['imageUrl'] = CommonLogic::findResource($guds['sign'], 'single');
            $guds['endTimes']=$guds['saleend'];
            $guds['sendTime'] = date('m-d H:i',strtotime($guds['send']));
            $guds['salestart'] = date('m-d H:i',strtotime($guds['salestart']));
            $guds['saleend'] = date('m-d H:i',strtotime($guds['saleend']));
            $pageData[$key] = $guds;
        }
        return $pageData;
    }


    
    public function selectById($gudsid) {
        $where = ['id'=>['in',$gudsid]];
        $goodsData = $this->pageGoods($where, [], 1, count($gudsid));
        $return  = [];
        foreach ($goodsData as $guds) {
            $return[$guds['id']] = $guds;
        }
        return $return;
    }
    
    public function goodsSku($skuid) {
        return [];
    }
    
    public function detail($goodsid,$img = true) {
        $detail = $this->init()
            ->where([
                'id'=>$goodsid,
                'status'=>SiteConst::GOODS_STATUS_UP
            ])
            ->field('status,uptime,addtime,addid,updatetime,updateid',true)
            ->result('find');
        if (!$detail) {
            self::error(30001);
        }

        $hasSku = $this->getHasSku($goodsid);
        $detail['endTimes']=$detail['saleend'];
        $detail['salestart'] = date('m-d H:i',strtotime($detail['salestart']));
        $detail['saleend'] = date('m-d H:i',strtotime($detail['saleend']));
        $detail['sendTime'] = date('m-d H:i',strtotime($detail['send']));
        $detail['hasSku'] = isset($hasSku[$detail['id']]) && $hasSku[$detail['id']]>0 ? SiteConst::YES_VALUE : 0;
        if ($img === true) {
            $detail['imageUrl'] = CommonLogic::findResource($detail['sign'], SiteConst::IMAGE_SINGLE,true);
            $detail['atlasImage'] = CommonLogic::findResource($detail['sign'], SiteConst::IMAGE_ATLAS,true);
        }
        return $detail;
    }
    
    public function selectWithCategory(){
        $categuds = $this->init('a')
            ->join(TBS::GOODS_CATEGORY, 'b', 'b.goodsid=a.id','right')
            ->where([
                'a.status'=>SiteConst::GOODS_STATUS_UP,
                'a.leftnum'=>['>',0]
            ])
            ->field('a.id,a.title,a.sign,b.categoryid,a.price,a.leftnum')
            ->result('select');
        $return = [];
        foreach ($categuds as $guds) {
            if (!isset($return[$guds['categoryid']])) {
                $return[$guds['categoryid']] = [];
            }
            $guds['imageUrl'] = CommonLogic::findResource($guds['sign'], SiteConst::IMAGE_SINGLE);
            $return[$guds['categoryid']][] = $guds;
        }
        return $return;
    }
    
    public function getHasSku($goodsId) {
        if (!$goodsId || empty($goodsId)) {
            return [];
        }
        return [];
    }
    public function savehits($goodsid){
        $this->getTb()
            ->where(['id'=>$goodsid])
            ->update([
                'hits'=>['exp','hits+1']
            ]);
    }
    
    public function stockNum($goodsid,$num) {
        $this->getTb()
            ->where(['id'=>$goodsid])
            ->update([
                'leftnum'=>['exp','leftnum'.($num>0 ? '+'.$num : $num)]
            ]);
    }
//    public function stockNum($goodsid,$num) {
//        $this->getTb()
//            ->where(['id'=>$goodsid])
//            ->update([
//                'leftnum'=>['exp','leftnum'.($num>0 ? '+'.$num : $num)]
//            ]);
//    }
}
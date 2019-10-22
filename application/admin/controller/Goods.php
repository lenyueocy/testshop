<?php
namespace app\admin\controller;

use Constants\TBS;
use Constants\ConstArr;
use Constants\SiteConst;
use Logic\AdminLogic;
use Model\ConfigModel;

class Goods extends Common
{   
    private $tags = [
        [
            'field'=>'ishot',
            'title'=>'热卖'
        ],
        [
            'field'=>'isnew',
            'title'=>'精品'
        ],[
            'field'=>'isquality',
            'title'=>'限量'
        ],[
            'field'=>'issale',
            'title'=>'预售'
        ]
    ];
    
    public function goods_list() {
        if ($this->isAjax) {
            $sqlObj = $this->tb(TBS::GOODS)
                ->alias('a')
                ->join(TBS::GOODS_CATEGORY.' b','a.id=b.goodsid','left')
                ->field('a.*')
                ->where($this->input['where'])
                ->order('a.sort desc,a.id desc')
                ->group('a.id');
            $return = $this->jsonData($sqlObj);
            $this->ajaxMsg($return);
        }
        
        $category = $this->tb(TBS::CATEGORY)->field('id,title,parentid,level')->select();
        $this->assign('category',$category);
        
        return $this->fetch('goods/goods/list');
    }
    
    public function goods_add() {
        if ($this->isAjax) {

            if(strtotime($this->input['salestart'])>strtotime($this->input['saleend'])){
                return ['status'=>-1,'info'=>'预售开始时间不能大于预售结束时间'];
            }

            if($this->input['types']==1){
                if(empty($this->input['sendtxt'])){
                    return ['status'=>-1,'info'=>'配送文本不能为空'];
                }
            }else{
                if(strtotime($this->input['saleend'])>strtotime($this->input['send'])){
                    return ['status'=>-1,'info'=>'预售结束时间不能大于配送时间'];
                }
            }


            if(isset($this->input['isopen'])){
                $this->input['isopen']=1;
                //判断积分规则开启/关闭 开启的时候 积分消耗和优惠现金不能为空 优惠金额不能大于积分数量
                if(empty($this->input['down'])){
                    return ['status'=>-1,'info'=>'请输入消耗积分'];
                }
                if(empty($this->input['cash'])){
                    return ['status'=>-1,'info'=>'请输入优惠金额'];
                }
                if($this->input['cash']>=$this->input['down']){
                    return ['status'=>-1,'info'=>'消耗积分必须大于优惠金额'];
                }
            }else{
                $this->input['isopen']=0;
            }
            if($this->input['cash']>=$this->input['price']){
                return ['status'=>-1,'info'=>'优惠金额必须小于商品价格'];
            }
            if($this->input['gift']>$this->input['price']){
                return ['status'=>-1,'info'=>'赠送积分不能大于商品价格'];
            }

            if (!isset($this->input['category'])){
                return ['status'=>-1,'info'=>'请选择商品分类'];
            }
            //商品名字去重
            $goods = $this->tb(TBS::GOODS)->where(['title'=>$this->input['title']])->find();
            if(!empty($goods)){
                return ['status'=>-1,'info'=>'商品名称已存在'];
            }
            if(!isset($this->input['single'])){
                return ['status'=>-1,'info'=>'请上传商品主图'];
            }

            if(!isset($this->input['atlas'])){
                return ['status'=>-1,'info'=>'请上传商品详情图片'];
            }
            if (isset($this->input['tag'])) foreach ($this->input['tag'] as $key=>$value) {
                $this->input[$key] = 1;
            }
            $this->input['leftnum'] = $this->input['num'];
            $return = $this->doAdd(TBS::GOODS, $this->input,[SiteConst::IMAGE_SINGLE,SiteConst::IMAGE_ATLAS]);
            if ($return['status'] == 1) {
                $add = [];
                if (isset($this->input['category'])){
                    foreach ($this->input['category'] as $cateid) {
                        $add[] = [
                            'goodsid'=>$return['data'],
                            'categoryid'=>$cateid
                        ];
                    }
                    if (!empty($add)) {
                        $this->tb(TBS::GOODS_CATEGORY)->insertAll($add);
                    }
                }
                
            }
            $this->ajaxMsg($return);
        }
        
        $category = $this->tb(TBS::CATEGORY)->field('id,title,parentid,level')->select();
        $this->assign('category',$category);
        
        $this->assign('tags',$this->tags);
        
        return $this->fetch('goods/goods/add');
    }
    
    public function goods_edit() {
        if ($this->isAjax) {
            //判断预售时间
            if(strtotime($this->input['salestart'])>strtotime($this->input['saleend'])){
                return ['status'=>-1,'info'=>'预售开始时间不能大于预售结束时间'];
            }
            //判断用户是否想选择的配送时间 types=0是时间  types=1是文本
            if($this->input['types']==0){
                $this->input['sendtxt']="";
            }

            if($this->input['types']==1){
                if(empty($this->input['sendtxt'])){
                    return ['status'=>-1,'info'=>'配送文本不能为空'];
                }
            }else{
                if(strtotime($this->input['saleend'])>strtotime($this->input['send'])){
                    return ['status'=>-1,'info'=>'预售结束时间不能大于配送时间'];
                }
            }

            if(isset($this->input['isopen'])){
                $this->input['isopen']=1;
                //判断积分规则开启/关闭 开启的时候 积分消耗和优惠现金不能为空 优惠金额不能大于积分数量
                if(empty($this->input['down'])){
                    return ['status'=>-1,'info'=>'请输入消耗积分'];
                }
                if(empty($this->input['cash'])){
                    return ['status'=>-1,'info'=>'请输入优惠金额'];
                }
                if($this->input['cash']>=$this->input['down']){
                    return ['status'=>-1,'info'=>'消耗积分必须大于优惠金额'];
                }
            }else{
                $this->input['isopen']=0;
            }
            if($this->input['cash']>=$this->input['price']){
                return ['status'=>-1,'info'=>'优惠金额必须小于商品价格'];
            }
            if($this->input['gift']>$this->input['price']){
                return ['status'=>-1,'info'=>'赠送积分不能大于商品价格'];
            }
            if($this->input['leftnum']>$this->input['num']){
                return ['status'=>-1,'info'=>'剩余库存不能大于总库存'];
            }
            if (!isset($this->input['category'])){
                return ['status'=>-1,'info'=>'请选择商品分类'];
            }
            //商品名字去重
            $goods = $this->tb(TBS::GOODS)->where(['title'=>$this->input['title'],'id'=>array('neq',$this->input['id'])])->find();
            if(!empty($goods)){
                return ['status'=>-1,'info'=>'商品名称已存在'];
            }
            if(!isset($this->input['single'])){
                return ['status'=>-1,'info'=>'请上传商品主图'];
            }

            if(!isset($this->input['atlas'])){
                return ['status'=>-1,'info'=>'请上传商品详情图片'];
            }



            foreach ($this->tags as $tag) {
                if (isset($this->input['tag']) && isset($this->input['tag'][$tag['field']])) {
                    $this->input[$tag['field']] = 1;
                }else{
                    $this->input[$tag['field']] = 2;
                }
            }
            $return = $this->doUpdate(TBS::GOODS, $this->input,[SiteConst::IMAGE_SINGLE,SiteConst::IMAGE_ATLAS]);

            if ($return['status'] == 1) {
                $this->tb(TBS::GOODS_CATEGORY)
                    ->where([
                        'goodsid'=>$this->input['id']
                    ])
                    ->delete();
                $add = [];
                if (isset($this->input['category'])){
                    foreach ($this->input['category'] as $cateid) {
                        $add[] = [
                            'goodsid'=>$this->input['id'],
                            'categoryid'=>$cateid
                        ];
                    }
                    if (!empty($add)) {
                        $this->tb(TBS::GOODS_CATEGORY)->insertAll($add);
                    }
                }
            }
            $this->ajaxMsg($return);
        }


        $detail = $this->detail(TBS::GOODS,['single','atlas']);
        $this->assign('detail',$detail);
        
        $category = $this->tb(TBS::CATEGORY)->field('id,title,parentid,level')->select();
        $this->assign('category',$category);
        
        $this->assign('tags',$this->tags);
        
        $goodsCate = $this->tb(TBS::GOODS_CATEGORY)->where(['goodsid'=>$this->input['id']])->column('categoryid');
        $this->assign('goodsCate',$goodsCate);
        
        return $this->fetch('goods/goods/edit');
    }
    
    public function goods_deal() {
        $return = $this->doDeal(TBS::GOODS);
        $this->ajaxMsg($return);
    }
    
    public function goods_del() {
        //查询商品如果有购买记录不能删除
        $goodsinfo = $this->tb(TBS::GOODS)->where(['id'=>['in',$this->input['dataId']]])->select();
        if(!empty($goodsinfo)){
            foreach ($goodsinfo as $item){
                if($item['status']!=1){
                    $return = ['status'=>-1,'info'=>$item['title'].'还未下架，不能删除'];
                    $this->ajaxMsg($return);
                    exit;
                }
                //查询商品有没有关联订单
                $ordergoods = $this->tb(TBS::ORDER_GOODS)->where(['goodsid'=>$item['id']])->find();
                if(!empty($ordergoods)){
                    $return = ['status'=>-1,'info'=>$item['title'].'已在购买订单中，不能删除'];
                    $this->ajaxMsg($return);
                    exit;
                }
            }
        }

        $return = $this->doDel(TBS::GOODS,['status'=>SiteConst::YES_VALUE]);

        if ($return['status'] == 1) {
            $this->tb(TBS::GOODS_SKU)->where(['goodsid'=>['in',$this->input['dataId']]])->delete();
            $this->tb(TBS::GOODS_CATEGORY)->where(['goodsid'=>['in',$this->input['dataId']]])->delete();
            $this->tb(TBS::GOODS_ATTR)->where(['goodsid'=>['in',$this->input['dataId']]])->delete();
        }
        $this->ajaxMsg($return);
    }
    
    public function goods_set() {
        $return  = $this->doUpdate(TBS::GOODS, $this->input);
        $this->ajaxMsg($return);
    }
    
    public function pack_add() {
        if ($this->isAjax) {
            $this->input['type'] = SiteConst::GOODS_TYPE_PACKAGE;
            $this->input['sign'] = $this->randSign();
            $return = $this->doAdd(TBS::GOODS, $this->input);
            if ($return['status'] == 1) {
                $this->dealUpload();
                AdminLogic::updatePackGoods($return['data'], $this->input['guds'], $this->input['num']);
            }
            $this->ajaxMsg($return);
        }
        $allGoods = $this->tb(TBS::GOODS)
            ->where([
                'type'=>['<>',SiteConst::GOODS_TYPE_PACKAGE]
            ])
            ->field('id,title')
            ->select();
        $this->assign('allGoods',$allGoods);
        
        $this->assign('packType',ConstArr::PACK_TYPE);
        return $this->fetch('goods/pack/add');
    }
    
    public function pack_edit() {
        if ($this->isAjax) {
            $this->input['type'] = SiteConst::GOODS_TYPE_PACKAGE;
            $return = $this->doUpdate(TBS::GOODS, $this->input);
            if ($return['status'] == 1) {
                $this->dealUpload();
                AdminLogic::updatePackGoods($this->input['id'], $this->input['guds'], $this->input['num']);
            }
            $this->ajaxMsg($return);
        }
        $this->assign('detail',$this->detail(TBS::GOODS,'single'));
        
        $allGoods = $this->tb(TBS::GOODS)
            ->where([
                'type'=>['<>',SiteConst::GOODS_TYPE_PACKAGE]
            ])
            ->field('id,title')
            ->select();
        $this->assign('allGoods',$allGoods);
        
        $goodsPack = $this->tb(TBS::GOODS_PACK)
            ->alias('a')
            ->join(TBS::GOODS.' b','a.goodsid=b.id')
            ->where(['a.packid'=>$this->input['id']])
            ->field('a.goodsid,a.num,b.title')
            ->select();
        $this->assign('goodsPack',$goodsPack);
    
        $this->assign('packType',ConstArr::PACK_TYPE);
        return $this->fetch('goods/pack/edit');
    }
    
    
    /**
     * 分类列表
     */
    public function category_list()
    {
        $nodes = $this->tb(TBS::CATEGORY)
            ->field('id,title,sort,parentid')
            ->order('sort asc,id desc')
            ->select();
        if ($this->isAjax) {
            $this->successMsg($nodes);
        }
        $this->assign('category',$nodes);
        return $this->fetch('goods/category/list');
    }
    
    /**
     * 分类添加
     */
    public function category_add()
    {
        if ($this->isAjax) {

            if(strlen($this->input['title'])>21){
                return ['status'=>-1,'info'=>'分类标题不能超过7个汉字'];
            }

            $this->input['sign'] = $this->randSign();
            $json = $this->doAdd(TBS::CATEGORY, $this->input,[SiteConst::IMAGE_SINGLE]);
            $this->ajaxMsg($json);
        }
        $data = $this->input;
        $parent = '';
        if(isset($data['pid']) && $data['pid']){
            $parent = $this->tb(TBS::CATEGORY)->where(['id'=>$data['pid']])->find();
        }
        $this->assign('parent',$parent);
    
        return $this->fetch('goods/category/add');
    }
    
    /**
     * 分类编辑
     */
    public function category_edit()
    {
        $data = $this->input;
        if ($this->isAjax) {
            if(strlen($this->input['title'])>21){
                return ['status'=>-1,'info'=>'分类标题不能超过7个汉字'];
            }
            $json = $this->doUpdate(TBS::CATEGORY, $data,[SiteConst::IMAGE_SINGLE]);
            $this->ajaxMsg($json);
        }
        $detail = $this->detail(TBS::CATEGORY,'single');
        $this->assign('detail',$detail);
    
        $parent = '';
        if(isset($detail['parentid'])){
            $parent = $this->tb(TBS::CATEGORY)->where(['id'=>$detail['parentid']])->find();
        }
        $this->assign('parent',$parent);
    
        return $this->fetch('goods/category/edit');
    }
    
    /**
     * 分类删除
     */
    public function category_del()
    {
        $data = $this->input['dataId'];
        if(!empty($data)){
            foreach($data as $val){
                //查询分类信息
                $res = $this->tb(TBS::GOODS_CATEGORY)->where(['categoryid'=>$val])->find();
                if(!empty($res)){
                    $json = ['status'=>-1,'info'=>'此分类已关联商品，不能删除'];
                    $this->ajaxMsg($json);
                }
            }

        }



        $json = $this->doDel(TBS::CATEGORY);
        $this->ajaxMsg($json);
    }
    
    public function category_sort() {
        foreach ($this->input['sort'] as $item) {
            $this->doUpdate(TBS::CATEGORY, [
                'id'=>$item['id'],
                'sort'=>$item['sort']
            ]);
        }
        $nodes = $this->tb(TBS::CATEGORY)
            ->field('id,title,sort,parentid')
            ->order('sort asc,id desc')
            ->select();
        $this->successMsg($nodes);
    }

    /*
     * 设置休市开始结束时间和 状态
     *
     */
    public  function  goods_close(){

        $data = $this->input;
        $Config = new ConfigModel();
        $data['id']=2;
        $id=$data['id'];
        if ($this->isAjax) {
            //判断预售时间
            if(strtotime($this->input['salestart'])>strtotime($this->input['saleend'])){
                return ['status'=>-1,'info'=>'预售开始时间不能大于预售结束时间'];
            }
            $json = $this->doUpdate(TBS::CONFIG, $data);
            $this->ajaxMsg($json);
//            $json = $Config->edit_config($id,$data);
//            $this->ajaxMsg($json);
        }

        $detail= $Config -> selects($id);
        $detail=$detail[0];
        $this->assign('detail',$detail);


        return $this->fetch('goods/goods/close');
    }

}
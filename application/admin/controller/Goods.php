<?php
namespace app\admin\controller;

use Constants\TBS;
use Constants\ConstArr;
use Constants\SiteConst;
use Logic\AdminLogic;
use Model\ConfigModel;
use think\Db;

class Goods extends Common
{
    /**
     * 商品列表
     * @author: Leny
     * @date: 2019/01/01 00:00:00
     */
    public function goods_list() {
        if ($this->isAjax) {
            $sqlObj = $this->table('goods')
                ->alias('a')
                ->join(TBS::CATEGORY.' b','a.cate_id=b.id','left')
                ->field('a.*,b.title as category_name')
                ->where($this->input['where'])
                ->order('a.sort desc,a.id desc')
                ->group('a.id');
            $return = $this->jsonData($sqlObj);
            $this->ajaxMsg($return);
        }
        $category = $this->tb(TBS::CATEGORY)->field('id,title')->select();
        $this->assign('category',$category);
        
        return $this->fetch('goods/goods/list');
    }

    /**
     * 商品添加
     * @author: Leny
     * @date: 2019/01/01 00:00:00
     */
    public function goods_add() {
        if ($this->isAjax) {
            $goods = $this->table('goods')->where(['goods_name'=>$this->input['goods_name']])->find();
            if (!$this->input['category']) $this->_return(-1,'请选择商品分类');
            if(!empty($goods)) $this->_return(-1,'商品名已经存在');
            if(empty($this->input['goods_img'])) $this->_return(-1,'请上传商品图片');
            if(empty($this->input['entitle'])) $this->_return(-1,'请填写关键字');
            if(empty($this->input['price'])) $this->_return(-1,'请填写价格');
            if(empty($this->input['saleprice'])) $this->_return(-1,'请填写市场价格');
            if(empty($this->input['num'])) $this->_return(-1,'请填写库存');
            $insertData = [
                'cate_id'=>$this->input['category'],
                'goods_name'=>$this->input['goods_name'],
                'desc'=>$this->input['desc'],
                'goods_img'=>$this->input['goods_img'],
                'entitle'=>$this->input['entitle'],
                'price'=>$this->input['price'],
                'saleprice'=>$this->input['saleprice'],
                'num'=>$this->input['num'],
                'addtime'=>time(),
            ];
            $res = $this->table('goods')->insert($insertData);
            if($res){
                $this->_return(1,'添加商品成功');
            }
            $this->_return(-1,'商品添加失败');
        }
        $categoryData = $this->table('category')->field("id,title,sort")->where(['status'=>1])->select();
        $this->assign('category',$categoryData);
        return $this->fetch('goods/goods/add');
    }

    /**
     * 商品编辑
     * @author: Leny
     * @date: 2019/01/01 00:00:00
     */
    public function goods_edit() {
        if ($this->isAjax) {
            $id = $this->input['id'];
            if(empty($id)) $this->_return(-1,'请选择要编辑的商品');
            if (!$this->input['category']) $this->_return(-1,'请选择商品分类');
            if(empty($this->input['goods_img'])) $this->_return(-1,'请上传商品图片');
            if(empty($this->input['entitle'])) $this->_return(-1,'请填写关键字');
            if(empty($this->input['price'])) $this->_return(-1,'请填写价格');
            if(empty($this->input['saleprice'])) $this->_return(-1,'请填写市场价格');
            if(empty($this->input['num'])) $this->_return(-1,'请填写库存');
            $updateData = [
                'cate_id'=>$this->input['category'],
                'goods_name'=>$this->input['goods_name'],
                'desc'=>$this->input['desc'],
                'goods_img'=>$this->input['goods_img'],
                'entitle'=>$this->input['entitle'],
                'price'=>$this->input['price'],
                'saleprice'=>$this->input['saleprice'],
                'num'=>$this->input['num'],
                'addtime'=>time(),
            ];
            $res = $this->table('goods')->where(['id'=>$id])->update($updateData);
            if($res){
                $this->_return(1,'商品编辑成功');
            }
            $this->_return(-1,'商品编辑失败');
        }

        $goodsData = $this->table('goods')
            ->where(['id'=>$_GET['id']])
            ->find();
        $categoryData = $this->table('category')
            ->select();
        $this->assign('category',$categoryData);
        $this->assign('goods',$goodsData);

        return $this->fetch('goods/goods/edit');
    }

    /**
     * 商品删除
     * @author: Leny
     * @date: 2019/01/01 00:00:00
     */
    public function goods_del() {
        $return = $this->doDel(TBS::GOODS,['status'=>SiteConst::YES_VALUE]);
        $this->ajaxMsg($return);
    }

    /**
     * 下架商品
     * @author: Leny
     * @date: 2019/01/01 00:00:00
     */
    public function goods_deal() {
        try {
            $data = $this->input;
            $params['status'] = $data['value'];

            if(!$data['dataId']) throw new Exception('参数错误');
            $where['id'] = ['in',$data['dataId']];
            $this->table('goods')
                ->strict(false)
                ->where($where)
                ->update($params);
        } catch (Exception $e) {
            $msg = $e->getMessage() ? $e->getMessage() :'服务器正忙，请稍后重试';
            return ['status'=>-1,'info'=>$msg];
        }
        return ['status'=>1,'data'=>$data['dataId']];
    }

    /**
     * 下架商品
     * @author: Leny
     * @date: 2019/01/01 00:00:00
     */
    public function goods_set() {
        $params = $this->input;
        try {
            Db::startTrans();
            $id = $params['id'];
            unset($params['id']);
            if(!$id){
                throw new Exception('参数错误');
            }
            $result = $this->table('goods')
                ->strict(false)
                ->where(['id'=>$id])
                ->update($params);
            Db::commit();
        } catch (Exception $e) {
            Db::rollback();
            $msg = $e->getMessage() ? $e->getMessage() :'服务器正忙，请稍后重试';
            return ['status'=>-1,'info'=>$msg];
        }
        return ['status'=>1,'data'=>$id];
    }

    public function category_list()
    {
        $nodes = $this->tb(TBS::CATEGORY)
            ->field('id,title,sort')
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
     * @author: Leny
     * @date: 2019/01/01 00:00:00
     */
    public function category_add()
    {
        if ($this->isAjax) {
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
     * @author: Leny
     * @date: 2019/01/01 00:00:00
     */
    public function category_edit()
    {
        if ($this->isAjax) {
            $id = $this->input['id'];
            $updateData = $this->input;
            unset($updateData['id']);
            $res = $this->table('category')->where(['id'=>$id])->update($updateData);
            if($res){
                $this->_return(1,"操作成功");
            }
            $this->_return(-1,'操作失败');
        }
        $detail = $this->table('category')
            ->where(['id'=>$_GET['id']])
            ->find();
        $this->assign('detail',$detail);
        return $this->fetch('goods/category/edit');
    }

    /**
     * 分类删除
     * @author: Leny
     * @date: 2019/01/01 00:00:00
     */
    public function category_del()
    {
        $cate_id = $this->input['dataId'][0];
        $goods = $this->table('goods')
            ->where(['cate_id'=>$cate_id])
            ->find();
        if($goods) $this->_return(-1,"该分类下还有商品，无法删除此分类");
        $json = $this->doDel(TBS::CATEGORY);
        $this->ajaxMsg($json);
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
<?php
namespace app\admin\controller;

use Constants\TBS;
use Constants\SiteConst;
class Count extends Common
{
    public function count_index() {
        return $this->fetch('index');
    }
    //日销售统计
    public function count_sale() {
        if ($this->isAjax) {

            $start = isset($this->input['start']) ? $this->input['start'] : date('Y-m-d 00:00:00',strtotime('-7 days'));
            $end = isset($this->input['end']) ? $this->input['end'] : date('Y-m-d H:i:s',time());
            if($start > $end ){
                return ['status'=>-1,'info'=>'开始时间不能大于结束时间'];
            }
            $countData = $this->tb(TBS::ORDER)
                ->where([
                    'addtime'=>['between',[$start,$end]],
                    'status'=>['>=',SiteConst::ORDER_STATUS_PAY]
                ])
                ->group('DATE_FORMAT(addtime,"%Y-%m-%d")')
                ->column('DATE_FORMAT(addtime,"%Y-%m-%d") as date,sum(orderfee) as saleFee');
            
            $countList = [
                'x'=>[],
                'y'=>[],
            ];
            $startTemp = strtotime($start);
            while ($startTemp < strtotime($end)) {
                $date = date('Y-m-d',$startTemp);
                $countList['x'][] = $date;
                $countList['y'][] = isset($countData[$date]) ? $countData[$date]-0 : 0;
                $startTemp+=86400;
            }
            $this->successMsg($countList);   
        }
        
        return $this->fetch('sale');
    }

    //月销售统计
    public function count_count() {
        if ($this->isAjax) {
            $start = isset($this->input['start']) ? $this->input['start'] : date('Y-m-d 00:00:00',strtotime('-3 month'));
            $end = isset($this->input['end']) ? $this->input['end'] : date('Y-m-d 23:59:59',time());
            if($start > $end ){
                return ['status'=>-1,'info'=>'开始时间不能大于结束时间'];
            }
            $countData = $this->tb(TBS::ORDER)
                ->where([
                    'addtime'=>['between',[$start,$end]],
                    'status'=>['>=',SiteConst::ORDER_STATUS_PAY]
                ])
                ->group('DATE_FORMAT(addtime,"%Y-%m")')
                ->column('DATE_FORMAT(addtime,"%Y-%m") as date,sum(orderfee) as saleFee');

            $countList = [
                'x'=>[],
                'y'=>[],
            ];
            $i            = false; //开始标示
            $startTemp = strtotime($start);
            while ($startTemp < strtotime($end)) {
                $NewMonth = !$i ? date('Y-m', strtotime('+0 Month', $startTemp)) : date('Y-m', strtotime('+1 Month', $startTemp));
                $startTemp = strtotime( $NewMonth );
                $i = true;
                $countList['x'][] = $NewMonth;
                $countList['y'][] = isset($countData[$NewMonth]) ? $countData[$NewMonth]-0 : 0;
            }
            $this->successMsg($countList);
        }

        return $this->fetch('sale');
    }

    public function count_goods() {
        if ($this->isAjax) {

//            if($start > $end ){
//                return ['status'=>-1,'info'=>'开始时间不能大于结束时间'];
//            }

            $sqlObj = $this->tb(TBS::ORDER_GOODS)
                ->alias('a')
                ->join(TBS::ORDER.' b','a.orderid=b.id','left')
                ->where($this->input['where'])
                ->field('a.title,sum(a.num) as total')
                ->order('total desc')
                ->group('a.goodsid');
            $data = $this->jsonData($sqlObj,false,true);
            $this->ajaxMsg($data);
        }
        $groups = $this->tb(TBS::USER)
            ->where(['type'=>SiteConst::USER_TYPE_PARCHSE])
            ->field('id,realname')
            ->select();
        $this->assign('groups',$groups);
        return $this->fetch('goods');
    }
}
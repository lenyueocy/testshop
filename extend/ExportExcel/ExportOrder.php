<?php
namespace ExportExcel;

use ExportExcel\Lib\Excel;

class ExportOrder
{

    const HEADER_BAK = [
        ['field' => 'inc','name' => '序号','width' => 5],
        ['field' => 'orderno','name' => '订单号','width' => 30],
        ['field' => 'status','name' => '状态','width' => 8],
        ['field' => 'nickname','name' => '昵称','width' => 20],
        ['field' => 'mobile','name' => '用户手机号','width' => 12],
        ['field' => 'groupername','name' => '所属团长','width' => 20],
        ['field' => 'groupermobile','name' => '团长手机号','width' => 12],
        ['field' => 'address','name' => '配送地址','width' => 40],
        ['field' => 'mark','name' => '备注','width' => 20],
        ['field' => 'title','name' => '产品名称','width' => 30],
        ['field' => 'num','name' => '购买数量','width' => 10],
        ['field' => 'send','name' => '配送时间','width' => 20],
    ];

    const HEADER_NEW = [
        ['field' => 'orderno','name' => '订单号','width' => 30],
        ['field' => 'nickname','name' => '昵称','width' => 20],
        ['field' => 'mobile','name' => '用户手机号','width' => 12],
        ['field' => 'groupername','name' => '所属团长','width' => 20],
        ['field' => 'groupermobile','name' => '团长手机号','width' => 12],
        ['field' => 'address','name' => '配送地址','width' => 70],
        ['field' => 'orderfee','name' => '金额','width' => 20],
        ['field' => 'status','name' => '状态','width' => 20],
        ['field' => 'addtime','name' => '添加时间','width' => 20],
    ];
    
    const GUDS_FILED = ['title','num','send'];
    
    const HEADER = [
        ['field' => 'orderno','name' => '订单号','width' => 30],
        ['field' => 'nickname','name' => '昵称','width' => 30],
        ['field' => 'mobile','name' => '用户手机号','width' => 12],
        ['field' => 'groupername','name' => '所属团长','width' => 20],
        ['field' => 'groupermobile','name' => '团长手机号','width' => 12],
        ['field' => 'address','name' => '配送地址','width' => 70],
        ['field' => 'title','name' => '产品名称','width' => 50],
        ['field' => 'num','name' => '购买数量','width' => 10],
        ['field' => 'totalprice','name' => '付款金额','width' => 10],
        ['field' => 'status','name' => '状态','width' => 20],
        ['field' => 'mark','name' => '备注','width' => 20],
    ];
    
    
    public function exportTwo($dataList) {
        $export = new Excel();
        $export->setHeader(self::HEADER/*,1,'ccffff'*/);
        $row = 2;
        foreach ($dataList as $order) {
            foreach ($order['gudsList'] as $item) {
                $export->setCellValue(0, $row, $order['orderno']);
                $export->setCellValue(1, $row, $order['nickname']);
                $export->setCellValue(2, $row, $order['mobile']);
                $export->setCellValue(3, $row, $order['groupername']);
                $export->setCellValue(4, $row,$order['groupermobile']);
                $export->setCellValue(5, $row,$order['address']);
                $export->setCellValue(6, $row, $item['title']);
                $export->setCellValue(7, $row, $item['num']);
                $export->setCellValue(8, $row, $item['totalprice']);
                $export->setCellValue(9, $row, $order['status']);
                $export->setCellValue(10, $row, $order['mark']);
                $row++;
            }
        }
        $filename = '订单导出-'.date('Y年m月d日 H时i分').'.xlsx';
        return $export->asyncDownload($filename);
    }

    public function exportNew($dataList) {
        $export = new Excel();
        $export->setHeader(self::HEADER_NEW);
        $row = 2;
        foreach ($dataList as $order) {
                $export->setCellValue(0, $row, $order['orderno']);
                $export->setCellValue(1, $row, $order['nickname']);
                $export->setCellValue(2, $row, $order['mobile']);
                $export->setCellValue(3, $row, $order['groupername']);
                $export->setCellValue(4, $row,$order['groupermobile']);
                $export->setCellValue(5, $row,$order['address']);
                $export->setCellValue(6, $row, $order['orderfee']);
                $export->setCellValue(7, $row, $order['status']);
                $export->setCellValue(8, $row, $order['addtime']);
                $row++;
        }
        $filename = '订单导出-'.date('Y年m月d日 H时i分').'.xlsx';
        return $export->asyncDownload($filename);
    }


    public function export($dataList) {
        $export = new Excel();
        $export->setHeader(self::HEADER/*,1,'ccffff'*/);
        
        $row = 2;
        foreach ($dataList as $order) {
            $col = 0;
            $gudsCount = count($order['gudsList']);
            foreach (self::HEADER as $item) {
                if (!in_array($item['field'], self::GUDS_FILED)) {
                    if ($gudsCount>1) {
                        $export->mergeCell($col, $row, $col, ($row+$gudsCount-1));
                    }
                    $export->setCellValue($col, $row, $order[$item['field']]);
                    $col+=1;
                }
            }
            foreach ($order['gudsList'] as $guds) {
                $colTemp = $col;
                foreach (self::GUDS_FILED as $field) {
                    $export->setCellValue($colTemp, $row, $guds[$field]);
                    $colTemp += 1;
                }
                $row+=1;
            }
        }
        $filename = '订单导出-'.date('Y年m月d日 H时i分');
        return $export->asyncDownload($filename);
    }
}
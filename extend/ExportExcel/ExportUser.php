<?php
namespace ExportExcel;

use ExportExcel\Lib\Excel;

class ExportUser
{
    
    const HEADER = [
        ['field' => 'num','name' => '序号','width' => 10],
        ['field' => 'nickname','name' => '昵称','width' => 30],
        ['field' => 'mobile','name' => '用户手机号','width' => 12],
        ['field' => 'sex','name' => '性别','width' => 10],
        ['field' => 'groupername','name' => '所属团长','width' => 20],
        ['field' => 'groupermobile','name' => '团长手机号','width' => 20],
        ['field' => 'addtime','name' => '注册时间','width' => 20]
    ];
    
    
    public function export($dataList) {
        $export = new Excel();
        $export->setHeader(self::HEADER);
        $row = 2;
        $i=0;
        foreach ($dataList as $user) {
            if($user['sex']==1){
                $user['sex']='男';
            }elseif($user['sex']==2){
                $user['sex']='女';
            }else{
                $user['sex']='保密';
            }
                $i++;
                $export->setCellValue(0, $row, $i);
                $export->setCellValue(1, $row, $user['nickname']?$user['nickname']:'暂无');
                $export->setCellValue(2, $row, $user['mobile']);
                $export->setCellValue(3, $row, $user['sex']);
                $export->setCellValue(4, $row, $user['groupername']);
                $export->setCellValue(5, $row, $user['groupermobile']);
                $export->setCellValue(6, $row, $user['addtime']);
                $row++;
        }
        $filename = '用户导出-'.date('Y年m月d日 H时i分').'.xlsx';
        return $export->asyncDownload($filename);
    }
    

}
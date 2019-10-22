<?php
namespace ExportExcel\Lib;

class Excel
{
    private $excelObj;
    
    public function __construct() {
        $this->excelObj = new \PHPExcel();
        $this->setActiveSheet();
        $this->getActiveSheet()
            ->getDefaultStyle()
            ->getAlignment()
//             ->setWrapText(true)
            ->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
    }
    
    public function setCellValue($col,$row,$value,$color = false) {
        $col = \PHPExcel_Cell::stringFromColumnIndex($col);
        //如果是数字，设置成文本格式
//         if(is_numeric($value)){
//             $this->getActiveSheet()
//                  ->setCellValueExplicit($col.$row,$value." ",\PHPExcel_Cell_DataType::TYPE_STRING);
//         }else{
//             //不是数字直接设置
//             $this->getActiveSheet()
//                 ->setCellValue($col.$row,$value);
//         }
        
        $this->getActiveSheet()
            ->setCellValue($col.$row,$value);
        
        //如果需要颜色，设置颜色
        if ($color) {
            $this->getActiveSheet()
                ->getStyle($col.$row.':'.$col.$row)
                ->getFill()
                ->setFillType(\PHPExcel_Style_Fill::FILL_SOLID);
            
            $this->getActiveSheet()
                 ->getStyle($col.$row.':'.$col.$row)
                 ->getFill()
                 ->getStartColor()
                 ->setRGB($color);
        }
        return $this;
    }
    
    public function setHeader($headerArr,$row=1,$color = false) {
        foreach ($headerArr as $key=>$header) {
            $col = \PHPExcel_Cell::stringFromColumnIndex($key);
            
            //设置宽度
            $this->getActiveSheet()
                 ->getColumnDimension($col)
                 ->setWidth($header['width']);
            
            //设置为文本格式
            $this->getActiveSheet()
                 ->getStyle($col)
                 ->getNumberFormat()
                 ->setFormatCode(\PHPExcel_Style_NumberFormat::FORMAT_TEXT);
            
            //设置值
            $this->setCellValue($key, $row, $header['name'],$color);
        }
        $this->setRowHeight($row, 25);
        return $this;
    }
    
    public function setRowHeight($row,$height){
        $this->getActiveSheet()
        ->getRowDimension($row)
        ->setRowHeight($height);
        return $this;
    }
    
    public function mergeCell($formCol,$formRow,$toCol,$toRow) {
        $this->getActiveSheet()
            ->mergeCellsByColumnAndRow($formCol,$formRow,$toCol,$toRow);
        return $this;
    }
    
    public function addImage($filePath,$name,$col,$row,$x,$height) {
        $col = \PHPExcel_Cell::stringFromColumnIndex($col);
        $objDrawing = new \PHPExcel_Worksheet_Drawing();
        $objDrawing->setName($name);
        $objDrawing->setDescription($name);
        $objDrawing->setPath($filePath); //图片引入位置
        $objDrawing->setCoordinates($col.$row); //图片添加位置
        $objDrawing->setOffsetX($x);
//         $objDrawing->setRotation(25);
        $objDrawing->setHeight($height);
        $objDrawing->getShadow()->setVisible (true);
        $objDrawing->getShadow()->setDirection(45);
        $objDrawing->setWorksheet($this->getActiveSheet());
        return $this;
    }
    
    public function setActiveSheet($index=0) {
        $this->excelObj->setActiveSheetIndex($index);
        return $this;
    }
    
    public function getActiveSheet() {
        return $this->excelObj->getActiveSheet();
    }
    
    public function save($file) {
        $objWriter = \PHPExcel_IOFactory::createWriter($this->excelObj,'Excel2007');
        $objWriter->save($file);
    }
    
    public function download($filename) {
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Cache-Control: cache, must-revalidate');
        header('Pragma: public');
        $objWriter = \PHPExcel_IOFactory::createWriter($this->excelObj, 'Excel2007');
        $objWriter->save('php://output');
        die();
    }
    
    public function asyncDownload($filename) {
        $objWriter = \PHPExcel_IOFactory::createWriter($this->excelObj, 'Excel2007');
        ob_start();
        $objWriter->save("php://output");
        $xlsData = ob_get_contents();
        ob_end_clean();
        return [
            'filename' => $filename, 
            'file' => "data:application/vnd.ms-excel;base64," . base64_encode($xlsData)
        ];
    }
}
<?php
include "./Classes/PHPExcel.php";
$filePath = "export_1.xls";
$fileType = PHPExcel_IOFactory::identify($filePath); //文件名自动判断文件类型
$objReader = PHPExcel_IOFactory::createReader($fileType);
$objPHPExcel = $objReader->load($filePath);
/*$sheet=$objPHPExcel->getSheet(1);//获取第一个索引表
echo $sheet->getHighestRow();//取得总行数
$highestColumm = $sheet->getHighestColumn(); // 取得总列数*/
$savePath = './new_index.html'; //这里记得将文件名包含进去
$objWriter = new PHPExcel_Writer_HTML($objPHPExcel); 
$objWriter->setSheetIndex(1); //可以将括号中的0换成需要操作的sheet索引
$objWriter->save("php://output");
//也可以保存为html
/*$objWriter->save($savePath);//保存为html文件
echo file_get_contents($savePath);*/

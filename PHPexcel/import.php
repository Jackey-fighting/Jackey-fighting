<?php
include "./Classes/PHPExcel.php";
$filePath = "export_1.xls";
$fileType = PHPExcel_IOFactory::identify($filePath); //文件名自动判断文件类型
$objReader = PHPExcel_IOFactory::createReader($fileType);
$objPHPExcel = $objReader->load($filePath);
$objsheet=$objPHPExcel->getSheet(1);//获取第一个索引表
countRow=$objsheet->getHighestRow();//取得总行数
/*$highestColumm = $sheet->getHighestColumn(); // 取得总列数*/
//设置单元的边框
$styleThinBlackBorderOutline = array(
       'borders' => array (
             'outline' => array (
                   'style' => PHPExcel_Style_Border::BORDER_THIN,   //设置border样式
                   //'style' => PHPExcel_Style_Border::BORDER_THICK,  另一种样式
                   'color' => array ('argb' => 'FF000000'),          //设置border颜色
            ),
      ),
);
for ($i=1; $i <= $countRow; $i++) { 
	$objsheet->getStyle( 'A'.$i)->applyFromArray($styleThinBlackBorderOutline);
	$objsheet->getStyle( 'B'.$i)->applyFromArray($styleThinBlackBorderOutline);
	$objsheet->getStyle( 'C'.$i)->applyFromArray($styleThinBlackBorderOutline);
}

$savePath = './new_index.html'; //这里记得将文件名包含进去
$objWriter = new PHPExcel_Writer_HTML($objPHPExcel); 
$objWriter->setSheetIndex(1); //可以将括号中的0换成需要操作的sheet索引
$objWriter->save("php://output");
//也可以保存为html
/*$objWriter->save($savePath);//保存为html文件
echo file_get_contents($savePath);*/

<?php
$dir = dirname(__FILE__);
require $dir.'/PHPExcel-1.8/Classes/PHPExcel.php';//引入库文件
$objPHPExcel = new PHPExcel();//实例化PHPExcele，等同于在桌面上新建一个表格
$objSheet = $objPHPExcel->getActiveSheet();//获取当前活动sheet的对象
$objSheet->setTitle("demo");//给当前活动sheet设置名称
/**$objSheet->setCellValue("A1","姓名")->setCellValue("B1","分数");//给当前活动sheet填充数据
$objSheet->setCellValue("A2","Jackey")->setCellValue("B2","99");**/
$array=array(
	array(),
	array("","姓名","分数"),
	array("","历史","60"),
	array("","语文","70"),
);
$objSheet->fromArray($array);//直接加载数据块来填充数据，如果数据过大，不建议使用fromarray(),因为比较消耗内存
$objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,"Excel2007");//按照指定格式生成excel文件
$objWriter->save($dir."/demo.xlsx");


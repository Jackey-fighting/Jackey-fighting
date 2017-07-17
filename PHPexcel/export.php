<?php
$dir=dirname(__FILE__);
require $dir."/db.php";//引入MySQL操作文件
require $dir."/PHPExcel-1.8/Classes/PHPExcel.php";//引入PHPExcel
$db = new db($phpexcel);//实例化db类 连接数据库
$objPHPExcel = new PHPExcel();//实例化PHPExcel类，等同于在桌面上创建一个excel
for($i=1;$i<=3;$i++){
	if($i>1){//因为默认会创建一个sheet
		$objPHPExcel->createSheet();//创建内置表
	}
	$objPHPExcel->setActiveSheetIndex($i-1);//默认是从0开始的饿
	$objSheet=$objPHPExcel->getActiveSheet();//获取活动的sheet
	$objSheet->setTitle("第".$i."类新闻");
	$data = $db->getDataByType($i);//查询每个type的数据
	$objSheet->setCellValue("A1","id")->setCellValue("B1","type")->setCellValue("C1","news标题");

	$j=2;
	foreach($data as $key=>$val){
		$objSheet->setCellValue("A".$j,$val['id'])->setCellValue("B".$j,$val['type'])->setCellValue("C".$j,$val['title']);
		$j++;
	}
}

$objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,"Excel2007");//生成excel文件
//$objWriter->save($dir."/export_1.xls");//保存文件

browser_export('Excel2007','browser_excel07.xls');//输出到浏览器
$objWriter->save("php://output");

//以下是输出浏览器的语句，可以直接粘贴
function browser_export($type,$filename){
	if ($type=="Excel5") {
		header('Content-Type:application/vnd.ms-excel');//告诉浏览器将要输出excel03文件
	}else{
		//告诉浏览器将要输出excel07文件
		header('Content-Type:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	}
	//告诉浏览器将要输出的名称
	header('Content-Disposition:attachment;filename='.$filename);
	//禁止缓存
	header('Cache-Control:max-age=0');
}

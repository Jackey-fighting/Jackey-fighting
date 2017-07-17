<?php
header("content-type:text/html;charset=utf8");
$dir=dirname(__FILE__);
require $dir."/db.php";//引入MySQL操作文件
require $dir."/PHPExcel-1.8/Classes/PHPExcel.php";//引入PHPExcel
$db = new db($phpexcel);//实例化db类 连接数据库
$objPHPExcel = new PHPExcel();//实例化PHPExcel类，等同于在桌面上创建一个excel
$objSheet = $objPHPExcel->getActiveSheet();//获取活动单元格

//设置excel文件默认水平居中
$objSheet->getDefaultStyle()->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
//设置默认字体以及
$objSheet->getDefaultStyle()->getFont()->setName("微软雅黑")->setSize("14");
//设置type所在行的的字体大小
$objSheet->getStyle("A2:H2")->getFont()->setSize('20')->setBold(True);
//设置下一个type所在行的字体大小
$objSheet->getStyle("A3:H3")->getFont()->setSize('16')->setBold(True);
//开始本节课代码编写
$typeInfo = $db->getAllType();//查询所有的种类
$index=0;
foreach($typeInfo as $t_k=>$t_v){
	$totleIndex = getCells($index*2);//获取type所在咧
	$objSheet->setCellValue($totleIndex.'2','第'.$t_v['type'].'类');
	$idInfo=$db->getDistinctType($t_v['type']);//查询不重复的type种类的
	
	foreach($idInfo as $c_k=>$c_v){
		$idIndex=getCells($index*2);//获取每个种类所在的列位置
		$titleIndex=getCells($index*2+1);//获取每个种类所在的内容
		$objSheet->mergeCells($idIndex.'3:'.$titleIndex.'3'); //合并第二个种类的单元格
		//给其填充颜色
		$objSheet->getStyle($idIndex.'3:'.$titleIndex.'3')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB("66ff33");
		$typeBorderStyle_2 = getBorderStyle('EE30A7');
		$objSheet->getStyle($idIndex.'3:'.$titleIndex.'3')->applyFromArray($typeBorderStyle_2);
		$info=$db->getContentByType($t_v['type']);//查询每个type的内容
		$objSheet->setCellValue($idIndex.'3','类别:'.$t_v['type']);//分种类的
		
		//设置换行符,一定要放在换行符的前面
		$objSheet->getStyle($idIndex)->getAlignment()->setWrapText(true);
		//加入换行符
		$objSheet->setCellValue($idIndex.'4',"id\n换行")->setCellValue($titleIndex.'4','title');
		$objSheet->getStyle($idIndex)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);

		$j=5;//从第五行开始
		foreach($info as $key=>$val){
			/*$objSheet->setCellValue($idIndex.$j,$val['id'])->setCellValue($titleIndex.$j,$val['title']);*/
			$objSheet->setCellValueExplicit($idIndex.$j,'2222222222222222222',PHPExcel_Cell_DataType::TYPE_STRING)->setCellValue($titleIndex.$j,$val['title']);
			$j++;
		}

		$index++;
	}
	$endTypeIndex = getCells($index*2-1);//获得每个种类的的终止单元格
	$objSheet->mergeCells($totleIndex.'2:'.$endTypeIndex.'2');//合并每个种类的单元格
	//填充第一个种类的颜色
	$objSheet->getStyle($totleIndex.'2:'.$endTypeIndex.'2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB("00cccc");
	//获取第一个大type所在行边框
	$typeBorderStyle_1 = getBorderStyle('e3df51');
	$objSheet->getStyle($totleIndex.'2:'.$endTypeIndex.'2')->applyFromArray($typeBorderStyle_1);
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
//根据当前下标获取列位数
function getCells($index){
	$arr=range('A', 'Z');
	return $arr[$index];
}
//获取不同的边框样式
function getBorderStyle($color){
	$styleArray = array(
		'borders'=>array(
			'outline'=>array(
				'style'=>PHPExcel_Style_Border::BORDER_THICK,
				'color'=>array('rgb'=>$color),
			),			
		),
	);

	return $styleArray;
}
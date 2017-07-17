<?php
header("content-type:text/html;charset=utf8");
$dir=dirname(__FILE__);
require $dir."/db.php";//引入MySQL操作文件
require $dir."/PHPExcel-1.8/Classes/PHPExcel.php";//引入PHPExcel
$db = new db($phpexcel);//实例化db类 连接数据库
$objPHPExcel = new PHPExcel();//实例化PHPExcel类，等同于在桌面上创建一个excel
$objSheet = $objPHPExcel->getActiveSheet();//获取当前活动sheet
//开始本节课代码编写开始
$arr=array(
		array("","一班","二班","三班"),
		array("不及格",20,30,40),
		array("良好",30,50,55),
		array("优秀",60,80,100),
	);//准备数据
$objSheet->fromArray($arr);//直接加载数组填充单元格内
//开始图表代码编写
$labels=array(
		new PHPExcel_Chart_DataSeriesValues('String','Worksheet!$B$1',null,1),//一班
		new PHPExcel_Chart_DataSeriesValues('String','Worksheet!$C$1',null,1),//二班
		new PHPExcel_Chart_DataSeriesValues('String','Worksheet!$D$1',null,1),//三班
	);//先取得绘制图表的标签
$xLabels=array(
		//	取得图表X轴的刻度
		new PHPExcel_Chart_DataseriesValues('String','WorkSheet!$A$2:$A4',null,3),
	);
$datas=array(
		//取得一班数据
		new PHPExcel_Chart_DataSeriesValues('Number','WorkSheet!$B$2:$B$4',null,3),
		//取得二班数据
		new PHPExcel_Chart_DataSeriesValues('Number','WorkSheet!$C$2:$C$4',null,3),
		//取得三班数据
		new PHPExcel_Chart_DataSeriesValues('Number','WorkSheet!$D$2:$D$4',null,3),
	);//取得绘图所需的数据
$series=array(
		new PHPExcel_Chart_DataSeries(
			PHPExcel_Chart_DataSeries::TYPE_LINECHART,
			PHPExcel_Chart_DataSeries::GROUPING_STANDARD,
			range(0,count($labels)-1),
			$labels,
			$xLabels,
			$datas
		),
	);//根据取得的东西做成一个框架
//使用layout来显示具体某个点的数据
$layout=new PHPExcel_Chart_Layout();
$layout->setShowVal(true);
$areas=new PHPExcel_Chart_PlotArea($layout,$series);
$legend=new PHPExcel_Chart_Legend(PHPExcel_Chart_Legend::POSITION_RIGHT,null,false);
$title=new PHPExcel_Chart_Title("高一学生成绩分布");
$ytitle=new PHPExcel_Chart_Title("value(人数)");
//以上参数围绕 new PHPExcel_Chart()来展开
$chart=new PHPExcel_Chart(
	"line_chart",
	$title,
	$legend,
	$areas,
	true,
	false,
	null,
	$ytitle
	);

//绘制图表所在的表格中位置
$chart->setTopLeftPosition("A7")->setBottomRightPosition("K25");
//将chart添加到表格中
$objSheet->addChart($chart);

//生成excel文件
$objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,"Excel2007");
$objWriter->setIncludeCharts(true);
//$objWriter->save($dir."/export_1.xls");//保存文件

//输出到浏览器
browser_export('Excel2007','browser_charts07.xls');
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

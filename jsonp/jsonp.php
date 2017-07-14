<?php
//这里是取得jsoncallback的函数名
$jsoncallback=htmlspecialchars($_REQUEST['jsoncallback']);

/*$arr=array(
		'Jackey',
		'20',
		'Eting',
		'23',
	);*/

$arr=array(
	'name'=>array('Jackey','Eting','Baby'),
	'pwd'=>array('111111','222222','333333'),
	);
$json_data=json_encode($arr);//这里返回了一个json字符串

echo $jsoncallback."(".$json_data.")";//输出jsonp格式的数据
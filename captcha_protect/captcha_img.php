<?php

session_start();

$table = array(
		'pic0' => 'boy',
		'pic1' => 'girl',
		'pic2' => '招',
		'pic3' => '爱你'
	);

$index = rand(0,3);

$value = $table['pic'.$index];
$_SESSION['authcode'] = $value;

$filename = dirname(__FILE__).'\\pic'.$index.'.jpg';
$contents = file_get_contents($filename);

//在header这里 要有空格，不然到时会输不出图片
header('content-type: image/jpg');
echo $contents;
?>
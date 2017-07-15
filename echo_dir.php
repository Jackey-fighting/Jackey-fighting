<?php
$rootDir = dirname(__FILE__);

function shuChuDir($rootDir){
	$result=scandir($rootDir);//获取所有一级目录
	echo '<ul>';
	//输出循环
	foreach($result as $val){
		//判断是不是目录，并不为 . 或者..
		if ($val!='.' && $val!='..' && is_dir($val)) {
			echo '<li style="color:lightblue"><b>'.$val.'</b></li>';//输出目录
			//使用递归，把目录循环干净
			shuChuDir($rootDir.'\\'.$val);
		}else{
			echo '<li>'.$val.'</li>';
		}
	}
	echo '</ul>';
}

shuChuDir($rootDir);
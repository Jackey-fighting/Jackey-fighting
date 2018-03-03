<?php
//计算两个文件的相对路径
function getRelativePath($file1, $file2){
	//获取文件的dirname
	$dir1 = pathinfo($file1, PATHINFO_DIRNAME);
	$dir2 = pathinfo($file2, PATHINFO_DIRNAME);
	$dirArr1 = explode('/', $dir1);
	for ($i=0; $i < count($dirArr1); $i++) { 
		$dirArr1[$i] = $dirArr1[$i].'/';
	}

	foreach($dirArr1 as $v){
		$dir2 = str_replace($v, '', $dir2);
	}
	echo '计算出 文件2 相对 文件1 的路径为：'.$dir2;
}

getRelativePath('www/aaa/dd/a.php','www/aaa/cc/bb/b.php');

<?php
//这里是来匹配文件
foreach (glob('*.*') as $key => $file) {
	echo $file.'<br/>';
}

//这个方法也是可以遍历目录的
/*$resource=opendir('../1014');
while (($file=readdir($resource))!=false) {
	echo $file.' filetype: '.filetype('../1014/'.$file).'<br/>';
}
closedir($resource);*/

//如果不存在file目录，则创建
function createFile(){
	$path = dirname(__FILE__);
	$hzarr = array('php','html','txt');
	if (file_exists($path.'/file')) {
		for ($i=0; $i < 3; $i++) { 
			file_put_contents($path.'/file/'.$i.'.'.$hzarr[$i], $hzarr[$i]);
		}
		scandirOut($path.'/file/');//遍历所有目录文件
		
	}else{
		mkdir($path.'/file');
		echo 'file 目录创建成功。';
	}
}

//删除存在的file 文件
function deleteFile(){
	$path = dirname(__FILE__);
	if (file_exists($path.'/file')) {
		rmdir($path.'/file');
		echo '已经删除file文件';
	}else{
		echo '没有这个file目录';
	}
}

//遍历所有的目录
function scandirOut($path){
	$scandir = scandir($path);
	echo '<ul>';
		foreach ($scandir as $key => $file) {
			if ($file!='.' && $file!='..' && is_dir($file)) {
				scandirOut($file);
				echo '<li>'.$file.'</li>';
			}elseif($file!='.' && $file!='..'){
				echo '<li>'.$file.'</li>';
			}
		}//foreach
	echo '</ul>';
}

//删除所有的文件以及目录
function deleteAllFile($path){
	if (file_exists($path)) {
		if (@rmdir($path)!=true) {//判断目录是不是空
			$scandir = scandir($path);
			foreach ($scandir as $key => $file) {
				//如果不是目录则删除文件，是目录则递归
				if (@rmdir($path.$file)!=true&&$file!='.'&&$file!='..') {
					unlink($path.$file);
					$lastdir=(@rmdir($path)==true)?'已经删除 '.$path.' 目录。':'';
				}elseif($file!='.'&&$file!='..'){
					deleteAllFile($file);
				}
			}
		}
	}
	echo '已经删除此目录的所有文件,以及'.$lastdir;
}
$path = str_replace('\\', '/', dirname(__FILE__)).'/file/' ;
deleteAllFile($path);

//createFile();

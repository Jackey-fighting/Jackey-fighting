<?php
/*
得到文件拓展名
@param string $filename
@return string
*/
function getExt($filename){
	return strtolower(pathinfo($filename,PATHINFO_EXTENSION));
}

/*
产生唯一字符串
@return string
*/
function getUniName(){
	return md5(uniqid(microtime(true),true));
}
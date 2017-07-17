<?php
//print_r($_FILES);
header('content-type: text/html;charset=utf-8');
require_once 'MoreUpload.func.php';
require_once 'common.func.php';
$files = getFlies();
foreach($files as $fileInfo){
	$res=uploadFile($fileInfo);
	echo $res['mes'],'<br/>';
	@$uploadFiles[]=$res['dest'];
}
echo '......................';
//array_filter($arr) 是过滤掉空值的数组
$uploadFiles = array_values(array_filter($uploadFiles));
echo '<pre>';
print_r($uploadFiles);
echo '</pre>';
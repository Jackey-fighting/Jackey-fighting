<?php
//$_FILES 是三位数组的，$_FILES['myFile']['name']['file1'],在有出现多文件的时候，
//才会有第三组的出现

include_once 'upload.func.php';
$fileInfo = $_FILES['myFile'];
/*$newName = uploadFile($fileInfo);
echo $newName;*/

$allowExt = array('jpg','png','jpeg','gif');
$newName = uploadFile($fileInfo,$allowExt,'imooc',false);
echo $newName;



?>
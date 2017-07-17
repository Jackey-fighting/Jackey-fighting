<?php
$filename=$_FILES['myFile']['name'];
$type = $_FILES['myFile']['type'];
$tmp_name = $_FILES['myFile']['tmp_name'];
$size = $_FILES['myFile']['size'];
$error = $_FILES['myFile']['error'];

//将服务器上的临时文件移动到指定的目录下
//move_uploaded_file($tmp_name,$destination),成功返回ture,失败返回false
//move_uploaded_file($tmp_name, "uploads/".$filename);

/*在用了base64_encode()编辑二进制后，用echo base64_decode()来解码输出就行了
$fgc = file_get_contents(dirname(__FILE__)."/uploads/".$filename);
$base64_en = base64_encode($fgc);
header("content-type: image/jpg");
echo base64_decode($base64_en);*/

//copy($src,$dst); 将文件拷贝到指定目录下
copy($tmp_name, "uploads/".$filename);
?>
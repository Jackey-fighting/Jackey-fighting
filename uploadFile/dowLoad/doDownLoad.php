<?php
$filename = $_GET['filename'];
//content-disposition:attachment;是在浏览器中存储
//basename($path,suffix)是返回文件名部分；若带有suffix则返回名字，去除拓展名；
header('content-disposition: attachment;filename='.basename($filename));
//content-length:是压缩后的长度
header('content-length:'.filesize($filename));
readfile($filename);


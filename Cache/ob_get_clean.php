<?php
ob_start();
header("Refresh:3");
date_default_timezone_set('PRC');
?>
<!DOCTYPE html>
<html>
<head
	<meta charset="utf-8">
	<title>我是huancun.php</title>
</head>
<body>
<p>我是缓存静态页面哦。Jackey.</p>

<?php

if (!file_exists("index.html")) {
	fopen("./index.html","x+");//创建文件
}
//echo filemtime("./index.html");exit;

echo "<p>".date("Y-m-d H:i:s",time())."</p>
</body>
</html>";
file_put_contents(dirname(__FILE__)."\index.html", ob_get_clean());
//echo date("Y-m-d H:i:s",time());
echo file_get_contents("./index.html");

//ob_end_clean();//清除了此页面所有的缓存内容
?>

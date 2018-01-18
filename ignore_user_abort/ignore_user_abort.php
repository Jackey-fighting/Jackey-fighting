<?php
ignore_user_abort();//关闭浏览器后仍然执行
set_time_limit(0);//设置无限制时间
$interval = 3;//设置休眠时间
date_default_timezone_set("PRC");

do {
	$flag = include("switch.php");//这里用return 1;来控制开关，进行循环
	$msg = date("Y-m-d H:i:s")."\r\n";
	file_put_contents('./log.log', $msg,FILE_APPEND);
	sleep($interval);
}while ($flag);
exit;

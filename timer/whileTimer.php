<?php
//定时器
set_time_limit(0);//执行脚本时间设置为无限制
ini_set('memory_limit', '521M');//执行所需的内存，ini_set()仅对当前执行程序生效
$interval = 3600;
while (true) {
	//业务逻辑处理

	sleep($interval);//休眠时间
}

<?php

echo 'process-start-time:'.date('Y-m-d H:i:s');
$urls = [
	'http://baidu.com',
	'http://sina.com.cn',
	'http://qq.com',
	'http://baidu.com?search=singwa',
	'http://baidu.com?search=imooc',
];

$count = count($urls);
//同时循环开启多个进程，不过一般在cpu的1-4倍，下面的use是闭包的使用，才可以使用外面的变量
for ($i=0; $i < $count; $i++) { 
  //swoole_process的true是开启管道，意思就是不在cli打印了，直接输出到管道，那么就需要用到进程的read()来读取管道消息
	$process = new swoole_process(function(swoole_process $worker) use($i, $urls){ 
		//创建进程成功后调用回调函数，也会执行这里的内容
    $content = curlData($urls[$i]);
		echo $content.PHP_EOL; //这里的消息打印到管道里面，使用read()去读取
	}, true);
  
	$pid = $process->start();//每次start()都会创建一个子进程
	$workers[$pid] = $process;//把swoole进程赋值
}

foreach ($workers as $process) {
	echo $process->read();//去读取管道的消息，然后输出
}

function curlData($url){
	sleep(1);
	return $url.'success'.PHP_EOL;
}
echo 'process-end-time:'.date('Y-m-d H:i:s');

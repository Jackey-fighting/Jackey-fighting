<?php
$redisClient = new swoole_redis;
$redisClient->connect('127.0.0.1', 6379, function(swoole_redis $redisClient, $result){
	echo 'connect'.PHP_EOL;
	echo $result;
  //用set来创建值，在connect的回调函数中使用
	/*$redisClient->set('Jackey_1', time(), function(swoole_redis $redisClient, $result){
		var_dump($result);
	});*/
  //用get来获取值， 一样是在connect的回调函数中使用
	/*$redisClient->get('Jackey_1', function(swoole_redis $redisClient, $result){
		var_dump($result);
		$redisClient->close();
	});*/
  //可以使用keys来进行模糊匹配查找值
	$redisClient->keys('*ck*_1', function($redisClient, $result){
		var_dump($result);
	});
});

echo 'start'.PHP_EOL;

#1.所谓异步是程序不会因为当前的查询而阻塞，也就程序会继续往下走,结果自然会返回
#2.只要实例化了redis对象，可以使用redis中所有的函数操作，比如set , get , keys ==

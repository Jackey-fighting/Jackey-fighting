<?php
$http = new swoole_http_server();//创建一个http_server服务
$http->on('request', function($request, $response){
  $redis = new Swoole\Coroutine\Redis();
  $redis->connect('127.0.0.1', 6379);//链接redis
  $key = $request->get['key'];//获取url的query参数key值
  $value = $redis->get($key);
  
  $response->end($value);//打印值到浏览器
});

$http->start();//启动服务

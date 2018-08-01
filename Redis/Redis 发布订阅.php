<?php
#Redis 发布订阅(pub/sub)是一种消息通信模式：发送者(pub)发送消息，订阅者(sub)接收消息。
#Redis 客户端可以订阅任意数量的频道。
发布消息
$redis->publish($name(string), $msg);
订阅消息
$redis->subscribe(array('自定义的订阅频道名'), 'callback');
function callback($redis, $channel, $msg){

}

phpredis 命令URL：
https://github.com/phpredis/phpredis#psubscribe

#window下redis拓展安装包
https://pecl.php.net/package/redis/

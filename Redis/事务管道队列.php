<?php
/*Redis事务管道队列
*mutil + PIPELINE 让队列保证高效不出错的
*/
function writeMutil(){
	$redis = new Redis();
	$pipe = $redis->multi(Redis::PIPELINE);
	$pipe->rpush($key, $val);
	$flag = $pipe->exec();

	if ($flag) {
		return true;
	}else{
		return flase;
	}
}

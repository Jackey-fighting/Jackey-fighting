<?php
set_time_limit(0);//设置不限时间
//ini_set('memory', '200M');//设置临时内存

/*
*将使用的内存转换带单位输出
*/
function convert($size)
{
    $unit = array('b', 'kb', 'mb', 'gb', 'tb', 'pb');
    return @round($size / pow(1024, ($i = floor(log($size, 1024)))), 2) . ' ' . $unit[$i];
}

$start = memory_get_usage();//获取使用的内存
echo 'memory_get_usage : '.$start.'<br/>';

echo convert($start);

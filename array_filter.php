<?php
$arr = array('name', '1', 'xixi', 'php');
$result = array_combine($keys, $vals);

$keys = array_filter($arr, 'odd', ARRAY_FILTER_USE_KEY);//获取奇数(索引)值，并返回数组
$vals = array_filter($arr, 'even', ARRAY_FILTER_USE_KEY);//获取偶数(索引)值，并返回数组

//奇数函数
function odd($var){
	return $var&1;
}
//偶数函数
function even($var){
	return !($var&1);
}

//array_filter中要使用ARRAY_FILTER_USE_KEY,PHP版本一定要是5.6以上的
//使用ARRAY_FILTER_USE_KEY的话，就是下标来排序的，比如上面的奇数：1 , php

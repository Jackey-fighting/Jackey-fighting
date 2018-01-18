<?php
/*创建一个独占锁文件的函数
@param $path 路径
@param $mode 读写方式，默认w+
@param $string 写入的字符串
*/
function cflock($path,$mode='w+',$string){
	$handle = fopen(realpath($path), $mode);
	if (flock($handle, LOCK_EX|LOCK_NB)) {//进行文件锁
		fwrite($handle, $string);
		echo '已经修改成功';
		sleep(5);
		flock($handle, LOCK_UN);//进行释放独占锁
	}else{
		echo 'flock get fail';
	}
	fclose($handle);
}
cflock('./test.txt','a','Welcome to here!222');

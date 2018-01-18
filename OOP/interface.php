<?php
interface MPopedom{
	function popedom();
}
interface MPurview{
	function purview();
}
class Member implements MPurview{
	function purview(){
		echo '会员拥有的权限。';
	}
}

class Manager implements MPopedom,MPurview{
	function purview(){
		echo '管理员拥有会员的全部权限。';
	}
	function popedom(){
		echo '管理员还有会员没有的权限。';
	}
}

$member = new Member();
$member->purview();
echo PHP_EOL;

$manager = new Manager();
$manager->purview();
echo PHP_EOL;
$manager->popedom();

?>

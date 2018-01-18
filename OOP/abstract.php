<?php
abstract class CommodityObject{
	abstract function service($getName,$price,$num);
}
class MyBook extends CommodityObject{
	function service($getName,$price,$num){
		echo '您购买的商品是'.$getName.',该商品的价格是：'.$price.'元。'.PHP_EOL;
		echo '您购买的数量为：'.$num.'本。'.PHP_EOL;
		echo '如发现缺页，损坏请在3日内更换。'.PHP_EOL;
	}
}
class MyCoumputer extends CommodityObject{
	function service($getName,$price,$num){
		echo '您购买的商品是：'.$getName.',该商品的价格是：'.$price.'元。'.PHP_EOL;
		echo '您购买的数量为：'.$num.'台。'.PHP_EOL;
		echo '如发生非人为质量问题，请在3个月内更换。';
	}
}
$book = new MyBook();
$computer = new MyCoumputer();
$book->service('Jackey','20000000','24');
echo PHP_EOL;
$computer->service('Eting','50000000','24');
?>

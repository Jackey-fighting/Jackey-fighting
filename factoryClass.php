<?php
//一个规定的父类
abstract class Cal{
	public abstract function calculation($num1,$num2);
}

class Add extends Cal{
	public function calculation($num1,$num2){
		return $num1+$num2;
	}
}

class Reduce extends Cal{
	public function calculation($num1,$num2){
		return $num1-$num2;
	}
}

//实例化的工厂类
/*@param type $type 要创建的类型*/
Class CalFactory{
	public static function createObj($type){
		switch($type){
			case 'Add':
				return new Add();
				break;
			case 'Reduce':
				return new Reduce();
				break;
		}
	}
}

$Obj=CalFactory::createObj('Reduce');
echo $Obj->calculation(10,20);
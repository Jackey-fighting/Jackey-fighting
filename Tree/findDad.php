<?php

$arr = array(
   array('id'=>1,'name'=>'安徽','parent'=>'0'),
   array('id'=>2,'name'=>'海淀','parent'=>'7'),
   array('id'=>3,'name'=>'濉溪县','parent'=>'5'),
   array('id'=>4,'name'=>'昌平','parent'=>'7'),
   array('id'=>5,'name'=>'淮北','parent'=>'1'),
   array('id'=>6,'name'=>'朝阳','parent'=>'7'),
   array('id'=>7,'name'=>'北京','parent'=>'0'),
   array('id'=>8,'name'=>'上地','parent'=>'2')   
	);
//找子栏目
function findson($arr,$id=0){
	$sons=array();
	foreach ($arr as $v) {
		if ($v['parent']==$id) {
			$sons[]=$v;
		}
	}
	return $sons;
}
print_r(findson($arr,1));

//找子孙树
function subtree($arr,$id=0,$lev=1){
	static $subs=array();
	foreach ($arr as $v) {
		if ($v['parent']==$id) {
			$v['lev']=$lev;
			$subs[]=$v;
			subtree($arr,$v['id'],$lev+1);
		}
	}
	return $subs;
}

echo '<br/>';
$tree = subtree($arr,0,1);
foreach ($tree as $k => $v) {
	echo str_repeat('&nbsp;', $v['lev']).$v['name'].'<br/>';
}
echo '<br/>----------------------------------------------------------------<br/>';

//家谱树，根据儿子找爸爸
function tree($area,$id,$lev=1){
	static $tree = array(); //注意这里的 static是避免再次循环的时候，置空 $tree，static 是让$tree有了初始值
	foreach ($area as $v) {
		if ($v['id']==$id) {
			$v['lev']=$lev;
			$tree[]=$v;
			tree($area,$v['parent'],$lev+1);
		}
	}
	return $tree;
}
echo '<pre>';
print_r(tree($arr,8));
echo '</pre>';

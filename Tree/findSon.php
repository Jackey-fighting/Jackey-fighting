<?php
//连接数据库,并查询返回 query object
function conn($sql){
	$conn = mysqli_connect('localhost','root','111111','mydb') or exit('数据库连接失败');
	mysqli_set_charset($conn,'utf8');
	$query=$conn->query($sql);
	return $query;
}

$sql = "SELECT goods_cat_id,goods_cat_name,goods_cat_intro,parent_id FROM goods_cat";
$query = conn($sql);
//获取数组，并存在$rows 数组
while ($v = mysqli_fetch_assoc($query)) {
	$rows[] = $v;
}

//递归无限找子孙 ，根据parent_id 往下找儿子
function getSonTree($arr,$id=0,$lev=1){
	static $res=array();
	foreach ($arr as $v) {
		if ($v['parent_id']==$id) {
			$v['lev']=$lev;
			$res[] = $v;
			getSonTree($arr,$v['goods_cat_id'],$lev+1);
		}
	}
	return $res;
}

$result = getSonTree($rows,0,0);
foreach ($result as $v) {
	echo "<li>".str_repeat('&nbsp;', $v['lev']).$v['goods_cat_name']."</li>";
}

<?php
$mongodb = new MongoClient();
$db = $mongodb->test;//获取数据库，没有的则会自动创建
$collection = $db->runoob;//获取集合

$document = [
	[
		'name' => 'Go',
		'age'  => 'Time',
		'num'  => 1
	],
	[
		'name' => 'Go_2',
		'age'  => 'Time_2',
		'num'  =>  2
	],
	[
		'name' => 'Go_3',
		'age'  => 'Time_3',
		'num'  =>  3
	]
];
//$collection->insert($document);//插入一条数据
//$collection->batchInsert($document);//批量插入，可以弄成二维数组
//$collection->update(['name'=>'Go'], ['$set'=>['name'=>'Go_2']]); //参数1 是条件， 参数2 是改变的值
//$collection->remove(); //清除集合
//$collection->ensureIndex(['name'=>1], ['unique'=>true]); //给集合设置索引， 1为升序创建索引，-1降序创建索引，参数2 是设置可选参数
$where = ['name'=>['$ne'=>'Go_2']];
//管道参数是个数组
$pipleline = array(
	['$match'=>['name'=>['$eq'=>'Go']]],//匹配集合的key对应的值
	['$group'=>['_id' =>'name', 'total'=>['$sum'=>'$num'], 'age'=>['$sum'=>1]]]//然后根据匹配出来的进行统计
);
/*->find()->limit(10)->skip(0)->sort(['name'=>1])*/
//在3.5后aggregate有游标参数2 了，聚合函数返回的是思维数组，一般取 $result['cursor']['firstBatch']来遍历即可
$result = $collection->aggregate($pipleline,  ['cursor' => (object)['batchSize' => 10000]]);
print_r($result);
$data_result = $result['cursor']['firstBatch'];

$count = count($data_result);
foreach ($data_result as $value) { 
	echo '<br/>_id: '.$value['_id'].' , total: '.$value['total'].' , age: '.$value['age'];
}

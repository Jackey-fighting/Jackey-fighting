<?php
$table = new swoole_table(1024);
//创建表字段
$table->column('id', $table::TYPE_INT, 4);
$table->column('name', $table::TYPE_STRING, 64);
$table->column('age', $table::TYPE_INT, 3);
$table->create();

//创建行值
//$table->set('Jackey-fighting', ['id'=>1, 'name'=>'Jackey', 'age'=>25]);
//这个方法也可以创建行值，如果相同key ，则会覆盖上一行的内容
$table['Jackey-fighting_2'] = [
	'id'=>2,
	'name'=>'Jackey2',
	'age'=>26
];

/*$table->incr('Jackey-fighting_2', 'age', 4);
$table->decr('Jackey-fighting_2', 'age', 2);*/
print_r($table->get('Jackey-fighting_2'));

/*echo 'delete start:';

$flag = $table->del('Jackey-fighting_2');
var_dump($flag);*/

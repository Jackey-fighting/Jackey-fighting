<?php
$mongo = new MongoClient();
$db = $mongo->test;

$person = $db->person;
$address = $db->address;

$myAddress = array(
	'line 1' => '123 Main Street',
	'line 2' => null,
	'city'   => 'Springfield',
	'state'  => 'Vermont',
	'country'=> 'USA'
);

//保存address文档
$address->insert($myAddress);

//保存一个person关联到address
$me = array('name'=>'Jackey', 'address'=>$myAddress['_id']);
$person->insert($me);

//可以使用findOne()进行查找address的id
/*$where = ['name' => 'Jackey'];
$where2 = ['address' => 1];
$result = $person->findOne($where, $where2);
var_dump($result);*/

#引用的时候是将 address的地址放到 me的数组里面，采用的'address'(自定义)，对应上面刚插入的$myAddress数组

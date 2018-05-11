<?php
$mongo = new MongoClient();
$db = $mongo->test;
$user = $db->user;

//嵌入式关系： 把address嵌入到 user集合里面，但这种数据量一大的话，就会读写慢了，建议用引用
$userDocument = [
	'name' => 'Tom Hanks',
	'contact' => '987654321',
	'dob' => '01-01-1991',
	'address'=>[
				'building'=> '22 A, Indiana Apt',
				'pincode' => 123456,
				'city' => 'Los Angeles',
				'state' => 'California'
				]
];

/*$flag = $user->insert($userDocument);
var_dump($flag);*/

$result = $user->findOne(['name'=>'Tom Hanks'], ['address'=>1]);
var_dump($result);

$value = $result['address'];
echo $value['building'].' , '.$value['pincode'];

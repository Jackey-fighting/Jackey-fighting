<?php
/**
* User:Jackey
*/
class AsyncMysql
{
	public $dbSource = '';
	public $dbConfig = [];
	public function __construct()
	{ 
  //实例化一个swoole mysql实例
		$this->dbSource = new Swoole\Mysql;
    //进行链接的配置
		$this->dbConfig = [
			'host' => '127.0.0.1',
			'port' => 3306,
			'user' => 'root',
			'password' => 123456,
			'database' => 'swoole',
			'charset' => 'utf8'
		];
	}

	public function update(){

	}

	public function add(){

	}

	public function execute($id, $username){
		//connect
		$this->dbSource->connect($this->dbConfig, function($db, $result){
			echo 'mysql-connect'.PHP_EOL;
			if ($result == false) {
				var_dump($db->connect_error);
			}
			$sql = 'select * from test';
			//query 进行语句查询 $result 是返回成功失败的变量
			$db->query($sql, function($db, $result){
				if ($result === false) {
					//todo
				}elseif ($result === true) {
					//todo
				}else{
					print_r($result);
				}
				$db->close();
			});
		});
		return true;
	}
}

$obj = new AsyncMysql();
$flag = $obj->execute(1, 'Jackey-11111');
var_dump($flag).PHP_EOL;
echo 'start'.PHP_EOL;

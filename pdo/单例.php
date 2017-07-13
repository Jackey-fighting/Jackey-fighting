<?php
class Db{
	//数据库连接配置
	private $_dbConfig=array(
		'host'=>'localhost',
		'username'=>'root',
		'pwd'=>'111111',
		'dbName'=>'mydb'
	);

	//实现单例
	static private $_instance;

	static private function getInstance(){
		if (!self::$_instance instanceof self) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	//实现数据库连接方法，此方法提供给外界的
	static private $connectSource;

	public function getConnect(){
		if (!self::$_connetSource) {
			self::$_connectSource = mysqli_connect($this->_dbConfig['host'],$this->_dbConfig['username'],$this->_dbConfig['pwd'],$this->_dbConfig['dbName']) or die("连接失败。");
			mysqli_set_charset(self::$_connetSource,'utf8');
		}
		return self::$_connetSource;
	}
}


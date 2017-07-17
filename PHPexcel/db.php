<?php
require dirname(__FILE__)."/dbConfig.php";//引入配置文件

class db{
	public $conn = null;

	public function __construct($config){
		$this->conn=mysqli_connect($config['host'],$config['username'],$config['pwd'],$config['dbname']) or die($this->conn->error);
		mysqli_set_charset($this->conn,$config['charset']);
	}

	//根据传入sql语句查询mysql结果集
	public function getResult($sql){
		$resource = mysqli_query($this->conn,$sql) or die("数据库查询失败。");//查询sql语句
		$res=array();
		while(($row=mysqli_fetch_assoc($resource))!=false){
			$res[]=$row;
		}
		return $res;
	}
	//根据type查询数据
	public function getDataByType($type){
		$sql="select id,type,title from news where type='{$type}' order by type desc";
		$res=self::getResult($sql);
		return $res;
	}

	//style.php相关查询语句

	//查询所有的种类 
	public function getAllType(){
		$sql = "SELECT distinct(type) FROM news order by type asc";
		$res = $this->getResult($sql);
		return $res;
}
	//根据种类查询所有的id
public function getDistinctType($type){
	$sql = "SELECT distinct(type) FROM news WHERE type=".$type." order by id asc";
	$res=$this->getResult($sql);
	return $res;
}

//根据种类查询内容信息
public function getContentByType($type){
	$sql="SELECT id,title FROM news WHERE type=".$type;
	$res=$this->getResult($sql);
	return $res;
}
}
<?php
$db_host = 'localhost';
$db_user = 'root';
$db_pwd  = '111111';
$db_name = 'mydb';
$conn = mysqli_connect($db_host,$db_user,$db_pwd,$db_name) or die('连接失败');
$sql = "SELECT id,lastname from archive_tb where 1 and id=? and lastname=?";
$stmt=$conn->prepare($sql);
$stmt->bind_param("is",$id,$lastname);
//设置参数
$id=2;
$lastname='eting';
$stmt->execute();
//绑定结果
$stmt->bind_result($id2,$lastname2);
//获取值
while(mysqli_stmt_fetch($stmt)){
	echo $id2.' '.$lastname2.'<br/>';
};
//关闭预编译
$stmt->close();
$conn->close();

?>

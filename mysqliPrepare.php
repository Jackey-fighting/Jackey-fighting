<?php
$db_host = 'localhost';
$db_user = 'root';
$db_pwd  = '111111';
$db_name = 'mydb';
$conn = mysqli_connect($db_host,$db_user,$db_pwd,$db_name) or die('����ʧ��');
$sql = "SELECT id,lastname from archive_tb where 1 and id=? and lastname=?";
$stmt=$conn->prepare($sql);
$stmt->bind_param("is",$id,$lastname);
//���ò���
$id=2;
$lastname='eting';
$stmt->execute();
//�󶨽��
$stmt->bind_result($id2,$lastname2);
//��ȡֵ
while(mysqli_stmt_fetch($stmt)){
	echo $id2.' '.$lastname2.'<br/>';
};
//�ر�Ԥ����
$stmt->close();
$conn->close();

?>

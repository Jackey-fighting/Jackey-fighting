<?php

//复制实例网址 ：https://github.com/PHPMailer/PHPMailer

//引入类
$rootPath = dirname(__FILE__);
require $rootPath.'/PHPMailer-master/PHPMailerAutoload.php';

function sendMail($host,$fromEmail,$fromPwd,$fromName,$toEmail,$toName,$subject,$content){
	$mail = new PHPMailer;
	$mail ->isSMTP();  //设置邮件使用SMTP
	$mail ->Host = $host; //设置邮箱服务器地址
	$mail->SMTPAuth = true;//启用SMTP身份验证
	$mail->CharSet = "UTF-8"; //设置邮件编码
	$mail->Encoding = "base64"; //使用base64加密有邮箱和密码
	$mail->Username = $fromEmail; //SMTP用户名，即个人的邮箱地址
	$mail->Password = $fromPwd; //SMTP密码，即个人的邮箱密码
	$mail->From = $fromEmail; //发件人邮箱地址
	$mail->FromName = $fromName;//发件人名称
	$mail->addAddress($toEmail,$toName);  //添加接受者
	$mail->isHTML(true);
	$mail->Subject = $subject;
	$mail->msgHTML($content);
	return $mail->send();
}

$link = mysqli_connect('localhost','root','111111','mydb');
mysqli_set_charset($link,"utf8");
while (true) {
	$sql = "select * from task_list WHERE status = 0 order by task_id ASC LIMIT 5";
	$res = $link->query($sql);
	$mailList = array();
	while($row = mysqli_fetch_assoc($res)){
		$mailList[] = $row;
	}

	if (empty($mailList)) {
		break;
	}else{
		foreach($mailList as $k => $v){
			if (sendMail("smtp.aliyun.com",
				"jackeyliu@aliyun.com",
				"cheng8689890.",
				"aliyun",
				$v['user_email'],"sina","php_mysql模拟队列发送邮件课程",
				file_get_contents($rootPath."/new_course.html"))) {
				//发送成功之后来来更新一下状态
				$link->query("UPDATE task_list set status = 1 WHERE task_id=".$v['task_id']);
			}

				sleep(3);
		}
	}
}//最外面的while
	mysqli_close($link);
	echo "done";
?>
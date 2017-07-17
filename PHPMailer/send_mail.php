<?php
//复制实例网址 ：https://github.com/PHPMailer/PHPMailer

//引入类
$rootPath = dirname(__FILE__);
require $rootPath.'/PHPMailer-master/PHPMailerAutoload.php';

//实例化
$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.aliyun.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'jackeyliu@aliyun.com';                 // SMTP username
$mail->Password = 'cheng8689890.';                           // SMTP password
/*
$mail->SMTPSecure = 'tls';   // 加密不要了 Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;            // 端口默认就好了，所以也不要了 TCP port to connect to*/
$mail->CharSet = "UTF-8"; //设置下邮件内容的编码，因为默认是在 class.phpmailer.php的48行编码中默认是ios
$mail->setFrom('jackeyliu@aliyun.com', 'aliyun'); //这里是发送的邮箱，aliyun 是我们自定义取得名字
$mail->addAddress('jackey_sina@sina.com', 'sina');     // 收件人
/*$mail->addAddress('ellen@example.com');               // Name is optional 收件邮箱可选*/
$mail->addReplyTo('jackeyliu@aliyun.com', 'aliyun'); //这里是反回复的
/*$mail->addCC('cc@example.com');   //这里两个是密送，就是抄送，有需要的时候加上地址就行了
$mail->addBCC('bcc@example.com');*/

/*$mail->addAttachment('/var/tmp/file.tar.gz');         // 这里要发送的附件 Add attachments
$mail->addAttachment('/tmp/image.jpg', 'new.jpg'); */   // Optional name
$mail->isHTML(true);    // 这里是允许添加HTML附件 Set email format to HTML

$mail->Subject = '慕课邮件视频演示';
$mail->Body    = '这是一封演示邮件。</b>';
//$mail->msgHTML(file_get_contents('index.html'));//这里是添加html文件附件

//不带html的文本体 $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}
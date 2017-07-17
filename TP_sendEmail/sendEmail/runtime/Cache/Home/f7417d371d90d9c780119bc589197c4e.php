<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf8">
	<title>发送文件首页</title>
</head>
<body>
<form action="<?php echo U('Index/sendEmail');?>" method="post">
	用户名：<input type="text" name="name" id="" /><br/>
	密码  ：<input type="password" name="password" id="" /><br/>
	邮箱  ：<input type="email" name="email" id="" /><br/>
	<input type="submit" value="提交">
</form>
</body>
</html>
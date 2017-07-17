<?php
header("content-type: text/html;charset='utf8'");
$fileInfo = $_FILES['myFile'];
$maxSize = 2097152;//允许的最大值
$allowExt = array('jpeg','jpg','png','gif');
$flag = true;//检测是否为真是图片类型
// 判断错误号
if ($fileInfo['error']==0) {
	//判断上传文件的大小
	if ($fileInfo['size']>$maxSize) {
		exit('上传文件过大');
	}

	//$ext = strtolower(end(explode('.', $fileInfo['name'])));
	$ext = pathinfo($fileInfo['name'],PATHINFO_EXTENSION);
	if (!in_array($ext,$allowExt)) {
		exit('非法文件类型');
			}
		//判断文件是否是通过HTTP POST 方式上传来的
		if (!is_uploaded_file($fileInfo['tmp_name'])) {
			exit('文件不是通过HTTP POST 方式上传来的');
		}

		//检验真正的图片类型
		if ($flag) {
			if (getimagesize($fileInfo['tmp_name'])) {
				exit('不是一个真实的图片');
			}
		}


		$path = 'uploads';
		//如果当前目录不存在则创建一个目录
		if (!file_exists($path)) {
			mkdir($path,0777,true);
			chmod($path,0777);
		}
		//确保文件名唯一，防止重名产生覆盖
		$uniName = md5(uniqid(microtime(true),true)).'.'.$ext;
		$destination = $path."/".$uniName;
	if(@move_uploaded_file($fileInfo['tmp_name'], $destination)){
		echo '文件上传成功';
	}else{
		echo '文件上传失败';
	}

}else{
	//匹配错误信息
	switch ($fileInfo['error']) {
		case 1:
			echo '上传文件超过了PHP配置文件中的upload_max_filesize选项';
			break;
		case 2:
			echo '超过了表单MAX_FILE_SIZE限制的大小';
			break;
		case 3 :
			echo '文件部分被上传';
			break;
		case 4 :
			echo '没有选择上传文件';
			break;
		case 6 :
			echo '没有找到临时目录';
			break;
		case 7:
		case 8:
			echo '系统错误';
			break;
		default:
			break;
}
}
?>
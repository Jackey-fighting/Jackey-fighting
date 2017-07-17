<?php
/*
针对于单文件、多个文件、多个单文件的上传

*/
function getFlies(){
	$i=0;
	foreach($_FILES as $file){
		if (is_string($file['name'])) {
			$files[$i]=$file;
			$i++;
		}elseif (is_array($file['name'])) {
			/*
			*因为多文件上传的时候，就会出现三维数组，主要是name后面的会自动填补	
			*['file1'],['file2']等类推三维数组，如果没多文件上传的话，
			*$_FILES['myFile']['name']是一个字符串的，也就没有三维的出现；
			*因为上面用了foreach($_FILES as $file)会，比如 $file=$_FILES['myFile']
			*/
			foreach($file['name'] as $key=>$val){
				$files[$i]['name']=$file['name'][$key];
				$files[$i]['type']=$file['type'][$key];
				$files[$i]['tmp_name']=$file['tmp_name'][$key];
				$files[$i]['error']=$file['error'][$key];
				$files[$i]['size']=$file['size'][$key];
				$i++;
			}
		}
	}
	return $files;
}

function uploadFile($fileInfo,$path = './uploads',$flag= true,$maxSize = 1048576,$allowExt = array('jpeg','jpg','gif','png')){
	//$flag= true;
	//$maxSize = 1048576;//1M
//	$allowExt = array('jpeg','jpg','gif','png');
	//判断错误号
	$res = '';
	if ($fileInfo['error']===UPLOAD_ERR_OK) {
		//检测上传文件的大小
		if ($fileInfo['size']>$maxSize) {
			$res['res['mes']']=$fileInfo['name'].'上传文件过大';
		}
		$ext=getExt($fileInfo['name']);
		//检测上传文件的类型
		if (!in_array($ext, $allowExt)) {
			$res['res['mes']']=$fileInfo['name'].'非法文件类型';
		}
		//检测是否是真是的图片类型，这里采用$flag是表明不用每次都去检查
		if ($flag) {
			if (!getimagesize($fileInfo['tmp_name'])) {
				$res['res['mes']']=$fileInfo['name'].'不是真是图片类型';
			}
		}
		//检测是否是HTTP POST 上传上来的
		if (!is_uploaded_file($fileInfo['tmp_name'])) {
			$res['res['mes']']=$fileInfo['name'].'文件不是通过HTTP POST 方式上传上来的';
		}
		if ($res) {
			return $res;
					}
		//$path = './uploads';
		if (!file_exists('uploads')) {
			mkdir($path,0777,true);
			chmod($path, 0777);
		}
		
		$uniName=getUniName();
		$destination = $path.'/'.$uniName.'.'.$ext;
		if (!move_uploaded_file($fileInfo['tmp_name'], $destination)) {
			$res['res['mes']']=$fileInfo['name'].'文件移动失败';
		}
		$res['res['mes']']=$fileInfo['name'].'上传成功了。';
		$res['dest']=$destination;
		return $res;
	}else{
		//匹配错误信息
	switch ($fileInfo['error']) {
		case 1:
			$res['mes']= '上传文件超过了PHP配置文件中的upload_max_filesize选项';
			break;
		case 2:
			$res['mes']= '超过了表单MAX_FILE_SIZE限制的大小';
			break;
		case 3 :
			$res['mes']= '文件部分被上传';
			break;
		case 4 :
			$res['mes']= '没有选择上传文件';
			break;
		case 6 :
			$res['mes']= '没有找到临时目录';
			break;
		case 7:
		case 8:
			$res['mes']= '系统错误';
			break;
		default:
			break;
	}
	exit($res['mes']);
}
}
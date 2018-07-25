<?php
//将图片保存到本地方法
function base64_image_content($base64_image_content,$path){
	date_default_timezone_set('PRC');
    //匹配出图片的格式
    if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_image_content, $result)){
        $type = $result[2];
        $new_file = $path."/".date('Ymd',time())."/";
        if(!file_exists($new_file)){
            //检查是否有该文件夹，如果没有就创建，并给予最高权限
            mkdir($new_file, 0700);
        }
        $new_file = $new_file.time().".{$type}";
        if (file_put_contents($new_file, base64_decode(str_replace($result[1], '', $base64_image_content)))){
            return '/'.$new_file;
        }else{
            return false;
        }
    }else{
        return false;
    }
}


/*获取图片的base64编码*/
function getBase64Image($path){
	$filesize = filesize($path);//获取文件的大小
	$fopen = fopen($path, 'r');
	$image_str = fread($fopen, $filesize);//读取全部内容成一个字符串
	return base64_encode($image_str);
}

//执行本地图片测试转化成base64并保存到本地
$image_str = getBase64Image('./images.jpg');
$str = 'data:image/jpg;base64,'.$image_str;
$path = 'upload';
echo base64_image_content($str, $path);

#如果是要保存base64码的视频：
data url的格式是：data:[<mediatype>][;base64],<data>，所以存视频可以这样：
data:video/mp4;base64,3bvwAA...
video/mp4、video/webm这些就是视频格式的mime。

<?php
/*这个是前端传base64码的图片过来，然后将图片格式保存起来*/
    header('Content-type:text/html;charset=utf-8');
    $base64_image_content = $_POST['imgBase64'];
    //匹配出图片的格式
    if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_image_content, $result)){
        $type = $result[2];
        $path = "upload/";
        if(!file_exists($path))
        {
            //检查是否有该文件夹，如果没有就创建，并给予最高权限
            mkdir($path, 0700);
        }
        $new_file = $path . time() . ".{$type}";
        if (file_put_contents($new_file, base64_decode(str_replace($result[1], '', $base64_image_content)))){
            echo '保存成功：', $new_file;
        } else {
            echo '保存失败';
        }
    }


#如果是要保存base64码的视频：
data url的格式是：data:[<mediatype>][;base64],<data>，所以存视频可以这样：
data:video/mp4;base64,3bvwAA...
video/mp4、video/webm这些就是视频格式的mime。

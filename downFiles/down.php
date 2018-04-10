<?php
/**
 * 下载
 * return $data
 */
function downfile($filePath){

    // 2.获取MIME类型
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
//     var_dump($finfo);exit;
    $mime = finfo_file($finfo , $filePath);
    finfo_close($finfo);

    // 3.指定文件下载的类型
    header('content-type:' . $mime);
    // header('content-type:image/jpeg');

    // 4.告知浏览器，本次请求带有附件，并指定客户端下载的名字
    header('Content-Disposition:attachment;filename=' . basename($filePath));

    // 5.指定文件大小
    header('content-length:' . filesize($filePath));

    // 6.直接输出
    readfile($filePath);
}

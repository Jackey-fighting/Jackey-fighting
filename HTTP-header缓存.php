<?php
$interval=120; //2分钟
if(isset($_SERVER['HTTP_IF_MODIFIED_SINCE'])){
    // HTTP_IF_MODIFIED_SINCE即下面的: Last-Modified,文档缓存时间.
    // 缓存时间+时长.
    $c_time = strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE'])+$interval;
    // 当大于当前时间时, 表示还在缓存中... 释放304
    if($c_time > time()){
        header('HTTP/1.1 304 Not Modified');
        exit();
    }
}
header('Cache-Control:max-age='.$interval);
header("Expires: " . gmdate("D, d M Y H:i:s",time()+$interval)." GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
echo ' - <a href="">点击重新载入本页面</a><br />';

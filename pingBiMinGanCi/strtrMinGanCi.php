<?php
require('badword.src.php');//这是引入敏感词
$arr = array_comebine($badwords, array_fill(0, count($badwords), '**'));

$str = '我要操你，你个大傻逼';
echo strtr($str, $arr);

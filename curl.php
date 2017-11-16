<?php
/*发送 post 数据
@param url $url 发送地址
@param data $data 发送的json数据*/
 function http_curl($url,$data){
 
   	//1.初始化curl
   	$ch = curl_init();
  
   	//2.设置curl的参数
   	curl_setopt($ch, CURLOPT_URL, $url);
   	curl_setopt($ch, CURLOPT_HEADER, 0);
 	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_POST, 1);
   	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
   	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   	//3.采集
   	$output = curl_exec($ch);
   	//4.关闭
	
   	$output?var_dump($output):die(curl_error($ch));
   	curl_close($ch);
   }
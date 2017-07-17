<?php

session_start();

$image = imagecreatetruecolor(200, 60);
$bgcolor=imagecolorallocate($image, 255, 255, 255);
imagefill($image, 0, 0, $bgcolor);

/*纯数字
for ($i=0; $i < 4; $i++) { 
	$fontsize = 6;
	//下面之所以选择120 是因为这个颜色会比较深
	$fontcolor = imagecolorallocate($image, rand(0,120), rand(0,120), rand(0,120));
	$fontcontent = rand(0,9);

	$x = ($i*100/4)+rand(5,10);
	$y = rand(5,10);

	imagestring($image, $fontsize, $x, $y, $fontcontent, $fontcolor);
}*/
$fontface = 'simhei.ttf';
$strdb = array('我','爱','你','啊');
$captch_code = '';

for($i=0;$i<4;$i++){
	
	$fontcolor = imagecolorallocate($image, rand(0,120), rand(0,120), rand(0,120));
	$cn = $strdb[$i];
	
	$captch_code.=$cn;

	imagettftext($image, mt_rand(20,24), mt_rand(-60,60), (40*$i+20), mt_rand(30,35), $fontcolor, $fontface, $cn);
}
$_SESSION['authcode'] = $captch_code;

//画点
for ($i=0; $i < 200; $i++) { 
	//这里采用了50,200是这个颜色值比较浅
	$pointcolor = imagecolorallocate($image, rand(50,200), rand(50,200), rand(50,200));
	imagesetpixel($image, rand(1,199), rand(1,59), $pointcolor);
}
//画线
for ($i=0; $i < 3; $i++) { 
	$linecolor = imagecolorallocate($image, rand(80,220), rand(80,220), rand(80,220));
	imageline($image, rand(1,199), rand(1,59), rand(1,199), rand(1,59), $linecolor);
}

header('content-type: image/png');
imagepng($image);


//end
imagedestroy($image);
?>
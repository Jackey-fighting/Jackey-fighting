<?php
$image = imagecreatetruecolor(100, 30);
$imagecolor = imagecolorallocate($image, 255, 255, 255);
imagefill($image, 0, 0, $imagecolor);

/*for ($i=0; $i < 4; $i++) { 
	$fontsize = 6;
	$fontcolor = imagecolorallocate($image, rand(0,120), rand(0,120), rand(0,120));
	$fontcontent = rand(0,9);
	$x = ($i*100/4)+rand(5,10);
	$y = rand(5,10);
	imagestring($image, $fontsize, $x, $y, $fontcontent, $fontcolor);
}*/

//输出数字和字母
for ($i=0; $i < 4; $i++) { 
	$data = 'abcdefghijkmnpqrstuvwxy3456789';
	$data_str = substr($data, rand(0,strlen($data)),1);
	$fontsize = 6;
	$image_color = imagecolorallocate($image, rand(0,120), rand(0,120), rand(0,120));
	$x = ($i*100/4)+rand(5,10);
	$y = rand(5,10);
	imagestring($image, $fontsize, $x, $y, $data_str, $image_color);
}

//画点
for ($i=0; $i < 200; $i++) { 
	$pxcolor = imagecolorallocate($image, rand(50,200), rand(50,200), rand(50,200));
	$x = rand(1,99);
	$y = rand(1,29);
	imagesetpixel($image, $x, $y, $pxcolor);
}
//画线
for ($i=0; $i < 4; $i++) { 
	
	$linecolor = imagecolorallocate($image, rand(80,220), rand(80,220), rand(80,220));
	imageline($image, rand(1,99), rand(1,29), rand(1,99), rand(1,29), $linecolor);
}

header('content-type:image/png');
imagepng($image);

//end
imagedestroy($image);
?>
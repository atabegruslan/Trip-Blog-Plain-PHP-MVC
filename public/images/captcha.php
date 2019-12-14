<?php
	session_start(); 
	header('Content-type: image/png');
	
	$_SESSION['captcha'] = '';  	  
	for ($i = 0; $i < 9; $i++) {  
		$_SESSION['captcha'] .= chr(rand(97, 122));  
	} 
	
	$string=$_SESSION['captcha'];
	$png_image = imagecreate(153, 35);
	imagecolorallocate($png_image, 255, 255, 255);
	imagesetthickness($png_image, 1);
	$black = imagecolorallocate($png_image, 0, 0, 0);
	for($i=1;$i<9;$i++){
		$x1=rand(1,150);
		$y1=rand(1,35);
		$x2=rand(1,150);
		$y2=rand(1,35);
		imageline($png_image, $x1, $y1, $x2, $y2, $black);
	}
	imagestring ( $png_image ,200,40, 10, $string ,225 );
	imagepng($png_image);
	imagedestroy($png_image); 
?>
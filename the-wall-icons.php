<?php
session_start();
if(isset($icons)){
	foreach($icons as $icon_first_char){
		$my_img = imagecreate(30,30);
		$background = imagecolorallocate( $my_img, rand(1,255), rand(1,255), rand(1,255));
		$text_colour = imagecolorallocate( $my_img, rand(1,255), rand(1,255), rand(1,255));
		$line_colour = imagecolorallocate( $my_img, rand(1,255), rand(1,255), rand(1,255));
		imagestring( $my_img, 3, 12, 5, "$icon_first_char", $text_colour );
		imagesetthickness ( $my_img,2);
		imageline($my_img,0,22,30,22,$line_colour);
		imagepng($my_img,"icon_" . "$icon_first_char" . ".png");
		imagedestroy($my_img);
	}
}
?>
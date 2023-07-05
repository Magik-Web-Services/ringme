<?php
session_start();  
header('Content-type: image/png'); $code = "".rand(111,999);  $im = imagecreate(34, 15); $bg = imagecolorallocate($im, 250, 250, 250); $textcolor = imagecolorallocate($im, 0, 0, 0); 
for($i = 0, $x = 0; $i < 6; $i++, $x+=10) 
imagestring($im, 5, $x, 0,$code[$i] , $textcolor);  imagepng($im);  imagedestroy($im);  $_SESSION["texto"] = $code; 
?>
<?php
session_start("gd_img");
session_register("number","if_ok");
$_SESSION['number']=rand(100,999);
$imgworkpath="img/bgim";
if (function_exists("imagepng")) {
	$img_path=$imgworkpath.".png";
	$img=ImageCreateFromPng($img_path);
} else die("No image support in this PHP server");

$sizex=77;		// image size X
$sizey=30;		// image size Y
$degr=0;			// ugol
$sizef=20;			// fontsize, px
$left=10;			// left||digits
$top=25;			// top||digits
$step=20;			// space between digits
$font="img/arial.ttf";		//path to a TTF font 

$fcolor=imagecolorallocate($img, 255,255,255);

$i=0;while($i<$sizey) { $m=mt_rand(10,20);$i+=$m;imageline($img,0,$i,$sizex,$i,$fcolor); }
$i=0;while($i<$sizex) { $m=mt_rand(10,30);$i+=$m;imageline($img,$i,0,$i,$sizey,$fcolor); }

for($i=0;$i<4;$i++) {
	$s=substr($_SESSION['number'],$i,1);$m=mt_rand(23,27);$d=mt_rand(-20,20);$sz=mt_rand(15,24);
	$rc=mt_rand(1,6);
	if ($rc=="1") {
		$fcolor=imagecolorallocate($img, 48,0,147);
	} else if ($rc=="2") {
		$fcolor=imagecolorallocate($img, 0,147,0);
	} else if ($rc=="3") {
		$fcolor=imagecolorallocate($img, 175,175,0);
	} else if ($rc=="4") {
		$fcolor=imagecolorallocate($img, 0,184,169);
	} else if ($rc=="5") {
		$fcolor=imagecolorallocate($img, 184,0,173);
	} else {
		$fcolor=imagecolorallocate($img, 147,48,147);
	}
	$degr=$d;$sizef=$sz;
	imagettftext($img,$sizef,$degr,$left,$top,$fcolor,$font,$s);
	$top=$m;$left+=$step;
}
 
if (function_exists("imagepng")) {
	header ("Content-type: image/png");
	imagepng ($img);
} else die("No image support in this PHP server");
?>
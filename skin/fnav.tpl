<!--
***************************************************************
*
*                           ALPHA chat
*
*     Copyright (c) 2008 Myst. All rights reserved.
*         url: http://www.siberia.tut.su/achat/
*           E-mail: black-angel@newmail.ru 
*                          icq: 384099483
*
***************************************************************
-->
<html>
<head>
<style>
body {
	color: #fc0;
	font-weight: 700; 
	padding: 10px 10px 20px; 
	margin: 0; 
	background-color: #000000;
	background-position: center;
	background-attachment: fixed
}
div.mynav {
	background-color: #000; 
	background-image: url(skin/img/navig.jpg); 
	position:absolute;
	top:0px;
	left:0px;
	width: 110%;
	font-size: 14px;
	font-family: Palatino Linotype;
}
div.mynavlinks {
	background-image: url(skin/img/nmbg.jpg);
	background-attachment: fixed;
}
.nmenu {
	font: 12px sans-serif; 
	width:100%;
	text-decoration: none;
	font-family: Arial;
	text-align: left; 
	color: #fc0;
	padding: 0px 0px 0px 10px
}
</style>
<body>
<div class="mynav" align="center"><table><TD height=16></TD></table><div class="mynavlinks" align="left">
<?php
if ($UsrReg['stat']=="admin") {
?>
<a class="nmenu" href="admin/cp.php"  target=_blank>админка</a><br>
<a class="nmenu" href="control.php"  target=_blank>опции</a><br>
<a class="nmenu" href="list.php" target=_blank>списки</a><br>
<?php
} else if ($UsrReg['stat']=="moder") {
?>
<a class="nmenu" href="control.php"  target=_blank>опции</a><br>
<a class="nmenu" href="list.php" target=_blank>списки</a><br>
<a class="nmenu" href="reg.php"  target=_blank>регистрация</a><br>
<?php
} else {
?>
<a class="nmenu" href="reg.php"  target=_blank>регистрация</a><br>
<a class="nmenu" href="rules.php"  target=_blank>правила</a><br>
<a class="nmenu" href="list.php" target=_blank>помощь</a><br>
<?php
}
?>
<a class="nmenu" href="smiles.php"  target=_blank>смайлы</a><br>
<a class="nmenu" href='' onclick="top.usersfr.location.href='options.php';">настройки</a><br>
<a class="nmenu" href="info.php" target=_blank>информация</a><br>
<a class="nmenu" href="quit.php" target=_top>выход</a><br>
</div></div>
</body></html>
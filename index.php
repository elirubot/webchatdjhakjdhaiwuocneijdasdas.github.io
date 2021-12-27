<?
include "functions.php";				//Подключение файла функций
$ChtConfig=ChtConfigFunc();	
?><!--
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
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<TITLE><?=$ChtConfig['title']?></TITLE>
</HEAD>
<frameset rows="90,*,30" frameborder=no framespacing=0>
<frameset cols="*,510" frameborder=no framespacing=0>
<frame src=top.php scrolling=no marginwidth=0 marginheight=0>
<frame src=iframe.php scrolling=no marginwidth=0 marginheight=0 noresize>
</frameset>
<frameset cols="*,250" frameborder=no framespacing=0>
<frame src="ilogo.php" marginwidth=0 marginheight=0>
<frame src="inews.php" marginwidth=0 marginheight=0>
</frameset>
<frame src="iform.php" scrolling=no marginwidth=0 marginheight=0 noresize>
</frameset></HTML>
<?
include "functions.php";				//Подключение файла функций
$Msg = $_GET['msg'];
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
<html><head><title>Правила</title>
<link id=css_d1_18 rel=stylesheet type=text/css href=img/css/chi.css>
</head>
<body>
<div class=top><a>&nbsp;ЧАТ&nbsp;</a></div>
<table width=500 cellspacing=0 cellpadding=1>
<col width=220><col width=280>
<tr><td colspan=2 class=h>И Н Ф О Р М А Ц И Я</tr>
<tr><td colspan=2 align=center>
<br><br>
<?=$Msg?>
<br><br><input type=button class=btn onclick="javascript:top.location.href='./';" value="На главную">
<br>
</td></tr>
<tr><td colspan=2 class=h>&nbsp;</tr>
<tr><td><td></tr>
</table>
</body>
</html>


<?php
include "functions.php";				//Подключение файла функций

$Usr=NickFromSess();						//определяем $Usr
$UsrReg=RegData($Usr);					//получаем рег. данные
$Title="$Usr:: Информация";

if(!$UsrReg) {						//при отстуствие рег. данных
	$Msg="Вы незарегистрированы!";
}
if($Msg) {
	Header("Location: ./error.php?msg=$Msg");
} else {
	$Name=$UsrReg['name'];
	$Sex=$UsrReg['sex'];
	$BDate=$UsrReg['dbdate'];
	$Pass=$UsrReg['pass'];
	$Mail=$UsrReg['mail'];
	$ICQ=$UsrReg['icq'];

	$Sex=($Sex=="М")?("<option value=\"М\">Мужской</a><option value=\"Ж\">Женский</a>"):("<option value=\"Ж\">Женский</a><option value=\"М\">Мужской</a>");
?>
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
<title><?=$Title?></title>
<LINK href="img/css/chi.css" type=text/css rel=stylesheet>
</head>
<body>
<div class=top><a>&nbsp;ЧАТ&nbsp;</a></div>
<form action="save.php" method="post"  enctype="multipart/form-data">
<input name="pass_hide" type="hidden" value="<?=$Pass?>">
<table width=500 cellspacing=0 cellpadding=1>
<col width=220><col width=280>
<tr><td colspan=2 class=h>Информация / <?=$Usr?> </td></tr>
<tr><td colspan=2><br><br><td></tr>
<tr class=bg0><td>Новый пароль:<td><input class=inp name="pass" size=42 type="password" value='' maxlength=15></tr>
<tr class=bg1><td>Имя:<td><input class=inp name="name" type="text" size=42 value='<?=$Name?>' maxlength=15></tr>
<tr class=bg0><td>Пол:<td><select name="sex" class="inp"><?=$Sex?></select></tr>
<tr class=bg1><td>Возраст:<td><input class=inp name="dbdate" type="text" size=42 value='<?=$BDate?>' maxlength=15></tr>
<tr class=bg0><td>Почта:<td><input class=inp name="mail" type="text" size=42 value='<?=$Mail?>' maxlength=15></tr>
<tr class=bg1><td>ICQ:<td><input class=inp name="icq" type="text" size=42 value='<?=$ICQ?>' maxlength=15></tr>
<tr><td><br><br><td></tr>
<tr><td colspan=2><hr></tr>
<tr class=btns>
<td><input type=button class=btn onClick="top.close();" value="Отмена">
<td align=right>
<input type=submit name=save class=btn value="Сохранить">
</tr>
</table>
</form>
</body>
</html>

<?php
}
?>
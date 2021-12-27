<?
$Action=$_POST['s'];
$Error=$_GET['e'];

include "functions.php";				//Подключение файла функций
error_reporting(0);					//Не позоляет видеть ошибки пользователям
$ChtConfig=ChtConfigFunc();					//Получаем конфиг чата

if ($ChtConfig['reg_close']==1) {
	$Msg="Регистрация временно закрыта!";
}
if($Msg) {
	Header("Location: ./error.php?msg=$Msg");
	exit;
}



if($Action!=1) {
	if($Error==null) {
		$Error="Здравствуйте, мы
      		рады видеть Вас на нашем сайте!<BR>Пожалуйста, заполните все поля и
      		проверьте их содержимое.";
	}
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
<LINK href="img/css/chi.css" type=text/css rel=stylesheet>
</head>






<body>
<form action="reg.php" method="post" enctype="multipart/form-data">
<input name="s" type="hidden" value="1">
<div class=top><a>&nbsp;ЧАТ&nbsp;</a></div>
<table width=500 cellspacing=0 cellpadding=1>
<col width=220><col width=280>
<tr><td colspan=2 class=h>Р Е Г И С Т Р А Ц И Я</td></tr>
<tr><td colspan=2 align=center><br><?=$Error?><br><br><td></tr>
<tr class=bg0><td>Ник:<td><input  class=inp name=nick size=42 maxlength=50></tr>
<tr class=bg1><td>Пароль:<td><input  class=inp name=pass size=42 maxlength=50 type="password"></tr>
<tr class=bg0><td>Код:<td><input  class=inp name=kart size=42 maxlength=50></tr>
<tr class=bg1><td colspan=2><center><img src="img.php"></center></tr>
<tr><td><br><br><td></tr>
<tr><td colspan=2><hr></tr>

<tr class=btns>
<td><input type=button class=btn onClick="top.close();" value="Отмена">
<td align=right>

<input type=submit name=subm class=btn value="Зарегить">
</tr>


</table>
</form>
</body>
</html>
<?php
} else {
	$Nick=ReplNickSimFunc($_POST['nick']); 		//убираем символы
	$Pass=ReplPassSimFunc($_POST['pass']);			//убираем символы
	$kart=$_POST['kart'];			

	$Error=null;
	//ошибки при  регистрации

	if($Nick==null) {
		$Error.="Вы не указали ник!<BR>Внимание: Ник будет являться Вашим уникальным именем в чате изменить которое возможно лиш повторно пройдя процедуру регистрации.";
		$html="<script>location.href='reg.php?e=$Error';</script>";
	} else {
		if(preg_match('!^[a-z0-9_]+$!i',$Nick)==0) {
			$Error.="Ошибка ввода ника!<BR>Внимание: Ник может включать в себя только латинские буквы и символ  _!";
			$html="<script>location.href='reg.php?e=$Error';</script>";
		} else {
			if((strlen($Nick)<($ChtConfig['nick_size_min'])) or (strlen($Nick)>($ChtConfig['nick_size_max']))) {
				$Error.="Ошибка ввода ника!<BR>Внимание: Ник неможет содержать менее  ".$ChtConfig['nick_size_min']." или более ".$ChtConfig['nick_size_max']." букв/символов.";
				$html="<script>location.href='reg.php?e=$Error';</script>";
			} else {
				if($Pass=="") {
					$Error.="Вы не указали пароль!<BR>Внимание: Пароль защищает вашу регистрацию, рекомендуем не делать пароль слишком простым и маленьким.";
					$html="<script>location.href='reg.php?e=$Error';</script>";
				} else {
					if($kart!=$_SESSION['number']) {
						$Error.="Цыфры не совпадают!<BR>Внимание: Картинка существует для защиты от автоматической регистрации, укажите верное число.";
						$html="<script>location.href='reg.php?e=$Error';</script>";
					}
				}
			}
		}
	}


	if ($Error==null) {
		$UsrInfFName=file("data/users/".strtolower($Nick).".php");
		if(!$UsrInfFName) {
			$UsrInfFile="data/users/".strtolower($Nick).".php";
			$FileOpen = fopen($UsrInfFile, "w+" );
			fputs ($FileOpen, "<?die?>\n");
			fputs ($FileOpen, "|name||\n");
			fputs ($FileOpen, "|sex|Н|\n");
			fputs ($FileOpen, "|dbdate||\n");
			fputs ($FileOpen, "|nick|$Nick|\n");
			fputs ($FileOpen, "|pass|".md5($Pass)."|\n");
			fputs ($FileOpen, "|stat|user|\n");
			fputs ($FileOpen, "|mail||\n");
			fputs ($FileOpen, "|icq||\n");
			fputs ($FileOpen, "|was||\n");
			@fflush($FileOpen);
			fclose($FileOpen);

			$Msg="Пользователь $Nick зарегистрирован. <BR> Для того, чтобы войти в чат Вам необходимо вернуться на главную страницу и ввести соответствующий логин и пароль.";
			if($Msg) {
				Header("Location: ./error.php?msg=$Msg");
				exit;
			}

		} else {
	//если регистрация существует
			$html="<script>location.href='reg.php?e=Такой ник уже зарегистрирован!<BR>Вам необходимо выбрать другой ник и заного заполнить регистрацию.';</script>";
        	}
	}
print $html;
}
?>
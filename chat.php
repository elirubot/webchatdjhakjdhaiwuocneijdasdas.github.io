<?php
	//убираем символы из ника

$_POST['nick']=trim($_POST['nick']); $_POST['nick']=ereg_replace(";","",$_POST['nick']);
$_POST['nick']=ereg_replace("#","",$_POST['nick']); $_POST['nick']=ereg_replace(" ","",$_POST['nick']);
$_POST['nick']=str_replace("\r\n","",$_POST['nick']); $_POST['nick']=str_replace("\n","",$_POST['nick']);
$_POST['nick']=str_replace("\t","",$_POST['nick']); $_POST['nick']=eregi_replace(":","",$_POST['nick']);
$_POST['nick']=eregi_replace("<","",$_POST['nick']); $_POST['nick']=eregi_replace(">","",$_POST['nick']);
$_POST['nick']=eregi_replace("\"","",$_POST['nick']); $_POST['nick']=eregi_replace("\[","",$_POST['nick']);
$_POST['nick']=eregi_replace("\]","",$_POST['nick']); $_POST['nick']=eregi_replace("\(","",$_POST['nick']);
$_POST['nick']=eregi_replace("\)","",$_POST['nick']); $_POST['nick']=eregi_replace("\{","",$_POST['nick']);
$_POST['nick']=eregi_replace("\}","",$_POST['nick']); $_POST['nick']=eregi_replace("&","",$_POST['nick']);


	//Проверка на регистрацию при формирование session ID

error_reporting(0);					//Не позоляет видеть ошибки пользователям
$UsrInfFName="data/users/".strtolower($nick).".php";
$UsrInfFile = file($UsrInfFName);
if (!$UsrInfFile) {
	$SesID=md5($_POST['nick']);			//Формирование ID по md5 нику, если нет регистрации
} else {
	$SesID=md5($_POST['nick'].$_POST['pass']);	//Формирование ID по нику и паролю, если есть регистрация
}

session_id($SesID);					//Непоредственное формирование ID сессии

include "functions.php";				//Подключение файла функций

$StartTime = GetMicroTime();				//Получаем время начала генерации страницы

$Error=0;

$Usr=$_POST['nick'];

$UsrReg=RegData($Usr);					//Получаем регистрационные данные
$IPBanRtrn=IPBanFunc();						//Проверка на бан ip
$NickBanRtrn=NickBanFunc();					//Проверка на бан nick
$ChtConfig=ChtConfigFunc();						//Получаем конфиг чата

	//Проверка ника и чата

if($ChtConfig['close']==1 && $UsrReg['stat']!='admin') {
	$Error="Чат закрыт! По причине:<br>".$ChtConfig['close_reason'];
}
if(count(file("data/onlinelist.php"))>=$ChtConfig['chat_max_people'] and $ChtConfig['chat_max_people']!='0' and $UsrReg['stat']!='admin') {
	$Error="Чат перегружен!<BR>Внимание: В чате может находиться только ".$ChtConfig['chat_max_people']." человек.";
}
if(empty($_POST['nick'])) {
	$Error="Вы не указали ник!";
}
if(preg_match('!^[a-z0-9_]+$!i',$_POST['nick'])==0) {
	$Error="Ошибка ввода ника!<BR>Внимание: Ник может включать в себя только латинские буквы и символ  _!";
}
if((strlen($_POST['nick'])<($ChtConfig['nick_size_min'])) or (strlen($_POST['nick'])>($ChtConfig['nick_size_max']))) {
	$Error="Ошибка ввода ника!<BR>Внимание: Ник не может содержать менее  ".$ChtConfig['nick_size_min']." или более ".$ChtConfig['nick_size_max']." букв/символов.";
}
if($UsrReg and $UsrReg['pass']!=md5($_POST['pass'])) {
	$Error="Пароль не верный!";
}
if($IPBanRtrn!=null) {
	if($UsrReg['stat']!='admin') {
		$Error=$IPBanRtrn;
	}
}
if($NickBanRtrn!=null) {
	if($UsrReg['stat']!='admin') {
		$Error=$NickBanRtrn;
	}
}
if($Error) {
	Header("Location: ./error.php?msg=$Error");
	exit;
}

	//Проверка на режим чата
if ($ChtConfig['reg']==1) {
	if(!$UsrReg) {
		print "<script>top.location.href='./error.php?msg=Чат работает в клубном режиме! Вы не зарегистрированы!';</script>";
		break;
	}
}




	//Старт сессии и регистрация в ней переменных
session_start();
session_register('nick','pass','ip','mstat');
$_SESSION['nick']=$_POST['nick'];
$_SESSION['pass']=$_POST['pass'];
$_SESSION['ip']=$REMOTE_ADDR;
$_SESSION['mstat']=$UsrReg['stat'];

	//Проверка возможности входа в чат, если $Func==0, то входим в чат, 
	//проверяет есть ли ник в онлайн листе если нет то входим,
	//также выкидывает по таймауту при принудительном рефреше
$NickInOList=AwayList();
if(!$NickInOList) {

	$Func=EnterFunc($Usr);
	if ($Func==1) {
		break;
	}

} else {

	$Func=ReEnterFunc($Usr);
	if ($Func==1) {
		break;
	}
}

$_SESSION['ent']=$_POST['ent'];

	//Получаем настройки чата
$Title=$ChtConfig['title'];
$Refr=$ChtConfig['refresh'];

	//Получаем топик
$ThmFName="data/thm.php";
$ThmFile=file($ThmFName);
$Thm=trim($ThmFile[0]);

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
<html>
<head>
<META http-equiv=Content-Type content="text/html; charset=windows-1251">
<title><?=$Title?> :: <?=$Usr?></title>

<script>
	//Конфиг для чата
var Usr="<?=$Usr?>";
var thm="<?=$Thm?>";
var ThmMas=thm.split("|");
var timeit=<?=$Refr?>*1000;
</script>

<script src="script.js" language="JavaScript"><?=$_POST['r']?></script>

<frameset rows="90,*,30,0,0,0"  frameborder=no framespacing=0>
<frameset cols="*,510" frameborder=no framespacing=0>
<frame src=top.php scrolling=no marginwidth=0 marginheight=0>
<frame src=topmenu.php scrolling=no marginwidth=0 marginheight=0 noresize>
</frameset>
<frameset cols="*,250" frameborder=no framespacing=0>
<frame src="text.php" name=textfr marginwidth=0 marginheight=0 borderheight=100% scrolling=auto style="border-right: solid #000 1px;">
<frame src="users.php" name=usersfr marginwidth=0  marginheight=0>
</frameset>
<frame src="submit.php" scrolling=no name=submfr marginwidth=0 marginheight=0 noresize>
<frame src="msg.php" scrolling=no name=hidefr marginwidth=0 marginheight=0 noresize>
<frame scrolling=no name=rfr marginwidth=0 marginheight=0 noresize>
<frame scrolling="no" name=reload src="javascript:top.Refresh();" noresize  marginheight=0 marginwidth=0>
</frameset>
</HTML>
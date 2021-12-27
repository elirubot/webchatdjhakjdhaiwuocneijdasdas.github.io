<?php
include "functions.php";				//Подключение файла функций
$NickInOList=AwayList();
$Usr=$_SESSION['nick'];					//определение $Usr
$ChtConfig=ChtConfigFunc();						//получаем настройки чата
$LogMsgName=date("d-m-Y",time());				//название лог файла по дате
	//проверка есть ли ник в чате
if(!$NickInOList) {
	print "<script>top.location.href='./error.php?msg=Ваш ник не обнаружен. Вы покинули чат до этого.';</script>";
	exit;
}
	//проверка есть ли сессия
if(!$Usr) {
	print "<script>top.location.href='./error.php?msg=Ваша сессия не обнаружена. Вы покинули чат до этого.';</script>";
	exit;
}
	//защита от длинных сообщений
if(strlen($_POST['msg'])>$ChtConfig['chat_max_msg']) {
	print "<script>top.ClearForm();top.FocusForm();</script>";
	exit;
}

$MaxChtMsg=$ChtConfig['chat_max']-1;				//максимальное число сообщений
$ChtMsgFName="data/chatmsg.php";
$LogMsgFName="data/logs/".$LogMsgName.".php";
$ChtMsgFile=file($ChtMsgFName);
$LogMsgFile=file($LogMsgFName);
$ChtMsgData="";
$LogMsgData="";

$MsgStatus="A";						//статус обычного сообщения

	//в лог фаил пишет все сообщения
for($i=0;$i<count($LogMsgFile);$i++) {
	if(trim($LogMsgFile[$i])) {
		$LogMsgData.=trim($LogMsgFile[$i])."\n";
	}
}

	//в случае привата или топика расширяет число макс сообщений
$AddMaxMsg=0;
for($i=0;$i<count($ChtMsgFile);$i++) {
	$Mas=split("::",$ChtMsgFile[$i]);
	$Mas=$Mas[1];
	if(($Mas=="P") or ($Mas=="T")){
		$AddMaxMsg++;
	}
}

if(count($ChtMsgFile)<$MaxChtMsg) {
	$AllMaxMsg=count($ChtMsgFile);
} else {
	$AllMaxMsg=$MaxChtMsg+$AddMaxMsg;
}

	//в чат фаил пишет ограниченое число сообщений
for($i=0;$i<$AllMaxMsg;$i++) {
	if(trim($ChtMsgFile[$i])) {
		$ChtMsgData.=trim($ChtMsgFile[$i])."\n";
	}
}
	//условие приватного сообщения
if(!empty($_POST['priv'])) {
	$MsgStatus="P";
}

$Msg=ReplSimFunc($_POST['msg']);				//заменяет(убирает) теги
$Msg=ReplMatFunc($Msg);					//заменяет мат
$Msg=ReplSmileFunc($Msg);					//заменяет на смайлы

	//получаем проверенные настройки
$NickGradStrt=convGradColor($_COOKIE[$Usr."NickGradStrt"]);
$NickGradEnd=convGradColor($_COOKIE[$Usr."NickGradEnd"]);
$MsgColor=convGradColor($_COOKIE[$Usr."MsgColor"]);
$MsgFace=convFont($_COOKIE[$Usr."MsgFace"]);
$MsgFontWeight=convFontWeight($_COOKIE[$Usr."MsgFontWeight"]);
$MsgFontStyle=convFontStyle($_COOKIE[$Usr."MsgFontStyle"]);

$FontData=$NickGradStrt."|".$NickGradEnd."|".$MsgColor."|".$MsgFace."|".$MsgFontWeight."|".$MsgFontStyle;

	//запись в чат и лог
$ChtMsgData=date("H:i:s",time()+$ChtConfig['chat_time'])."::".$MsgStatus."::$Usr::".$FontData."::$Msg\n".$ChtMsgData;
$LogMsgData=date("H:i:s",time()+$ChtConfig['chat_time'])."::".$MsgStatus."::$Usr::".$FontData."::$Msg\n".$LogMsgData;
$FileOpen=fopen("$ChtMsgFName", "w+");
	//обновление при записи в чат
if(fwrite($FileOpen, $ChtMsgData)) {
	echo "<script>top.ClearForm();top.FocusForm();top.hidefr.location.href='msg.php';</script>";
} else {
	echo "<script>top.location.href='./error.php?msg=Ошибка при отправке сообщения!';</script>";
}
fclose($FileOpen);
	//проверка включен ли лог
if($ChtConfig['log_msg']=="1") {
	$FileOpen=fopen("$LogMsgFName", "w+");
	fwrite($FileOpen, $LogMsgData);
	fclose($FileOpen);
}
?>
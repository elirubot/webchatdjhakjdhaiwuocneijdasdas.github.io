<?php
include "functions.php";			//Подключение файла функций
$Usr=NickFromSess();			//определение $Usr
$UsrReg=RegData($Usr);			//получаем рег. данные
$ChtConfig=ChtConfigFunc();			//получаем настройки чата
	//необходимость регистрации
if ($ChtConfig['reg']==1) {
	if(!$UsrReg) {
		print "<script>top.location.href='./error.php?msg=Необходима регистрация!';</script>";
		break;
	}
}
include ("skin/submit.tpl");
?>

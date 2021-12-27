<?
include "functions.php";				//Подключение файла функций
$Usr=NickFromSess();
$UsrReg=RegData($Usr);					//Получаем регистрационные данные
include ("skin/fnav.tpl");
?>

<?php
include "functions.php";				//Подключение файла функций
$Usr=$_SESSION['nick'];					//определение $Usr
	//проверка есть ли сессия
if(!$Usr) {
	Header("Location: ./error.php?msg=Ваша сессия необнаружена. Вы покинули чат до этого.");
	exit;
}
	//функция выхода
ExitFunc($Usr);
	//переход на главную
Header("Location: ./");
	//убираем сессию
session_destroy();
?>
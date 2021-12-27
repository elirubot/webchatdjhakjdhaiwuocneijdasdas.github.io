<?php
include "functions.php";				//Подключение файла функций
$Usr=NickFromSess();						//определение $Usr
$UsrReg=RegData($Usr);					//получаем рег. данные
$ChtConfig=ChtConfigFunc();						//получаем настройки чата

	//проверка на режим чата
if ($ChtConfig['reg']==1) {
	if(!$UsrReg) {
		print "<script>top.location.href='./error.php?msg=Вы не зарегистрированы!';</script>";
		break;
	}
}

	//запись времени

$RtrnData="";
$UsrFind=0;
$OnlineUsrFName="data/onlinelist.php";
$OnlineUsrFile=file("$OnlineUsrFName");
for($i=0;$i<count($OnlineUsrFile);$i++) {
	$Mas=split("::",$OnlineUsrFile[$i]);
	if($Mas[1]!=$Usr) {
		$RtrnData.=trim($OnlineUsrFile[$i]).chr(10);
	} else if($Usr==$Mas[1]) {
		$UsrFind=1;
		$RtrnData.=$Mas[0]."::".$Mas[1]."::".time()."::".$Mas[3]."::".$Mas[4]."::".$Mas[5];
	}
}
if($UsrFind) {
	$FileOpen = fopen ($OnlineUsrFName, "w+");
	fwrite ($FileOpen, $RtrnData);
	fclose ($FileOpen);
}

?>
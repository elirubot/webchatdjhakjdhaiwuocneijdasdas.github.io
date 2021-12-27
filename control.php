<?
include "functions.php";			//подключение функций

$Usr=NickFromSess();					//определение пользователя
$UsrReg=RegData($Usr);
$IP=$_POST['ip'];
$IPBanDate=$_POST['time'];
$IPBanCommt=$_POST['comment'];
$Nick=$_POST['n'];
$NickBanDate=$_POST['time2'];
$NickBanCommt=$_POST['comment2'];
$KickNick=$_POST['n2'];
$KickCommt=$_POST['comment3'];

if(($UsrReg['stat']!="admin") and ($UsrReg['stat']!="moder") or ($UsrReg == 0) or ($Usr==null)) {
	print "<script>top.location.href='./error.php?msg=Вам отказано в доступе!';</script>";
	exit;
}
	//выполнение функции в зависимости от поступивших данных
if ($IP && ereg("([0-9]).([0-9]).([0-9]).([0-9])", $IP) && ereg("([0-9]{2}).([0-9]{2}).([0-9]{4})", $IPBanDate)) IpBan($IP,$IPBanDate,$IPBanCommt,$Usr);
if ($Nick && ereg("([0-9]{2}).([0-9]{2}).([0-9]{4})", $NickBanDate)) NickBan($Nick,$NickBanDate,$NickBanCommt,$Usr);
if ($KickNick) Kick($KickNick,$KickCommt,$Usr);

	//вывод ников и данных
$OnlineUsrFName="data/onlinelist.php";
$OnlineUsrFile=file("$OnlineUsrFName");
for($i=0;$i<count($OnlineUsrFile);$i++) {
	$Mas=split("::",$OnlineUsrFile[$i]);
	$IP=$Mas[0];
	$NickName=$Mas[1];
	$System=$Mas[5];
	$html.="<SPAN>Ник: ".$NickName."</SPAN><br>Данные: ".$IP." &nbsp; | &nbsp; ".$System."<br><br>";
}
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
<LINK href="img/css/chi.css" type=text/css rel=stylesheet>
</head>
<body>
<div class=top><a>&nbsp;ЧАТ&nbsp;</a></div>
<table width=500 cellspacing=0 cellpadding=1>
<col width=220><col width=280>
<tr><td colspan=2 class=h>О П Ц И И</td></tr>
<tr><td colspan=2><br><br><td></tr>
<form action="control.php" method="post" enctype="multipart/form-data">
<tr><td colspan=2><b>Блокировка IP</b><td></tr>
<tr class=bg0><td>IP:<td><input class=inp name="ip" type="text" size=42 value='0.0.0.0'></tr>
<tr class=bg1><td>Reason:<td><input class=inp name="comment" type="text" size=42 value=''></tr>
<tr class=bg0><td>Time:<td><input class=inp name="time" type="text" size=42 value=<?=date("d.m.Y")?>></tr>
<tr><td colspan=2><center><input type="submit" value="Заблокировать IP"  class="btn"></center></td></tr>
<tr><td><br><br><td></tr></form>

<form action="control.php" method="post" enctype="multipart/form-data">
<tr><td colspan=2><b>Блокировка ника</b><td></tr>
<tr class=bg0><td>Nick:<td><input class=inp name="n" type="text" size=42 value=''></tr>
<tr class=bg1><td>Reason:<td><input class=inp name="comment2" type="text" size=42 value=''></tr>
<tr class=bg0><td>Time:<td><input class=inp name="time2" type="text" size=42 value=<?=date("d.m.Y")?>></tr>
<tr><td colspan=2><center><input type="submit" value="Заблокировать ник"  class="btn"></center></td></tr>
<tr><td><br><br><td></tr></form>

<form action="control.php" method="post" enctype="multipart/form-data">
<tr><td colspan=2><b>Выкинуть ник</b><td></tr>
<tr class=bg0><td>Nick:<td><input class=inp name="n2" type="text" size=42 value=''></tr>
<tr class=bg1><td>Reason:<td><input class=inp name="comment3" type="text" size=42 value=''></tr>
<tr><td colspan=2><center><input type="submit" value="Выкинуть ник"  class="btn"></center></td></tr>
<tr><td><br><br><td></tr></form>


<tr><td colspan=2><b>В чате</b><td></tr>
<tr><td colSpan=2><?=$html?></td></tr>
<BR><BR><BR>
</body>
</html>
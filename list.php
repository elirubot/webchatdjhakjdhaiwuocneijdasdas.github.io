<?
include "functions.php";			//подключение функций
$Usr=NickFromSess();					//определение пользователя
$UsrReg=RegData($Usr);
$IP=$_POST['ip'];
$Nick=$_POST['n'];

if(($UsrReg['stat']!="admin") and ($UsrReg['stat']!="moder") or ($UsrReg == 0) or ($Usr==null)) {
	print "<script>top.location.href='./error.php?msg=Вам отказано в доступе!';</script>";
	exit;
}
	//выполнение функции в зависимости от поступивших данных
if ($IP && ereg("([0-9]).([0-9]).([0-9]).([0-9])", $IP)) IpUnBan($IP,$Usr);
if ($Nick) NickUnBan($Nick,$Usr);

	//вывод забаненых IP
$IPBanFName="data/banip.php";
$IPBanFile=file("$IPBanFName");
for($i=0;$i<count($IPBanFile);$i++) {
	$Mas=split("::",$IPBanFile[$i]);
	$IP=$Mas[0];
	$IPBanDate=$Mas[1];
	$IPBanCommt=$Mas[3];
	$html.="<SPAN>IP: ".$IP."</SPAN><br>Забанен до: ".$IPBanDate." &nbsp; | &nbsp; ".$IPBanCommt."<br><br>";
}
	//вывод забаненых Ников
$NickBanFName="data/ban.php";
$NickBanFile=file("$NickBanFName");
for($i=0;$i<count($NickBanFile);$i++) {
	$Mas=split("::",$NickBanFile[$i]);
	$NickName=$Mas[0];
	$NickBanDate=$Mas[1];
	$NickBanCommt=$Mas[3];
	$html2.="<SPAN>Nick: ".$NickName."</SPAN><br>Забанен до: ".$NickBanDate." &nbsp; | &nbsp; ".$NickBanCommt."<br><br>";
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
<tr><td colspan=2 class=h>С П И С К И</td></tr>
<tr><td colspan=2><br><br><td></tr>

<form action="list.php" method="post" enctype="multipart/form-data">
<tr><td colspan=2><b>Разблокировать IP</b><td></tr>
<tr class=bg0><td>IP:<td><input class=inp name="ip" type="text" size=42 value='0.0.0.0'></tr>
<tr><td colspan=2><center><input type="submit" value="Разблокировать IP"  class="btn"></center></td></tr>
<tr><td><br><br><td></tr></form>

<form action="list.php" method="post" enctype="multipart/form-data">
<tr><td colspan=2><b>Разблокировать ник</b><td></tr>
<tr class=bg0><td>Nick:<td><input class=inp name="n" type="text" size=42 value=''></tr>
<tr><td colspan=2><center><input type="submit" value="Разблокировать ник"  class="btn"></center></td></tr>
<tr><td><br><br><td></tr></form>

<TABLE cellSpacing=0 cellPadding=0 width=500 border=0>
  <TBODY>
  <TR vAlign=top>
    <TD width=50%>
    <TABLE style="MARGIN-BOTTOM: 10px" cellSpacing=0 cellPadding=0
      width="250" border=0>
        <TBODY>
        <TR>
          <TD><b>Забаненые IP</b></TD></TR>
        <TR>
          <TD colSpan=3>
	<DIV><?=$html?></DIV></TD></TR></TBODY></TABLE></TD>
    <TD  width=50% Align=right>
    <TABLE style="MARGIN-BOTTOM: 10px" cellSpacing=0 cellPadding=0
      width="250" border=0>
        <TBODY>
        <TR>
	  <TD><b>Забаненые Ники </b></TD></TR>
        <TR>
          <TD colSpan=3>
	<DIV><?=$html2?></DIV></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE><BR><BR><BR></body></html>
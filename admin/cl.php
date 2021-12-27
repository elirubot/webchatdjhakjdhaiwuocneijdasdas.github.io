<?
$Action=$_POST['s'];
$Title="Управление";
include "../functions.php";
$Usr=$_SESSION['nick'];
$UsrReg=AdminRegData($Usr);
$ChtConfig=ChtAdminConfigFunc();

$ChtConfigFName="../data/chatconf.php";

$IsMainAdmin=0;
$MainAdmin=explode(",",$ChtConfig['admin']);
for($i=0;$i<count($MainAdmin);$i++) {
	if ($Usr==$MainAdmin[$i]) {
		$IsMainAdmin=1;
        }
}

if(($UsrReg['stat']!="admin") or ($UsrReg == 0) or ($Usr==null) or ($IsMainAdmin==0)) {
?>
<html>
<head>
<link rel="stylesheet" href="css/cp.css" type="text/css">
</head><br><font face=Arial style="font-size : 13px"><div align="center"><b>Access denied.
</b></div><br><br><center>Попытка проникновения в панель управления.</center></font>
</html>
<?
	exit;
}

if($Action=='1') {
	$RtrnData=$_POST['ChtName']."::".$_POST['ChtAbout']."::".$_POST['ChtRegW']."::".$_POST['ChtRegCls']."::".$_POST['ChtCls']."::".$_POST['ChtClsWhy']."::".$_POST['ChtMainAdmin']."::".$_POST['AddToTime']."::".$_POST['SmlTranscript']."::".$_POST['MatReplace']."::".$_POST['MaxOnline']."::".$_POST['RefrTime']."::".$_POST['ChtTimeout']."::".$_POST['CountMsg']."::".$_POST['MaxLenMsg']."::".$_POST['MaxLenNick']."::".$_POST['MinLenNick']."::".$_POST['Log'];
	$FileOpen = fopen ($ChtConfigFName, "w+");
	fwrite ($FileOpen, $RtrnData);
	fclose ($FileOpen);
}

$ConfFile=file($ChtConfigFName);

$Mas=split("::",trim($ConfFile[0]));
$ChtName=trim($Mas[0]);
$ChtAbout=trim($Mas[1]);
$ChtRegW=($Mas[2]==1) ? "<option value=\"1\">Обязательна</option><option value=\"0\">Необязательна</option>" : "<option value=\"0\">Необязательна</option><option value=\"1\">Обязательна</option>";
$ChtRegCls=($Mas[3]==1) ? "<option value=\"1\">Закрыта</option><option value=\"0\">Открыта</option>" : "<option value=\"0\">Открыта</option><option value=\"1\">Закрыта</option>";
$ChtCls=($Mas[4]==1) ? "<option value=\"1\">Закрыт</option><option value=\"0\">Открыт</option>" : "  <option value=\"0\">Открыт</option><option value=\"1\">Закрыт</option>";
$ChtClsWhy=trim($Mas[5]);
$ChtMainAdmin=trim($Mas[6]);
$AddToTime=trim($Mas[7]);
$SmlTranscript=trim($Mas[8]);
$MatReplace=trim($Mas[9]);
$MaxOnline=trim($Mas[10]);
$RefrTime=trim($Mas[11]);
$ChtTimeout=trim($Mas[12]);
$CountMsg=trim($Mas[13]);
$MaxLenMsg=trim($Mas[14]);
$MaxLenNick=trim($Mas[15]);
$MinLenNick=trim($Mas[16]);
$Log=($Mas[17]==1) ? "<option value=\"1\">Да</option><option value=\"0\">Нет</option>" : "  <option value=\"0\">Нет</option><option value=\"1\">Да</option>";
?>
<HTML><HEAD><TITLE>Администрирование::<?=$Title?></TITLE>
<LINK href="css/cp.css" type=text/css rel=stylesheet></HEAD>
<BODY>
<TABLE style="TABLE-LAYOUT: fixed" height="100%" cellSpacing=0 cellPadding=0
width="100%" border=0>
  <TBODY>
  <TR>
    <TD class=LSideFrameBg></TD>
    <TD class=LSideFrameBgShadow width=11><IMG height=11 alt=Spacer
      src="img/spacer.gif" width=11></TD>
    <TD class=LSideFrameBgDetail width=10><IMG height=11 alt=Spacer
      src="img/spacer.gif" width=10></TD>
    <TD vAlign=top align=left width=750>
      <DIV align=center>
      <TABLE cellSpacing=0 cellPadding=0 width=745 height="89%" border=0>
        <TBODY>
        <TR>
          <TD vAlign=top width=193>
            <TABLE cellSpacing=0 cellPadding=0 width=193 border=0>
              <TBODY>
              <TR>
                <TD class=FeaturesMenuBase1 align=middle></TD></TR>
              <TR>
                <TD class=FeaturesMenuBodyBg align=middle>
                  <TABLE cellSpacing=0 cellPadding=0 width=154>
                    <TBODY>
                    <TR>
                      <TD><IMG height=2
                        src="img/PortalFeaturesDivider.gif"
                        width=154></TD></TR>
                    <TR align=left>
                      <TD><A class=FeaturesMenuText
                        href="cp.php">Информация</A></TD></TR>
                    <TR>
                      <TD><IMG height=2
                        src="img/PortalFeaturesDivider.gif"
                        width=154></TD></TR>
                    <TR align=left>
                      <TD><A class=FeaturesMenuText
                        href="cl.php">Управление</A></TD></TR>
                    <TR>
                      <TD><IMG height=2
                        src="img/PortalFeaturesDivider.gif"
                        width=154></TD></TR>
                    <TR align=left>
                      <TD><A class=FeaturesMenuText
                        href="cw.php">Антимат</A></TD></TR>
                    <TR>
                      <TD><IMG height=2
                        src="img/PortalFeaturesDivider.gif"
                        width=154></TD></TR>
                    <TR align=left>
                      <TD><A class=FeaturesMenuText
                        href="ct.php">Топик</A></TD></TR>
                    <TR>
                      <TD><IMG height=2
                        src="img/PortalFeaturesDivider.gif"
                        width=154></TD></TR>
                    <TR align=left>
                      <TD><A class=FeaturesMenuText
                        href="cu.php">Пользователи</A></TD></TR>
                    <TR>
                      <TD><IMG height=2
                        src="img/PortalFeaturesDivider.gif"
                        width=154></TD></TR>
                    <TR align=left>
                      <TD><A class=FeaturesMenuText
                        href="cs.php">Смайлы</A></TD></TR>
                    <TR>
                      <TD><IMG height=2
                        src="img/PortalFeaturesDivider.gif"
                        width=154></TD></TR>
                    <TR align=left>
                      <TD><A class=FeaturesMenuText
                        href="co.php">Профайл</A></TD></TR>
                    <TR>
                      <TD><IMG height=2
                        src="img/PortalFeaturesDivider.gif"
                        width=154></TD></TR>
                    <TR align=left>
                      <TD><A class=FeaturesMenuText
                        href="cm.php">Архив</A></TD></TR>
                    <TR>
                      <TD><IMG height=2
                        src="img/PortalFeaturesDivider.gif"
                        width=154></TD></TR></TBODY></TABLE></TD></TR>
              <TR>
                <TD class=FeaturesMenuBase align=middle><BR><BR>
                  <DIV class=SiteText><font color=#ffffff>Control Panel V1.0</font></DIV><BR><BR>
                  </TD></TR></TBODY></TABLE></TD>
          <TD style="PADDING-TOP: 11px" vAlign=top>
            <TABLE height="100%" cellSpacing=0 cellPadding=0 width="100%"
            border=0>
              <TBODY>
         <TR>
          <TD vAlign=top width=1 bgColor=#e3e3e3><IMG
            height=1 src="img/spacer.gif"
          width=1></TD>
          <TD style="TEXT-ALIGN: left" vAlign=top width=542><IMG  width=100%
            src="img/SubHeaderGrayBg.jpg"><BR>
            <P class=Header1DarkGray>УПРАВЛЕНИЕ</P>
            <P class=SiteText>
<TABLE width=500>
<form action="cl.php" method="post" enctype="multipart/form-data">
<input name="s" type="hidden" value="1">
 <TBODY>
   <TR class=table_header><TD>Название:</td><td width=80%><input name="ChtName" type="text" value="<?=$ChtName?>" size=60></td></tr>
   <TR class=table_header><TD>Версия:</td><td width=80%><input name="ChtAbout" type="text" value="<?=$ChtAbout?>" size=60></td></tr>
   <TR class=table_header><TD>Регистрация:</td><td width=80%><select size="1" name="ChtRegW" style="width:33%;"><?=$ChtRegW?></select></td></tr>
   <TR class=table_header><TD>Регистрация:</td><td width=80%><select size="1" name="ChtRegCls" style="width:33%;"><?=$ChtRegCls?></select></td></tr>
   <TR class=table_header><TD>Чат:</td><td width=80%><select size="1" name="ChtCls" style="width:33%;"><?=$ChtCls?></select></td></tr>
   <TR class=table_header><TD>Причина закрытия:</td><td width=80%><input name="ChtClsWhy" type="text" value="<?=$ChtClsWhy?>" size=60></td></tr>
   <TR class=table_header><TD>Главный:</td><td width=80%><input name="ChtMainAdmin" type="text" value="<?=$ChtMainAdmin?>" size=60></td></tr>
   <TR class=table_header><TD>Корректировка времени:</td><td width=80%><input name="AddToTime" type="text" value="<?=$AddToTime?>" size=60></td></tr>
   <TR class=table_header><TD>Обозначение смайлов:</td><td width=80%><input name="SmlTranscript" type="text" value="<?=$SmlTranscript?>" size=60></td></tr>
   <TR class=table_header><TD>Мат:</td><td width=80%><input name="MatReplace" type="text" value="<?=$MatReplace?>" size=60></td></tr>
   <TR class=table_header><TD>Макс. онлайн:</td><td width=80%><input name="MaxOnline" type="text" value="<?=$MaxOnline?>" size=60></td></tr>
   <TR class=table_header><TD>Рефреш:</td><td width=80%><input name="RefrTime" type="text" value="<?=$RefrTime?>" size=60></td></tr>
   <TR class=table_header><TD>Таймаут:</td><td width=80%><input name="ChtTimeout" type="text" value="<?=$ChtTimeout?>" size=60></td></tr>
   <TR class=table_header><TD>Макс. сообщений:</td><td width=80%><input name="CountMsg" type="text" value="<?=$CountMsg?>" size=60></td></tr>
   <TR class=table_header><TD>Макс. длинна сообщения:</td><td width=80%><input name="MaxLenMsg" type="text" value="<?=$MaxLenMsg?>" size=60></td></tr>
   <TR class=table_header><TD>Макс. длинна ника:</td><td width=80%><input name="MaxLenNick" type="text" value="<?=$MaxLenNick?>" size=60></td></tr>
   <TR class=table_header><TD>Мин. длинна нника:</td><td width=80%><input name="MinLenNick" type="text" value="<?=$MinLenNick?>" size=60></td></tr>
   <TR class=table_header><TD>Лог сообщений:</td><td width=80%><select size="1" name="Log" style="width:33%;"><?=$Log?></select></td></tr>
</TBODY></TABLE><DIV align=center><INPUT class=sb type=submit value=Сохранить></DIV>
</form>
<?
if($Action=='1') {
?>
<table align='center' style='color:#000; border:1px solid #B3C4FA; background:#D3DDFD; width:90%'><tr><td width='10' style='padding:10px'><img src="img/arMsg.gif" /></td><td style='padding:10px'><p class=SiteMsg>Сохранено!</p></td></tr></table>
<?
}
?>
            <DIV class=SiteText></DIV></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></DIV><BR>
      <DIV
      style="BACKGROUND-POSITION: center 50%; FONT-SIZE: 10px; BACKGROUND-IMAGE: url(img/Footer.gif); WIDTH: 750px; COLOR: #ffffff; PADDING-TOP: 25px; BACKGROUND-REPEAT: no-repeat; FONT-FAMILY: Geneva, Arial, Helvetica, sans-serif; HEIGHT: 53px"
      align=center>
      <DIV style="PADDING-TOP: 5px">Copyright © 2008 Myst. All rights reserved.</DIV></DIV></TD>
    <TD class=RSideFrameBgDetail><IMG height=11 alt=Spacer
      src="img/spacer.gif" width=10></TD>
    <TD class=RSideFrameBgShadow><IMG height=11 alt=Spacer
      src="img/spacer.gif" width=11></TD>
    <TD
class=RSideFrameBg>&nbsp;</TD></TR></TBODY></TABLE></BODY></HTML>
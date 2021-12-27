<?
$Title="Архив";
$Log=$_POST['log'];
include "../functions.php";
$Usr=$_SESSION['nick'];
$UsrReg=AdminRegData($Usr);
$Date=date("d-m-Y",time());

if(($UsrReg['stat']!="admin") or ($UsrReg == 0) or ($Usr==null)) {
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
            <P class=Header1DarkGray>АРХИВ</P>
            <P class=SiteText>
<TABLE width=500  cellPadding=3 cellSpacing=0>
 <TBODY>
  <TR class=table_header><TD>

<form action="cm.php" method="post">
<table width=260 align=center><TBODY><tr class=table_header>
<td>Дата:</td>
<td><input name="log" type="text" value="<?=$Date?>"></td>
<td><input type="submit" class=sb value="Открыть" title="Открыть" style="width:80"></td></tr>
</TBODY>
</table>
</form>
<?
if($_POST['log']) {
	$Log=$_POST['log'];
	$LogFName="../data/logs/".$Log.".php";
	$LogFile=file($LogFName);
}
?>
<TABLE  width=496 cellPadding=3 cellSpacing=0 style="TABLE-LAYOUT: fixed">
<TBODY>
<BR>
<tr class=table_oheader height=20 nowrap>
  <td style="font-weight: bold;" width=43 align=center>Time</td>
  <td style="font-weight: bold;" width=35>Status</td>
  <td style="font-weight: bold;" width=140>Username</td>
  <td style="font-weight: bold;" width=248>Msg</td>
</tr>
<?
for($i=0;$i<count($LogFile);$i++) {
	$Mas=split("::",trim($LogFile[$i]));
?>
<tr class=table_header height=20 nowrap>
  <td width=43><?=$Mas[0]?></td>
  <td width=35 align=center><?=$Mas[1]?></td>
  <td><?=$Mas[2]?></td>
  <td><?=$Mas[4]?></td>
</tr>
<?
}
?>
</TBODY></table><BR>
</TD></TR>
</TBODY></TABLE>
        </P><DIV class=SiteText></DIV>
	</TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></DIV><BR>
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
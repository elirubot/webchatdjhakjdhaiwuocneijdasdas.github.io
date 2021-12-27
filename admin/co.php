<?
$Title="Профайл";
$FindNick=$_POST['FindNick'];
$PostNick=$_POST['Nick'];
include "../functions.php";
$Usr=$_SESSION['nick'];
$UsrReg=AdminRegData($Usr);

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
if($PostNick) {
	$OldPass=$_POST['OldPass'];
	$UsrName=$_POST['UsrName'];
	$Sex=$_POST['Sex'];
	$BDate=$_POST['BDate'];
	$Pass=$_POST['Pass'];
	$Stat=$_POST['Stat'];
	$Mail=$_POST['Mail'];
	$ICQ=$_POST['ICQ'];
	$Was=$_POST['Was'];
	$Nick=$_POST['Nick'];

	if ($Pass==null) {
		$Pass=$OldPass;
	} else {
		$Pass=md5($Pass);
        }
	$UsrInfFName="../data/users/".strtolower($PostNick).".php";
	$FileOpen = fopen($UsrInfFName, "w+" );
	fputs ($FileOpen, "<?die?>\n");
	fputs ($FileOpen, "#|name|$UsrName|\n");
	fputs ($FileOpen, "#|sex|$Sex|\n");
	fputs ($FileOpen, "#|dbdate|$BDate|\n");
	fputs ($FileOpen, "#|nick|$Nick|\n");
	fputs ($FileOpen, "#|pass|$Pass|\n");
	fputs ($FileOpen, "#|stat|$Stat|\n");
	fputs ($FileOpen, "#|mail|$Mail|\n");
	fputs ($FileOpen, "#|icq|$ICQ|\n");
	fputs ($FileOpen, "#|was|$Was|\n");
	@fflush($FileOpen);
	fclose($FileOpen);
}
$FindNick=ReplNickSimFunc($FindNick);
if ($FindNick!="") {
	$FindNickReg=AdminRegData($FindNick);
}
if($FindNickReg) {
	$Nick=$FindNick;
	$Pass=$FindNickReg['pass'];
	$Stat=$FindNickReg['stat'];
	$Mail=$FindNickReg['mail'];
	$Sex=$FindNickReg['sex'];
	$ICQ=$FindNickReg['icq'];
	$UsrName=$FindNickReg['name'];
	$BDate=$FindNickReg['dbdate'];
	$Was=$FindNickReg['was'];
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
            <P class=Header1DarkGray>ПОЛЬЗОВАТЕЛИ</P>
            <P class=SiteText>
<TABLE width=500  cellPadding=3 cellSpacing=0>
 <TBODY>
  <TR class=table_header><TD>

<form action="co.php" method="post">
<table align=center><TBODY><tr class=table_header>
<td>Пользователь:</td>
<td><input name="FindNick" type="text" value=""></td>
<td><input type="submit" class=sb value="Найти" title="Найти" style="width:80"></td></tr>
</table>
</form>
<TABLE>
<TBODY>
<BR>
<form action="co.php" method="post">
<input name=OldPass type="hidden" value=<?=$Pass?>>
<TR class=table_header><TD>Ник:</td><td width=80%><input name="Nick" type="text" size="60" value=<?=$Nick?>></td></tr>
<TR class=table_header><TD>Пароль [при смене]:</td><td width=80%><input name="Pass" type="text" size="60" value=""></td></tr>
<TR class=table_header><TD>Статус:</td><td width=80%><select size="1" name="Stat" style="width:33%;"><option value="<?=$Stat?>" selected><?=$Stat?></option>
  <option value="user">Пользователь</option>
  <option value="moder">Модератор</option>
  <option value="admin">Администратор</option>
</select></td></tr>
<TR class=table_header><TD>Email:</td><td width=80%><input name="Mail" type="text" size="60" value=<?=$Mail?>></td></tr>
<TR class=table_header><TD>Имя:</td><td width=80%><input name="UsrName" type="text" size="60" value=<?=$UsrName?>></td></tr>
<TR class=table_header><TD>Возраст:</td><td width=80%><input name="BDate" type="text" size="60" value=<?=$BDate?>></td></tr>
<TR class=table_header><TD>Пол:</td><td width=80%><select size="1" name="Sex" style="width:33%;"><option value="<?=$Sex?>" selected><?=$Sex?></option>
  <option value="М">М</option>
  <option value="Ж">Ж</option>
</select></td></tr>
<TR class=table_header><TD>ICQ:</td><td width=80%><input name="ICQ" type="text" size="60" value=<?=$ICQ?>></td></tr>
<TR class=table_header><TD>Был в чате:</td><td width=80%><input name="Was" type="text" size="60" value=<?=$Was?>></td></tr>
</TBODY></table><BR><DIV align=center><INPUT class=sb type=submit style="width:23%;" value=Сохранить></DIV>
</form></TD></TR>
	    </TBODY></TABLE>
<?
if($PostNick) {
?>
<table align='center' style='color:#000; border:1px solid #B3C4FA; background:#D3DDFD; width:90%'><tr><td width='10' style='padding:10px'><img src="img/arMsg.gif" /></td><td style='padding:10px'><p class=SiteMsg>Сохранено!</p></td></tr></table>
<?
}
?>
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
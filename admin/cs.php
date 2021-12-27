<?
$Title="Смайлы";
$Del=$_POST['del'];
include "../functions.php";
$Usr=$_SESSION['nick'];
$UsrReg=AdminRegData($Usr);
$ChtConfig=ChtAdminConfigFunc();

$SmlDir="../img/smiles";
$OpenSmlDir=opendir($SmlDir);

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
if (isset($Del)) {
	while(($File=readdir($OpenSmlDir))!==false) {
		if($File!="." && $File!="..") {
			$md5File=md5($File);
			if($md5File==$Del) {
				$FindFile=$File;
			}
		}
	}
	if($FindFile) {
		unlink("$SmlDir/$FindFile");
	}
}


if($_FILES['file']) {
	$SmlTranscript=$ChtConfig['chat_smile_see'];
	if($_FILES['file']['size'] > 250000) {
		$Msg="Не привышайте предел в 250 кб!";
	} else if($_FILES['file']['type']!="image/gif") {
		$Msg="Это не рисунок(*.gif)!";
	} else if(!ereg(".gif$", $_FILES['file']['name'])) {
		$Msg="Это не рисунок(*.gif)!";
	} else if(strlen($_FILES['file']['name']) > 30) {
		$Msg="Имя файла рисунка больше 30ти символов!";
	} else {
		if(copy($_FILES['file']['tmp_name'],"../img/smiles/".$_FILES['file']['name'])) {
			$Smile=ereg_replace(".gif$","",$_FILES['file']['name']);
			$Msg="Смайлик добавлен!<br>Замена: $SmlTranscript$Smile";
		} else {
			$Msg="Ошибка при добовлении!";
		}
	}
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
            <P class=Header1DarkGray>СМАЙЛЫ</P>
            <P class=SiteText>
<TABLE width=430 cellPadding=3 align=center cellSpacing=0>
 <TBODY>
<tr class=table_oheader height=20 nowrap>
  <td style="font-weight: bold;" align=center width=60>Transcript</td>
  <td style="font-weight: bold;" align=center>Smile</td>
  <td style="font-weight: bold;" width=18>Del</td>
</tr>
<?
$OpenSmlDir=opendir($SmlDir);
while(($File=readdir($OpenSmlDir))!==false) {
	if($File!="." && $File!="..") {
		$Smile=ereg_replace(".gif$","",$File);
		$md5File=md5($File);
?>
<tr class=table_header style="height: 35;">
<td align=center>
<?=$ChtConfig['chat_smile_see']?><?=$Smile?>
</td>
<td align=center>
<img src="<?=$SmlDir?>/<?=$Smile?>.gif">
</td>
<form name=del action=cs.php method=post><td><input type='hidden' name=del value=<?=$md5File?>><input type="image" align=center src="img/del.gif"  alt="Удалить"></td></form>
</tr>
<?
	}
}
?>
</TBODY></TABLE></P><br>
<form action="cs.php" method="post" enctype="multipart/form-data">
<table align=center><TBODY><tr class=table_header>
<td>Смайлик(*.gif):</td>
<td><input name="file" type="file"></td>
<td><input type="submit" class=sb value="Добавить" title="Добавить"></td></tr>
</table>
</form>
<?
if($_FILES['file']) {
?>
<table align='center' style='color:#000; border:1px solid #B3C4FA; background:#D3DDFD; width:90%'><tr><td width='10' style='padding:10px'><img src="img/arMsg.gif" /></td><td style='padding:10px'><p class=SiteMsg><?=$Msg?></p></td></tr></table>
<?
}
?>
            <DIV class=SiteText>
            <P>&nbsp;</P></DIV></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></DIV><BR>
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
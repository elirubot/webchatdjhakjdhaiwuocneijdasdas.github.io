<?
$Title="�������";
$Action=$_POST['s'];
include "../functions.php";
$Usr=$_SESSION['nick'];
$UsrReg=AdminRegData($Usr);
$ChtConfig=ChtAdminConfigFunc();

$MatFName="../data/badwords.php";

if(($UsrReg['stat']!="admin") or ($UsrReg == 0) or ($Usr==null)) {
?>
<html>
<head>
<link rel="stylesheet" href="css/cp.css" type="text/css">
</head><br><font face=Arial style="font-size : 13px"><div align="center"><b>Access denied.
</b></div><br><br><center>������� ������������� � ������ ����������.</center></font>
</html>
<?
        exit;
}
if($Action=='1') {
	$_POST['mat']=ReplSimFunc($_POST['mat']);
	$_POST['mat']=str_replace(" ","\n",$_POST['mat']);
	$FileOpen = fopen ($MatFName, "w+");
	fwrite ($FileOpen, $_POST['mat']);
	fclose ($FileOpen);
}

$MatFile=file($MatFName);
$MatLine="";
for($i=0;$i<count($MatFile);$i++) {
	$MatLine.=trim($MatFile[$i]).chr(10);
}
?>
<HTML><HEAD><TITLE>�����������������::<?=$Title?></TITLE>
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
                        href="cp.php">����������</A></TD></TR>
                    <TR>
                      <TD><IMG height=2
                        src="img/PortalFeaturesDivider.gif"
                        width=154></TD></TR>
                    <TR align=left>
                      <TD><A class=FeaturesMenuText
                        href="cl.php">����������</A></TD></TR>
                    <TR>
                      <TD><IMG height=2
                        src="img/PortalFeaturesDivider.gif"
                        width=154></TD></TR>
                    <TR align=left>
                      <TD><A class=FeaturesMenuText
                        href="cw.php">�������</A></TD></TR>
                    <TR>
                      <TD><IMG height=2
                        src="img/PortalFeaturesDivider.gif"
                        width=154></TD></TR>
                    <TR align=left>
                      <TD><A class=FeaturesMenuText
                        href="ct.php">�����</A></TD></TR>
                    <TR>
                      <TD><IMG height=2
                        src="img/PortalFeaturesDivider.gif"
                        width=154></TD></TR>
                    <TR align=left>
                      <TD><A class=FeaturesMenuText
                        href="cu.php">������������</A></TD></TR>
                    <TR>
                      <TD><IMG height=2
                        src="img/PortalFeaturesDivider.gif"
                        width=154></TD></TR>
                    <TR align=left>
                      <TD><A class=FeaturesMenuText
                        href="cs.php">������</A></TD></TR>
                    <TR>
                      <TD><IMG height=2
                        src="img/PortalFeaturesDivider.gif"
                        width=154></TD></TR>
                    <TR align=left>
                      <TD><A class=FeaturesMenuText
                        href="co.php">�������</A></TD></TR>
                    <TR>
                      <TD><IMG height=2
                        src="img/PortalFeaturesDivider.gif"
                        width=154></TD></TR>
                    <TR align=left>
                      <TD><A class=FeaturesMenuText
                        href="cm.php">�����</A></TD></TR>
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
            <P class=Header1DarkGray>�������</P>
            <P class=SiteText>
<TABLE width=500>
 <TBODY>
<TR class=table_header><TD></TD><TD>�������� ��: <?=$ChtConfig['chat_mat_see']?></TD></TR>
<form action="cw.php" method="post">
<input name="s" type="hidden" value="1">
 <TR class=table_header>
  <TD width=10%>�����:</TD>
  <TD><textarea name="mat"  style="BORDER-RIGHT: #cecfce 1px solid; BORDER-TOP:
	#cecfce 1px solid; BORDER-LEFT: #cecfce 1px solid; BORDER-BOTTOM:
	#cecfce 1px solid; WIDTH: 90%; SCROLLBAR-3DLIGHT-COLOR: #ddd;SCROLLBAR-DARKSHADOW-COLOR: #ddd;
	SCROLLBAR-TRACK-COLOR: #fff; SCROLLBAR-HIGHLIGHT-COLOR: #fff; SCROLLBAR-SHADOW-COLOR: #fff;
 	SCROLLBAR-ARROW-COLOR: #ddd; SCROLLBAR-FACE-COLOR: #fff;" rows=8><?=$MatLine?></textarea></TD></TR>
 <TR>
  <TD colspan=2 align=center><BR><INPUT  class=sb style="width:40%" type=submit value=���������></TD></TR>
</form></TBODY></TABLE></P>
<?
if($Action=='1') {
?>
<table align='center' style='color:#000; border:1px solid #B3C4FA; background:#D3DDFD; width:90%'><tr><td width='10' style='padding:10px'><img src="img/arMsg.gif" /></td><td style='padding:10px'><p class=SiteMsg>���������!</p></td></tr></table>
<?
}
?>
      </TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></DIV><BR>
      <DIV
      style="BACKGROUND-POSITION: center 50%; FONT-SIZE: 10px; BACKGROUND-IMAGE: url(img/Footer.gif); WIDTH: 750px; COLOR: #ffffff; PADDING-TOP: 25px; BACKGROUND-REPEAT: no-repeat; FONT-FAMILY: Geneva, Arial, Helvetica, sans-serif; HEIGHT: 53px"
      align=center>
      <DIV style="PADDING-TOP: 5px">Copyright � 2008 Myst. All rights reserved.</DIV></DIV></TD>
    <TD class=RSideFrameBgDetail><IMG height=11 alt=Spacer
      src="img/spacer.gif" width=10></TD>
    <TD class=RSideFrameBgShadow><IMG height=11 alt=Spacer
      src="img/spacer.gif" width=11></TD>
    <TD
class=RSideFrameBg>&nbsp;</TD></TR></TBODY></TABLE></BODY></HTML>
<?
$Title="Информация";
include "../functions.php";
$Usr=$_SESSION['nick'];
$UsrReg=AdminRegData($Usr);
$ChtConfig=ChtAdminConfigFunc();

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
$ChtName=$ChtConfig['title'];
$ChtAbout=$ChtConfig['opis'];
$ChtRegW=($ChtConfig['reg']==1) ? "Обязательна" : "Необязательна";
$ChtRegCls=($ChtConfig['reg_close']==1) ? "Закрыта" : "Открыта";
$ChtCls=($ChtConfig['close']==1) ? "Закрыт" : "Открыт";
$ChtMainAdmin=$ChtConfig['admin'];

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
            <P class=Header1DarkGray>ИНФОРМАЦИЯ</P>
            <P class=SiteText>
<TABLE width=500>
 <TBODY>
   <TR><TD width=250>
	<TABLE cellSpacing=0 cellPadding=3 width=245>
	 <TBODY>
	  <TR class=table_header height=20 nowrap>
	    <TD width=80><b>НАЗВАНИЕ:</b></TD>
	    <TD width=165><?=$ChtName?></TD></TR>
	  <TR class=table_oheader height=20 nowrap>
	    <TD width=80><b>ОПИСАНИЕ:</b></TD>
	    <TD width=165><?=$ChtAbout?></TD></TR>
	  <TR class=table_header height=20 nowrap>
	    <TD width=80><b>РЕГИСТРАЦИЯ:</b></TD>
	    <TD width=165><?=$ChtRegW?></TD></TR>
	  <TR class=table_oheader height=20 nowrap>
	    <TD width=80><b>РЕГИСТРАЦИЯ:</b></TD>
	    <TD width=165><?=$ChtRegCls?></TD></TR>
	  <TR class=table_header height=20 nowrap>
	    <TD width=80><b>ЧАТ:</b></TD>
	    <TD width=165><?=$ChtCls?></TD></TR>
	 </TBODY></TABLE></TD>
       <TD width=250 vAlign=top>
	<TABLE cellSpacing=0 cellPadding=3 width=245>
	 <TBODY>
	  <TR class=table_header height=20 nowrap>
	    <TD width=80><b>ГЛАВНЫЙ:</b></TD>
	    <TD width=165><?=$ChtMainAdmin?></TD></TR>
	  <TR class=table_oheader height=20 nowrap>
	    <TD width=80><b>ВАШ ЛОГИН:</b></TD>
	    <TD width=165><?=$Usr?></TD></TR>
	 </TBODY></TABLE></TD></TR></TBODY></TABLE><BR><BR><BR><BR><BR>
	    <STRONG><IMG height=7
            src="img/PortalProductDivider.gif"
            width=500><BR><BR>
		<IFRAME src="http://www.siberia.tut.su/achat/news.php" frameBorder=no
		width="100%" height="150"></IFRAME><BR><IMG height=7
            src="img/PortalProductDivider.gif"
            width=500><BR></STRONG></P>
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
<?php
	//������� ������� �� ����

$_POST['nick']=trim($_POST['nick']); $_POST['nick']=ereg_replace(";","",$_POST['nick']);
$_POST['nick']=ereg_replace("#","",$_POST['nick']); $_POST['nick']=ereg_replace(" ","",$_POST['nick']);
$_POST['nick']=str_replace("\r\n","",$_POST['nick']); $_POST['nick']=str_replace("\n","",$_POST['nick']);
$_POST['nick']=str_replace("\t","",$_POST['nick']); $_POST['nick']=eregi_replace(":","",$_POST['nick']);
$_POST['nick']=eregi_replace("<","",$_POST['nick']); $_POST['nick']=eregi_replace(">","",$_POST['nick']);
$_POST['nick']=eregi_replace("\"","",$_POST['nick']); $_POST['nick']=eregi_replace("\[","",$_POST['nick']);
$_POST['nick']=eregi_replace("\]","",$_POST['nick']); $_POST['nick']=eregi_replace("\(","",$_POST['nick']);
$_POST['nick']=eregi_replace("\)","",$_POST['nick']); $_POST['nick']=eregi_replace("\{","",$_POST['nick']);
$_POST['nick']=eregi_replace("\}","",$_POST['nick']); $_POST['nick']=eregi_replace("&","",$_POST['nick']);


	//�������� �� ����������� ��� ������������ session ID

error_reporting(0);					//�� �������� ������ ������ �������������
$UsrInfFName="data/users/".strtolower($nick).".php";
$UsrInfFile = file($UsrInfFName);
if (!$UsrInfFile) {
	$SesID=md5($_POST['nick']);			//������������ ID �� md5 ����, ���� ��� �����������
} else {
	$SesID=md5($_POST['nick'].$_POST['pass']);	//������������ ID �� ���� � ������, ���� ���� �����������
}

session_id($SesID);					//��������������� ������������ ID ������

include "functions.php";				//����������� ����� �������

$StartTime = GetMicroTime();				//�������� ����� ������ ��������� ��������

$Error=0;

$Usr=$_POST['nick'];

$UsrReg=RegData($Usr);					//�������� ��������������� ������
$IPBanRtrn=IPBanFunc();						//�������� �� ��� ip
$NickBanRtrn=NickBanFunc();					//�������� �� ��� nick
$ChtConfig=ChtConfigFunc();						//�������� ������ ����

	//�������� ���� � ����

if($ChtConfig['close']==1 && $UsrReg['stat']!='admin') {
	$Error="��� ������! �� �������:<br>".$ChtConfig['close_reason'];
}
if(count(file("data/onlinelist.php"))>=$ChtConfig['chat_max_people'] and $ChtConfig['chat_max_people']!='0' and $UsrReg['stat']!='admin') {
	$Error="��� ����������!<BR>��������: � ���� ����� ���������� ������ ".$ChtConfig['chat_max_people']." �������.";
}
if(empty($_POST['nick'])) {
	$Error="�� �� ������� ���!";
}
if(preg_match('!^[a-z0-9_]+$!i',$_POST['nick'])==0) {
	$Error="������ ����� ����!<BR>��������: ��� ����� �������� � ���� ������ ��������� ����� � ������  _!";
}
if((strlen($_POST['nick'])<($ChtConfig['nick_size_min'])) or (strlen($_POST['nick'])>($ChtConfig['nick_size_max']))) {
	$Error="������ ����� ����!<BR>��������: ��� �� ����� ��������� �����  ".$ChtConfig['nick_size_min']." ��� ����� ".$ChtConfig['nick_size_max']." ����/��������.";
}
if($UsrReg and $UsrReg['pass']!=md5($_POST['pass'])) {
	$Error="������ �� ������!";
}
if($IPBanRtrn!=null) {
	if($UsrReg['stat']!='admin') {
		$Error=$IPBanRtrn;
	}
}
if($NickBanRtrn!=null) {
	if($UsrReg['stat']!='admin') {
		$Error=$NickBanRtrn;
	}
}
if($Error) {
	Header("Location: ./error.php?msg=$Error");
	exit;
}

	//�������� �� ����� ����
if ($ChtConfig['reg']==1) {
	if(!$UsrReg) {
		print "<script>top.location.href='./error.php?msg=��� �������� � ������� ������! �� �� ����������������!';</script>";
		break;
	}
}




	//����� ������ � ����������� � ��� ����������
session_start();
session_register('nick','pass','ip','mstat');
$_SESSION['nick']=$_POST['nick'];
$_SESSION['pass']=$_POST['pass'];
$_SESSION['ip']=$REMOTE_ADDR;
$_SESSION['mstat']=$UsrReg['stat'];

	//�������� ����������� ����� � ���, ���� $Func==0, �� ������ � ���, 
	//��������� ���� �� ��� � ������ ����� ���� ��� �� ������,
	//����� ���������� �� �������� ��� �������������� �������
$NickInOList=AwayList();
if(!$NickInOList) {

	$Func=EnterFunc($Usr);
	if ($Func==1) {
		break;
	}

} else {

	$Func=ReEnterFunc($Usr);
	if ($Func==1) {
		break;
	}
}

$_SESSION['ent']=$_POST['ent'];

	//�������� ��������� ����
$Title=$ChtConfig['title'];
$Refr=$ChtConfig['refresh'];

	//�������� �����
$ThmFName="data/thm.php";
$ThmFile=file($ThmFName);
$Thm=trim($ThmFile[0]);

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
<META http-equiv=Content-Type content="text/html; charset=windows-1251">
<title><?=$Title?> :: <?=$Usr?></title>

<script>
	//������ ��� ����
var Usr="<?=$Usr?>";
var thm="<?=$Thm?>";
var ThmMas=thm.split("|");
var timeit=<?=$Refr?>*1000;
</script>

<script src="script.js" language="JavaScript"><?=$_POST['r']?></script>

<frameset rows="90,*,30,0,0,0"  frameborder=no framespacing=0>
<frameset cols="*,510" frameborder=no framespacing=0>
<frame src=top.php scrolling=no marginwidth=0 marginheight=0>
<frame src=topmenu.php scrolling=no marginwidth=0 marginheight=0 noresize>
</frameset>
<frameset cols="*,250" frameborder=no framespacing=0>
<frame src="text.php" name=textfr marginwidth=0 marginheight=0 borderheight=100% scrolling=auto style="border-right: solid #000 1px;">
<frame src="users.php" name=usersfr marginwidth=0  marginheight=0>
</frameset>
<frame src="submit.php" scrolling=no name=submfr marginwidth=0 marginheight=0 noresize>
<frame src="msg.php" scrolling=no name=hidefr marginwidth=0 marginheight=0 noresize>
<frame scrolling=no name=rfr marginwidth=0 marginheight=0 noresize>
<frame scrolling="no" name=reload src="javascript:top.Refresh();" noresize  marginheight=0 marginwidth=0>
</frameset>
</HTML>
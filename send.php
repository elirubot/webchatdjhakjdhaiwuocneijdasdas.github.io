<?php
include "functions.php";				//����������� ����� �������
$NickInOList=AwayList();
$Usr=$_SESSION['nick'];					//����������� $Usr
$ChtConfig=ChtConfigFunc();						//�������� ��������� ����
$LogMsgName=date("d-m-Y",time());				//�������� ��� ����� �� ����
	//�������� ���� �� ��� � ����
if(!$NickInOList) {
	print "<script>top.location.href='./error.php?msg=��� ��� �� ���������. �� �������� ��� �� �����.';</script>";
	exit;
}
	//�������� ���� �� ������
if(!$Usr) {
	print "<script>top.location.href='./error.php?msg=���� ������ �� ����������. �� �������� ��� �� �����.';</script>";
	exit;
}
	//������ �� ������� ���������
if(strlen($_POST['msg'])>$ChtConfig['chat_max_msg']) {
	print "<script>top.ClearForm();top.FocusForm();</script>";
	exit;
}

$MaxChtMsg=$ChtConfig['chat_max']-1;				//������������ ����� ���������
$ChtMsgFName="data/chatmsg.php";
$LogMsgFName="data/logs/".$LogMsgName.".php";
$ChtMsgFile=file($ChtMsgFName);
$LogMsgFile=file($LogMsgFName);
$ChtMsgData="";
$LogMsgData="";

$MsgStatus="A";						//������ �������� ���������

	//� ��� ���� ����� ��� ���������
for($i=0;$i<count($LogMsgFile);$i++) {
	if(trim($LogMsgFile[$i])) {
		$LogMsgData.=trim($LogMsgFile[$i])."\n";
	}
}

	//� ������ ������� ��� ������ ��������� ����� ���� ���������
$AddMaxMsg=0;
for($i=0;$i<count($ChtMsgFile);$i++) {
	$Mas=split("::",$ChtMsgFile[$i]);
	$Mas=$Mas[1];
	if(($Mas=="P") or ($Mas=="T")){
		$AddMaxMsg++;
	}
}

if(count($ChtMsgFile)<$MaxChtMsg) {
	$AllMaxMsg=count($ChtMsgFile);
} else {
	$AllMaxMsg=$MaxChtMsg+$AddMaxMsg;
}

	//� ��� ���� ����� ����������� ����� ���������
for($i=0;$i<$AllMaxMsg;$i++) {
	if(trim($ChtMsgFile[$i])) {
		$ChtMsgData.=trim($ChtMsgFile[$i])."\n";
	}
}
	//������� ���������� ���������
if(!empty($_POST['priv'])) {
	$MsgStatus="P";
}

$Msg=ReplSimFunc($_POST['msg']);				//��������(�������) ����
$Msg=ReplMatFunc($Msg);					//�������� ���
$Msg=ReplSmileFunc($Msg);					//�������� �� ������

	//�������� ����������� ���������
$NickGradStrt=convGradColor($_COOKIE[$Usr."NickGradStrt"]);
$NickGradEnd=convGradColor($_COOKIE[$Usr."NickGradEnd"]);
$MsgColor=convGradColor($_COOKIE[$Usr."MsgColor"]);
$MsgFace=convFont($_COOKIE[$Usr."MsgFace"]);
$MsgFontWeight=convFontWeight($_COOKIE[$Usr."MsgFontWeight"]);
$MsgFontStyle=convFontStyle($_COOKIE[$Usr."MsgFontStyle"]);

$FontData=$NickGradStrt."|".$NickGradEnd."|".$MsgColor."|".$MsgFace."|".$MsgFontWeight."|".$MsgFontStyle;

	//������ � ��� � ���
$ChtMsgData=date("H:i:s",time()+$ChtConfig['chat_time'])."::".$MsgStatus."::$Usr::".$FontData."::$Msg\n".$ChtMsgData;
$LogMsgData=date("H:i:s",time()+$ChtConfig['chat_time'])."::".$MsgStatus."::$Usr::".$FontData."::$Msg\n".$LogMsgData;
$FileOpen=fopen("$ChtMsgFName", "w+");
	//���������� ��� ������ � ���
if(fwrite($FileOpen, $ChtMsgData)) {
	echo "<script>top.ClearForm();top.FocusForm();top.hidefr.location.href='msg.php';</script>";
} else {
	echo "<script>top.location.href='./error.php?msg=������ ��� �������� ���������!';</script>";
}
fclose($FileOpen);
	//�������� ������� �� ���
if($ChtConfig['log_msg']=="1") {
	$FileOpen=fopen("$LogMsgFName", "w+");
	fwrite($FileOpen, $LogMsgData);
	fclose($FileOpen);
}
?>
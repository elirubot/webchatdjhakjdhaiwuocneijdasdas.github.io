<?php
error_reporting(0);					//�� �������� ������ ������ �������������
include "functions.php";				//����������� ����� �������

$Usr=$_SESSION['nick'];					//������ $Usr
if (!$Usr) {
	print "<script>top.location.href='./error.php?msg=���� ������ ������������. �� �������� ��� �� �����.';</script>";
	exit;
}
$UsrReg=RegData($Usr);					//�������� ��������������� ������


$OldPass=ReplNickSimFunc($_POST['pass_hide']);
$Pass=ReplNickSimFunc($_POST['pass']);
	//���� ������ �� ������ �� �������� ������
if ($Pass==null) {
	$Pass=$OldPass;
} else {
	$Pass=md5($Pass);
}
$Name=ReplNickSimFunc($_POST['name']);
$Sex=ReplNickSimFunc($_POST['sex']);
$BDate=ReplNickSimFunc($_POST['dbdate']);
$Mail=ReplNickSimFunc($_POST['mail']);
$ICQ=ReplNickSimFunc($_POST['icq']);
	//������ ���
if(($Sex!='�') & ($Sex!='�') & ($Sex!='�')) {
	$Sex="�";
}
	//������ ���
if(strlen($Name)>12) {
	$Name="";
}
	//������ �������
if(!preg_match("/[0-9]{2}/i", $BDate)||($BDate>99)||($BDate<01)||(strlen($BDate)>2)) {
	$BDate="";
}
	//������ ����
if(!preg_match("/[0-9a-z_]+@[0-9a-z_^\.]+\.[a-z]{2,3}/i", $Mail)||(strlen($Mail)>25)) {
	$Mail="";
}
	//������ ICQ
if(!preg_match("/^[0-9]{4,10}$/", $ICQ)||($ICQ<1000)||($ICQ>9999999999)) {
	$ICQ="";
}

	//������ � ����
$UsrInfFile=file("data/users/".strtolower($Usr).".php");
if($UsrInfFile) {
	$UsrInfFName="data/users/".strtolower($Usr).".php";
	$FileOpen = fopen($UsrInfFName, "w+" );
	fputs ($FileOpen, "<?die?>\n");
	fputs ($FileOpen, "|name|$Name|\n");
	fputs ($FileOpen, "|sex|$Sex|\n");
	fputs ($FileOpen, "|dbdate|$BDate|\n");
	fputs ($FileOpen, "|nick|$Usr|\n");
	fputs ($FileOpen, "|pass|$Pass|\n");
	fputs ($FileOpen, "|stat|".$UsrReg['stat']."|\n");
	fputs ($FileOpen, "|mail|$Mail|\n");
	fputs ($FileOpen, "|icq|$ICQ|\n");
	fputs ($FileOpen, "|was|".$UsrReg['was']."|\n");
	@fflush($FileOpen);
	fclose($FileOpen);

	$html=Header("Location: ./error.php?msg=���������� ���������.");
	exit;
} else {
	$html=Header("Location: ./error.php?msg=������������ �����������. �� �������� ��� �� �����!.");
	exit;
}
?>
<html>
<?=$html?>
</html>
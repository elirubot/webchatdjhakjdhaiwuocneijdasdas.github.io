<?php
include "functions.php";			//����������� ����� �������
$Usr=NickFromSess();			//����������� $Usr
$UsrReg=RegData($Usr);			//�������� ���. ������
$ChtConfig=ChtConfigFunc();			//�������� ��������� ����
	//������������� �����������
if ($ChtConfig['reg']==1) {
	if(!$UsrReg) {
		print "<script>top.location.href='./error.php?msg=���������� �����������!';</script>";
		break;
	}
}
include ("skin/submit.tpl");
?>

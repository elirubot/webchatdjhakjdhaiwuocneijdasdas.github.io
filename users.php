<?
include "functions.php";				//����������� ����� �������
$Usr=NickFromSess();
$UsrReg=RegData($Usr);					//�������� ��������������� ������
include ("skin/users.tpl");
?>

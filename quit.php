<?php
include "functions.php";				//����������� ����� �������
$Usr=$_SESSION['nick'];					//����������� $Usr
	//�������� ���� �� ������
if(!$Usr) {
	Header("Location: ./error.php?msg=���� ������ ������������. �� �������� ��� �� �����.");
	exit;
}
	//������� ������
ExitFunc($Usr);
	//������� �� �������
Header("Location: ./");
	//������� ������
session_destroy();
?>
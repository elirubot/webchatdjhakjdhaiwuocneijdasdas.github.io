<?php
include "functions.php";				//����������� ����� �������
$Usr=NickFromSess();						//����������� $Usr
$UsrReg=RegData($Usr);					//�������� ���. ������
$ChtConfig=ChtConfigFunc();						//�������� ��������� ����

	//�������� �� ����� ����
if ($ChtConfig['reg']==1) {
	if(!$UsrReg) {
		print "<script>top.location.href='./error.php?msg=�� �� ����������������!';</script>";
		break;
	}
}

	//������ �������

$RtrnData="";
$UsrFind=0;
$OnlineUsrFName="data/onlinelist.php";
$OnlineUsrFile=file("$OnlineUsrFName");
for($i=0;$i<count($OnlineUsrFile);$i++) {
	$Mas=split("::",$OnlineUsrFile[$i]);
	if($Mas[1]!=$Usr) {
		$RtrnData.=trim($OnlineUsrFile[$i]).chr(10);
	} else if($Usr==$Mas[1]) {
		$UsrFind=1;
		$RtrnData.=$Mas[0]."::".$Mas[1]."::".time()."::".$Mas[3]."::".$Mas[4]."::".$Mas[5];
	}
}
if($UsrFind) {
	$FileOpen = fopen ($OnlineUsrFName, "w+");
	fwrite ($FileOpen, $RtrnData);
	fclose ($FileOpen);
}

?>
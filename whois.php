<?php
include "functions.php";				//����������� ����� �������

$Nick='';						//��������� ���������� ����
if (isset($_GET['nick'])) {
	$Nick = $_GET['nick'];
} else {
	if (isset($_POST['nick'])) {
		$Nick = $_POST['nick'];
	}
}

$NickReg=RegData($Nick);					//���. ������

$Nick=ReplPassSimFunc($Nick);					//������ �� ��������

$Title="$Nick :: ����������";

	//���������� ��� ����������� ��� �� ����������
if($NickReg) {
	$Name=(!empty($NickReg['name'])) ? $NickReg['name'] : "-";
	$Sex=convertSex($NickReg['sex']);
	$BDate=(!empty($NickReg['dbdate'])) ? $NickReg['dbdate'] : "-";
	$Stat=convertStatus($NickReg['stat']);
	$Mail=(!empty($NickReg['mail'])) ? "<a style='color: #555555; text-decoration: none; font-weight: lighter' href=\"mailto:".$NickReg['mail']."\">".$NickReg['mail']."</a>" : "-";
	$ICQ=(!empty($NickReg['icq'])) ? $NickReg['icq'] : "-";
	$Was=(!empty($NickReg['was'])) ? $NickReg['was'] : "00.00.0000 00:00:00";
} else {
	$Stat="�����������������";
}
?>
<!--
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
<title><?=$Title?></title>
<LINK href="img/css/chi.css" type=text/css rel=stylesheet>
</head>
<body>
<div class=top><a>&nbsp;���&nbsp;</a></div>
<table width=500 cellspacing=0 cellpadding=1>
<col width=220><col width=280>
<tr><td colspan=2 class=h>���������� / <?=$Nick?></td></tr>
<tr><td colspan=2><br><br><td></tr>
<tr class=bg0><td>��� - <td><?=$Name?></tr>
<tr class=bg1><td>������ - <td><?=$Stat?></tr>
<tr class=bg0><td>��� - <td><?=$Sex?></tr>
<tr class=bg1><td>������� - <td><?=$BDate?></tr>
<tr class=bg0><td>����� - <td><?=$Mail?></tr>
<tr class=bg1><td>ICQ - <td><?=$ICQ?></tr>
<tr class=bg0><td>���(�) � ���� - <td><?=$Was?></tr>
<tr><td><br><br><td></tr>
<tr><td colspan=2><hr></tr>
</table>
</body>
</html>

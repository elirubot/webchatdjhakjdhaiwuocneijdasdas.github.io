<?php
include "functions.php";				//����������� ����� �������

$ChtConfig=ChtConfigFunc();						//�������� ��������� ����
$Title="������";
?>
<html>
<head>
  <title><?=$Title?></title>
    <link rel="stylesheet" href="img/css/chi.css" type="text/css" />
</head>
<body>
<div class=top><a>&nbsp;���&nbsp;</a></div>
<table width=500 cellspacing=0 cellpadding=1>
<col width=220><col width=280>
<tr><td colspan=2 class=h>� � � � � �</td></tr>
<tr><td colspan=2><br><br><td></tr>
        <TBODY>
        <TR>
          <TD colSpan=3>
		<table align="center" width=500>
  		   <TBODY>
<?
	//����� �������
$SmlDir="./img/smiles";
$OpenSmlDir=opendir($SmlDir);
while(($File=readdir($OpenSmlDir))!==false) {
	if($File!="." && $File!=".." && ereg(".gif$",$File)) {
		$Smile=ereg_replace(".gif$","",$File);
?>
<tr class="tr">
<td align=middle height=40  width="50%">
<img src="<?=$SmlDir?>/<?=$Smile?>.gif" border="0">
</td>
<td align=middle height=40  width="50%">
<b><?=$ChtConfig['chat_smile_see']?><?=$Smile?></b>
</td>
</tr>
<?
	}
}
?>
	</tbody></table></DIV></TD></TR></TBODY></TABLE>
</body>
</html>
<?
$Action=$_POST['s'];
$Error=$_GET['e'];

include "functions.php";				//����������� ����� �������
error_reporting(0);					//�� �������� ������ ������ �������������
$ChtConfig=ChtConfigFunc();					//�������� ������ ����

if ($ChtConfig['reg_close']==1) {
	$Msg="����������� �������� �������!";
}
if($Msg) {
	Header("Location: ./error.php?msg=$Msg");
	exit;
}



if($Action!=1) {
	if($Error==null) {
		$Error="������������, ��
      		���� ������ ��� �� ����� �����!<BR>����������, ��������� ��� ���� �
      		��������� �� ����������.";
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
<LINK href="img/css/chi.css" type=text/css rel=stylesheet>
</head>






<body>
<form action="reg.php" method="post" enctype="multipart/form-data">
<input name="s" type="hidden" value="1">
<div class=top><a>&nbsp;���&nbsp;</a></div>
<table width=500 cellspacing=0 cellpadding=1>
<col width=220><col width=280>
<tr><td colspan=2 class=h>� � � � � � � � � � �</td></tr>
<tr><td colspan=2 align=center><br><?=$Error?><br><br><td></tr>
<tr class=bg0><td>���:<td><input  class=inp name=nick size=42 maxlength=50></tr>
<tr class=bg1><td>������:<td><input  class=inp name=pass size=42 maxlength=50 type="password"></tr>
<tr class=bg0><td>���:<td><input  class=inp name=kart size=42 maxlength=50></tr>
<tr class=bg1><td colspan=2><center><img src="img.php"></center></tr>
<tr><td><br><br><td></tr>
<tr><td colspan=2><hr></tr>

<tr class=btns>
<td><input type=button class=btn onClick="top.close();" value="������">
<td align=right>

<input type=submit name=subm class=btn value="��������">
</tr>


</table>
</form>
</body>
</html>
<?php
} else {
	$Nick=ReplNickSimFunc($_POST['nick']); 		//������� �������
	$Pass=ReplPassSimFunc($_POST['pass']);			//������� �������
	$kart=$_POST['kart'];			

	$Error=null;
	//������ ���  �����������

	if($Nick==null) {
		$Error.="�� �� ������� ���!<BR>��������: ��� ����� �������� ����� ���������� ������ � ���� �������� ������� �������� ��� �������� ������ ��������� �����������.";
		$html="<script>location.href='reg.php?e=$Error';</script>";
	} else {
		if(preg_match('!^[a-z0-9_]+$!i',$Nick)==0) {
			$Error.="������ ����� ����!<BR>��������: ��� ����� �������� � ���� ������ ��������� ����� � ������  _!";
			$html="<script>location.href='reg.php?e=$Error';</script>";
		} else {
			if((strlen($Nick)<($ChtConfig['nick_size_min'])) or (strlen($Nick)>($ChtConfig['nick_size_max']))) {
				$Error.="������ ����� ����!<BR>��������: ��� ������� ��������� �����  ".$ChtConfig['nick_size_min']." ��� ����� ".$ChtConfig['nick_size_max']." ����/��������.";
				$html="<script>location.href='reg.php?e=$Error';</script>";
			} else {
				if($Pass=="") {
					$Error.="�� �� ������� ������!<BR>��������: ������ �������� ���� �����������, ����������� �� ������ ������ ������� ������� � ���������.";
					$html="<script>location.href='reg.php?e=$Error';</script>";
				} else {
					if($kart!=$_SESSION['number']) {
						$Error.="����� �� ���������!<BR>��������: �������� ���������� ��� ������ �� �������������� �����������, ������� ������ �����.";
						$html="<script>location.href='reg.php?e=$Error';</script>";
					}
				}
			}
		}
	}


	if ($Error==null) {
		$UsrInfFName=file("data/users/".strtolower($Nick).".php");
		if(!$UsrInfFName) {
			$UsrInfFile="data/users/".strtolower($Nick).".php";
			$FileOpen = fopen($UsrInfFile, "w+" );
			fputs ($FileOpen, "<?die?>\n");
			fputs ($FileOpen, "|name||\n");
			fputs ($FileOpen, "|sex|�|\n");
			fputs ($FileOpen, "|dbdate||\n");
			fputs ($FileOpen, "|nick|$Nick|\n");
			fputs ($FileOpen, "|pass|".md5($Pass)."|\n");
			fputs ($FileOpen, "|stat|user|\n");
			fputs ($FileOpen, "|mail||\n");
			fputs ($FileOpen, "|icq||\n");
			fputs ($FileOpen, "|was||\n");
			@fflush($FileOpen);
			fclose($FileOpen);

			$Msg="������������ $Nick ���������������. <BR> ��� ����, ����� ����� � ��� ��� ���������� ��������� �� ������� �������� � ������ ��������������� ����� � ������.";
			if($Msg) {
				Header("Location: ./error.php?msg=$Msg");
				exit;
			}

		} else {
	//���� ����������� ����������
			$html="<script>location.href='reg.php?e=����� ��� ��� ���������������!<BR>��� ���������� ������� ������ ��� � ������ ��������� �����������.';</script>";
        	}
	}
print $html;
}
?>
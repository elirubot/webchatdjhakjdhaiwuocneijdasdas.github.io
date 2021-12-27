<?php
include "functions.php";				//Подключение файла функций
$NickInOList=AwayList();
$Usr=$_SESSION['nick'];					//определение $Usr
	//проверка есть ли ник в чате
if(!$NickInOList) {
	print "<script>top.location.href='./error.php?msg=Ваш ник не обнаружен. Вы покинули чат до этого.';</script>";
	exit;
}

	//Проверка на таймаут (вызывается при рефреше)
$Func=offLine();
if ($Func==1) {
	break;
}

$ChtMsgFName = "data/chatmsg.php";
$ChtMsgFile = file($ChtMsgFName);
$Mas=null;
print "$Usr<script language=\"JavaScript\">\n";
print "var a=new Array();\n";
$j=0;
for($i=(count($ChtMsgFile)-1);$i>-1;$i--){
	$Mas=split("::",trim($ChtMsgFile[$i]));
 	switch($Mas[1]) {
    		case "P":
     		$Msg=$Mas[4];
        	$PrivNickMas=split(",",$Msg);
        	$PrivNickMas=$PrivNickMas[0];
        	$Msg=substr($Msg,strlen($PrivNickMas)+1,strlen($Msg));

        	if($PrivNickMas==$Usr or $Mas[2]==$Usr) {
			$Msg="$PrivNickMas,".$Msg;
			$MsgData=$Mas[0]."::P::".$Mas[2]."::".$Mas[3]."::".trim($Msg);
        		print "a[$j]=\"$MsgData\";\n";
    			$j++;
		}
    		break;

    		case "A":
     		$Msg=$Mas[4];
        	$Msg=eregi_replace($Usr.",", "<font class=my_nick><span style='color:ffffcc'>".$Usr.",</span></font>", $Msg);
        	$MsgData=$Mas[0]."::A::".$Mas[2]."::".$Mas[3]."::".trim($Msg);
        	print "a[$j]=\"$MsgData\";\n";
     		$j++;
    		break;

		case "T":
        	print "a[$j]=\"".trim($ChtMsgFile[$i])."\";\n";
        	$j++;
    		break;

    		case "S":
        	print "a[$j]=\"".trim($ChtMsgFile[$i])."\";\n";
        	$j++;
    		break;

    		case "J":
        	print "a[$j]=\"".trim($ChtMsgFile[$i])."\";\n";
        	$j++;
    		break;
 	}
}
	//выполнение функции printMsg
print "top.printMsg(a);\n\n";

print "var u=new Array();\n";
print "var u=[";
$OnlineUsrFName="data/onlinelist.php";
$OnlineUsrFile=file("$OnlineUsrFName");
$Tmp=',';
for($i=0;$i<count($OnlineUsrFile);$i++) {
	$Mas=split("::",$OnlineUsrFile[$i]);
	if (($i+1)==count($OnlineUsrFile)) {
		$Tmp='';
        }
	print "['".trim($Mas[1])."','".trim($Mas[3])."','".trim($Mas[4])."']".$Tmp."";
}
print "]\n";

	//выполнение функции printUsr
print "top.printUsr(u);\n";
print "</script>";
?>
<?
session_start();					//Старт сессии
	//основные настройки чата
function ChtConfigFunc() {
	$Rtrn=0;
	$ChtConfigFName="data/chatconf.php";
	$ChtConfigFile=file($ChtConfigFName);
	for($i=0;$i<count($ChtConfigFile);$i++) {
		$Mas=split("::",$ChtConfigFile[$i]);
		$Rtrn=array(
		"title" => trim($Mas[0]),
		"opis" => trim($Mas[1]),
		"reg" => trim($Mas[2]),
		"reg_close" => trim($Mas[3]),
		"close" => trim($Mas[4]),
		"close_reason" => trim ($Mas[5]),
		"admin" => trim($Mas[6]),
		"chat_time" => (trim($Mas[7])*3600),
		"chat_smile_see" => trim($Mas[8]),
		"chat_mat_see" => trim($Mas[9]),
		"chat_max_people" => trim($Mas[10]),
		"refresh" => trim($Mas[11]),
		"chat_timeout" => trim($Mas[12]),
		"chat_max" => trim($Mas[13]),
		"chat_max_msg" => trim($Mas[14]),
		"nick_size_max" => trim($Mas[15]),
		"nick_size_min" => trim($Mas[16]),
		"log_msg" => trim($Mas[17])
		);
	}
	return $Rtrn;
}
	//подсчет текущего времени
function GetMicroTime() {
	list($USec, $Sec) = explode(" ",microtime());
	return ((float)$USec + (float)$Sec);
}
	//замна на смайлы
function ReplSmileFunc($Msg) {
	$SmlDir="./img/smiles";
	$ChtConfig=ChtConfigFunc();
	$OpenSmlDir=opendir($SmlDir);
	while(($File=readdir($OpenSmlDir))!==false) {
		if($File!="." && $File!="..") {
			$SmileTscrpt=$ChtConfig['chat_smile_see'].ereg_replace(".gif$","",$File);
			$Msg=eregi_replace($SmileTscrpt, "<img src=./img/smiles/$File border=0>", $Msg);
		}
	}
	return $Msg;
}
	//функция замены (для сообщения)
function ReplSimFunc($Msg) {
	$Msg=trim($Msg);
	$Msg= ' ' . $Msg;
	$Msg=str_replace("\r\n"," ",$Msg);
	$Msg=str_replace("\n"," ",$Msg);
	$Msg=str_replace("\t"," ",$Msg);
	$Msg=str_replace("\\","",$Msg);
	$Msg=stripslashes($Msg);
	$Msg=htmlspecialchars($Msg);
	$Msg=eregi_replace(":","&#58;",$Msg);
	$Msg=ereg_replace(" +"," ",$Msg);
	$Msg = substr($Msg, 1);
	return $Msg;
}
	//функция замены (ник при входе)
function ReplNickSimFunc($Chr) {
	$Chr=trim($Chr);
	$Chr=ereg_replace(";","",$Chr);
	$Chr=ereg_replace("#","",$Chr);
	$Chr=ereg_replace(" ","",$Chr);
	$Chr=str_replace("\r\n","",$Chr);
	$Chr=str_replace("\n","",$Chr);
	$Chr=str_replace("\t","",$Chr);
	$Chr=eregi_replace(":","",$Chr);
	$Chr=eregi_replace("<","",$Chr);
	$Chr=eregi_replace(">","",$Chr);
	$Chr=eregi_replace("\"","",$Chr);
	$Chr=eregi_replace("\[","",$Chr);
	$Chr=eregi_replace("\]","",$Chr);
	$Chr=eregi_replace("\(","",$Chr);
	$Chr=eregi_replace("\)","",$Chr);
	$Chr=eregi_replace("\{","",$Chr);
	$Chr=eregi_replace("\}","",$Chr);
	$Chr=eregi_replace("&","",$Chr);
	return $Chr;
}
	//функция замены (при регистрации)
function ReplPassSimFunc($Chr) {
	$Chr=trim($Chr);
	$Chr=str_replace("\r\n","",$Chr);
	$Chr=str_replace("\n","",$Chr);
	$Chr=str_replace("\t","",$Chr);
	$Chr=eregi_replace("::","",$Chr);
	$Chr=eregi_replace("<","",$Chr);
	$Chr=eregi_replace(">","",$Chr);
	$Chr=eregi_replace("\"","",$Chr);
	$Chr=eregi_replace("\[","",$Chr);
	$Chr=eregi_replace("\]","",$Chr);
	$Chr=eregi_replace("\{","",$Chr);
	$Chr=eregi_replace("\}","",$Chr);
	$Chr=eregi_replace("&","",$Chr);
	return $Chr;
}
	//заменяет мат
function ReplMatFunc($Msg) {
	$ChtConfig=ChtConfigFunc();
	$MatFName="data/badwords.php";
	$MatFile=file($MatFName);
	for($i=0;$i<count($MatFile);$i++) {
		$Msg=eregi_replace(trim($MatFile[$i]),$ChtConfig['chat_mat_see'], $Msg);
	}
	return $Msg;
}
	//написать в чат
function PostMsgFunc($Msg) {
	$ChtConfig=ChtConfigFunc();
	$ChtMsgFName="data/chatmsg.php";
	$ChtMsgFile=file($ChtMsgFName);
	$ChtMsgData="";
	for($i=0;$i<count($ChtMsgFile);$i++) {
		if(trim($ChtMsgFile[$i])) {
			$ChtMsgData.=trim($ChtMsgFile[$i])."\n";
		}
	}
	$ChtMsgData=date("H:i:s",time()+$ChtConfig['chat_time'])."".$Msg."\n".$ChtMsgData;
	$FileOpen=fopen("$ChtMsgFName", "w+");
	fwrite($FileOpen, $ChtMsgData);
	fclose($FileOpen);
}
	//удаление топика при обновление
function delThm($Usr) {
	$ChtMsgFName = "data/chatmsg.php";
	$ChtMsgFile = file($ChtMsgFName);
	$FileOpen=fopen("$ChtMsgFName", "w+");
	for($i=0;$i<count($ChtMsgFile);$i++) {
		$Mas=split("::",trim($ChtMsgFile[$i]));
		if (($Mas[1]=="T") and ($Mas[4]==$Usr)) {
          	} else {
			fwrite($FileOpen,$ChtMsgFile[$i]);
		}
	}
        fclose($FileOpen);
}
	//функция выкидывает по таймауту
function offLine() {
	$ChtConfig=ChtConfigFunc();
	$OnlineUsrFName="data/onlinelist.php";
	$RtrnUsr="";
	$OnlineUsrFile=file("$OnlineUsrFName");
	for($i=0;$i<count($OnlineUsrFile);$i++) {
		$Mas=split("::",$OnlineUsrFile[$i]);
		$PingTime=time()-$Mas[2];
		if($PingTime<$ChtConfig['chat_timeout']) {
			$RtrnUsr.=trim($OnlineUsrFile[$i])."".chr(10);
		} else {
			PostMsgFunc("::S::::::<FONT color=#ffffcc>Н</FONT><FONT color=#f2f2bb>а</FONT><FONT color=#e5e5aa>с</FONT> <FONT color=#cccc88>п</FONT><FONT color=#bfbf77>о</FONT><FONT color=#b2b266>к</FONT><FONT color=#a5a555>и</FONT><FONT color=#999944>д</FONT><FONT color=#8c8c33>а</FONT><FONT color=#7f7f22>е</FONT><FONT color=#727211>т</FONT> <FONT color=lime>".$Mas[1]." </FONT>");
		}
	}
	$FileOpen=fopen("$OnlineUsrFName", "w+");
	fwrite($FileOpen,$RtrnUsr);
	fclose($FileOpen);
}
	//вход в чат с проверкой на таймаут ники
function EnterFunc($Usr) {
	global $HTTP_SERVER_VARS;
	$ChtConfig=ChtConfigFunc();
	//запись даты входа в инфо
	$UsrRegConfig=RegData($Usr);
	$UsrInfFName="data/users/".strtolower($Usr).".php";
	$UsrInfFile = file($UsrInfFName);
	//если регистрация существует записываем дату входа
	if ($UsrInfFile) {
		$FileOpen = fopen($UsrInfFName, "w+" );
		fputs ($FileOpen, "<?die?>\n");
		fputs ($FileOpen, "|name|".$UsrRegConfig['name']."|\n");
		fputs ($FileOpen, "|sex|".$UsrRegConfig['sex']."|\n");
		fputs ($FileOpen, "|dbdate|".$UsrRegConfig['dbdate']."|\n");
		fputs ($FileOpen, "|nick|$Usr|\n");
		fputs ($FileOpen, "|pass|".$UsrRegConfig['pass']."|\n");
		fputs ($FileOpen, "|stat|".$UsrRegConfig['stat']."|\n");
		fputs ($FileOpen, "|mail|".$UsrRegConfig['mail']."|\n");
		fputs ($FileOpen, "|icq|".$UsrRegConfig['icq']."|\n");
		fputs ($FileOpen, "|was|".date("d.m.Y H:i:s")."|\n");
		@fflush($FileOpen);
		fclose($FileOpen);
	}
	//запись в onlinelist и проверка на таймаут
	$OnlineUsrFName="data/onlinelist.php";
	$RtrnUsr="";
	$OnlineUsrFile=file("$OnlineUsrFName");
	for($i=0;$i<count($OnlineUsrFile);$i++) {
		$Mas=split("::",$OnlineUsrFile[$i]);
		$PingTime=time()-$Mas[2];
        	if($Mas[1]!=$Usr and $PingTime<$ChtConfig['chat_timeout']) {
			$RtrnUsr.=trim($OnlineUsrFile[$i])."".chr(10);
		} else {
			PostMsgFunc("::S::::::<FONT color=#ffffcc>Н</FONT><FONT color=#f2f2bb>а</FONT><FONT color=#e5e5aa>с</FONT> <FONT color=#cccc88>п</FONT><FONT color=#bfbf77>о</FONT><FONT color=#b2b266>к</FONT><FONT color=#a5a555>и</FONT><FONT color=#999944>д</FONT><FONT color=#8c8c33>а</FONT><FONT color=#7f7f22>е</FONT><FONT color=#727211>т</FONT> <FONT color=lime>".$Mas[1]."</FONT>");
        	}
	}
	$Gender=$UsrRegConfig['sex'];
	$Gender=(!empty($UsrRegConfig['sex'])) ? $Gender : "Н";	//присваивает всем незарегистрированным пол Н
	$RtrnUsr.=$_SERVER["REMOTE_ADDR"]."::$Usr::".time()."::".$Gender."::".$UsrRegConfig['stat']."::".$HTTP_SERVER_VARS['HTTP_USER_AGENT']."".chr(10);
	$FileOpen=fopen("$OnlineUsrFName", "w+");
	fwrite($FileOpen,$RtrnUsr);
	fclose($FileOpen);
	PostMsgFunc("::S::::::<FONT color=#666600>К</FONT> <FONT color=#7b7b1d>н</FONT><FONT color=#86862b>а</FONT><FONT color=#91913a>м</FONT> <FONT color=#a7a757>п</FONT><FONT color=#b2b266>р</FONT><FONT color=#bdbd74>и</FONT><FONT color=#c8c883>х</FONT><FONT color=#d3d391>о</FONT><FONT color=#dedea0>д</FONT><FONT color=#e9e9ae>и</FONT><FONT color=#f4f4bd>т</FONT> <FONT color=lime>$Usr</FONT>");
	delThm($Usr);
	PostMsgFunc("::T::::::$Usr");
}
	//Перезаход в чат - ник еще в списке онлайн
function ReEnterFunc($Usr) {
	global $HTTP_SERVER_VARS;
	$UsrRegConfig=RegData($Usr);
	//запись в onlinelist обновленного времени пинга
	$OnlineUsrFName="data/onlinelist.php";
	$RtrnUsr="";
	$OnlineUsrFile=file("$OnlineUsrFName");
	for($i=0;$i<count($OnlineUsrFile);$i++) {
		$Mas=split("::",$OnlineUsrFile[$i]);
       		if($Mas[1]!=$Usr) {
			$RtrnUsr.=trim($OnlineUsrFile[$i])."".chr(10);
		}
	}
	$Gender=$UsrRegConfig['sex'];
	$Gender=(!empty($UsrRegConfig['sex'])) ? $Gender : "Н";	//присваивает всем незарегистрированным пол Н
	$RtrnUsr.=$_SERVER["REMOTE_ADDR"]."::$Usr::".time()."::".$Gender."::".$UsrRegConfig['stat']."::".$HTTP_SERVER_VARS['HTTP_USER_AGENT']."".chr(10);
	$FileOpen=fopen("$OnlineUsrFName", "w+");
	fwrite($FileOpen,$RtrnUsr);
	fclose($FileOpen);
	delThm($Usr);
	PostMsgFunc("::T::::::$Usr");
}
	//функция выхода из чата
function ExitFunc($Usr) {
	$OnlineUsrFName="data/onlinelist.php";
	$RtrnData="";
	$OnlineUsrFile=file("$OnlineUsrFName");
	for($i=0;$i<count($OnlineUsrFile);$i++) {
		$Mas=split("::",$OnlineUsrFile[$i]);
		if($Mas[1]!=$Usr) {
			$RtrnData.=trim($OnlineUsrFile[$i])."\n";
		} else {
			PostMsgFunc("::S::::::<FONT color=#ffffcc>Н</FONT><FONT color=#f2f2bb>а</FONT><FONT color=#e5e5aa>с</FONT> <FONT color=#cccc88>п</FONT><FONT color=#bfbf77>о</FONT><FONT color=#b2b266>к</FONT><FONT color=#a5a555>и</FONT><FONT color=#999944>д</FONT><FONT color=#8c8c33>а</FONT><FONT color=#7f7f22>е</FONT><FONT color=#727211>т</FONT> <FONT color=lime>".$Mas[1]."</FONT>");
		}
	}
	$FileOpen=fopen("$OnlineUsrFName", "w+");
	fwrite($FileOpen,"$RtrnData");
	fclose($FileOpen);
}
	//проверка есть ли пользователь в чате, выводит ошибку если сессии нет
function NickFromSess() {
	if(session_is_registered("nick")) {
		$Rtrn=$_SESSION['nick'];
	} else {
		$Rtrn='';
		print "<script>top.location.href='./error.php?msg=Ваша сессия не обнаружена. Вы покинули чат до этого.';</script>";exit;
        }
	return $Rtrn;
}
	//проверка есть ли пользователь в  onlinelist
function AwayList() {
	$Usr=$_SESSION['nick'];
	$OnlineUsrFName="data/onlinelist.php";
	$Rtrn=0;
	$OnlineUsrFile=file("$OnlineUsrFName");
	for($i=0;$i<count($OnlineUsrFile);$i++) {
		$Mas=split("::",$OnlineUsrFile[$i]);
		if($Mas[1]==$Usr) {
			$Rtrn=$Mas[1];
		}
	}
	return $Rtrn;
}

	//получает данные из регистрации
function RegData($Usr) {
	error_reporting(0);
	$Rtrn=0;
	$UsrFName="data/users/".strtolower($Usr).".php";
	$UsrFile = file($UsrFName);
	if (!$UsrFile) {
        	$Rtrn=null;
	} else {
		$UsrFileSzof = sizeof($UsrFile);
		for ($i=0;$i<$UsrFileSzof;$i++) {
			list($NoData,$UsrFileDName,$UsrFileDValue,$NoData)= split ('[|]', $UsrFile[$i]);
			if ($UsrFileDName == "name"){$UsrNameValue = $UsrFileDValue;}
			if ($UsrFileDName == "sex"){$UsrSexValue = $UsrFileDValue;}
			if ($UsrFileDName == "dbdate"){$UsrBdateValue = $UsrFileDValue;}
			if ($UsrFileDName == "nick"){ $UsrNickValue = $UsrFileDValue;}
			if ($UsrFileDName == "pass"){$UsrPassValue = $UsrFileDValue;}
			if ($UsrFileDName == "stat"){$UsrStatValue = $UsrFileDValue;}
			if ($UsrFileDName == "mail"){$UsrMailValue = $UsrFileDValue;}
			if ($UsrFileDName == "icq"){$UsrIcqValue = $UsrFileDValue;}
			if ($UsrFileDName == "was"){$UsrWasValue = $UsrFileDValue;}
		}
		$Rtrn=array(
		"name" => trim($UsrNameValue),
		"sex" => trim($UsrSexValue),
		"dbdate" => trim($UsrBdateValue),
		"pass" => trim($UsrPassValue),
		"stat" => trim($UsrStatValue),
		"mail" => trim($UsrMailValue),
		"icq" => trim($UsrIcqValue),
		"was" => trim($UsrWasValue)
		);
	}
	return $Rtrn;
}
	//проверка на бан nick
function NickBanFunc(){
	$Rtrn=0;
	$NickBanFName="data/ban.php";
	$NickBanFile=file($NickBanFName);
	for($i=0;$i<count($NickBanFile);$i++) {
		$Mas=split("::",trim($NickBanFile[$i]));
		$DayNow = date("d");
		$MonthNow = date("m");
		$YearNow = date("Y");
		$BanNick=$Mas[0];
		$BanDate=$Mas[1];
		$UserNick=$Mas[2];
		$BanCommt=$Mas[3];
    		$Nick=$_POST['nick'];
		if ($Nick==$BanNick) {
			$BanDate=explode(".",$BanDate);
			$Day=$BanDate[0]; $Month=$BanDate[1]; $Year=$BanDate[2];
			if ($YearNow < $Year) {
				$Rtrn="Ник был заблокирован до ".$Day.".".$Month.".".$Year.".<br>Причина: ".$BanCommt;
                	} else if (($YearNow == $Year) && ($MonthNow < $Month)) {
				$Rtrn="Ник был заблокирован до ".$Day.".".$Month.".".$Year.".<br>Причина: ".$BanCommt;
                	} else if (($YearNow == $Year) && ($MonthNow == $Month) && ($DayNow < $Day)) {
				$Rtrn="Ник был заблокирован до ".$Day.".".$Month.".".$Year.".<br>Причина: ".$BanCommt;
                	} else {
				$RtrnData="";
				for($i=0;$i<count($NickBanFile);$i++) {
					$Mas=split("::",trim($NickBanFile[$i]));
					$BanNick=$Mas[0];
					if(!eregi($_POST['nick'],$BanNick)) {
						$RtrnData.=trim($NickBanFile[$i]).chr(10);
					}
				}
				$FileOpen = fopen ($NickBanFName, "w+");
				fwrite ($FileOpen, $RtrnData);
				fclose ($FileOpen);
			}
		}
	}
	return $Rtrn;
}
	//проверка на бан ip
function IPBanFunc() {
	$Rtrn=0;
	$IPBanFName="data/banip.php";
	$IPBanFile=file($IPBanFName);
	for($i=0;$i<count($IPBanFile);$i++) {
		$Mas=split("::",trim($IPBanFile[$i]));
		$DayNow = date("d");
		$MonthNow = date("m");
		$YearNow = date("Y");
		$BanIP=$Mas[0];
		$BanDate=$Mas[1];
		$UserNick=$Mas[2];
		$BanCommt=$Mas[3];
		$BanIP=explode(".",trim($BanIP));
		$IP=explode(".",trim($_SERVER["REMOTE_ADDR"]));
		if (($IP[0]==$BanIP[0]) or ($BanIP[0]=="*")) {
			if (($IP[1]==$BanIP[1]) or ($BanIP[1]=="*")) {
				if (($IP[2]==$BanIP[2]) or ($BanIP[2]=="*")) {
					if (($IP[3]==$BanIP[3]) or ($BanIP[3]=="*")) {
						$BanDate=explode(".",$BanDate);
						$Day=$BanDate[0]; $Month=$BanDate[1]; $Year=$BanDate[2];
						if ($YearNow < $Year) {
							$Rtrn="Вы были заблокированы до ".$Day.".".$Month.".".$Year.".<br>Причина: ".$BanCommt;
                				} else if (($YearNow == $Year) && ($MonthNow < $Month)) {
							$Rtrn="Вы были заблокированы на ".$Day.".".$Month.".".$Year.".<br>Причина: ".$BanCommt;
                				} else if (($YearNow == $Year) && ($MonthNow == $Month) && ($DayNow < $Day)) {
							$Rtrn="Вы были заблокированы на ".$Day.".".$Month.".".$Year.".<br>Причина: ".$BanCommt;
                				} else {
							$RtrnData="";
							for($i=0;$i<count($IPBanFile);$i++) {
								$Mas=split("::",trim($IPBanFile[$i]));
								$BanIP=$Mas[0];
								if(!eregi($_SERVER["REMOTE_ADDR"],$BanIP)) {
									$RtrnData.=trim($IPBanFile[$i]).chr(10);
								}
							}
							$FileOpen = fopen ($IPBanFName, "w+");
							fwrite ($FileOpen, $RtrnData);
							fclose ($FileOpen);
						}
					}
				}
			}
		}
	}
	return $Rtrn;
}
	//Обработка sex (инфо)
function convertSex($Sex) {
	$SexConv = array(
	"М"       => "Мужской",
	"Ж"     => "Женский",
	"Н"        => "Неуказан"
	);

	if(empty($SexConv[$Sex])) {
		return "Не определен";
	} else {
		return $SexConv[$Sex];
	}
}
	//Обработка статусов(инфо)
function convertStatus($Stat) {
	$StatConv = array(
	"admin"       => "Администратор",
	"moder"     => "Модератор",
	"user"        => "Пользователь"
	);

	if(empty($StatConv[$Stat])) {
		return "Не определен";
	} else {
		return $StatConv[$Stat];
	}
}
	//Возможные шрифты
function convFont($Font) {
	$FontConv = array(
	"Arial"           => "Arial",
	"Arial Black"         => "Arial Black",
	"Arial Narrow" => "Arial Narrow",
	"Comic Sans MS"     => "Comic Sans MS",
	"Times New Roman"   => "Times New Roman",
	"Verdana"        => "Verdana"
	);
	if(empty($FontConv[$Font])) {
		return "Arial";
	} else {
		return $FontConv[$Font];
	}
}
	//Возможные цвета
function convGradColor($Color) {
	if(preg_match('!^[0-9ABCDEF]{6}+$!i',$Color)==0) {
		return "ff0000";
	} else {
		return $Color;
	}
}
	//Возможные стили
function convFontStyle($Style) {
	$FontStyleConv = array(
	"normal"   => "normal",
	"italic"   => "italic"
	);

	if(empty($FontStyleConv[$Style])) {
		return "normal";
	} else {
		return $FontStyleConv[$Style];
	}
}
	//Возможная толщина
function convFontWeight($Weight) {
	$FontWeightConv = array(
	"normal"   => "normal",
	"bold"   => "bold"
	);

	if(empty($FontWeightConv[$Weight])) {
		return "normal";
	} else {
		return $FontWeightConv[$Weight];
	}
}
	//запись IP бана
function IpBan($BanIP,$BanDate,$BanCommt,$UserNick) {
	$ChtMsgFName="data/chatmsg.php";
	$ChtMsgFile=file($ChtMsgFName);
	$ChtMsgData="";
	for($i=0;$i<count($ChtMsgFile);$i++) {
		if(trim($ChtMsgFile[$i])) {
			$ChtMsgData.=trim($ChtMsgFile[$i])."\n";
		}
	}
	$ChtMsgData=date("H:i:s")."::J::$UserNick::::IP $BanIP забанен $BanCommt\n".$ChtMsgData;
	$IPBanFName="data/banip.php";			//запись в banip
	$IPBanFile=file($IPBanFName);
	$RtrnData="$BanIP::$BanDate::$UserNick::$BanCommt".chr(10);
	if ($BanIP!=null) {
		$FileOpen = fopen ($IPBanFName, "a+");
		fwrite ($FileOpen, $RtrnData);
		fclose ($FileOpen);
	}

	$FileOpen=fopen("$ChtMsgFName", "w+");		//вывод сообщения о бане
	fwrite($FileOpen, $ChtMsgData);
	fclose($FileOpen);
	print "<script>top.location.href='./error.php?msg=$BanIP забанен до $BanDate!';</script>";
}
	//запись бана по нику
function NickBan($BanNick,$BanDate,$BanCommt,$UserNick) {
	$ChtMsgFName="data/chatmsg.php";
	$ChtMsgFile=file($ChtMsgFName);
	$ChtMsgData="";
	for($i=0;$i<count($ChtMsgFile);$i++) {
		if(trim($ChtMsgFile[$i])) {
			$ChtMsgData.=trim($ChtMsgFile[$i])."\n";
		}
	}
	$ChtMsgData=date("H:i:s")."::J::$UserNick::::$BanNick забанен $BanCommt\n".$ChtMsgData;
	$NickBanFName="data/ban.php";			//запись в ban
	$NickBanFile=file($NickBanFName);
	$RtrnData="$BanNick::$BanDate::$UserNick::$BanCommt".chr(10);
	if ($BanNick!=null) {
		$FileOpen = fopen ($NickBanFName, "a+");
		fwrite ($FileOpen, $RtrnData);
		fclose ($FileOpen);
	}

	$FileOpen=fopen("$ChtMsgFName", "w+");		//вывод сообщения о бане
	fwrite($FileOpen, $ChtMsgData);
	fclose($FileOpen);
	print "<script>top.location.href='./error.php?msg=Ник $BanNick забанен до $BanDate!';</script>";
}
	//запись kick
function Kick($KickNick,$KickCommt,$UserNick) {
	$ChtMsgFName="data/chatmsg.php";
	$ChtMsgFile=file($ChtMsgFName);
	$ChtMsgData="";
	for($i=0;$i<count($ChtMsgFile);$i++) {
		if(trim($ChtMsgFile[$i])) {
			$ChtMsgData.=trim($ChtMsgFile[$i])."\n";
		}
	}
	$ChtMsgData=date("H:i:s")."::J::$UserNick::::$KickNick выкинут из чата $KickCommt\n".$ChtMsgData;
	$RtrnData="";				//поиск ника в онлайн
	$OnlineUsrFName="data/onlinelist.php";
	$OnlineUsrFile=file($OnlineUsrFName);
   	for($i=0;$i<count($OnlineUsrFile);$i++) {
  		$Mas=split("::",trim($OnlineUsrFile[$i]));
   		if($Mas[1]!=$KickNick) {
      			$RtrnData.=trim($OnlineUsrFile[$i]).chr(10);
		} else if($KickNick==$Mas[1]) {
			$KickNickFind=1;
 		}
 	}
	if($KickNickFind) {				//удаление ника
		$FileOpen = fopen ($OnlineUsrFName, "w+");
		fwrite ($FileOpen, $RtrnData);
		fclose ($FileOpen);

		$FileOpen=fopen("$ChtMsgFName", "w+");	//вывод сообщения о kick
		fwrite($FileOpen, $ChtMsgData);
		fclose($FileOpen);
		print "<script>top.location.href='./error.php?msg=Пользователь $KickNick выкинут из чата!';</script>";
	}
}
	//удаление записи ipban
function IpUnBan($UnBanIP,$UserNick) {
	$RtrnData="";
  $BanIPFind="";
	$IPBanFName="data/banip.php";
	$IPBanFile=file($IPBanFName);
	for($i=0;$i<count($IPBanFile);$i++) {
		$Mas=split("::",$IPBanFile[$i]);
		$BanIP=$Mas[0];
		if($BanIP!=$UnBanIP) {
			$RtrnData.=trim($IPBanFile[$i]).chr(10);
		} else {
			$BanIPFind=1;
		}
	}
	$FileOpen = fopen ($IPBanFName, "w+");
	fwrite ($FileOpen, $RtrnData);
	fclose ($FileOpen);
	if($BanIPFind) {
		print "<script>top.location.href='./error.php?msg=IP $UnBanIP удалён из базы!';</script>";
	} else {
		print "<script>top.location.href='./error.php?msg=IP $UnBanIP нет в базе!';</script>";
	}
}
	//удаление записи nickban
function NickUnBan($UnBanNick,$UserNick) {
	$RtrnData="";
  $BanNickFind="";
	$NickBanFName="data/ban.php";
	$NickBanFile=file($NickBanFName);
	for($i=0;$i<count($NickBanFile);$i++) {
		$Mas=split("::",$NickBanFile[$i]);
		$BanNick=$Mas[0];
		if($BanNick!=$UnBanNick) {
			$RtrnData.=trim($NickBanFile[$i]).chr(10);
		} else {
			$BanNickFind=1;
		}
	}
	$FileOpen = fopen ($NickBanFName, "w+");
	fwrite ($FileOpen, $RtrnData);
	fclose ($FileOpen);
	if($BanNickFind) {
		print "<script>top.location.href='./error.php?msg=Ник $UnBanNick удалён из базы!';</script>";
	} else {
		print "<script>top.location.href='./error.php?msg=Ника $UnBanNick нет в базе!';</script>";
	}
}
	//получение данных из регистрации (для админки)
function AdminRegData($Usr) {
	error_reporting(0);
	$Rtrn=0;
	$UsrFName="../data/users/".strtolower($Usr).".php";
	$UsrFile = file($UsrFName);
	if (!$UsrFile) {
        	$Rtrn=null;
	} else {
		$UsrFileSzof = sizeof($UsrFile);
		for ($i=0;$i<$UsrFileSzof;$i++) {
			list($NoData,$UsrFileDName,$UsrFileDValue,$NoData)= split ('[|]', $UsrFile[$i]);
			if ($UsrFileDName == "name"){$UsrNameValue = $UsrFileDValue;}
			if ($UsrFileDName == "sex"){$UsrSexValue = $UsrFileDValue;}
			if ($UsrFileDName == "dbdate"){$UsrBdateValue = $UsrFileDValue;}
			if ($UsrFileDName == "nick"){ $UsrNickValue = $UsrFileDValue;}
			if ($UsrFileDName == "pass"){$UsrPassValue = $UsrFileDValue;}
			if ($UsrFileDName == "stat"){$UsrStatValue = $UsrFileDValue;}
			if ($UsrFileDName == "mail"){$UsrMailValue = $UsrFileDValue;}
			if ($UsrFileDName == "icq"){$UsrIcqValue = $UsrFileDValue;}
			if ($UsrFileDName == "was"){$UsrWasValue = $UsrFileDValue;}
		}
		$Rtrn=array(
		"name" => trim($UsrNameValue),
		"sex" => trim($UsrSexValue),
		"dbdate" => trim($UsrBdateValue),
		"pass" => trim($UsrPassValue),
		"stat" => trim($UsrStatValue),
		"mail" => trim($UsrMailValue),
		"icq" => trim($UsrIcqValue),
		"was" => trim($UsrWasValue)
		);
	}
	return $Rtrn;
}
	//получение настроек чата (для админки)
function ChtAdminConfigFunc() {
	$Rtrn=0;
	$ChtConfigFName="../data/chatconf.php";
	$ChtConfigFile=file($ChtConfigFName);
	for($i=0;$i<count($ChtConfigFile);$i++) {
		$Mas=split("::",$ChtConfigFile[$i]);
		$Rtrn=array(
		"title" => trim($Mas[0]),
		"opis" => trim($Mas[1]),
		"reg" => trim($Mas[2]),
		"reg_close" => trim($Mas[3]),
		"close" => trim($Mas[4]),
		"close_reason" => trim ($Mas[5]),
		"admin" => trim($Mas[6]),
		"chat_time" => (trim($Mas[7])*3600),
		"chat_smile_see" => trim($Mas[8]),
		"chat_mat_see" => trim($Mas[9]),
		"chat_max_people" => trim($Mas[10]),
		"refresh" => trim($Mas[11]),
		"chat_timeout" => trim($Mas[12]),
		"chat_max" => trim($Mas[13]),
		"chat_max_msg" => trim($Mas[14]),
		"nick_size_max" => trim($Mas[15]),
		"nick_size_min" => trim($Mas[16]),
		"log_msg" => trim($Mas[17])
		);
	}
	return $Rtrn;
}
?>
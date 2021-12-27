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
<style>
body {
	margin: 0; 
	padding: 0; 
	color: #fc0; 
	background: #071367 url(skin/img/sbg.jpg) fixed; 
	font-style: normal; 
	font-weight: 100 
}
.inp { 
	color: #c90; 
	background: #071367 url(skin/img/ibg.jpg); 
	font: normal 700 11px sans-serif; 
	width:100%;
	border: inset 1px #4c1e00 
}
#inp { 
	color: #fc0; 
	background: #374397 url(skin/img/aibg.jpg); 
	border: inset 1px #4c1e00
}
.btn { 
	color: #ffd632; 
	background:  url(skin/img/sbtnbg.jpg); 
	font-style: normal; 
	font-size: 10px;
	border: groove 1px #cc7a00; 
	margin: 0px 1px 0px 0px; 
	height: 18px
}
#btn { 
	color: #fc0; 
	background: #374397 url(skin/img/asbtnbg.gif); 
	border: groove 1px #662800
}
</style>
<script language="JavaScript">
var PrAct=0;
	//Кнопка приват
function prv() {
	PrAct=1;
}
	//Кнопка сказать
function forall() {
	PrAct=0;
}
function send() {
	if(PrAct==0) {
		document.forms['sndf'].priv.value="0";
	} else {
		document.forms['sndf'].priv.value="1";
	}
	if(!document.forms['msgf'].msg.value) {
		document.forms['msgf'].msg.focus();
		return false;
	}
	document.forms['sndf'].msg.value=document.forms['msgf'].msg.value;
	document.forms['sndf'].submit();
	return false;
}
	//Обновление ввремени при отклике
var RTime=<?=$ChtConfig['chat_timeout']?>-45;
function SaveMe() {
	top.rfr.location.href='ctp.php';
	setTimeout("SaveMe()", RTime*1000);
}
SaveMe();
</script>
</head>
<body onload="top.FocusForm();">
<table cellspacing=0 cellpadding=0 height=100% width=100%><tbody>
<tr><td>
<form name="sndf" action="send.php" method="POST" target="rfr">
<input name="priv" type="hidden" value="0">
<input name="msg" type="hidden">
</form></td>
<form name="msgf" onsubmit="return send();">
<td width=5%>&nbsp</td>
<td width=94%>
<input name="msg" type="text" onFocus=id=className onBlur=id='' class="inp" maxlength="<?=$conf['chat_max_msg']?>">
</td><td>&nbsp</td><td>
<input onclick="forall();top.FocusForm();" onMouseOver=id=className onMouseOut=id='' type="submit" class="btn" value="Сказать" title="Отправить сообщение">
</td><td>&nbsp</td><td>
<input class="btn" onclick="prv();top.FocusForm();" onMouseOver=id=className onMouseOut=id='' type="submit" value="Приват" unselectable="on">
</td><td width=1%></td></form></tr>
</table>
</body>
</html>
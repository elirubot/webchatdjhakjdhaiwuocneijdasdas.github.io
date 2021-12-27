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
.txt { 
	color: #201003; 
	font: 12px sans-serif; 
}
.dfrmsend { 
	color: #c90; 
	background: #071367 url(skin/img/ibg.jpg); 
	font: normal 700 11px sans-serif; 
	width:100%;
	border: inset 1px #4c1e00 
}
#dfrmsend { 
	color: #fc0; 
	background: #374397 url(skin/img/aibg.jpg); 
	border: inset 1px #4c1e00
}
.btnsend { 
	color: #ffd632; 
	background:  url(skin/img/sbtnbg.jpg); 
	font-style: normal; 
	font-size: 10px;
	border: groove 1px #cc7a00; 
	margin: 0px 1px 0px 0px; 
	height: 18px
}
#btnsend { 
	color: #fc0; 
	background: #374397 url(skin/img/asbtnbg.gif); 
	border: groove 1px #662800
}
</style>
</HEAD>
<body>
<table cellspacing=0 cellpadding=0 height=100% width=100%><tbody>
<tr>
<form action="chat.php" method=post target=_top>
<td width=35%></td><td class=txt>&nbspНик:</td>
<td width=15%>
<input name="nick" type="text" value='' onFocus=id=className onBlur=id='' class="dfrmsend"  maxlength="15">
</td><td class=txt>&nbsp&nbspПароль:</td><td width=15%>
<input name="pass" type="password" value='' onFocus=id=className onBlur=id='' class="dfrmsend"  maxlength="15">
</td><td>&nbsp</td><td>
<input class="btnsend" name="f" onMouseOver=id=className onMouseOut=id='' type="submit" value="Войти">
</td><td width=35%></td></form></tr></TBODY></TABLE></BODY></HTML>
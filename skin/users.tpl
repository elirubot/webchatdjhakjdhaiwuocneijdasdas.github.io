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
	color: #fc0; 
	background:  url(skin/img/ubg.jpg) fixed; 
	font-style: normal; 
	font-weight: 700; 
	padding: 10px; 
	scrollbar-face-color: #000; 
	scrollbar-highlight-color: #cc7a00; 
	scrollbar-shadow-color: #cc7a00; 
	scrollbar-3dlight-color: #000; 
	scrollbar-darkshadow-color: #000; 
	scrollbar-track-color: #000; 
	overflow-y: scroll;
	scrollbar-arrow-color: #cc7a00 

}
.gm { 
	color: #e5e500; 
	font-style: normal; 
	font-weight: 700; 
	text-align: left; 
	border: none; 
	margin: 15px 0px 5px
}
.nm { 
	color: #e5e500; 
	font-style: normal; 
	font-weight: 700; 
	text-align: left; 
	border: none; 
	margin: 15px 0px 5px
}
.bm { 
	color: #e5e500; 
	font-style: normal; 
	font-weight: 700; 
	text-align: left; 
	border: none; 
	margin: 15px 0px 5px
}
.tm { 
	font-weight: 700; 
	text-align: center; 
	margin: 10px 0px 0px
}
#fn { 
	width: 0; 
	filter: glow(color=#000000,strength=1) 
}
.mnick {
	font-weight: 700;
	color: #666699;
	text-decoration: none;
	padding: 1px 5px 1px 2px 
}
.mnick:hover { 
	text-decoration: underline 
}
.fnick {
	font-weight: 700;
	color: #ff761a;
	text-decoration: none;
	padding: 1px 5px 1px 2px 
}
.fnick:hover { 
	text-decoration: underline 
}
.nnick {
	font-weight: 700;
	color: #999999;
	text-decoration: none;
	padding: 1px 5px 1px 2px 
}
.nnick:hover { 
	text-decoration: underline 
}
.fnav{
	BORDER-RIGHT: 0px; 
	BORDER-TOP: 0px;
	LEFT: 0px; 
	BORDER-LEFT: 0px;
	BORDER-BOTTOM: 0px; 
	POSITION: absolute;
}
</style>
<body>
<DIV><IFRAME id=fnav onmouseover=showmenu() class=fnav
onmouseout=hidemenu() name=wnav src="fnav.php" frameBorder=no scrolling=no></IFRAME></DIV>
<SCRIPT>
var x=20
var intHide
var speed=1
setInterval("s()",1)

function s() {
	document.getElementById('fnav').style.top=(document.body.scrollTop + document.body.clientHeight - document.getElementById('fnav').offsetHeight);
	document.getElementById('fnav').style.width=(document.body.clientWidth)
}

document.getElementById('fnav').style.height=x

function showmenu() {
	clearInterval(intHide)
	intShow=setInterval("show()",10)
}
function hidemenu() {
	clearInterval(intShow)
	intHide=setInterval("hide()",10)
}
function show() {
	if (x<125) {
		x=x+speed
		document.getElementById('fnav').style.height=x
		document.getElementById('fnav').style.top=(document.body.scrollTop + document.body.clientHeight - document.getElementById('fnav').offsetHeight);
	}
}
function hide() {
	if (x>20) {
		x=x-speed
		document.getElementById('fnav').style.height=x
		document.getElementById('fnav').style.top=(document.body.scrollTop + document.body.clientHeight - document.getElementById('fnav').offsetHeight);
	}
}
</SCRIPT>

</head>
<div id=nick></div>
</body></html>
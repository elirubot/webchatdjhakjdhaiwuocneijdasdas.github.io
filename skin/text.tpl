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
<html><head>
<style type="text/css">
body {
	color: #fc0; 
	background: #000 url(skin/img/tfbg.jpg) fixed no-repeat right top; 
	font-style: normal; font-weight: 700; 
	padding: 2px 3px; 
	scrollbar-face-color: #000; 
	scrollbar-highlight-color: #cc7a00; 
	scrollbar-shadow-color: #cc7a00; 
	scrollbar-3dlight-color: #000; 
	scrollbar-darkshadow-color: #000; 
	scrollbar-track-color: #000; 
	scrollbar-arrow-color: #cc7a00 

}
.nick {
	font-weight: bold;
	text-decoration: none;
	font-family:Times New Roman;
}
.my_nick {
	text-decoration: underline overline;
	color: 232323;
}
.sysmsg {
	color: #cccc88; 
	font-weight: 700;
	font-size: 13px;
	margin: 1px 0px; 
	padding: 1px 
}
DIV.line {
	line-height: 100%;
}
.sys {
	color: #cccc88; 
	font-weight: 700; 
	font-size: 13px;
	margin: 1px 0px; 
	padding: 1px 
}
</style>
</head>
<script>
	//Пишем скрол для главного окна!
setInterval("scrollit()",20);
function scrollit() {
	window.scroll(0, document.body.scrollTop+1);
}
</script>
<body>
<div id=text></div>
</body></html>
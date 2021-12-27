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
<title><?=$title?></title>
<style>
body { 
	margin: 0; 
	color: #fc0; 
	background: #071367 url(skin/img/obg.jpg) fixed; 
	font-style: normal; 
	font-weight: 100; 
	padding: 15px; 
	scrollbar-face-color: #000; 
	scrollbar-highlight-color: #cc7a00; 
	scrollbar-shadow-color: #cc7a00; 
	scrollbar-3dlight-color: #000; 
	scrollbar-darkshadow-color: #000; 
	scrollbar-track-color: #000; 
	scrollbar-arrow-color: #cc7a00 

}
table.t { 
	width: 100%; 
	border-collapse: collapse; 
	color: #fc0; 
	font: 12px MS Sans Serif 
}
.t th { 
	color: #fff; 
	background: #000; 
	font: 700 14px MS Sans Serif; 
	text-align: right;
	border: groove 2px #cc7a00; 
	padding: 0px 3px 0px 0px 
}
td.t { 
	border: groove 2px #cc7a00
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
.ex {
	BACKGROUND: #000; padding: 10px
}
#sq {
	WIDTH: 6px; HEIGHT: 6px
}
</STYLE>
</head>
<body>
<CENTER>
<H3>Личные настройки</H3>
<TABLE cellSpacing=1 cellPadding=0 width=190 align=center>
  <form name="options1" onsubmit="sendForm(this);return false;">
  <TBODY>
  <TR>
    <TD colSpan=2>
      <TABLE class=t cellSpacing=0 cellPadding=0 align=center>
        <TBODY>
        <TR>
          <TH>Начало градиента ника</TH></TR>
        <TR>
          <TD class=t align=middle>
            <DIV class=ex><FONT id=mex1 color=#ff0000><B>Text Text Text</B></FONT></DIV><INPUT id=in onkeyup=CurMC1(value) 
            style="WIDTH: 100%" type=text maxLength=20 value=ff0000 name=NickGradStrt> 
            <DIV>
            <TABLE id=mc1 cellSpacing=0 cellPadding=0 border=0>
              <SCRIPT>
		//Действия при наведение и клике, с учетом отличий Firefox от IE
		mc1.onclick = function ( e ) { if (window.event) e = window.event;  var getEEl = e.srcElement? e.srcElement : e.target; SetMC1 (getEEl.bgColor) }
		mc1.onmouseover = function ( e ) { if (window.event) e = window.event;  var getEEl = e.srcElement? e.srcElement : e.target; CurMC1 (getEEl.bgColor) }
		mc1.onmouseout = function () { CurMC1 (document.options1.NickGradStrt.value) }
		SetMC1 = function ( c ) { var op='';if (c.charAt (0)!='#'){op=c.charAt (0);} document.options1.NickGradStrt.value = op+c.charAt (1)+c.charAt (2)+c.charAt (3)+c.charAt (4)+c.charAt (5)+c.charAt (6) }
		CurMC1 = function ( c ) { mex1.color = c }
		for (var y = 0; y < sc * 4 + 1; y++) {
			document.write ("<tr>")
			for (var x = 0; x < sc * 6; x++)
				document.write ("<td id=sq bgcolor=" + c (x, y) + "></td>")
			document.write ("<td width=10 bgcolor=" + Hex (255 * y / sc / 4) + Hex (255 * y / sc / 4) + Hex (255 * y / sc / 4) + "></td>")
			document.write ("</tr>");
		}
	</SCRIPT></TABLE></DIV></TD></TR></TBODY></TABLE><BR>
      <TABLE class=t cellSpacing=0 cellPadding=0 align=center>
        <TBODY>
        <TR>
          <TH>Конец градиента ника</TH></TR>
        <TR>
          <TD class=t align=middle>
            <DIV class=ex><FONT id=mex2 color=#ff0000><B>Text Text Text</B></FONT></DIV><INPUT id=in onkeyup=CurMC2(value) 
            style="WIDTH: 100%" type=text maxLength=20 value=ff0000 name=NickGradEnd> 
            <DIV>
            <TABLE id=mc2 cellSpacing=0 cellPadding=0 border=0>
              <SCRIPT>
		//Действия при наведение и клике, с учетом отличий Firefox от IE
		mc2.onclick = function ( e ) { if (window.event) e = window.event;  var getEEl = e.srcElement? e.srcElement : e.target; SetMC2 (getEEl.bgColor) }
		mc2.onmouseover = function ( e ) { if (window.event) e = window.event;  var getEEl = e.srcElement? e.srcElement : e.target; CurMC2 (getEEl.bgColor) }
		mc2.onmouseout = function () { CurMC2 (document.options1.NickGradEnd.value) }
		SetMC2 = function ( c ) { var op='';if (c.charAt (0)!='#'){op=c.charAt (0);} document.options1.NickGradEnd.value = op+c.charAt (1)+c.charAt (2)+c.charAt (3)+c.charAt (4)+c.charAt (5)+c.charAt (6) }
		CurMC2 = function ( c ) { mex2.color = c }
		for (var y = 0; y < sc * 4 + 1; y++) {
			document.write ("<tr>")
			for (var x = 0; x < sc * 6; x++)
				document.write ("<td id=sq bgcolor=" + c (x, y) + "></td>")
			document.write ("<td width=10 bgcolor=" + Hex (255 * y / sc / 4) + Hex (255 * y / sc / 4) + Hex (255 * y / sc / 4) + "></td>")
			document.write ("</tr>");
		}
	</SCRIPT></TABLE></DIV></TD></TR></TBODY></TABLE><BR>
      <TABLE class=t cellSpacing=0 cellPadding=0 align=center>
        <TBODY>
        <TR>
          <TH>Цвет сообщений</TH></TR>
        <TR>
          <TD class=t align=middle>
            <DIV class=ex><FONT id=mex3 color=#ff0000><B>Text Text Text</B></FONT></DIV><INPUT id=in onkeyup=CurMC3(value) 
            style="WIDTH: 100%" type=text maxLength=20 value=ff0000 name=MsgColor> 
            <DIV>
            <TABLE id=mc3 cellSpacing=0 cellPadding=0 border=0>
              <SCRIPT>
		mc3.onclick = function ( e ) { if (window.event) e = window.event;  var getEEl = e.srcElement? e.srcElement : e.target; SetMC3 (getEEl.bgColor) }
		mc3.onmouseover = function ( e ) { if (window.event) e = window.event;  var getEEl = e.srcElement? e.srcElement : e.target; CurMC3 (getEEl.bgColor) }
		mc3.onmouseout = function () { CurMC3 (document.options1.MsgColor.value) }
		SetMC3 = function ( c ) { var op='';if (c.charAt (0)!='#'){op=c.charAt (0);} document.options1.MsgColor.value = op+c.charAt (1)+c.charAt (2)+c.charAt (3)+c.charAt (4)+c.charAt (5)+c.charAt (6) }
		CurMC3 = function ( c ) { mex3.color = c }
		for (var y = 0; y < sc * 4 + 1; y++) {
			document.write ("<tr>")
			for (var x = 0; x < sc * 6; x++)
				document.write ("<td id=sq bgcolor=" + c (x, y) + "></td>")
			document.write ("<td width=10 bgcolor=" + Hex (255 * y / sc / 4) + Hex (255 * y / sc / 4) + Hex (255 * y / sc / 4) + "></td>")
			document.write ("</tr>");
		}
	</SCRIPT></TABLE></DIV></TD></TR></TBODY></TABLE><BR>
      <TABLE class=t cellSpacing=0 cellPadding=0>
        <TBODY>
        <TR>
          <TH>Шрифт сообщений</TH></TR>
        <TR>
          <TD class=t><INPUT type=radio CHECKED value="Times New Roman" name=MsgFace> <font face="Times New Roman">Times New Roman</font><BR>
	<INPUT type=radio value="Arial" name=MsgFace> <font face="Arial">Arial</font><BR>
	<INPUT type=radio value="Arial Black" name=MsgFace> <font face="Arial Black">Arial Black</font><BR>
	<INPUT type=radio value="Arial Narrow" name=MsgFace> <font face="Arial Narrow">Arial Narrow</font><BR>
	<INPUT type=radio value="Comic Sans MS" name=MsgFace> <font face="Comic Sans MS">Comic Sans MS</font><BR>
	<INPUT type=radio value="Verdana" name=MsgFace> <font face="Verdana">Verdana</font> 
        </TD></TR>
        <TR>
          <TH>Толщина шрифта</TH></TR>
        <TR>
          <TD class=t><INPUT type=radio CHECKED value=normal name=MsgFontWeight> <font style="font-weight: normal">normal</font><BR>
	<INPUT type=radio value=bold name=MsgFontWeight> <b>bold</b>	 
         </TD></TR>        
         <TR>
          <TH>Стиль шрифта</TH></TR>
        <TR>
          <TD class=t><INPUT type=radio CHECKED value=normal name=MsgFontStyle> normal<BR>
	<INPUT type=radio value=italic name=MsgFontStyle> <i>italic</i>	 
         </TD></TR></TBODY></TABLE><BR></TD></TR>
<TR>
<TD width="50%"><INPUT onmouseup=id=className class=btn onmouseover=id=className style="WIDTH: 100%" onmouseout="id=''" type=submit value=OK name=save></TD>
<TD width="50%"><INPUT onmouseup=id=className class=btn onmouseover=id=className style="WIDTH: 100%" onmouseout="id=''" type=button value=Cancel onClick="location.href='users.php';" name=cancel></TD></TR></TBODY></TABLE></FORM></CENTER></BODY></HTML>
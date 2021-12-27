	//-------------Функции градиента---------------
	//Перевод из  RRGGBB в [rrr,ggg,bbb].
function hexToDec(hex) {
	var i, hash, dec = [];
	hash = {
	'A' : 10, 'B' : 11, 'C' : 12, 'D' : 13, 'E' : 14, 'F' : 15, 'a' : 10, 'b' : 11, 'c' : 12, 'd' : 13, 'e' : 14, 'f' : 15
	}
	for (i = 0; i <= 9; i++) hash[''+i] = i;
	for (i = 0; i < hex.length; i++) {
		if (i % 2 == 0) dec[parseInt(i / 2)] = hash[hex.charAt(i)] * 16;
		else dec[parseInt(i / 2)] += hash[hex.charAt(i)];
	}
	return dec;
}
	//Обратный перевод
function decToHex(decArray) {
	var hex = ['0','1','2','3','4','5','6','7','8','9','A','B','C','D','E','F','a','b','c','d','e','f'];
	var out = "#";
	for (var i = 0; i < decArray.length; i++) {
		dec = parseInt(decArray[i]);
		out += hex[parseInt(dec / 16)] + hex[dec % 16];
    	}
    	return out;
}
	//Градиент
function textGradient(t, clrStart, clrEnd) {
	var k, count, rgb = [], html = "", simb;
	var red, green, blue;
	count = 0;
	rgb[0] = hexToDec(clrStart);
	rgb[1] = hexToDec(clrEnd);
  	html = "";

	var notglength=t.length;
	for (k = 0; k < t.length; k++) {
		simb = t.charAt(k);
		if (simb == "<") { 
			while(simb!=">") { k++;html +=simb;notglength--;simb = t.charAt(k);continue;}
		}
		if (simb == ">") {  html +=">";notglength--;continue;}
		if (simb == " ") { html += " ";notglength--;continue;}
		red = parseInt(rgb[0][0] + (rgb[1][0] - rgb[0][0]) * (count / notglength));
		green = parseInt(rgb[0][1] + (rgb[1][1] - rgb[0][1]) * (count / notglength));
		blue = parseInt(rgb[0][2] + (rgb[1][2] - rgb[0][2]) * (count / notglength));
		html += "<span style=\"color:" + decToHex([red, green, blue]) + "\">" + simb + "<\/span>";
		count++;
	}
	return html; 
} 
	//-------------End-------------
	//установка Cookie
function setCookie(name,value,expire) {
	dat=new Date();dat.setMonth(dat.getMonth()+3);
	str = name+'='+value+';expires='+dat.toGMTString()+';path=/';
	top.document.cookie=str;
}

	//получение Cookie
function getCookie(options) {
	var Stroka,MasStroka;
	str=top.document.cookie;
	Mas=str.split('; ');
	for (i in Mas){
	Stroka=Mas[i];MasStroka=Stroka.split('=');
	if (MasStroka[0]==options) {
		if (MasStroka[1]=='false') return false; else return MasStroka[1];
		}
	}
	return null;
}
	//установка font
function saveOptions(s1,s2,s3,s4,s5,s6) {
	setCookie(Usr+'NickGradStrt',s1);
	setCookie(Usr+'NickGradEnd',s2);
	setCookie(Usr+'MsgColor',s3);
	setCookie(Usr+'MsgFace',s4);
	setCookie(Usr+'MsgFontWeight',s5);
	setCookie(Usr+'MsgFontStyle',s6);
}
	//вывод ника при нажатии
function setNick(nick) {
	var Msg=submfr.document.forms['msgf'].msg;
	var MsgValue=Msg.value;
	var Temp=0;
	for(var i=0;i<16;i++) {
		if(MsgValue.substring(i,i+1)==",") {
			Temp=i;break;
		}
	}
	var ToNick=MsgValue.substring(0,Temp)+', ';
	if(nick!=ToNick) {
		Msg.value=nick+Msg.value;
	} else {
		FocusForm();
	}
}

	//очистка строки сообщения
function ClearForm() {
	top.submfr.document.forms['msgf'].msg.value='';
}

	//фокусирорвка на строке сообещния
function FocusForm() {
	top.submfr.document.forms['msgf'].msg.focus();
}
	//вывод сообщений
function printMsg(MsgMas) {
	var DivText='';
  	for(var i=0;i<MsgMas.length;i++) {
  		var Mas=MsgMas[i].split("::");
  		var Time=Mas[0];
		Time='<font color=#7f7f22>'+Time.charAt (0)+'</font><font color=#8c8c33>'+Time.charAt (1)+'</font><font color=#999944>'+Time.charAt (2)+'</font><font color=#a5a555>'+Time.charAt (3)+'</font><font color=#b2b266>'+Time.charAt (4)+'</font><font color=#bfbf77>'+Time.charAt (5)+'</font><font color=#cccc88>'+Time.charAt (6)+'</font><font color=#e5e5aa>'+Time.charAt (7)+'</font>';
  		var Stat=Mas[1];
  		var Nick=Mas[2];
  		var FontMas=Mas[3].split("|");
  		var Msg=Mas[4];

		switch (Stat) {
    			case 'J':
     			DivText+='<font class=sys>'+Msg+'</font><br>\n';
     			break;

    			case 'T':
			if(Msg==Usr) {
        			DivText+=top.ThmMas[2];
			}
     			break;

     			case 'A':
			var NickColStart=FontMas[0];
			var NickColEnd=FontMas[1];
			var GradNick=textGradient(Nick,NickColStart,NickColEnd);
     			DivText+='<div class=line><font class=sysmsg>~'+Time+'~</font><a href="javascript:;" onclick="top.setNick(\''+Nick+', \')" oncontextmenu="top.setNickC(\''+Nick+'\');return false;" class=nick>'+GradNick+'<font color=#cccc88>: </font></a><font color="'+FontMas[2]+'" face="'+FontMas[3]+'" style="font-weight:'+FontMas[4]+'; font-style: '+FontMas[5]+'">'+Msg+'</font></div>\n';
     			break;

     			case 'S':
     			DivText+='<font class=sysmsg>'+Msg+'</font><br>\n';
     			break;

     			case 'P':
			var NickColStart=FontMas[0];
			var NickColEnd=FontMas[1];
			var GradNick=textGradient(Nick,NickColStart,NickColEnd);
     			if(Nick!=Usr) {
     				DivText+='<div class=line><font class=sysmsg>~'+Time+'~</font><font class=sysmsg><font color=#e5e5aa>П</font><font color=#cccc88>р</font><font color=#bfbf77>и</font><FONT color=#b2b266>в</font><FONT color=#a5a555>а</font><FONT color=#999944>т</font><FONT color=#8c8c33>н</font><FONT color=#7f7f22>о</font></font> <a href="javascript:;" onclick="top.setNick(\''+Nick+', \');" oncontextmenu="top.setNickC(\''+Nick+'\');return false;" class=nick>'+GradNick+'</a><font class=sysmsg color=#cccc88>: </font><font color="'+FontMas[2]+'" face="'+FontMas[3]+'" class=my_msg style="font-weight:'+FontMas[4]+'; font-style: '+FontMas[5]+'"> '+Msg+'</font></div>\n';
     			} else {
     				DivText+='<div class=line><font class=sysmsg>~'+Time+'~</font><font class=sysmsg><font color=#e5e5aa>П</font><font color=#cccc88>р</font><font color=#bfbf77>и</font><FONT color=#b2b266>в</font><FONT color=#a5a555>а</font><FONT color=#999944>т</font><FONT color=#8c8c33>н</font><FONT color=#7f7f22>о</font></font> <a href="javascript:;" onclick="top.setNick(\''+Nick+', \');" oncontextmenu="top.setNickC(\''+Nick+'\');return false;" class=nick>'+GradNick+'</a><font class=sysmsg color=#cccc88>: </font><font color="'+FontMas[2]+'" face="'+FontMas[3]+'" style="font-weight:'+FontMas[4]+'; font-style: '+FontMas[5]+'">'+Msg+'</font></div>\n';
      			}
     			break;
        	}

  	}

	textfr.document.getElementById('text').innerHTML=DivText;

}
	//вывод ников
function printUsr(NickMas) {

	var DivNick='<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0><TBODY>';
	DivNick+='<TR><TD colSpan=3><DIV class=tm id=title align=center>СЕЙЧАС В ЧАТЕ: '+(NickMas.length)+'</DIV></TD></TR>';
	var BoyDivNick='<TR><TD colSpan=3><DIV class=bm>Парни:</DIV></TD></TR>';
	var GirlDivNick='<TR><TD colSpan=3><DIV class=gm>Девушки:</DIV></TD></TR>';
	var AnothDivNick='<TR><TD colSpan=3><DIV class=nm>Инкогнито:</DIV></TD></TR>';
	var bOn='0';var gOn='0';var nOn='0';
        for(var i=0;i<(NickMas.length);i++) {
    		var Nick=(NickMas[i][0].length>15)?(NickMas[i][0].substring(0,15)+'...'):(NickMas[i][0]);
    		if (NickMas[i][1]=='Н') {
			nOn='1';
    			AnothDivNick+='<TR><TD vAlign=center align=center width="12%"><a href="./whois.php?nick='+NickMas[i][0]+'" target="_blank"><img src=./img/i.gif title="Посмотреть информацию" border=0></a></TD><TD vAlign=center align=left width="88%" height=25><a href="javascript:;" onclick="top.setNick(\''+NickMas[i][0]+', \')" oncontextmenu="top.setNickC(\''+NickMas[i][0]+'\');return false;"  class=nnick title="'+NickMas[i][0]+'" id=fn>'+Nick+'</a></TD></TR>\n';
    		}
    		if (NickMas[i][1]=='М') {
			bOn='1';
			BoyDivNick+='<TR><TD vAlign=center align=center width="12%"><a href="./whois.php?nick='+NickMas[i][0]+'" target="_blank"><img src=./img/i.gif title="Посмотреть информацию" border=0></a></TD><TD vAlign=center align=left width="88%" height=25><a href="javascript:;" onclick="top.setNick(\''+NickMas[i][0]+', \')" oncontextmenu="top.setNickC(\''+NickMas[i][0]+'\');return false;"  class=mnick title="'+NickMas[i][0]+'" id=fn>'+Nick+'</a></TD></TR>\n';
    		}
    		if (NickMas[i][1]=='Ж') {
			gOn='1';
    			GirlDivNick+='<TR><TD vAlign=center align=center width="12%"><a href="./whois.php?nick='+NickMas[i][0]+'" target="_blank"><img src=./img/i.gif title="Посмотреть информацию" border=0></a></TD><TD vAlign=center align=left width="88%" height=25><a href="javascript:;" onclick="top.setNick(\''+NickMas[i][0]+', \')" oncontextmenu="top.setNickC(\''+NickMas[i][0]+'\');return false;"  class=fnick title="'+NickMas[i][0]+'" id=fn>'+Nick+'</a></TD></TR>\n';
    		}
    	}
	if (bOn=='1') {
		DivNick+=BoyDivNick;
	}
	if (gOn=='1') {
		DivNick+=GirlDivNick;
	}
	if (nOn=='1') {
		DivNick+=AnothDivNick;
	}
	DivNick+='</TBODY></TABLE></DIV>';
	DivNick+='</TBODY></TABLE>';
	if (usersfr.document.getElementById('nick')!=null) {
		usersfr.document.getElementById('nick').innerHTML=DivNick;
	}
}
	//обновление и скрол
function Refresh() {
	top.hidefr.location.href='msg.php';
	top.window.setTimeout('Refresh()', timeit);
}
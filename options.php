<?php
include "functions.php";				//Подключение файла функций
$Usr=NickFromSess();						//определяем $Usr
$title="$Usr:: Настройки";
?>
<script>
//Задается для куков
var Usr="<?=$Usr?>";
</script>
<script src="script.js" language="JavaScript"></script>
<script language="JavaScript">
	//получение radioValue
function getRadioGroupValue(radioGroupObj) {
	for (var i=0; i < radioGroupObj.length; i++)
	if (radioGroupObj[i].checked) return radioGroupObj[i].value;
	return null;
}
	//выполнение saveOptions()
function sendForm(t) {
	var MsgFace = getRadioGroupValue(document.options1.MsgFace);
	var MsgFontWeight = getRadioGroupValue(document.options1.MsgFontWeight);
	var MsgFontStyle = getRadioGroupValue(document.options1.MsgFontStyle);
	saveOptions(t.NickGradStrt.value,t.NickGradEnd.value,t.MsgColor.value,MsgFace,MsgFontWeight,MsgFontStyle);
	location.href='users.php';
}
	//функции палитры
s1 = s2 = true
function c ( x, y ) {
	var c = 256 / sc * (x % sc)
	switch (Math.floor (x / sc)) {
		case 0: R = 255; G = c; B = 0; break
		case 1: R = 255 - c; G = 255; B = 0; break
		case 2: R = 0; G = 255; B = c; break
		case 3: R = 0; G = 255 - c; B = 255; break
		case 4: R = c; G = 0; B = 255; break
		case 5: R = 255; G = 0; B = 255 - c; break
	}	
	if (y < 2 * sc) { var k = y / sc / 2; R *= k; G *= k; B *= k }
	else { var k = y / sc / 2 - 1; R += (255 - R) * k; G += (255 - G) * k; B += (255 - B) * k }
	return Hex (R) + Hex (G) + Hex (B)
}
function Hex ( B ) { Chars = "0123456789abcdef"; return Chars.charAt (B >> 4) + Chars.charAt (B & 0x0F) }
sc = 5
</script>
<?php
include ("skin/options.tpl");
?>
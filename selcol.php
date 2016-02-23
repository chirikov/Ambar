<?php
include ("head.php");
if($pass != $pass0 or !$pass or !$pass0) {print "<h1>Неверный пароль! Повторите ввод.</h1>";
exit;
}
?>
<h1>Выбор цвета</h1><br>
<h3>Выберите оттенок красного, зелёного и синего цветов и нажмите "ОК".</h3>
<br>
<form name="f1">
<select name="s1" class=name onfocus='id=className' onblur='id=1' onchange="fun()">
<option value="1">Выберите цвет
<?php
for($i1 = 255; $i1 >= 0; $i1 -= 1.5) {
	$i161 = dechex($i1);
	while(strlen($i161)<2) {
		$i161 = "0".$i161;
	}
	$color = $i161."0000";
	print "<option value='$i161' style='background-color: #$color;'>#$color\n";
}
print "</select> + <select name='s2' class=name onfocus='id=className' onblur='id=1' onchange='fun()'><option value='1'>Выберите цвет";
for($i1 = 255; $i1 >= 0; $i1 -= 1.5) {
	$i161 = dechex($i1);
	while(strlen($i161)<2) {
		$i161 = "0".$i161;
	}
	$color = "00".$i161."00";
	print "<option value='$i161' style='background-color: #$color;'>#$color\n";
}
print "</select> + <select name='s3' class=name onfocus='id=className' onblur='id=1' onchange='fun()'><option value='1'>Выберите цвет";
for($i1 = 255; $i1 >= 0; $i1 -= 1.5) {
	$i161 = dechex($i1);
	while(strlen($i161)<2) {
		$i161 = "0".$i161;
	}
	$color = "0000".$i161;
	print "<option value='$i161' style='background-color: #$color;'>#$color\n";
}
print "</select> = ";
?>

<input name="t1" type='Text' style="border: 1px; border-type: solid;" readonly="true">&nbsp;<input name="t2" readonly="true" type='Text' style="border: 1px; border-type: solid; background-color: '<?php print $conf['colors']['fon'] ?>';">
<br><br><br><input type="Button" value="OK" class="submit" onmouseover="id=className" onmouseout="id=''" onclick="cl()">
</form>
<script language="JavaScript">
function cl() {
if (f1.s1.value != 1 && f1.s2.value != 1 && f1.s3.value != 1) {
var what = "<?php print $what ?>";
if (what == "textcol") {
opener.fconf.textcol.value = "#" + f1.s1.value + f1.s2.value + f1.s3.value;
}
if (what == "bgcol") {
opener.fconf.bgcol.value = "#" + f1.s1.value + f1.s2.value + f1.s3.value;
}
if (what == "boutcol") {
opener.fconf.boutcol.value = "#" + f1.s1.value + f1.s2.value + f1.s3.value;
}
if (what == "bovcol") {
opener.fconf.bovcol.value = "#" + f1.s1.value + f1.s2.value + f1.s3.value;
}
if (what == "tblurcol") {
opener.fconf.tblurcol.value = "#" + f1.s1.value + f1.s2.value + f1.s3.value;
}
if (what == "tfoccol") {
opener.fconf.tfoccol.value = "#" + f1.s1.value + f1.s2.value + f1.s3.value;
}
if (what == "tbcol") {
opener.fconf.tbcol.value = "#" + f1.s1.value + f1.s2.value + f1.s3.value;
}
if (what == "nbcol") {
opener.fconf.nbcol.value = "#" + f1.s1.value + f1.s2.value + f1.s3.value;
}
self.close();
}
}
function fun() {
if (f1.s1.value != 1 && f1.s2.value != 1 && f1.s3.value != 1) {
f1.t1.style.backgroundColor = "#" + f1.s1.value + f1.s2.value + f1.s3.value;
f1.t2.value = "#" + f1.s1.value + f1.s2.value + f1.s3.value;
}
}
</script>

</body>
</html>

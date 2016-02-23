<?php include ("head.php");
if($pass != $pass0 or !$pass or !$pass0) {print "<h1>Неверный пароль! Повторите ввод.</h1>
<meta http-equiv='Refresh' content='2; url=index.php'>";
exit;
}?>
<h1>Создание нового поставщика</h1>
<br>
<h3>Итак, создадим нового поставщика. Для этого введите  в соответствующие поля известную Вам информацию.
Звёздочкой (*) отмечены поля, ОБЯЗАТЕЛЬНЫЕ для заполнения.</h3><br>
<form action="newpost.php">
<table class="hp">
<tr><td align="right">Имя поставщика : </td><td><input maxlength="50" size="50" type="Text" class=name onfocus='id=className' onblur='id=1' name="name" value="<?php print "$name"; ?>">*</td></tr>
<tr><td align="right">Телефон : </td><td><input maxlength="20" size="20" type="Text" class=name onfocus='id=className' onblur='id=1' name="phone" size="15" value="<?php print "$phone"; ?>&nbsp;"></td></tr>
<tr><td align="right">Адрес E-mail : </td><td><input maxlength="50" size="50" type="Text" class=name onfocus='id=className' onblur='id=1' name="mail" value="<?php print "$mail"; ?>&nbsp;"></td></tr>
<tr><td align="right">Адрес сайта : </td><td><input maxlength="50" size="50" type="Text" class=name onfocus='id=className' onblur='id=1' name="www" value="<?php print "$www"; ?>&nbsp;"></td></tr>
<tr><td align="right">Контактное лицо : </td><td><input maxlength="50" size="50" type="Text" class=name onfocus='id=className' onblur='id=1' name="contact" value="<?php print "$contact"; ?>&nbsp;"></td></tr>
</table><br>
<input class="submit" onmouseover="id=className" onmouseout="id=''" type="Submit" value="Всё правильно. Дальше." name="go">
</form><br>
<form action="prihod0.php">
<input type="Submit" class="submit" style="width: 400" onmouseover="id=className" onmouseout="id=''" value="Можно вернуться назад, пока не поздно" accesskey=','>
</form>
<?php
if(isset($go)){
if($name == "") {print "<br><br><h3>Имя поставщика-то Вы не ввели.</h3>"; exit;}
print "<h3>Итак:</h3>
<table class='hp'>
<tr><td align=right>Имя поставщика : </td><td><b>$name</b></td></tr>
<tr><td align=right>Телефон : </td><td><b>$phone</b></td></tr>
<tr><td align=right>Адрес E-mail : </td><td><b>$mail</b></td></tr>
<tr><td align=right>Адрес сайта : </td><td><b>$www</b></td></tr>
<tr><td align=right>Контактное лицо : </td><td><b>$contact</b></td></tr>
</table><br>
<h3>Всё правильно?</h3>
<form action='newpost.php'>
<input type='hidden' name='name' value='$name'>
<input type='hidden' name='phone' value='$phone'>
<input type='hidden' name='mail' value='$mail'>
<input type='hidden' name='www' value='$www'>
<input type='hidden' name='contact' value='$contact'>
<input class='submit' onmouseover='id=className' onmouseout='id=0' type='Submit' value='Да' name='go2'></form>
<h4>Если не всё правильно, просто измените информацию в синих окошках и нажмите 'Всё правильно. Дальше.'</h4>";
}
if(isset($go2)) {
$mysql = @mysql_connect($mconf['mysql']['host'], $mconf['mysql']['login'], $mconf['mysql']['password']) or die ("<font color='#ff0000'>Не получилось подключиться к серверу MySQL. Обратитесь к разработчику.</font>");
@mysql_select_db($mconf['mysql']['db']) or die("<font color='#ff0000'>Не получилось выбрать базу данных. Обратитесь к разработчику.</font>");

	$res33 = mysql_query("select name from postavsh");
	for($iii=0;$iii<mysql_num_rows($res33);$iii++) {
		$nname = mysql_result($res33, $iii, 'name');
		if($nname == $name) {print "<font color='#ff0000'>Поставщик с таким именем уже существует.</font>"; exit;}
	}

$query = "select id from postavsh";
$result = mysql_query($query);
$nn00 = mysql_num_rows($result);
if($nn00 < 1) {$n = 1;}
else {
	$ids2 = array();
	for($ids = 0; $ids < $nn00; $ids++) {$ids2[] = mysql_result($result, $ids, 'id');}
	$n = max($ids2);
	$n++;
}

$time = date("U");
$query2 = "insert into postavsh values($n, \"$name\", \"$phone\", \"$mail\", \"$www\", \"$contact\", $time)";
$result2 = mysql_query($query2);
if($result2 == false) {
print "<font color='#ff0000'>Не получилось создать нового поставщика. Обратитесь к разработчику.</font>"; exit;}
if($result2 == true) {
print "<h3>Поздравляю! Создание нового поставщика успешно закончилось.<br>
Пожалуйста, подождите.
<meta http-equiv=Refresh content='1; url=prihod0.php'";
}
mysql_close($mysql);
} ?>
</body>
</html>
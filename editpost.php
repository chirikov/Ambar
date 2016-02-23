<?php
include ("head.php");
if($pass != $pass0 or !$pass or !$pass0) {print "<h1>Неверный пароль! Повторите ввод.</h1>
<meta http-equiv='Refresh' content='2; url=index.php'>";
exit;
}
$mysql = @mysql_connect($mconf['mysql']['host'], $mconf['mysql']['login'], $mconf['mysql']['password']) or die ("<font color='#ff0000'>Не получилось подключиться к серверу MySQL. Обратитесь к разработчику.</font>");
@mysql_select_db($mconf['mysql']['db']) or die("<font color='#ff0000'>Не получается выбрать базу данных. Обратитесь к разработчику.</font>");
$query = "SELECT * FROM postavsh";
$result = mysql_query($query);
$n = mysql_num_rows($result);
?>
<h1>Корректировка информации о поставщиках</h1><br>
<br>
<h3>Выберите поставщика</h3><br>
<?php
if ($n == 0) {print "<b>В программе не зарегистрировано ни одного поставщика.</b>";
mysql_close($mysql);
print "
<br><br>
<form action=edit.php>
<input class=submit onmouseover='id=className' onmouseout='id=0' style='width: 430' type=submit value='Вернуться назад' accesskey=','>
</form>
</body>
</html>";
exit;}
?>
<table cellspacing="0" class="table">
<tr><th class="table">ID поставщика</th><th class="table">Имя поставщика</th>
<th class="table">Телефон</th><th class="table">E-mail</th><th class="table">Сайт</th>
<th class="table">Конт. лицо</th><th class="table">Последнее изменение</th></tr>
<?php
for($x=0;$x < $n;$x++) {
	$id[$x] = mysql_result($result, $x, 'id');
	$name[$x] = mysql_result($result, $x, 'name');
	$phone[$x] = mysql_result($result, $x, 'phone');
	$contact[$x] = mysql_result($result, $x, 'contact');
	$chang[$x] = mysql_result($result, $x, 'chang');
	$mail[$x] = mysql_result($result, $x, 'mail');
	$www[$x] = mysql_result($result, $x, 'www');
	print "<form action='editpost.php'>
	<input type='hidden' name='x2' value='$x'><tr>
	<th class='table'><input type='Submit' class='submit2' value='$id[$x]' name='go2'></th>
	<td class='table' align=center><input type='Submit' class='submit2' value='$name[$x]' name='go2'></td>
	<td class='table' align=center>$phone[$x]</td>
	<td class='table' align=center>$mail[$x]</td>
	<td class='table' align=center>$www[$x]</td>
	<td class='table' align=center>$contact[$x]</td>
	<td class='table' align=center>".date("d.m.Y, H:i", $chang[$x])."</td>
	</tr></form>";
}
?>
</table>
<?php
if(isset($go2)) {
print "<br><br><h2>Внесите любые изменения :</h2><br>
<form action='editpost.php'>
<input type=Hidden name='id2' value='$id[$x2]'>
<table class='hp'>
<tr><td align=right>Имя поставщика : </td><td><input type=Text size=50 maxlength=50 class=name onfocus='id=className' onblur='id=1' name='name2' value='$name[$x2]'></td></tr>
<tr><td align=right>Телефон : </td><td><input type=Text size=20 maxlength=20 class=name onfocus='id=className' onblur='id=1' name='phone2' value='$phone[$x2]'></td></tr>
<tr><td align=right>E-mail : </td><td><input type=Text size=50 maxlength=50 class=name onfocus='id=className' onblur='id=1' name='mail2' value='$mail[$x2]'></td></tr>
<tr><td align=right>Сайт : </td><td><input maxlength='50' size='50' type=Text class=name onfocus='id=className' onblur='id=1' name='www2' value='$www[$x2]'></td></tr>
<tr><td align=right>Контактное лицо : </td><td><input maxlength='50' size='50' type=Text class=name onfocus='id=className' onblur='id=1' name='contact2' value='$contact[$x2]'></td></tr>
</table><br>
<input type=submit value='Дальше' name='go3' class=submit onmouseover='id=className' onmouseout='id=0'>
</form>
";
}
if(isset($go3)) {
if(!$name2 or $name2 == " " or $name2 == "-") {print "<script language='JavaScript'> alert('Вы не ввели имя поставщика.'); setTimeout('window.history.back()', 10); </script>"; exit;}
if(!$phone2){$phone2 = $phone2."&nbsp;";}
if(!$www2){$www2 = $www2."&nbsp;";}
if(!$mail2){$mail2 = $mail2."&nbsp;";}
if(!$contact2){$contact2.= $contact2."&nbsp;";}
$result2 = mysql_query("delete from postavsh where id=$id2");;
if($result2 == false) {
	print "<font color='#ff0000'>Не удалось удалить старую запись. Обратитесь к разработчику.</font><br>".mysql_error();
	exit;
}
$time = date("U");
$result3 = mysql_query("insert into postavsh values($id2, \"$name2\", \"$phone2\", \"$mail2\", \"$www2\", \"$contact2\", $time)");
if($result3 == false) {
print "<font color='#ff0000'>Не получилось вставить запись. Обратитесь к разработчику.</font>".mysql_error(); exit;}
if($result3 == true) {
print "<h3>Поздравляю! Изменение информации успешно закончилось.<br>
Пожалуйста, подождите.
<meta http-equiv=Refresh content='1; url=editpost.php'>";
}
mysql_close($mysql);
}
?>
<br><br><br>
<form action="edit.php">
<input class="submit" onmouseover="id=className" onmouseout="id=''" type="Submit" value="Вернуться назад" accesskey=','>
</form>
</body>
</html>
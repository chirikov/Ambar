<?php include ("head.php");
if($pass != $pass0 or !$pass or !$pass0) {print "<h1>Неверный пароль! Повторите ввод.</h1>
<meta http-equiv='Refresh' content='2; url=index.php'>";
exit;
}?>
<h1>Создание новой группы товара</h1>
<br>
<h3>Итак, создадим новую группу. Для этого введите в поле имя группы.</h3><br>
<form action="newgrupp.php">
<input type="hidden" name="postid" value="<?php print "$postid"; ?>">
<table class="hp">
<tr><td align="right">Наименование группы : </td><td><input maxlength="50" size="50" type="Text" class=name onfocus='id=className' onblur='id=1' name="name" value="<?php print "$name"; ?>"></td></tr>
</table><br>
<input class="submit" onmouseover="id=className" onmouseout="id=''" type="Submit" value="Всё правильно. Дальше." name="go">
</form><br>
<form action="prihod1.php">
<input type="hidden" name="postid" value="<?php print "$postid"; ?>">
<input type="Submit" value="Можно вернуться назад, пока не поздно" class="submit" style="width: 350px;" onmouseover="id=className" onmouseout="id=''" accesskey=','>
</form>
<?php
if(isset($go)){
if($name == "") {
	print "<br><br><h3>Вы не ввели имя группы.</h3>";
	exit;
}
$mysql = @mysql_connect($mconf['mysql']['host'], $mconf['mysql']['login'], $mconf['mysql']['password']) or die ("<font color='#ff0000'>Не получилось подключиться к серверу MySQL. Обратитесь к разработчику.</font>");
@mysql_select_db($mconf['mysql']['db']) or die("<font color='#ff0000'>Не получилось выбрать базу данных. Обратитесь к разработчику.</font>");

	$res33 = mysql_query("select name from gruppy");
	for($iii=0;$iii<mysql_num_rows($res33);$iii++) {
		$nname = mysql_result($res33, $iii, 'name');
		if($nname == $name) {print "<font color='#ff0000'>Группа с таким именем уже существует.</font>"; exit;}
	}

$query = "select id from gruppy";
$result = mysql_query($query);
$nn00 = mysql_num_rows($result);
if($nn00 < 1) {$n = 1;}
else {
	$ids2 = array();
	for($ids = 0; $ids < $nn00; $ids++) {$ids2[] = mysql_result($result, $ids, 'id');}
	$n = max($ids2);
	$n++;
}

$query2 = "insert into gruppy values($n, \"$name\")";
$result2 = mysql_query($query2);
if($result2 == false) {
	print "<font color='#ff0000'>Не получилось создать новую группу. Обратитесь к разработчику.</font>";
	exit;
}
if($result2 == true) {
	header("Location: prihod1.php?postid=$postid");
}
mysql_close($mysql);
}?>
</body>
</html>

<?php include ("head.php");
include ($mconf['dir']['inc']."/functions.php");
if($pass != $pass0 or !$pass or !$pass0) {print "<h1>Неверный пароль! Повторите ввод.</h1>
<meta http-equiv='Refresh' content='2; url=index.php'>";
exit;
}
$mysql = @mysql_connect($mconf['mysql']['host'], $mconf['mysql']['login'], $mconf['mysql']['password']) or die ("<font color='#ff0000'>Не получилось подключиться к серверу MySQL. Обратитесь к разработчику.</font>");
@mysql_select_db($mconf['mysql']['db']) or die("<font color='#ff0000'>Не получилось выбрать базу данных. Обратитесь к разработчику.</font>");
?>
<h1>Списывание товаров по наименованию</h1>
<h3>Выберите группу товаров, к которой относится товар</h3><br>
<?php
$query = "select * from gruppy";
$result = mysql_query($query);
$n = mysql_num_rows($result);
if($n == 0) {
	print "<b>Не найдено ни одной группы товара.</b><br><br>
	<form action='prodano.php'>
	<input type=Submit value='Вернуться назад' class='submit' onmouseover='id=className' onmouseout=id='0' accesskey=','>
	</form>";
	exit;
}
else {
print "<table class='table' cellspacing='0'>";
	for($xx=0;$xx<$n;$xx++) {
		$p2 = mysql_result($result, $xx, 'name');
		$p[] = $p2;
	}
	sort($p, SORT_STRING);
	reset($p);
	for($x=0;$x<count($p);$x++) {
		print "<form action='prodanoname.php'><input type='hidden' name='x2' value='$x'>";
		print "<tr><td class='table' align='center'><input type='submit' name='go' class='submit3' value='$p[$x]'></td></tr></form>";
	}
}
?>
</table>
<br><br><form action="prodano.php">
<input type="Submit" value="Вернуться назад" class='submit' onmouseover='id=className' onmouseout=id='0' accesskey=','>
</form>
<?php
if (isset($go)) {
	$grupid = mysql_rus_search("gruppy", "name", $go, "id");
	print "<script language='JavaScript'>
	window.location = 'prodanoname2.php?grupid=$grupid';
	</script>";
}
mysql_close($mysql);
?>
</body>
</html>
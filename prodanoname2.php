<?php include ("head.php");
if($pass != $pass0 or !$pass or !$pass0) {print "<h1>Неверный пароль! Повторите ввод.</h1>
<meta http-equiv='Refresh' content='2; url=index.php'>";
exit;
}
$mysql = @mysql_connect($mconf['mysql']['host'], $mconf['mysql']['login'], $mconf['mysql']['password']) or die ("<font color='#ff0000'>Не получилось подключиться к серверу MySQL. Обратитесь к разработчику.</font>");
@mysql_select_db($mconf['mysql']['db']) or die("<font color='#ff0000'>Не получилось выбрать базу данных. Обратитесь к разработчику.</font>");
$query0 = "select * from gruppy where id=$grupid";
$result0 = mysql_query($query0);
$gruppa = mysql_result($result0, 0, 'name');
?>
<h1>Списывание товаров из группы <?php print "$gruppa" ?></h1>
<h3>Выберите товар</h3><br>
<?php
$query = "select * from naimen where gruppa=$grupid";
$result = mysql_query($query);
$n = mysql_num_rows($result);
if($n == 0) {
	print "<b>Не найдено товара в этой группе.</b><br><br>
	<form action='prodanoname.php'>
	<input type=Submit value='Вернуться назад' class='submit' onmouseover='id=className' onmouseout=id='0' accesskey=','>
	</form>";
	exit;
}
else {
	print "<table class='table' cellspacing='0'><tr><th class='table'>Артикул</th><th class='table'>Наименование</th><th class='table'>В наличии</th>";
	for($x=0;$x<$n;$x++) {
		$tid[$x] = mysql_result($result, $x, 'id');
		$name = mysql_result($result, $x, 'name');
		$article = mysql_result($result, $x, 'article');
		$coun = mysql_result($result, $x, 'count');
		print "<form action='prodanoname2.php'>
		<input type='hidden' name='x2' value='$x'>
		<input type=Hidden name='grupid' value='$grupid'>";
		print "<tr><td class='table'><input type='submit' name='go' class='submit2' value='$article'></td><td class='table'><input type='submit' name='go' class='submit2' value='$name'></td><td class='table'>$coun</td></tr></form>";
	}
	print "</table>";
}
if(isset($go)) {
print "<script language='JavaScript'>
var count = prompt('Сколько продано?', '1');
location = 'prodanoname2.php?grupid=$grupid&count='+count+'&go2=1&x2=$x2';
</script>
";
}
if(isset($go2)) {
if(!is_numeric($count) && $count != "null") {
	print "<script language='javascript'>alert('Вы ввели неверное число!');
	var count = prompt('Сколько продано?', '1');
	location = 'prodanoname2.php?grupid=$grupid&count='+count+'&go2=1&x2=$x2';
	</script>";
}
elseif($count == "null") {}
else {
	$res = mysql_query("select * from naimen where id=$tid[$x2]");
	$art = mysql_result($res, 0, 'article');
	$name = mysql_result($res, 0, 'name');
	$ed = mysql_result($res, 0, 'ed');
	$ocount = mysql_result($res, 0, 'count');
	$price = mysql_result($res, 0, 'price');
	$post = mysql_result($res, 0, 'post');
	$newcount = $ocount-$count;
	if($newcount < 0) {print "<font color='#ff0000'><h3>Вы продали больше, чем было на складе. Операция не выполнена.</h3></font><form action='prodanoname.php'>
	<input type=Submit value='Вернуться назад' class='submit' onmouseover='id=className' onmouseout=id='0' accesskey=','>
	</form>"; exit;}
	$res2 = mysql_query("delete from naimen where id=$tid[$x2]");
	if($res2 == false) {
		print "<font color='#ff0000'>Не удалось удалить старую запись. Обратитесь к разработчику.</font><br>".mysql_error();
		exit;
	}
	$time = date("U");
	$query6 = "insert into prodaja values(\"$art\", $count, $time)";
	$result6 = mysql_query($query6);
	$result2 = mysql_query("insert into naimen values($tid[$x2], '$art', \"$name\", \"$ed\", '$newcount', '$price', '$post', '$grupid', '$time')");
	if($result2 == false || !$result6) {print "<font color='#ff0000'>Не удалось вставить новую запись. Обратитесь к разработчику.</font><br>".mysql_error();; exit;}
	else {
		print "<h3>Поздравляю! Информация успешно сохранена.<br>
		Пожалуйста, подождите.
		<meta http-equiv='Refresh' content='1; url=prodanoname.php'>";
	}
}
}
?>
<br><br><form action="prodanoname.php">
<input type="Submit" value="Вернуться назад" class='submit' onmouseover='id=className' onmouseout=id='0' accesskey=','>
</form>
</body>
</html>

<?php include ("head.php");
if($pass != $pass0 or !$pass or !$pass0) {print "<h1>Неверный пароль! Повторите ввод.</h1>
<meta http-equiv='Refresh' content='2; url=index.php'>";
exit;
}
$mysql = @mysql_connect($mconf['mysql']['host'], $mconf['mysql']['login'], $mconf['mysql']['password']) or die ("<font color='#ff0000'>Не получилось подключиться к серверу MySQL. Обратитесь к разработчику.</font>");
@mysql_select_db($mconf['mysql']['db']) or die("<font color='#ff0000'>Не получилось выбрать базу данных. Обратитесь к разработчику.</font>");
$query3 = "SELECT * FROM gruppy";
$result3 = mysql_query($query3);
$n3 = mysql_num_rows($result3);
?>
<h1>Группы товаров</h1><br>
<h3>Список групп</h3><br>
<?php
if ($n3 == 0) {print "<b>В программе не зарегистрировано ни одной группы товара.</b>";
mysql_close($mysql);
print "
<br><br>
<form action=info.php>
<input class=submit onmouseover='id=className' onmouseout='id=0' style='width: 430' type=submit value='Вернуться к просмотру общей информации' accesskey=','>
</form>
</body>
</html>";
exit;}
?>
<table cellspacing="0" class="table">
<tr><th class="table">ID группы</th><th class="table">Название группы</th><th class="table">Наименований товаров</th>
<th class="table">Общая стоимость</th><th class="table">Последнее изменение</th></tr>

<?php
$query = "select * from gruppy";
$result = mysql_query($query);
$x = 0;
$n = mysql_num_rows($result);
while($x < $n) {
	$id = mysql_result($result, $x, 'id');
	$name = mysql_result($result, $x, 'name');
	
	$query2 = "select * from naimen where gruppa=$id";
	$result2 = mysql_query($query2);
	$naimen = mysql_num_rows($result2);
	
	$d = 0;
	$stoim = 0;
	while($d < $naimen) {
		$count = mysql_result($result2, $d, 'count');
		$price = mysql_result($result2, $d, 'price');
		$s = $count*$price;
		$stoim += $s;
		$d++;
	}

$changes = array();
$y = 0;
while($y < $naimen) {
$chang = mysql_result($result2, $y, 'chang');
$changes[] = $chang;
$y++;}
rsort($changes);
$chang = $changes[0];

$aaa = explode(".", $stoim);
while (strlen($aaa[1])<2){
$aaa[1] = $aaa[1]."0";
}
$stoim = implode(".", $aaa);

print "
<tr><th class='table'>$id</th><td class='table' align=center><a href='oprnaimen.php?grupid=$id' title='Просмотреть товары этой группы'>$name</a></td>
<td class='table' align=center>$naimen</td><td class='table' align=center>$stoim</td>
<td class='table' align=center>";
if($chang < 1) {$chang = "Не известно."; print $chang."</td></tr>";}
else {print date("d.m.Y, H:i", $chang)."</td></tr>";}
$x++;}
?>

</table>
<br><br>
<form action=info.php>
<input class=submit onmouseover='id=className' onmouseout='id=0' style='width: 430' type=submit value='Вернуться к просмотру общей информации' accesskey=','>
</form>
</center>
<?php mysql_close($mysql); ?>
</font>
</body>
</html>

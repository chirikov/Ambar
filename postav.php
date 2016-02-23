<?php include ("head.php");
if($pass != $pass0 or !$pass or !$pass0) {print "<h1>Неверный пароль! Повторите ввод.</h1>
<meta http-equiv='Refresh' content='2; url=index.php'>";
exit;
}
$mysql = @mysql_connect($mconf['mysql']['host'], $mconf['mysql']['login'], $mconf['mysql']['password']) or die ("<font color='#ff0000'>Не получилось подключиться к серверу MySQL. Обратитесь к разработчику.</font>");
@mysql_select_db($mconf['mysql']['db']) or die("<font color='#ff0000'>Не получается выбрать базу данных. Обратитесь к разработчику.</font>");
$query3 = "SELECT * FROM postavsh";
$result3 = mysql_query($query3);
$n3 = mysql_num_rows($result3);
?>
<h1>Поставщики</h1><br>
<h3>Список поставщиков</h3><br>
<?php
if ($n3 == 0) {print "<b>В программе не зарегистрировано ни одного поставщика.</b>";
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
<tr><th class="table">ID поставщика</th><th class="table">Имя поставщика</th><th class="table">Наименований товаров</th>
<th class="table">Общая стоимость</th><th class="table">Телефон</th><th class="table">E-mail</th><th class="table">Сайт</th>
<th class="table">Конт. лицо</th><th class="table">Последнее изменение</th></tr>
<?php
$query = "SELECT * FROM postavsh";
$result = mysql_query($query);
$x = 0;
$n = mysql_num_rows($result);
while($x < $n) {
$id = mysql_result($result, $x, 'id');
$name = mysql_result($result, $x, 'name');
$phone = mysql_result($result, $x, 'phone');
$contact = mysql_result($result, $x, 'contact');
$chang = mysql_result($result, $x, 'chang');
$mail = mysql_result($result, $x, 'mail');
$www = mysql_result($result, $x, 'www');

$query2 = "SELECT * FROM naimen WHERE post=$id";
$result2 = mysql_query($query2);
$m = mysql_num_rows($result2);
$naimen = $m;

$d = 0;
$stoim = 0;
while($d < $m) {
$count = mysql_result($result2, $d, 'count');
$price = mysql_result($result2, $d, 'price');
$s = $count*$price;
$stoim += $s;
$d++;}

$aaa = explode(".", $stoim);
while (strlen($aaa[1])<2){
$aaa[1] = $aaa[1]."0";
}
$stoim = implode(".", $aaa);

print "<tr><th class='table'>$id</th><td class='table' align=center>$name</td><td class='table' align=center>$naimen</td>
<td class='table' align=center>$stoim</td><td class='table' align=center>$phone</td><td class='table' align=center>$mail</td>
<td class='table' align=center>$www</td><td class='table' align=center>$contact</td><td class='table' align=center>
".date("d.m.Y, H:i", $chang)."</td></tr>";
$x++;}
?>
</table>
<br><br>
<form action=info.php>
<input class=submit onmouseover='id=className' onmouseout='id=0' style='width: 430' type=submit value='Вернуться к просмотру общей информации' accesskey=','>
</form>


<?php mysql_close($mysql); ?>
</body>
</html>

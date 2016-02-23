<?php include ("head.php");
if($pass != $pass0 or !$pass or !$pass0) {print "<h1>Неверный пароль! Повторите ввод.</h1>
<meta http-equiv='Refresh' content='2; url=index.php'>";
exit;
}
$mysql = @mysql_connect($mconf['mysql']['host'], $mconf['mysql']['login'], $mconf['mysql']['password']) or die ("<font color='#ff0000'>Не получилось подключиться к серверу MySQL. Обратитесь к разработчику.</font>");
@mysql_select_db($mconf['mysql']['db']) or die("<font color='#ff0000'>Не получилось выбрать базу данных. Обратитесь к разработчику.</font>");
$query4 = "SELECT * FROM naimen";
$result4 = mysql_query($query4);
$n3 = mysql_num_rows($result4);
?>
<h1>Наименования товаров</h1><br>
<h3>Список наименований всех товаров</h3><br>
<?php
if ($n3 == 0) {print "<b>В программе не зарегистрировано ни одного наименования товара.</b>";
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
<tr><th class="table">Артикул</th><th class="table">Название товара</th><th class="table">Един. изм.</th>
<th class="table">Цена</th><th class="table">Количество</th><th class="table">Общая стоимость</th>
<th class="table">Группа</th><th class="table">Поставщик</th><th class="table">Последнее изменение</th></tr>

<?php
$query = "select * from naimen";
$result = mysql_query($query);
$x = 0;
$n = mysql_num_rows($result);
while($x < $n) {
$article = mysql_result($result, $x, 'article');
$name = mysql_result($result, $x, 'name');
$ed = mysql_result($result, $x, 'ed');
$price = mysql_result($result, $x, 'price');
$count = mysql_result($result, $x, 'count');
$postid = mysql_result($result, $x, 'post');
$grupid = mysql_result($result, $x, 'gruppa');
$chang = mysql_result($result, $x, 'chang');

$query2 = "select * from gruppy where id=$grupid";
$result2 = mysql_query($query2);
$gruppa = mysql_result($result2, 0, 'name');

$query3 = "select * from postavsh where id=$postid";
$result3 = mysql_query($query3);
$postav34 = mysql_fetch_assoc($result3);
$postav = $postav34['name'];

$stoim = $price*$count;

$aaa = explode(".", $price);
while (strlen($aaa[1])<2){
$aaa[1] = $aaa[1]."0";
}
$price = implode(".", $aaa);

$aaa = explode(".", $stoim);
while (strlen($aaa[1])<2){
$aaa[1] = $aaa[1]."0";
}
$stoim = implode(".", $aaa);

print "
<tr><td class='table'><b>$article</b></th><td class='table'>$name</td><td class='table'>$ed</td>
<td class='table'>$price</td><td class='table'>$count</td><td class='table'>$stoim</td>
<td class='table'><a href=oprnaimen.php?grupid=$grupid title='Просмотреть товары группы $gruppa'>$gruppa</a></td>
<td class='table'>$postav</td><td class='table'>".date("d.m.Y, H:i", $chang)."</td></tr>";
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

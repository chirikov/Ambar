<?php include ("head.php");
if($pass != $pass0 or !$pass or !$pass0) {print "<h1>Неверный пароль! Повторите ввод.</h1>
<meta http-equiv='Refresh' content='2; url=index.php'>";
exit;
}
$mysql = @mysql_connect($mconf['mysql']['host'], $mconf['mysql']['login'], $mconf['mysql']['password']) or die ("<font color='#ff0000'>Не получилось подключиться к серверу MySQL. Обратитесь к разработчику.</font>");
@mysql_select_db($mconf['mysql']['db']) or die("<font color='#ff0000'>Не получилось выбрать базу данных. Обратитесь к разработчику.</font>");
$query2 = "select * from gruppy where id=$grupid";
$result2 = mysql_query($query2);
$gruppa = mysql_result($result2, 0, 'name');
$query4 = "select * from naimen where gruppa=$grupid";
$result4 = mysql_query($query4);
$n = mysql_num_rows($result4);
if($n < 1) {
	print "<br><br><h3>В группе пока нет ни одного товара.</h3><br>";
	print "<br><br>
<form action='naimen.php'>
<input type='Submit' class='submit' value='Вернуться к просмотру всех наименований' onmouseover='id=className' onmouseout='id=0'>
</form><br>
<form action='info.php'>
<input type=Submit class='submit' value='Вернуться к просмотру общей информации' onmouseover='id=className' onmouseout='id=0' accesskey=','>
</form>";
exit;
}
?>
<h1>Наименования товаров</h1><br>
<h3>Список наименований товаров группы <?php print "$gruppa"; ?></h3><br>

<table cellspacing="0" class="table">
<tr><th class="table">Артикул</th><th class="table">Название товара</th><th class="table">Един. изм.</th>
<th class="table">Цена</th><th class="table">Количество</th><th class="table">Общая стоимость</th>
<th class="table">Поставщик</th><th class="table">Последнее изменение</th></tr>

<?php
$query = "select * from naimen where gruppa=$grupid";
$result = mysql_query($query);
$x = 0;
$n = mysql_num_rows($result);
$allsumm = 0;
while($x < $n) {
$article = mysql_result($result, $x, 'article');
$name = mysql_result($result, $x, 'name');
$ed = mysql_result($result, $x, 'ed');
$price = mysql_result($result, $x, 'price');
$count = mysql_result($result, $x, 'count');
$post = mysql_result($result, $x, 'post');
$chang = mysql_result($result, $x, 'chang');

$query3 = "select * from postavsh where id=$post";
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

$allsumm += $stoim;

print "
<tr><td class='table'><b>$article</b></td>
<td class='table'>$name</td>
<td class='table'>$ed</td>
<td class='table'>$price</td>
<td class='table'>$count</td>
<td class='table'>$stoim</td>
<td class='table'>$postav</td>
<td class='table'>".date("d.m.Y, H:i", $chang)."</td></tr>";
$x++;}
$acount = $n;
$aaa = explode(".", $allsumm);
while (strlen($aaa[1])<2){
$aaa[1] = $aaa[1]."0";
}
$allsumm = implode(".", $aaa);
print "
<tr valign=bottom style='font-size: 20px;'><td height='50'>Итого : &nbsp;</td><td align=right>Количество товаров : </td><td>$acount</td><td colspan=2 align=right>Общая сумма : </td><td>$allsumm</td><td></td><td></td></tr>
";
?>

</table>
<br><br>
<form action="naimen.php">
<input type="Submit" class="submit" style="width: 400px" value="Вернуться к просмотру всех наименований" onmouseover="id=className" onmouseout="id=''">
</form><br><br>
<form action="info.php">
<input type="Submit" class="submit" style="width: 400px" value="Вернуться к просмотру общей информации" onmouseover="id=className" onmouseout="id=''" accesskey=','>
</form>


</center>
<?php mysql_close($mysql); ?>
</font>
</body>
</html>

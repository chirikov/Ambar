<?php include("head.php");
if($pass != $pass0 or !$pass or !$pass0) {print "<h1>Неверный пароль! Повторите ввод.</h1>
<meta http-equiv='Refresh' content='2; url=index.php'>";
exit;
}
$mysql = @mysql_connect($mconf['mysql']['host'], $mconf['mysql']['login'], $mconf['mysql']['password']) or die ("<font color='#ff0000'>Не получилось подключиться к серверу MySQL. Обратитесь к разработчику.</font>");
@mysql_select_db($mconf['mysql']['db']) or die("<font color='#ff0000'>Не получилось выбрать базу данных. Обратитесь к разработчику.</font>");

$query = "select * from postavsh";
$result = mysql_query($query);

$query2 = "select * from naimen";
$result2 = mysql_query($query2);

$query3 = "select * from gruppy";
$result3 = mysql_query($query3);

$postav = mysql_num_rows($result);
$naimen = mysql_num_rows($result2);
$grupp = mysql_num_rows($result3);
$x = 0;
$stoim = 0;
while($x < $naimen) {
$price = mysql_result($result2, $x, 'price');
$count = mysql_result($result2, $x, 'count');
$s = $price*$count;
$stoim += $s;
$x++;}
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
?>

<h1>Информация о складе</h1><br>
<br>
<h3>Общая:</h3>
<form action="info.php">
<table class="table" width="300" cellspacing="0">
<tr>
<th class="table"><input class='submit3' onmouseover='id=className' onmouseout='id=0' type=Submit name="go" value='Поставщиков' title="Просмотреть список поставщиков"></th><th class="table">&nbsp;<?php print "<font size='+1'>$postav</font>"; ?>&nbsp;</th></tr>
<tr><th class="table"><input title="Просмотреть список групп товаров" class='submit3' onmouseover='id=className' onmouseout='id=0' type=Submit name="go" value='Групп товаров'></th><th class="table">&nbsp;<?php print "<font size='+1'>$grupp</font>"; ?>&nbsp;</th></tr>
<tr><th class="table"><input title="Просмотреть список наименований товаров" class='submit3' onmouseover='id=className' onmouseout='id=0' type=Submit name="go" value='Наименований товаров'></th><th class="table">&nbsp;<?php print "<font size='+1'>$naimen</font>"; ?>&nbsp;</th></tr>
<tr><th class="table"><input title="Общая стоимость всех товаров" class='submit3' onmouseover='id=className' onmouseout='id=0' type=button style="cursor: default" value='Общая стоимость товаров'></th><th class="table">&nbsp;<?php print "<font size='+1'>$stoim</font>"; ?>&nbsp;</th>

</tr></table>
</form>
<br><br>
<form action="stat.php">
<input type="Submit" value="Приход / Продажа" class=submit onmouseover='id=className' onmouseout='id=0'>
</form>
<br><br>
<form action="main.php">
<input type="Submit" value="Вернуться на стартовую страницу" class=submit onmouseover='id=className' onmouseout='id=0' style='width: 430' accesskey=','>
</form>
</center>
<?php mysql_close($mysql); ?>
</font>
</body>
</html>
<?php
if (isset($go)) {
switch ($go) {
case "Поставщиков" :
header ("Location: postav.php");
break;
case "Групп товаров" :
header ("Location: grupp.php");
break;
case "Наименований товаров" :
header ("Location: naimen.php");
break;
}
}
?>

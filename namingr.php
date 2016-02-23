<?php include ("head.php");
if($pass != $pass0 or !$pass or !$pass0) {print "<h1>Неверный пароль! Повторите ввод.</h1>
<meta http-equiv='Refresh' content='2; url=index.php'>";
exit;
}
$mysql = @mysql_connect($mconf['mysql']['host'], $mconf['mysql']['login'], $mconf['mysql']['password']) or die ("<font color='#ff0000'>Не получилось подключиться к серверу MySQL. Обратитесь к разработчику.</font>");
@mysql_select_db($mconf['mysql']['db']) or die("<font color='#ff0000'>Не получается выбрать базу данных. Обратитесь к разработчику.</font>");
$r0 = mysql_query("select name from naimen");
$num0 = mysql_num_rows($r0);
if ($num0 == 0) {
	print "<br><br>
	<b>В программе не зарегистрировано ни одного товара.</b>";
	?>
	<form action="graph.php">
	<input type="Submit" value="Вернуться назад" class='submit' onmouseover='id=className' onmouseout=id='0' accesskey=','>
	</form>
	<?php
	;
	exit;
}
?>
<h1>Распределение товаров в группах</h1><br><br>
<img src='diagr.php?namingr=1' name="ambarimage">
<br><br>
<h3>Всего групп : <?php print mysql_num_rows(mysql_query("select id from gruppy")) ?>&nbsp;&nbsp; Всего товаров : <?php print $num0 ?></h3>
<br><br>
<form action="graph.php">
<input type="Submit" value="Вернуться назад" class='submit' onmouseover='id=className' onmouseout=id='0' accesskey=','>
</form>
</body>
</html>

<?php
include ("head.php");
include ($mconf['dir']['inc']."/functions.php");
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
<form action="main.php">
<input type="Submit" value="Вернуться на стартовую страницу" class='submit' onmouseover='id=className' onmouseout=id='0' accesskey=','>
</form>
<?php
;
exit;
}
?>

<h1>Списывание проданного товара</h1><br>
<h2>Как Вы хотите списывать товар?</h2><br><br>
<form action="prodanoart.php">
<input type="Submit" value="По артикулу" class='submit' onmouseover='id=className' onmouseout=id='0'>
</form>
<form action="prodanoname.php">
<input type="Submit" value="По наименованию" class='submit' onmouseover='id=className' onmouseout=id='0'>
</form>


<br><br><br>
<form action="main.php">
<input type="Submit" value="Вернуться на стартовую страницу" class='submit' onmouseover='id=className' onmouseout=id='0' accesskey=','>
</form>
</body>
</html>

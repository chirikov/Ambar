<?php include ("head.php");
if($pass != $pass0 or !$pass or !$pass0) {print "<h1>Неверный пароль! Повторите ввод.</h1>
<meta http-equiv='Refresh' content='2; url=index.php'>";
exit;
}
?>
<h1>Диаграммы</h1>
<br><h3>Что вы хотите отобразить в виде диаграммы?</h3><br><br>
<form action="namingr.php">
<input type="Submit" value="Распределение товаров по группам" class='submit' onmouseover='id=className' onmouseout=id='0'>
</form>
<br>
<form action="naminpos.php">
<input type="Submit" value="Распределение товаров по поставщикам" style="width: 400" class='submit' onmouseover='id=className' onmouseout=id='0'>
</form>
<br><br>
<form action="dop.php">
<input type="Submit" value="Вернуться назад" class='submit' onmouseover='id=className' onmouseout=id='0' accesskey=",">
</form>
</body>
</html>

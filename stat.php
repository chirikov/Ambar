<?php
include ("head.php");
if($pass != $pass0 or !$pass or !$pass0) {print "<h1>Неверный пароль! Повторите ввод.</h1>
<meta http-equiv='Refresh' content='2; url=index.php'>";
exit;
}
?>
<h1>Приход / Продажа</h1><br>
<h3>Что Вы хотите просмотреть?</h3><br>
<form action="stat101.php">
<input type="Submit" value="Продажу определённого товара" class=submit onmouseover='id=className' onmouseout='id=0' style='width: 430'>
</form>
<br><br>
<form action="stat201.php">
<input type="Submit" value="Приход определённого товара" class=submit onmouseover='id=className' onmouseout='id=0' style='width: 430'>
</form>
<br><br><br>
<form action="info.php">
<input type="Submit" value="Вернуться назад" class=submit onmouseover='id=className' onmouseout='id=0' style='width: 430' accesskey=','>
</form>
</body>
</html>

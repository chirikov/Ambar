<?php include ("head.php");
if($pass != $pass0 or !$pass or !$pass0) {print "<h1>Неверный пароль! Повторите ввод.</h1><br>
<meta http-equiv='Refresh' content='2; url=index.php'>";
exit;
}?>
<br><br>
<h2>Главное меню<br><br></h2>
<form action="prihod0.php">
<input class="submit" onmouseover="id=className" onmouseout="id=''" type="Submit" value="Вводить приход товара"></form>
<form action="prodano.php">
<input class="submit" onmouseover="id=className" onmouseout="id=''" type="Submit" value="Списывать проданный товар"></form>
<form action="info.php">
<input class="submit" onmouseover="id=className" onmouseout="id=''" type="Submit" value="Просматривать информацию"></form>
<form action="config.php">
<input class="submit" onmouseover="id=className" onmouseout="id=''" type="Submit" value="Изменять настройки"></form>
<form action="dop.php">
<input class="submit" onmouseover="id=className" onmouseout="id=''" type="Submit" value="Дополнительные функции"></form>
<br><br><br>
<form action="main.php">
<input class="submit" onmouseover="id=className" onmouseout="id=''" type="submit" name="restart" value="Перезапустить программу" accesskey='r'><br><br>
<input class="submit" onmouseover="id=className" onmouseout="id=''" type="submit" name="qexit" value="Выйти из программы" accesskey='w'></form>
<?php
if(isset($restart)) {
setcookie($cname, $pass0, time()-7200);
header("Location: index.php");
}
if(isset($qexit)) {
print "
<script language='JavaScript'>
window.close();
</script>
";
}

?>
</center>
<br><br><br><font size="-1">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php print $mconf['program']['copyright']; ?></font>
</font>
</body>
</html>

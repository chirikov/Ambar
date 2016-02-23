<?php
include ("head.php");
if($pass != $pass0 or !$pass or !$pass0) {print "<h1>Неверный пароль! Повторите ввод.</h1>
<meta http-equiv='Refresh' content='2; url=index.php'>";
exit;
}
?>
<h1>Изменение пароля</h1>
<h3>Проверьте язык раскладки клавиатуры и режим Caps Lock!</h3>
<table border="0">
<form action="changepass.php">
<tr><td align="right">Текущий пароль : </td><td><input type="password" name="nowpass" class=name onfocus='id=className' onblur='id=1'></td></tr>
<tr><td align="right">Новый пароль : </td><td><input type="password" name="newpass" class=name onfocus='id=className' onblur='id=1'></td></tr>
<tr><td align="right">Ещё раз новый пароль : </td><td><input type="password" name="newpass2" class=name onfocus='id=className' onblur='id=1'></td></tr>
</table>
<input type="Submit" value="Изменить" name="go" class="submit" onmouseover="id=className" onmouseout="id=''">
</form>
<?php
if(isset($go)){
	if(!$nowpass or !$newpass or !$newpass2) {print "Не все поля заполнены. Заполните все поля."; exit;}
	if(md5($nowpass) != $pass0) {print "Вы ввели неверный текущий пароль."; exit;}
	if($newpass != $newpass2) {print "Введённые пароли не совпадают."; exit;}
	$newpass1 = md5($newpass);
	$fp = $mconf['dir']['inc']."/pass.txt";
	$fp = fopen($fp, "w");
	fputs($fp, $newpass1);
	fclose($fp);
	setcookie($cname, $newpass1, time()+7200);
	print "<h2>Пароль изменён.<br><br>Подождите...</h2>
	<script language=javascript>
	opener.location = 'main.php?restart=1';
	setTimeout('self.close()', 500);
	</script>";
}
?>
</body>
</html>

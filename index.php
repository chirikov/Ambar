<?php
include ("head.php");
setcookie($cname, $pass0, time()-7200);
?>
<h1><?php include("hi.php") ?></h1>
<h3><br>
<br>Введите пароль:</h3><br>
<form action="index.php" name="p1">
<table>
<tr>
<td>
Пароль : <input type="password" name="pass1" class=name onfocus='id=className' onblur='id=1'></td></tr>
<tr><td>
<input type="Submit" class="submit" onmouseover="id=className" onmouseout="id=''" value="Дальше" style="width: 100%" name="go"><br><br>
<input type="button" class="submit" onmouseover="id=className" onmouseout="id=''" value="Выйти" style="width: 100%" onclick="window.close();">

</td></tr></table>
</form>
<script language="JavaScript">
p1.pass1.focus();
</script>

<?php
if(isset($go)) {
	if(!$pass1) {
		print "<b>Вы же ничего не ввели! Введите пароль.</b>
		<script language='JavaScript'>
		p1.pass1.focus();
		</script>";
		exit;
	}
	$passconf = file($mconf['dir']['inc']."/pass.txt");
	$pass0 = $passconf[0];
	if(trim($pass0) != md5($pass1)) {
		print "<b>Вы ввели неверный пароль. Попробуйте еще раз.</b>
		<script language='JavaScript'>
		p1.pass1.focus();
		</script>";
		exit;
	}
	else {
		$pass0 = rtrim($pass0);
		$pass = rtrim($pass1);
		$cname = rand(1000000, 9999999);
		setcookie("ambarcookie", $cname);
		setcookie($cname, $pass0);
		header("Location: main.php");
	}
}
?>
</body>
</html>

<?php include ("head.php");
include ($mconf['dir']['inc']."/functions.php");
if($pass != $pass0 or !$pass or !$pass0) {print "<h1>Неверный пароль! Повторите ввод.</h1>
<meta http-equiv='Refresh' content='2; url=index.php'>";
exit;
}
$mysql = @mysql_connect($mconf['mysql']['host'], $mconf['mysql']['login'], $mconf['mysql']['password']) or die ("<font color='#ff0000'>Не получилось подключиться к серверу MySQL. Обратитесь к разработчику.</font>");
@mysql_select_db($mconf['mysql']['db']) or die("<font color='#ff0000'>Не получилось выбрать базу данных. Обратитесь к разработчику.</font>");

$post = mysql_fetch_assoc(mysql_query("select * from postavsh where id=$postid"));
$post = $post["name"];
print "<h1>Приход товара от \"$post\"</h1><br>";
?>
<h3>Теперь, мама, выбери группу товаров, к которой относится товар ...</h3><br>
<?php
$query = "select * from gruppy";
$result = mysql_query($query);
$n = mysql_num_rows($result);
if($n == 0) { print "<b>Не найдено ни одной группы товара.</b><br>
<br><br>
<h3>... или создай новую.</h3><br>
<form action='newgrupp.php'>
<input type='Hidden' name='postid' value='$postid'>
<input class='submit' onmouseover='id=className' onmouseout='id=0' type='Submit' value='Создать новую группу' accesskey='n'></form>
<br><br></form><form action='prihod0.php'>
<input type=Submit value='Вернуться назад' class='submit' onmouseover='id=className' onmouseout=id='0' accesskey=','>
</form>
"; exit;}
else {
print "
<form action='prihod1.php' name='f11'>
<input type='Hidden' name='postid' value='$postid'>
<table cellspacing='0'><tr><td><select name='gruppa' onchange='javascript: f12.gruppa.value = f11.gruppa.value;' class=name onfocus='id=className' onblur='id=1' "; if(isset($go2)){print "disabled";} print ">";}
for($xx=0;$xx<$n;$xx++) {
$p2 = mysql_result($result, $xx, 'name');
$p[] = $p2;
}
sort($p, SORT_STRING);
reset($p);
foreach($p as $p) {
print "<option value='$p'>$p";
}
?>
</select>
</td></tr>
<tr><td><input class="submit" onmouseover="id=className" onmouseout="id=''" type="Submit" value="Вот эта" style="width: 100%" name="go" <?php if(isset($go2)){print "disabled";}?>>
</td></tr></table></form>
<?php if(!isset($go2)) { ?>
<br><br>
<h3>... или создай новую.</h3><br>
<form action="newgrupp.php">
<input type='Hidden' name='postid' value="<?php print "$postid"; ?>">
<input class="submit" onmouseover="id=className" onmouseout="id=''" type="Submit" value="Создать новую группу" accesskey='n'></form>
<br><br>
<h3>Можно также удалить выбранную группу.</h3><br>
<form action='prihod1.php' name="f12">
<input type='Hidden' name='postid' value='<?php print "$postid" ?>'>
<input type='Hidden' name='gruppa' value='1'>
<input class='submit' onmouseover='id=className' onmouseout='id=0' type='Submit' value='Удалить группу' name='go2'></form>
<script language="JavaScript">
javascript: f12.gruppa.value = f11.gruppa.value;
</script>
<br><br><form action="prihod0.php">
<input type="Submit" value="Вернуться назад" class='submit' onmouseover='id=className' onmouseout=id='0' accesskey=','>
</form>
<?php } else {print "";}
if (isset($go)) {
	$grupid = mysql_rus_search("gruppy", "name", $gruppa, "id");
	header("Location: prihod.php?postid=$postid&grupid=$grupid");
}
if(isset($go2)) {
$grupid = mysql_rus_search("gruppy", "name", $gruppa, "id");
print "<h2>Внимание!!!</h2><br><h3>Будет удалена ВСЯ информация, касающаяся всех товаров, относящихся к группе $gruppa. Продолжить?
<form action='prihod1.php'>
<input type='Hidden' name='postid' value='$postid'>
<input type='Hidden' name='grupid' value='$grupid'>
<input class=submit onmouseover='id=className' onmouseout='id=0' type='Submit' value='Да' name=go3 style='width: 100'>
<input class=submit onmouseover='id=className' onmouseout='id=0' type='Submit' value='Нет' name=go4 style='width: 100'>
</form>";}
if (isset($go4)) {header ("Location: prihod1.php?postid=$postid");}
if (isset($go3)) {

$query5 = "select * from naimen where gruppa=$grupid";
$result5 = mysql_query($query5);
$fgh = mysql_num_rows($result5);
if ($fgh > 0) {
	$query4 = "delete from naimen where gruppa=$grupid";
	$result4 = mysql_query($query4);
	if(!$result4) {
		print "<font color='#ff0000'>Не удалось удалить товары группы. Обратитесь к разработчику.</font>";
		exit;
	}
}
$query2 = "delete from gruppy where id=$grupid";
$result2 = mysql_query($query2);
if(!$result2) {print "<font color='#ff0000'>Не удалось удалить группу. Обратитесь к разработчику.</font>"; exit;}
print "<form action='prihod1.php' name='ff'>
<input type='Hidden' name='postid' value='$postid'>
</form>
<script language='JavaScript'>
document.ff.submit();
</script>";
}
?>
<?php mysql_close($mysql); ?>
</body>
</html>
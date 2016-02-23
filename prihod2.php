<?php include ("head.php");
include ($mconf['dir']['inc']."/functions.php");
if($pass != $pass0 or !$pass or !$pass0) {print "<h1>Неверный пароль! Повторите ввод.</h1>
<meta http-equiv='Refresh' content='2; url=index.php'>";
exit;
}

$mysql = @mysql_connect($mconf['mysql']['host'], $mconf['mysql']['login'], $mconf['mysql']['password']) 
or die ("<font color='#ff0000'>Не получилось подключиться к серверу MySQL. Обратитесь к разработчику.</font>");
@mysql_select_db($mconf['mysql']['db']) or die("<font color='#ff0000'>Не получается выбрать базу данных. Обратитесь к разработчику.</font>");
$gruppa = mysql_fetch_assoc(mysql_query("select * from gruppy where id=$grupid"));
$gruppa = $gruppa["name"];
$post = mysql_fetch_assoc(mysql_query("select * from postavsh where id=$postid"));
$post = $post["name"];

print "<h1>Приход товара от \"$post\"<br>
в группу $gruppa.</h1><br>";
$query1 = "select * from naimen where id=$tid";
$result1 = mysql_query($query1);
$mystr = mysql_fetch_assoc($result1);
$name = $mystr['name'];
$ed = $mystr['ed'];
$price = $mystr['price'];
$article = $mystr['article'];
$postid3 = $mystr['post'];
$fp = $mconf['dir']['inc']."/ed.txt";
$eda = file($fp);
$fg = count($eda);

print "<h3>Вносим изменения:</h3>
(можно изменять все поля)
<form action=prihod2.php>
<input type=Hidden name='tid' value='$tid'>
<input type=Hidden name='postid' value='$postid'>
<input type=Hidden name='grupid' value='$grupid'>
<table class='hp'>
<tr><td align=right>Сколько пришло : </td><td><input type=Text size=4 maxlength=4 class=name onfocus='id=className' onblur='id=1' name='newcount' value='$newcount'></td></tr>
<tr><td align=right>Единица измерения : </td><td><select name='ed2' class=name onfocus='id=className' onblur='id=1'>";
$edn = array_search($ed, $eda);
print "<option value='$eda[$edn]'>$eda[$edn]";
foreach ($eda as $edan) {
	if ($edan == $eda[$edn]) continue;
	print "<option value='$edan'>$edan";
}
print "</select></td></tr>
<tr><td align=right>Цена : </td><td><input type=Text size=9 maxlength=9 class=name onfocus='id=className' onblur='id=1' name='price2' value='$price'></td></tr>
<tr><td align=right>Артикул : </td><td><input maxlength='50' size='50' type=Text class=name onfocus='id=className' onblur='id=1' name='article2' value='$article'></td></tr>
<tr><td align=right>Наименование : </td><td><input maxlength='50' size='50' type=Text class=name onfocus='id=className' onblur='id=1' name='name2' value='$name'></td></tr>
<tr><td align=right>Группа : </td><td><select class=name onfocus='id=className' onblur='id=1' name='gruppa2'>";
print "<option value='$gruppa'>$gruppa";
$query2 = "select name from gruppy";
$result2 = mysql_query($query2);
for($gri=0;$gri<mysql_num_rows($result2);$gri++){
	$grupp = mysql_result($result2, $gri, 'name');
if ($grupp == $gruppa) continue;
print "<option value='$grupp'>$grupp";}
print "</select>
</td></tr>
<tr><td align=right>Поставщик : </td><td><select class=name onfocus='id=className' onblur='id=1' name='post2'>";
$post3 = mysql_fetch_assoc(mysql_query("select * from postavsh where id=$postid3"));
$post3 = $post3["name"];
print "<option value='$post3'>$post3";
$query = "select name from postavsh";
$result = mysql_query($query);
for($posi=0;$posi<mysql_num_rows($result);$posi++){
	$postn = mysql_result($result, $posi, 'name');
	if ($postn == $post3) continue;
	else {print "<option value='$postn'>$postn";}
}
print "</select></td></tr>
</table><br>
<input class='submit' onmouseover='id=className' onmouseout=id='0' type=Submit value='Изменения внесены' style='width: 200' name=go3>
</form>";
print "<br><br>
<form action='prihod2.php'>
<input type='Hidden' name='postid' value='$postid'>
<input type='Hidden' name='grupid' value='$grupid'>
<input type=Hidden name='tid' value='$tid'>
<input type='Submit' class='submit' onmouseover='id=className' onmouseout='id=0' name=del value='Удалить данный товар'>
</form>
<br><br>";
print "<form action='prihod.php'>
<input type='Hidden' name='postid' value='$postid'>
<input type='Hidden' name='grupid' value='$grupid'>
<input class='submit' onmouseover='id=className' onmouseout='id=0' type='Submit' value='Вернуться к выбору товаров' style='width: 400' accesskey=','>
</form>";
if(isset($go3)) {
if(!$article2) {print "Артикул-то, однако, ввести надо."; exit;}
	if($name2 == "") {print "Наименование-то, однако, ввести надо."; exit;}
	if(!$price2 or !is_numeric($price2)) {
		if(!strstr($price2, ",")) {print "Цену-то, однако, ввести надо."; exit;}
		else {
			$zz = explode(",", $price2);
			if(!is_numeric($zz[0]) or !is_numeric($zz[1])) {print "Цену-то, однако, ввести надо."; exit;}
		}
	}
	if(strstr($price2, ".") || strstr($price2, ",")) {
		$price2 = ereg_replace(",", ".", $price2);
		$aaa = explode(".", $price);
		while (strlen($aaa[1])<2){$aaa[1] .= "0";}
		$price2 = implode(".", $aaa);
	}
	else $price2 = $price2.".00";
print "
<form name='fff1' action='prihod2.php'>
<input type='Hidden' name='postid' value='$postid'>
<input type='Hidden' name='grupid' value='$grupid'>
<input type='Hidden' name='newcount' value='$newcount'>
<input type='Hidden' name='name2' value='$name2'>
<input type='Hidden' name='article2' value='$article2'>
<input type='Hidden' name='price2' value='$price2'>
<input type='Hidden' name='ed2' value='$ed2'>
<input type='Hidden' name='tid' value='$tid'>
<input type='Hidden' name='ggg' value='1'>
<input type='Hidden' name='gruppa2' value='$gruppa2'>
<input type='Hidden' name='post2' value='$post2'>
</form>
<script language='javascript'>
var asd = confirm('Вы уверены, что всё правильно?');
if (asd == true) {
document.fff1.submit();
}
</script>";
}
if(isset($ggg)) {
	$grupid2 = mysql_rus_search('gruppy', 'name', $gruppa2, 'id');
	$postid2 = mysql_rus_search('postavsh', 'name', $post2, 'id');
	$query6 = "select * from naimen where id=$tid";
	$result6 = mysql_query($query6);
	$count0 = mysql_result($result6, 0, 'count');
	
	$count2 = $count0 + $newcount;
	
	$query4 = "delete from naimen where id=$tid";
	$result4 = mysql_query($query4);
	if (!$result4) {print "<font color='#ff0000'>Не удалось удалить старую запись. Обратитесь к разработчику.</font><br>".mysql_error(); exit;}
	else {
		$time = date("U");
		$query5 = "insert into naimen values($tid, \"$article2\", \"$name2\", \"$ed2\", $count2, $price2, $postid2, $grupid2, $time)";
		$result5 = mysql_query($query5);
		$result9 = mysql_query("insert into prihod values(\"$article2\", $newcount, $time)");
		if (!$result5) {print "<font color='#ff0000'>Не удалось вставить новую запись. Обратитесь к разработчику.</font><br>".mysql_error(); exit;}
		else {
			print "<h3>Поздравляю! Информация успешно сохранена.<br>
			Пожалуйста, подождите.
			<meta http-equiv='Refresh' content='1; url=prihod.php?grupid=$grupid&postid=$postid'>";
		}
	}
}
if(isset($del)) {
$result7 = mysql_query("select * from naimen where id=$tid");
$name = mysql_result($result7, '0', 'name');
print "
<form name='fff2' action='prihod2.php'>
<input type='Hidden' name='postid' value='$postid'>
<input type='Hidden' name='grupid' value='$grupid'>
<input type='Hidden' name='tid' value='$tid'>
<input type='Hidden' name='ggf' value='1'>
</form>
<script language='javascript'>
var asd = confirm('Вы действительно хотите удалить ВСЮ информацию, касающуюся товара \"$name\"?');
if (asd == true) {
document.fff2.submit();
}
</script>";
}
if(isset($ggf)) {
	$query8 = "delete from naimen where id=$tid";
	$result8 = mysql_query($query8);
	if($result8 == false) {
		print "<font color='#ff0000'>Не удалось удалить старую запись. Обратитесь к разработчику.</font><br>".mysql_error();
		exit;
	}
	else {
		print "<h3>Запись успешно удалена.<br><br>
		Пожалуйста, подождите.
		<meta http-equiv='Refresh' content='1; url=prihod.php?grupid=$grupid&postid=$postid'>";
	}
}
?>

</body></html>
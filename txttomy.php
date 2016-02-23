<?php
include ("head.php");
include ($mconf['dir']['inc']."/functions.php");
if($pass != $pass0 or !$pass or !$pass0) {print "<h1>Неверный пароль! Повторите ввод.</h1>
<meta http-equiv='Refresh' content='2; url=index.php'>";
exit;
}
?>
<h1>Ввод информации из текстовых файлов</h1>
<br>
<h3>Выберите, какую информацию Вы хотели бы копировать из текстовых файлов и укажите их расположение.</h3>
<script language="JavaScript">
function changef1(){
if(f1.naimen.checked == true) {f1.nfile.disabled = false; f1.s1.disabled = false; f1.act.disabled = false}
if(f1.naimen.checked == false){f1.nfile.disabled = true;
if(f1.gruppy.checked == false && f1.postavsh.checked == false) {f1.s1.disabled = true; f1.act.disabled = true}
}
}
function changef2(){
if(f1.gruppy.checked == true) {f1.gfile.disabled = false; f1.s1.disabled = false; f1.act.disabled = false}
if(f1.gruppy.checked == false){f1.gfile.disabled = true;
if(f1.naimen.checked == false && f1.postavsh.checked == false) {f1.s1.disabled = true; f1.act.disabled = true}
}
}
function changef3(){
if(f1.postavsh.checked == true) {f1.pfile.disabled = false; f1.s1.disabled = false; f1.act.disabled = false}
if(f1.postavsh.checked == false){f1.pfile.disabled = true;
if(f1.gruppy.checked == false && f1.naimen.checked == false) {f1.s1.disabled = true; f1.act.disabled = true}
}
}
</script>
<form action="txttomy.php" name="f1">
<table>
<tr><td><input type="Checkbox" name="naimen" class=name onfocus='id=className' onblur='id=1' onclick="javascript: changef1();"></td><td>О товарах</td></tr>
<tr><td></td><td>Файл : <input size="30" disabled type="file" name="nfile" value="<?php print "$nfile" ?>" class=name onfocus='id=className' onblur='id=1'> &nbsp;<input type="button" name="h1" style="width: 30;" title="Подсказка" value=" ? " class="submit" onmouseover="id=className" onmouseout="id=''" onclick="
javascript:
alert('Подсказка: Вы  указать должны указать только файлы, созданные программой `<?php print $mconf['program']['name'] ?>` начиная с версии 2.3.');
"><br><br></td></tr>
<tr><td><input type="Checkbox" name="gruppy" class=name onfocus='id=className' onblur='id=1' onclick="javascript: changef2();"></td><td>О группах товаров</td></tr>
<tr><td></td><td>Файл : <input size="30" disabled type="file" name="gfile" value="<?php print "$gfile" ?>" class=name onfocus='id=className' onblur='id=1'><br><Br></td></tr>
<tr><td><input type="Checkbox" name="postavsh" class=name onfocus='id=className' onblur='id=1' onclick="javascript: changef3();"></td><td>О поставщиках</td></tr>
<tr><td></td><td>Файл : <input size="30" disabled type="file" name="pfile" value="<?php print "$pfile" ?>" class=name onfocus='id=className' onblur='id=1'></td></tr>
</table>
<br><br>
<h3>Что делать при совпадении имён поставщиков/названий групп/артикулов товаров?</h3><br>
<select name="act" class=name onfocus='id=className' onblur='id=1' disabled>
<option value="change">Заменять
<option value="leave">Не трогать
</select>
<br><br>
<input type="Submit" name="s1" value="Дальше" class="submit" onmouseover="id=className" onmouseout="id=''" disabled>
</form>
<?php
if(isset($s1)) {
if($naimen && !$nfile) {print "Вы не ввели имя файла для сохранения информации о товарах.<br><br>
<form action='dop.php'>
<input class='submit' onmouseover='id=className' onmouseout='id=0' type='Submit' value='Вернуться назад'>
</form>"; exit;}
if($gruppy && !$gfile) {print "Вы не ввели имя файла для сохранения информации о группах товаров.<br><br>
<form action='dop.php'>
<input class='submit' onmouseover='id=className' onmouseout='id=0' type='Submit' value='Вернуться назад'>
</form>"; exit;}
if($postavsh && !$pfile) {print "Вы не ввели имя файла для сохранения информации о поставщиках.<br><br>
<form action='dop.php'>
<input class='submit' onmouseover='id=className' onmouseout='id=0' type='Submit' value='Вернуться назад'>
</form>"; exit;}
$mysql = @mysql_connect($mconf['mysql']['host'], $mconf['mysql']['login'], $mconf['mysql']['password']) or die ("<font color='#ff0000'>Не получилось подключиться к серверу MySQL. Обратитесь к разработчику.</font>");
@mysql_select_db($mconf['mysql']['db']) or die("<font color='#ff0000'>Не получилось выбрать базу данных. Обратитесь к разработчику.</font>");

if(isset($naimen)) {
$names = @file($nfile) or die("<font color='#ff0000'><h3>Не удалось открыть файл с товарами. Проверьте путь к файлу.</h3></font><br><form action='dop.php'>
<input class='submit' onmouseover='id=className' onmouseout='id=0' type='Submit' value='Вернуться назад' accesskey=','>
</form>");
foreach($names as $string) {
	if(substr($string, 0, 1) != "|") {continue;}
	$comp = explode("|", $string);
	if($act == "leave") {
		if(mysql_rus_search('naimen', 'article', trim($comp[1]), 'id')){continue;}
	}
	$q1 = "select id from naimen";
	$r1 = mysql_query($q1);
	if(mysql_num_rows($r1) < 1) {
		$nt = 1;
	}
	else {
		$ids2 = array();
		for($nnm=0;$nnm<mysql_num_rows($r1);$nnm++){
			$ids2[] = mysql_result($r1, $nnm, 'id');
		}
		$nt = max($ids2);
		$nt++;
	}
	if(mysql_rus_search('naimen', 'article', trim($comp[1]), 'id')) {
		$tid = mysql_rus_search('naimen', 'article', trim($comp[1]), 'id');
		$r12 = mysql_query("delete from naimen where id=$tid");
		if($r12 == false) {
			print "<font color='#ff0000'>Не получилось удалить старую запись. Обратитесь к разработчику.</font>"; exit;
		}
	}
	$time = date("U");
	$post = mysql_rus_search('postavsh', 'name', trim($comp[8]), 'id');
	if($post == false) {
		$pname = trim($comp[8]);
		$q1 = "select id from postavsh";
		$r1 = mysql_query($q1);
		if(mysql_num_rows($r1) < 1) {
			$nt = 1;
		}
		else {
			$ids2 = array();
			for($nnm=0;$nnm<mysql_num_rows($r1);$nnm++){
				$ids2[] = mysql_result($r1, $nnm, 'id');
			}
			$nt = max($ids2);
			$nt++;
		}
		$query2 = "insert into postavsh values($nt, \"$pname\", \" \", \" \", \" \", \" \", $time)";
		$result2 = mysql_query($query2);
		if($result2 == false) {
			print "<font color='#ff0000'>Не получилось создать временного поставщика. Обратитесь к разработчику.</font>";
			exit;
		}
		else {$post = $nt;}
	}
	$gruppa = mysql_rus_search('gruppy', 'name', trim($comp[7]), 'id');
	if($gruppa == false) {
		$pname = trim($comp[7]);
		$q1 = "select id from gruppy";
		$r1 = mysql_query($q1);
		if(mysql_num_rows($r1) < 1) {
			$nt = 1;
		}
		else {
			$ids2 = array();
			for($nnm=0;$nnm<mysql_num_rows($r1);$nnm++){
				$ids2[] = mysql_result($r1, $nnm, 'id');
			}
			$nt = max($ids2);
			$nt++;
		}
		$query2 = "insert into gruppy values($nt, \"$pname\")";
		$result2 = mysql_query($query2);
		if($result2 == false) {
			print "<font color='#ff0000'>Не получилось создать временную группу. Обратитесь к разработчику.</font>";
			exit;
		}
		else {$gruppa = $nt;}
	}
	$times = $comp[9];
	$day = substr($times, 0, 2);
	$mon = substr($times, 3, 5);
	$year = substr($times, 6, 10);
	$hour = substr($times, 12, 14);
	$min = substr($times, 15, 17);
	$tim = mktime($hour, $min, 0, $mon, $day, $year);
	$res = mysql_query("insert into naimen values($nt, \"$comp[1]\", \"$comp[2]\", \"$comp[3]\", $comp[5], $comp[4], $post, $gruppa, $tim)");
}
}

if(isset($gruppy)) {
$names = @file($gfile) or die("<font color='#ff0000'><h3>Не удалось открыть файл с группами. Проверьте путь к файлу.</h3></font><br><form action='dop.php'>
<input class='submit' onmouseover='id=className' onmouseout='id=0' type='Submit' value='Вернуться назад' accesskey=','>
</form>");
foreach($names as $string) {
	if(substr($string, 0, 1) != "|") {continue;}
	$comp = explode("|", $string);
	if($act == "leave") {
		if(mysql_rus_search('gruppy', 'name', trim($comp[1]), 'id')){continue;}
	}
	$q1 = "select id from gruppy";
	$r1 = mysql_query($q1);
	if(mysql_num_rows($r1) < 1) {
		$nt = 1;
	}
	else {
		$ids2 = array();
		for($nnm=0;$nnm<mysql_num_rows($r1);$nnm++){
			$ids2[] = mysql_result($r1, $nnm, 'id');
		}
		$nt = max($ids2);
		$nt++;
	}
	if(mysql_rus_search('gruppy', 'name', trim($comp[1]), 'id')) {
		$tid = mysql_rus_search('gruppy', 'name', trim($comp[1]), 'id');
		$r12 = mysql_query("delete from gruppy where id=$tid");
		if($r12 == false) {
			print "<font color='#ff0000'>Не получилось удалить старую запись. Обратитесь к разработчику.</font>"; exit;
		}
	}
	$res = mysql_query("insert into gruppy values($nt, \"$comp[1]\")");
}
}

if(isset($postavsh)) {
$names = @file($pfile) or die("<font color='#ff0000'><h3>Не удалось открыть файл с поставщиками. Проверьте путь к файлу.</h3></font><br><form action='dop.php'>
<input class='submit' onmouseover='id=className' onmouseout='id=0' type='Submit' value='Вернуться назад' accesskey=','>
</form>");
foreach($names as $string) {
	if(substr($string, 0, 1) != "|") {continue;}
	$comp = explode("|", $string);
	if($act == "leave") {
		if(mysql_rus_search('postavsh', 'name', trim($comp[1]), 'id')){continue;}
	}
	$q1 = "select id from postavsh";
	$r1 = mysql_query($q1);
	if(mysql_num_rows($r1) < 1) {
		$nt = 1;
	}
	else {
		$ids2 = array();
		for($nnm=0;$nnm<mysql_num_rows($r1);$nnm++){
			$ids2[] = mysql_result($r1, $nnm, 'id');
		}
		$nt = max($ids2);
		$nt++;
	}
	if(mysql_rus_search('postavsh', 'name', trim($comp[1]), 'id')) {
		$tid = mysql_rus_search('postavsh', 'name', trim($comp[1]), 'id');
		$r12 = mysql_query("delete from postavsh where id=$tid");
		if($r12 == false) {
			print "<font color='#ff0000'>Не получилось удалить старую запись. Обратитесь к разработчику.</font>"; exit;
		}
	}
	$time = date("U");
	$res = mysql_query("insert into postavsh values($nt, \"$comp[1]\", \"$comp[2]\", \"$comp[3]\", \"$comp[4]\", \"$comp[5]\", $time)");
}
}

print "<h3>Операция завершена успешно.<br></h3>
Внимание! Проверьте информацию с помощью меню \"Просмотр информации\"!<br>
Возможно, автоматически были созданы некоторые группы и поставщики.";
mysql_close($mysql);
}
?>
<br><br>
<form action="dop.php">
<input class="submit" onmouseover="id=className" onmouseout="id=''" type="Submit" value="Вернуться назад" accesskey=','>
</form>
</body>
</html>

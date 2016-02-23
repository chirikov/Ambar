<?php include ("head.php");
include ($mconf['dir']['inc']."/functions.php");
if($pass != $pass0 or !$pass or !$pass0) {print "<h1>Неверный пароль! Повторите ввод.</h1>
<meta http-equiv='Refresh' content='2; url=index.php'>";
exit;
}
$mysql = @mysql_connect($mconf['mysql']['host'], $mconf['mysql']['login'], $mconf['mysql']['password']) or die ("<font color='#ff0000'>Не получилось подключиться к серверу MySQL. Обратитесь к разработчику.</font>");
@mysql_select_db($mconf['mysql']['db']) or die("<font color='#ff0000'>Не получилось выбрать базу данных. Обратитесь к разработчику.</font>");
$query0 = "select * from gruppy where id=$grupid";
$result0 = mysql_query($query0);
$gruppa = mysql_result($result0, 0, 'name');
$name = mysql_result(mysql_query("select name from naimen where id=$tid"), '0', 'name');
$article = mysql_result(mysql_query("select article from naimen where id=$tid"), '0', 'article');
?>
<h1>Просмотр прихода товара <?php print "$name (артикул $article)" ?> из группы <?php print "$gruppa" ?></h1>
<br>
<?php
$r1 = mysql_query("select * from prihod");
$n = mysql_num_rows($r1);
$all = 0;
$d7 = 0;
$m1 = 0;
$y1 = 0;
if(mysql_rus_search('prihod', 'article', $article, 'date') > 0) {
	for($i=0;$i<$n;$i++) {
		if(mysql_result($r1, $i, 'article') == $article) {
			$all += mysql_result($r1, $i, 'count');
			if(mysql_result($r1, $i, 'date') >= time()-60*60*24*7) {
				$d7 += mysql_result($r1, $i, 'count');
			}
			if(mysql_result($r1, $i, 'date') >= time()-60*60*24*30) {
				$m1 += mysql_result($r1, $i, 'count');
			}
			if(mysql_result($r1, $i, 'date') >= time()-60*60*24*365) {
				$y1 += mysql_result($r1, $i, 'count');
			}
		}
	}
}
?>
<table class='table' cellspacing='0' cellpadding="3">
<tr><td class='table'>За последнюю неделю&nbsp;</td><td class='table'><?php print $d7 ?></td></tr>
<tr><td class='table'>За последний месяц</td><td class='table'><?php print $m1 ?></td></tr>
<tr><td class='table'>За последний год</td><td class='table'><?php print $y1 ?></td></tr>

</table>
<br><b>Всего пришло : <?php print $all ?></b><br><br>
<b>Также можно узнать :</b><br>
<ul type="square">
<li><form action="stat203.php" name="f1">
<input type="Hidden" name="grupid" value="<?php print "$grupid" ?>">
<input type="Hidden" name="tid" value="<?php print "$tid" ?>">
Сколько пришло за последние <select name="num1" class=name onfocus='id=className' onblur='id=1'>
<?php
for ($x=1;$x<=31;$x++) {
print "<option value='$x'>$x";
}
?>
</select> <select name="dmy" class=name onfocus='id=className' onblur='id=1'>
<option value="d">дней
<option value="m">месяцев
<option value="y">год/лет
</select> <input type=Submit value=">>" style="width: 30; height: 20" name="go1" class='submit' onmouseover='id=className' onmouseout=id='0'> 
</form></li>
<center id="res1" style="display: 'none'"><br><b><?php print "За последние $num1 ";
switch ($dmy) {
case 'd' : print "дней"; break;
case 'm' : print "месяцев"; break;
case 'y' : print "год/лет"; break;
}
print " пришло данного товара : <span id='res11'></span>."; ?></b><br><br></center>
<li><form action="stat203.php" name="f2">
<input type="Hidden" name="grupid" value="<?php print "$grupid" ?>">
<input type="Hidden" name="tid" value="<?php print "$tid" ?>">
Количество продаж, начиная с <select name="day1" class=name onfocus='id=className' onblur='id=1'>
<?php
for ($x=1;$x<=31;$x++) {
print "<option value='$x'>$x";
}
?>
</select> <select name="month1" class=name onfocus='id=className' onblur='id=1'>
<option value="1">января
<option value="2">февраля
<option value="3">марта
<option value="4">апреля
<option value="5">мая
<option value="6">июня
<option value="7">июля
<option value="8">августа
<option value="9">сентября
<option value="10">октября
<option value="11">ноября
<option value="12">декабря
</select> <select name="year1" class=name onfocus='id=className' onblur='id=1'>
<option value="2003">2003
<option value="2004" selected>2004
<option value="2005">2005
<option value="2006">2006
<option value="2007">2007
</select> и заканчивая <select name="day2" class=name onfocus='id=className' onblur='id=1'>
<?php
for ($x=1;$x<=31;$x++) {
if($x == date("j")) {print "<option value='$x' selected>$x"; continue;}
print "<option value='$x'>$x";
}
?>
</select> <select name="month2" class=name onfocus='id=className' onblur='id=1'>
<?php
switch (date("M")) {
case "Jan" : $mr = "января"; break;
case "Feb" : $mr = "февраля"; break;
case "Mar" : $mr = "марта"; break;
case "Apr" : $mr = "апреля"; break;
case "May" : $mr = "мая"; break;
case "Jun" : $mr = "июня"; break;
case "Jul" : $mr = "июля"; break;
case "Aug" : $mr = "августа"; break;
case "Sep" : $mr = "сентября"; break;
case "Oct" : $mr = "октября"; break;
case "Nov" : $mr = "ноября"; break;
case "Dec" : $mr = "декабря"; break;
}
print "<option value='".date("n")."'>$mr";
?>
<option value="1">января
<option value="2">февраля
<option value="3">марта
<option value="4">апреля
<option value="5">мая
<option value="6">июня
<option value="7">июля
<option value="8">августа
<option value="9">сентября
<option value="10">октября
<option value="11">ноября
<option value="12">декабря
</select> <select name="year2" class=name onfocus='id=className' onblur='id=1'>
<?php
for($i=2003;$i < 2008; $i++) {
if($i == date("Y")) {print "<option value='$i' selected>$i"; continue;}
print "<option value='$i'>$i";
}
?>
</select> <input type=Submit value=">>" style="width: 30; height: 20" name="go2" class='submit' onmouseover='id=className' onmouseout=id='0'> 
</form></li>
<center id="res2" style="display: 'none'"><br><b><?php print "Начиная с $day1 ";
switch ($month1) {
case "1" : $mr = "января"; break;
case "2" : $mr = "февраля"; break;
case "3" : $mr = "марта"; break;
case "4" : $mr = "апреля"; break;
case "5" : $mr = "мая"; break;
case "6" : $mr = "июня"; break;
case "7" : $mr = "июля"; break;
case "8" : $mr = "августа"; break;
case "9" : $mr = "сентября"; break;
case "10" : $mr = "октября"; break;
case "11" : $mr = "ноября"; break;
case "12" : $mr = "декабря"; break;
}
print "$mr";
print " $year1 года и заканчивая $day2 ";
switch ($month2) {
case "1" : $mr = "января"; break;
case "2" : $mr = "февраля"; break;
case "3" : $mr = "марта"; break;
case "4" : $mr = "апреля"; break;
case "5" : $mr = "мая"; break;
case "6" : $mr = "июня"; break;
case "7" : $mr = "июля"; break;
case "8" : $mr = "августа"; break;
case "9" : $mr = "сентября"; break;
case "10" : $mr = "октября"; break;
case "11" : $mr = "ноября"; break;
case "12" : $mr = "декабря"; break;
}
print "$mr";
print " $year2 года, продано данного товара : <span id='res21'></span>."; ?></b><br><br></center>
</ul>
<br><br>
<form action='stat103.php'>
<input type="Hidden" name="grupid" value="<?php print $grupid ?>">
<input type="Hidden" name="tid" value="<?php print $tid ?>">
<input type=Submit value='Просмотреть продажу этого товара' class='submit' onmouseover='id=className' onmouseout=id='0'>
</form>
<br><br>
<form action='stat202.php'>
<input type="Hidden" name="grupid" value="<?php print $grupid ?>">
<input type=Submit value='Вернуться назад' class='submit' onmouseover='id=className' onmouseout=id='0' accesskey=','>
</form>
</body>
</html>
<?php
if(isset($go1)) {
$res1 = 0;
if(mysql_rus_search('prodaja', 'article', $article, 'date') > 0) {
	for($i=0;$i<$n;$i++) {
		if(mysql_result($r1, $i, 'article') == $article) {
			if($dmy == "d") $otime = 60*60*24*$num1;
			if($dmy == "m") $otime = 60*60*24*30*$num1;
			if($dmy == "y") $otime = 60*60*24*365*$num1;
			if(mysql_result($r1, $i, 'date') >= time()-$otime) $res1 += mysql_result($r1, $i, 'count');
		}
	}
}
print "<script language='JavaScript'>
document.getElementById('res1').style.display='block';
document.getElementById('res11').innerText+='$res1';
</script>";
}
if(isset($go2)) {
$res2 = 0;
if(mysql_rus_search('prodaja', 'article', $article, 'date') > 0) {
	for($i=0;$i<$n;$i++) {
		if(mysql_result($r1, $i, 'article') == $article) {
			$time1 = mktime(0,0,0,$month1,$day1,$year1, 1);
			$time2 = mktime(0,0,0,$month2,$day2,$year2, 1);
			if(mysql_result($r1, $i, 'date') >= $time1 && mysql_result($r1, $i, 'date') <= $time2) $res2 += mysql_result($r1, $i, 'count');
		}
	}
}
print "<script language='JavaScript'>
document.getElementById('res2').style.display='block';
document.getElementById('res21').innerText+='$res2';
</script>";
}
?>

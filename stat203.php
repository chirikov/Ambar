<?php include ("head.php");
include ($mconf['dir']['inc']."/functions.php");
if($pass != $pass0 or !$pass or !$pass0) {print "<h1>�������� ������! ��������� ����.</h1>
<meta http-equiv='Refresh' content='2; url=index.php'>";
exit;
}
$mysql = @mysql_connect($mconf['mysql']['host'], $mconf['mysql']['login'], $mconf['mysql']['password']) or die ("<font color='#ff0000'>�� ���������� ������������ � ������� MySQL. ���������� � ������������.</font>");
@mysql_select_db($mconf['mysql']['db']) or die("<font color='#ff0000'>�� ���������� ������� ���� ������. ���������� � ������������.</font>");
$query0 = "select * from gruppy where id=$grupid";
$result0 = mysql_query($query0);
$gruppa = mysql_result($result0, 0, 'name');
$name = mysql_result(mysql_query("select name from naimen where id=$tid"), '0', 'name');
$article = mysql_result(mysql_query("select article from naimen where id=$tid"), '0', 'article');
?>
<h1>�������� ������� ������ <?php print "$name (������� $article)" ?> �� ������ <?php print "$gruppa" ?></h1>
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
<tr><td class='table'>�� ��������� ������&nbsp;</td><td class='table'><?php print $d7 ?></td></tr>
<tr><td class='table'>�� ��������� �����</td><td class='table'><?php print $m1 ?></td></tr>
<tr><td class='table'>�� ��������� ���</td><td class='table'><?php print $y1 ?></td></tr>

</table>
<br><b>����� ������ : <?php print $all ?></b><br><br>
<b>����� ����� ������ :</b><br>
<ul type="square">
<li><form action="stat203.php" name="f1">
<input type="Hidden" name="grupid" value="<?php print "$grupid" ?>">
<input type="Hidden" name="tid" value="<?php print "$tid" ?>">
������� ������ �� ��������� <select name="num1" class=name onfocus='id=className' onblur='id=1'>
<?php
for ($x=1;$x<=31;$x++) {
print "<option value='$x'>$x";
}
?>
</select> <select name="dmy" class=name onfocus='id=className' onblur='id=1'>
<option value="d">����
<option value="m">�������
<option value="y">���/���
</select> <input type=Submit value=">>" style="width: 30; height: 20" name="go1" class='submit' onmouseover='id=className' onmouseout=id='0'> 
</form></li>
<center id="res1" style="display: 'none'"><br><b><?php print "�� ��������� $num1 ";
switch ($dmy) {
case 'd' : print "����"; break;
case 'm' : print "�������"; break;
case 'y' : print "���/���"; break;
}
print " ������ ������� ������ : <span id='res11'></span>."; ?></b><br><br></center>
<li><form action="stat203.php" name="f2">
<input type="Hidden" name="grupid" value="<?php print "$grupid" ?>">
<input type="Hidden" name="tid" value="<?php print "$tid" ?>">
���������� ������, ������� � <select name="day1" class=name onfocus='id=className' onblur='id=1'>
<?php
for ($x=1;$x<=31;$x++) {
print "<option value='$x'>$x";
}
?>
</select> <select name="month1" class=name onfocus='id=className' onblur='id=1'>
<option value="1">������
<option value="2">�������
<option value="3">�����
<option value="4">������
<option value="5">���
<option value="6">����
<option value="7">����
<option value="8">�������
<option value="9">��������
<option value="10">�������
<option value="11">������
<option value="12">�������
</select> <select name="year1" class=name onfocus='id=className' onblur='id=1'>
<option value="2003">2003
<option value="2004" selected>2004
<option value="2005">2005
<option value="2006">2006
<option value="2007">2007
</select> � ���������� <select name="day2" class=name onfocus='id=className' onblur='id=1'>
<?php
for ($x=1;$x<=31;$x++) {
if($x == date("j")) {print "<option value='$x' selected>$x"; continue;}
print "<option value='$x'>$x";
}
?>
</select> <select name="month2" class=name onfocus='id=className' onblur='id=1'>
<?php
switch (date("M")) {
case "Jan" : $mr = "������"; break;
case "Feb" : $mr = "�������"; break;
case "Mar" : $mr = "�����"; break;
case "Apr" : $mr = "������"; break;
case "May" : $mr = "���"; break;
case "Jun" : $mr = "����"; break;
case "Jul" : $mr = "����"; break;
case "Aug" : $mr = "�������"; break;
case "Sep" : $mr = "��������"; break;
case "Oct" : $mr = "�������"; break;
case "Nov" : $mr = "������"; break;
case "Dec" : $mr = "�������"; break;
}
print "<option value='".date("n")."'>$mr";
?>
<option value="1">������
<option value="2">�������
<option value="3">�����
<option value="4">������
<option value="5">���
<option value="6">����
<option value="7">����
<option value="8">�������
<option value="9">��������
<option value="10">�������
<option value="11">������
<option value="12">�������
</select> <select name="year2" class=name onfocus='id=className' onblur='id=1'>
<?php
for($i=2003;$i < 2008; $i++) {
if($i == date("Y")) {print "<option value='$i' selected>$i"; continue;}
print "<option value='$i'>$i";
}
?>
</select> <input type=Submit value=">>" style="width: 30; height: 20" name="go2" class='submit' onmouseover='id=className' onmouseout=id='0'> 
</form></li>
<center id="res2" style="display: 'none'"><br><b><?php print "������� � $day1 ";
switch ($month1) {
case "1" : $mr = "������"; break;
case "2" : $mr = "�������"; break;
case "3" : $mr = "�����"; break;
case "4" : $mr = "������"; break;
case "5" : $mr = "���"; break;
case "6" : $mr = "����"; break;
case "7" : $mr = "����"; break;
case "8" : $mr = "�������"; break;
case "9" : $mr = "��������"; break;
case "10" : $mr = "�������"; break;
case "11" : $mr = "������"; break;
case "12" : $mr = "�������"; break;
}
print "$mr";
print " $year1 ���� � ���������� $day2 ";
switch ($month2) {
case "1" : $mr = "������"; break;
case "2" : $mr = "�������"; break;
case "3" : $mr = "�����"; break;
case "4" : $mr = "������"; break;
case "5" : $mr = "���"; break;
case "6" : $mr = "����"; break;
case "7" : $mr = "����"; break;
case "8" : $mr = "�������"; break;
case "9" : $mr = "��������"; break;
case "10" : $mr = "�������"; break;
case "11" : $mr = "������"; break;
case "12" : $mr = "�������"; break;
}
print "$mr";
print " $year2 ����, ������� ������� ������ : <span id='res21'></span>."; ?></b><br><br></center>
</ul>
<br><br>
<form action='stat103.php'>
<input type="Hidden" name="grupid" value="<?php print $grupid ?>">
<input type="Hidden" name="tid" value="<?php print $tid ?>">
<input type=Submit value='����������� ������� ����� ������' class='submit' onmouseover='id=className' onmouseout=id='0'>
</form>
<br><br>
<form action='stat202.php'>
<input type="Hidden" name="grupid" value="<?php print $grupid ?>">
<input type=Submit value='��������� �����' class='submit' onmouseover='id=className' onmouseout=id='0' accesskey=','>
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

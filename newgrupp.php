<?php include ("head.php");
if($pass != $pass0 or !$pass or !$pass0) {print "<h1>�������� ������! ��������� ����.</h1>
<meta http-equiv='Refresh' content='2; url=index.php'>";
exit;
}?>
<h1>�������� ����� ������ ������</h1>
<br>
<h3>����, �������� ����� ������. ��� ����� ������� � ���� ��� ������.</h3><br>
<form action="newgrupp.php">
<input type="hidden" name="postid" value="<?php print "$postid"; ?>">
<table class="hp">
<tr><td align="right">������������ ������ : </td><td><input maxlength="50" size="50" type="Text" class=name onfocus='id=className' onblur='id=1' name="name" value="<?php print "$name"; ?>"></td></tr>
</table><br>
<input class="submit" onmouseover="id=className" onmouseout="id=''" type="Submit" value="�� ���������. ������." name="go">
</form><br>
<form action="prihod1.php">
<input type="hidden" name="postid" value="<?php print "$postid"; ?>">
<input type="Submit" value="����� ��������� �����, ���� �� ������" class="submit" style="width: 350px;" onmouseover="id=className" onmouseout="id=''" accesskey=','>
</form>
<?php
if(isset($go)){
if($name == "") {
	print "<br><br><h3>�� �� ����� ��� ������.</h3>";
	exit;
}
$mysql = @mysql_connect($mconf['mysql']['host'], $mconf['mysql']['login'], $mconf['mysql']['password']) or die ("<font color='#ff0000'>�� ���������� ������������ � ������� MySQL. ���������� � ������������.</font>");
@mysql_select_db($mconf['mysql']['db']) or die("<font color='#ff0000'>�� ���������� ������� ���� ������. ���������� � ������������.</font>");

	$res33 = mysql_query("select name from gruppy");
	for($iii=0;$iii<mysql_num_rows($res33);$iii++) {
		$nname = mysql_result($res33, $iii, 'name');
		if($nname == $name) {print "<font color='#ff0000'>������ � ����� ������ ��� ����������.</font>"; exit;}
	}

$query = "select id from gruppy";
$result = mysql_query($query);
$nn00 = mysql_num_rows($result);
if($nn00 < 1) {$n = 1;}
else {
	$ids2 = array();
	for($ids = 0; $ids < $nn00; $ids++) {$ids2[] = mysql_result($result, $ids, 'id');}
	$n = max($ids2);
	$n++;
}

$query2 = "insert into gruppy values($n, \"$name\")";
$result2 = mysql_query($query2);
if($result2 == false) {
	print "<font color='#ff0000'>�� ���������� ������� ����� ������. ���������� � ������������.</font>";
	exit;
}
if($result2 == true) {
	header("Location: prihod1.php?postid=$postid");
}
mysql_close($mysql);
}?>
</body>
</html>

<?php include ("head.php");
if($pass != $pass0 or !$pass or !$pass0) {print "<h1>�������� ������! ��������� ����.</h1>
<meta http-equiv='Refresh' content='2; url=index.php'>";
exit;
}
$mysql = @mysql_connect($mconf['mysql']['host'], $mconf['mysql']['login'], $mconf['mysql']['password']) or die ("<font color='#ff0000'>�� ���������� ������������ � ������� MySQL. ���������� � ������������.</font>");
@mysql_select_db($mconf['mysql']['db']) or die("<font color='#ff0000'>�� ���������� ������� ���� ������. ���������� � ������������.</font>");
$query0 = "select * from gruppy where id=$grupid";
$result0 = mysql_query($query0);
$gruppa = mysql_result($result0, 0, 'name');
?>
<h1>�������� ������� ������ �� ������ <?php print "$gruppa" ?></h1>
<h3>�������� �����</h3><br>
<?php
$query = "select * from naimen where gruppa=$grupid";
$result = mysql_query($query);
$n = mysql_num_rows($result);
if($n == 0) {
	print "<b>�� ������� ������ � ���� ������.</b><br><br>
	<form action='stat101.php'>
	<input type=Submit value='��������� �����' class='submit' onmouseover='id=className' onmouseout=id='0' accesskey=','>
	</form>";
	exit;
}
else {
	print "<table class='table' cellspacing='0'><tr><th class='table'>�������</th><th class='table'>������������</th><th class='table'>� �������</th>";
	for($x=0;$x<$n;$x++) {
		$tid[$x] = mysql_result($result, $x, 'id');
		$name = mysql_result($result, $x, 'name');
		$article = mysql_result($result, $x, 'article');
		$coun = mysql_result($result, $x, 'count');
		print "<form action='stat102.php'>
		<input type='hidden' name='x2' value='$x'>
		<input type=Hidden name='grupid' value='$grupid'>";
		print "<tr><td class='table'><input type='submit' name='go' class='submit2' value='$article'></td><td class='table'><input type='submit' name='go' class='submit2' value='$name'></td><td class='table'>$coun</td></tr></form>";
	}
	print "</table>";
}
if(isset($go)) {
$tid = $tid[$x2];
print "<script language='JavaScript'>
window.location='stat103.php?grupid=$grupid&tid=$tid';
</script>";
}
?>
<br><br>
<form action='stat101.php'>
<input type=Submit value='��������� �����' class='submit' onmouseover='id=className' onmouseout=id='0' accesskey=','>
</form>
</body>
</html>

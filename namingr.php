<?php include ("head.php");
if($pass != $pass0 or !$pass or !$pass0) {print "<h1>�������� ������! ��������� ����.</h1>
<meta http-equiv='Refresh' content='2; url=index.php'>";
exit;
}
$mysql = @mysql_connect($mconf['mysql']['host'], $mconf['mysql']['login'], $mconf['mysql']['password']) or die ("<font color='#ff0000'>�� ���������� ������������ � ������� MySQL. ���������� � ������������.</font>");
@mysql_select_db($mconf['mysql']['db']) or die("<font color='#ff0000'>�� ���������� ������� ���� ������. ���������� � ������������.</font>");
$r0 = mysql_query("select name from naimen");
$num0 = mysql_num_rows($r0);
if ($num0 == 0) {
	print "<br><br>
	<b>� ��������� �� ���������������� �� ������ ������.</b>";
	?>
	<form action="graph.php">
	<input type="Submit" value="��������� �����" class='submit' onmouseover='id=className' onmouseout=id='0' accesskey=','>
	</form>
	<?php
	;
	exit;
}
?>
<h1>������������� ������� � �������</h1><br><br>
<img src='diagr.php?namingr=1' name="ambarimage">
<br><br>
<h3>����� ����� : <?php print mysql_num_rows(mysql_query("select id from gruppy")) ?>&nbsp;&nbsp; ����� ������� : <?php print $num0 ?></h3>
<br><br>
<form action="graph.php">
<input type="Submit" value="��������� �����" class='submit' onmouseover='id=className' onmouseout=id='0' accesskey=','>
</form>
</body>
</html>

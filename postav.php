<?php include ("head.php");
if($pass != $pass0 or !$pass or !$pass0) {print "<h1>�������� ������! ��������� ����.</h1>
<meta http-equiv='Refresh' content='2; url=index.php'>";
exit;
}
$mysql = @mysql_connect($mconf['mysql']['host'], $mconf['mysql']['login'], $mconf['mysql']['password']) or die ("<font color='#ff0000'>�� ���������� ������������ � ������� MySQL. ���������� � ������������.</font>");
@mysql_select_db($mconf['mysql']['db']) or die("<font color='#ff0000'>�� ���������� ������� ���� ������. ���������� � ������������.</font>");
$query3 = "SELECT * FROM postavsh";
$result3 = mysql_query($query3);
$n3 = mysql_num_rows($result3);
?>
<h1>����������</h1><br>
<h3>������ �����������</h3><br>
<?php
if ($n3 == 0) {print "<b>� ��������� �� ���������������� �� ������ ����������.</b>";
mysql_close($mysql);
print "
<br><br>
<form action=info.php>
<input class=submit onmouseover='id=className' onmouseout='id=0' style='width: 430' type=submit value='��������� � ��������� ����� ����������' accesskey=','>
</form>
</body>
</html>";
exit;}
?>
<table cellspacing="0" class="table">
<tr><th class="table">ID ����������</th><th class="table">��� ����������</th><th class="table">������������ �������</th>
<th class="table">����� ���������</th><th class="table">�������</th><th class="table">E-mail</th><th class="table">����</th>
<th class="table">����. ����</th><th class="table">��������� ���������</th></tr>
<?php
$query = "SELECT * FROM postavsh";
$result = mysql_query($query);
$x = 0;
$n = mysql_num_rows($result);
while($x < $n) {
$id = mysql_result($result, $x, 'id');
$name = mysql_result($result, $x, 'name');
$phone = mysql_result($result, $x, 'phone');
$contact = mysql_result($result, $x, 'contact');
$chang = mysql_result($result, $x, 'chang');
$mail = mysql_result($result, $x, 'mail');
$www = mysql_result($result, $x, 'www');

$query2 = "SELECT * FROM naimen WHERE post=$id";
$result2 = mysql_query($query2);
$m = mysql_num_rows($result2);
$naimen = $m;

$d = 0;
$stoim = 0;
while($d < $m) {
$count = mysql_result($result2, $d, 'count');
$price = mysql_result($result2, $d, 'price');
$s = $count*$price;
$stoim += $s;
$d++;}

$aaa = explode(".", $stoim);
while (strlen($aaa[1])<2){
$aaa[1] = $aaa[1]."0";
}
$stoim = implode(".", $aaa);

print "<tr><th class='table'>$id</th><td class='table' align=center>$name</td><td class='table' align=center>$naimen</td>
<td class='table' align=center>$stoim</td><td class='table' align=center>$phone</td><td class='table' align=center>$mail</td>
<td class='table' align=center>$www</td><td class='table' align=center>$contact</td><td class='table' align=center>
".date("d.m.Y, H:i", $chang)."</td></tr>";
$x++;}
?>
</table>
<br><br>
<form action=info.php>
<input class=submit onmouseover='id=className' onmouseout='id=0' style='width: 430' type=submit value='��������� � ��������� ����� ����������' accesskey=','>
</form>


<?php mysql_close($mysql); ?>
</body>
</html>

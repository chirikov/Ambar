<?php include ("head.php");
if($pass != $pass0 or !$pass or !$pass0) {print "<h1>�������� ������! ��������� ����.</h1>
<meta http-equiv='Refresh' content='2; url=index.php'>";
exit;
}
$mysql = @mysql_connect($mconf['mysql']['host'], $mconf['mysql']['login'], $mconf['mysql']['password']) or die ("<font color='#ff0000'>�� ���������� ������������ � ������� MySQL. ���������� � ������������.</font>");
@mysql_select_db($mconf['mysql']['db']) or die("<font color='#ff0000'>�� ���������� ������� ���� ������. ���������� � ������������.</font>");
$query4 = "SELECT * FROM naimen";
$result4 = mysql_query($query4);
$n3 = mysql_num_rows($result4);
?>
<h1>������������ �������</h1><br>
<h3>������ ������������ ���� �������</h3><br>
<?php
if ($n3 == 0) {print "<b>� ��������� �� ���������������� �� ������ ������������ ������.</b>";
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
<tr><th class="table">�������</th><th class="table">�������� ������</th><th class="table">����. ���.</th>
<th class="table">����</th><th class="table">����������</th><th class="table">����� ���������</th>
<th class="table">������</th><th class="table">���������</th><th class="table">��������� ���������</th></tr>

<?php
$query = "select * from naimen";
$result = mysql_query($query);
$x = 0;
$n = mysql_num_rows($result);
while($x < $n) {
$article = mysql_result($result, $x, 'article');
$name = mysql_result($result, $x, 'name');
$ed = mysql_result($result, $x, 'ed');
$price = mysql_result($result, $x, 'price');
$count = mysql_result($result, $x, 'count');
$postid = mysql_result($result, $x, 'post');
$grupid = mysql_result($result, $x, 'gruppa');
$chang = mysql_result($result, $x, 'chang');

$query2 = "select * from gruppy where id=$grupid";
$result2 = mysql_query($query2);
$gruppa = mysql_result($result2, 0, 'name');

$query3 = "select * from postavsh where id=$postid";
$result3 = mysql_query($query3);
$postav34 = mysql_fetch_assoc($result3);
$postav = $postav34['name'];

$stoim = $price*$count;

$aaa = explode(".", $price);
while (strlen($aaa[1])<2){
$aaa[1] = $aaa[1]."0";
}
$price = implode(".", $aaa);

$aaa = explode(".", $stoim);
while (strlen($aaa[1])<2){
$aaa[1] = $aaa[1]."0";
}
$stoim = implode(".", $aaa);

print "
<tr><td class='table'><b>$article</b></th><td class='table'>$name</td><td class='table'>$ed</td>
<td class='table'>$price</td><td class='table'>$count</td><td class='table'>$stoim</td>
<td class='table'><a href=oprnaimen.php?grupid=$grupid title='����������� ������ ������ $gruppa'>$gruppa</a></td>
<td class='table'>$postav</td><td class='table'>".date("d.m.Y, H:i", $chang)."</td></tr>";
$x++;}
?>

</table>
<br><br>
<form action=info.php>
<input class=submit onmouseover='id=className' onmouseout='id=0' style='width: 430' type=submit value='��������� � ��������� ����� ����������' accesskey=','>
</form>
</center>
<?php mysql_close($mysql); ?>
</font>
</body>
</html>

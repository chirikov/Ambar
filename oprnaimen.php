<?php include ("head.php");
if($pass != $pass0 or !$pass or !$pass0) {print "<h1>�������� ������! ��������� ����.</h1>
<meta http-equiv='Refresh' content='2; url=index.php'>";
exit;
}
$mysql = @mysql_connect($mconf['mysql']['host'], $mconf['mysql']['login'], $mconf['mysql']['password']) or die ("<font color='#ff0000'>�� ���������� ������������ � ������� MySQL. ���������� � ������������.</font>");
@mysql_select_db($mconf['mysql']['db']) or die("<font color='#ff0000'>�� ���������� ������� ���� ������. ���������� � ������������.</font>");
$query2 = "select * from gruppy where id=$grupid";
$result2 = mysql_query($query2);
$gruppa = mysql_result($result2, 0, 'name');
$query4 = "select * from naimen where gruppa=$grupid";
$result4 = mysql_query($query4);
$n = mysql_num_rows($result4);
if($n < 1) {
	print "<br><br><h3>� ������ ���� ��� �� ������ ������.</h3><br>";
	print "<br><br>
<form action='naimen.php'>
<input type='Submit' class='submit' value='��������� � ��������� ���� ������������' onmouseover='id=className' onmouseout='id=0'>
</form><br>
<form action='info.php'>
<input type=Submit class='submit' value='��������� � ��������� ����� ����������' onmouseover='id=className' onmouseout='id=0' accesskey=','>
</form>";
exit;
}
?>
<h1>������������ �������</h1><br>
<h3>������ ������������ ������� ������ <?php print "$gruppa"; ?></h3><br>

<table cellspacing="0" class="table">
<tr><th class="table">�������</th><th class="table">�������� ������</th><th class="table">����. ���.</th>
<th class="table">����</th><th class="table">����������</th><th class="table">����� ���������</th>
<th class="table">���������</th><th class="table">��������� ���������</th></tr>

<?php
$query = "select * from naimen where gruppa=$grupid";
$result = mysql_query($query);
$x = 0;
$n = mysql_num_rows($result);
$allsumm = 0;
while($x < $n) {
$article = mysql_result($result, $x, 'article');
$name = mysql_result($result, $x, 'name');
$ed = mysql_result($result, $x, 'ed');
$price = mysql_result($result, $x, 'price');
$count = mysql_result($result, $x, 'count');
$post = mysql_result($result, $x, 'post');
$chang = mysql_result($result, $x, 'chang');

$query3 = "select * from postavsh where id=$post";
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

$allsumm += $stoim;

print "
<tr><td class='table'><b>$article</b></td>
<td class='table'>$name</td>
<td class='table'>$ed</td>
<td class='table'>$price</td>
<td class='table'>$count</td>
<td class='table'>$stoim</td>
<td class='table'>$postav</td>
<td class='table'>".date("d.m.Y, H:i", $chang)."</td></tr>";
$x++;}
$acount = $n;
$aaa = explode(".", $allsumm);
while (strlen($aaa[1])<2){
$aaa[1] = $aaa[1]."0";
}
$allsumm = implode(".", $aaa);
print "
<tr valign=bottom style='font-size: 20px;'><td height='50'>����� : &nbsp;</td><td align=right>���������� ������� : </td><td>$acount</td><td colspan=2 align=right>����� ����� : </td><td>$allsumm</td><td></td><td></td></tr>
";
?>

</table>
<br><br>
<form action="naimen.php">
<input type="Submit" class="submit" style="width: 400px" value="��������� � ��������� ���� ������������" onmouseover="id=className" onmouseout="id=''">
</form><br><br>
<form action="info.php">
<input type="Submit" class="submit" style="width: 400px" value="��������� � ��������� ����� ����������" onmouseover="id=className" onmouseout="id=''" accesskey=','>
</form>


</center>
<?php mysql_close($mysql); ?>
</font>
</body>
</html>

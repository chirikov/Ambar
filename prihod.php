<?php include ("head.php");
include ($mconf['dir']['inc']."/functions.php");
if($pass != $pass0 or !$pass or !$pass0) {print "<h1>�������� ������! ��������� ����.</h1>
<meta http-equiv='Refresh' content='2; url=index.php'>";
exit;
}

$mysql = @mysql_connect($mconf['mysql']['host'], $mconf['mysql']['login'], $mconf['mysql']['password']) 
or die ("<font color='#ff0000'>�� ���������� ������������ � ������� MySQL. ���������� � ������������.</font>");
@mysql_select_db($mconf['mysql']['db']) or die("<font color='#ff0000'>�� ���������� ������� ���� ������. ���������� � ������������.</font>");
$gruppa = mysql_fetch_assoc(mysql_query("select * from gruppy where id=$grupid"));
$gruppa = $gruppa["name"];
$post = mysql_fetch_assoc(mysql_query("select * from postavsh where id=$postid"));
$post = $post["name"];
$query = "select * from naimen where gruppa=$grupid";
$result = mysql_query($query);
$n = mysql_num_rows($result);
if($n < 1) {
	print "<h3>� ������ $gruppa ���� ��� �� ������ ������.</h3><br>";
	print "<form action=newtovar.php>
	<input type=Hidden name='postid' value='$postid'>
	<input type=Hidden name='grupid' value='$grupid'>
	<input class='submit' onmouseover='id=className' onmouseout=id='0' type=Submit value='������� ����� �����' style='width: 300' accesskey='n'>
	</form>";
	?>
	<br><br>
	<form action="prihod1.php">
	<input type="Hidden" name="postid" value="<?php print "$postid"; ?>">
	<input class="submit" onmouseover="id=className" onmouseout="id=''" type="Submit" value="��������� � ������ ������ �������" style="width: 400" accesskey=','>
	</form><br><br>
	<?php
	exit;
}
print "<h1>������ ������ �� \"$post\"<br>
� ������ $gruppa.</h1><br>
<h3>����� ������ �����?</h3><br><br>
<form action=newtovar.php>
<input type=Hidden name='postid' value='$postid'>
<input type=Hidden name='grupid' value='$grupid'>
<input class='submit' onmouseover='id=className' onmouseout=id='0' type=Submit value='������� ����� �����' style='width: 300' accesskey='n'>
</form>
<br><br>
<table class='table' cellspacing='0'>
<tr class=table><th class='table'>�������</th><th class='table'>������������</th><th class='table'>����. ���.</th>
<th class='table'>����</th><th class='table'>� �������</th><th class='table'>�����</th><th class='table'>��������� ���������</th></tr>";
$allsumm = 0;
for($x=0;$x<$n;$x++) {
	$tid[$x] = mysql_result($result, $x, 'id');
	$article[$x] = mysql_result($result, $x, 'article');
	$name[$x] = mysql_result($result, $x, 'name');
	$ed[$x] = mysql_result($result, $x, 'ed');
	$count[$x] = mysql_result($result, $x, 'count');
	$price[$x] = mysql_result($result, $x, 'price');
	$chang[$x] = mysql_result($result, $x, 'chang');
	$stoim[$x] = $price[$x]*$count[$x];
	$aaa = explode(".", $stoim[$x]);
	while (strlen($aaa[1])<2){
	$aaa[1] = $aaa[1]."0";
	}
	$stoim[$x] = implode(".", $aaa);
	$allsumm += $stoim[$x];
	print "
	<form action=prihod2.php>
	<input type=Hidden name='tid' value='$tid[$x]'>
	<input type=Hidden name='postid' value='$postid'>
	<input type=Hidden name='grupid' value='$grupid'>
	<tr class='table'>
	<td class='table'><input type='Submit' class='submit2' value='$article[$x]' name='go2'></th>
	<td class='table' align=left><input type='Submit' class='submit2' value='$name[$x]' name='go2'></td>
	<td class='table' align=left>$ed[$x]</td>
	<td class='table' align=left>$price[$x]</td>
	<td class='table' align=left>$count[$x]</td>
	<td class='table' align=left>$stoim[$x]</td>
	<td class='table' align=left>".date("d.m.Y, H:i", $chang[$x])."</td></tr></form>";
}
$acount = $n;
$aaa = explode(".", $allsumm);
while (strlen($aaa[1])<2){
$aaa[1] = $aaa[1]."0";
}
$allsumm = implode(".", $aaa);
print "
<tr valign=bottom style='font-size: 20px;'><td height='50'>����� : &nbsp;</td><td align=right>���������� ������� : </td><td>$acount</td><td colspan=2 align=right>����� ����� : </td><td>$allsumm</td><td></td></tr>
</table>";
?>
<br><br>
<form action="prihod1.php">
<input type="Hidden" name="postid" value="<?php print "$postid"; ?>">
<input class="submit" onmouseover="id=className" onmouseout="id=''" type="Submit" value="��������� � ������ ������ �������" style="width: 400" accesskey=",">
</form>
<?php mysql_close($mysql); ?>
</body>
</html>

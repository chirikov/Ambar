<?php include ("head.php");
include($mconf['dir']['inc']."/functions.php");
if($pass != $pass0 or !$pass or !$pass0) {print "<h1>�������� ������! ��������� ����.</h1>
<meta http-equiv='Refresh' content='2; url=index.php'>";
exit;
}?>
<h1>������ ������</h1><br>
<h3>�������, ����, ������ ����������, �� �������� ������ ����� ...</h3><br>
<form action='prihod0.php'>
<?php
$mysql = @mysql_connect($mconf['mysql']['host'], $mconf['mysql']['login'], $mconf['mysql']['password']) or die ("<font color='#ff0000'>�� ���������� ������������ � ������� MySQL. ���������� � ������������.</font>");
@mysql_select_db($mconf['mysql']['db']) or die("<font color='#ff0000'>�� ���������� ������� ���� ������. ���������� � ������������.</font>");
$query = "select * from postavsh";
$result = mysql_query($query);
$n = mysql_num_rows($result);
if ($n > 0) {
	print "
	<table cellspacing=0><tr><td>
	<select name='post' class=name onfocus='id=className' onblur='id=1' "; if(isset($del)){print "disabled";} print ">";
	$x = 0;
	for($x=0;$x<$n;$x++) {
		$p = mysql_result($result, $x, 'name');
		print "<option value='$p'>$p";
	}
	print "</select></td></tr>
	<tr><td><input class='submit' onmouseover='id=className' onmouseout='id=0' type=Submit value='��� ����' style='width: 100%' name='go' "; if(isset($del)){print "disabled";} print "></td></tr></table>
	";
}
else {print "<b>�� ������ ���������� �� ����������������.</b><br>";}
?>
<br><br>
<?php if(!isset($del)) { ?>
<h3>... ��� ������ ������.</h3><br>
<input class="submit" onmouseover="id=className" onmouseout="id=''" type="Submit" value="������� ������ ����������" name="new" accesskey='n'>
<?php
if ($n > 0) {
print "
<br><br>
<h3>����� ������� ������� ����������.</h3><br>
<input class='submit' onmouseover='id=className' onmouseout='id=0' type='Submit' value='������� ����������' name='del'>
";}
?></form>
<br><br>
<form action="main.php">
<input type="Submit" value="��������� �� ��������� ��������" class='submit' onmouseover='id=className' onmouseout=id='0' accesskey=",">
</form>
<?php } else {print "</form>";}
if(isset($go)) {
	$postid = mysql_rus_search("postavsh", "name", $post, "id");
	header ("Location: prihod1.php?postid=$postid");
}
if(isset($new)) {header ("Location: newpost.php");}
if(isset($del)) {
	$postid = mysql_rus_search("postavsh", "name", $post, "id");
	print "<h1>�������� ����������</h1><br>
	<h3>�� ������������� ������ ������� $post � ��� ���������� � �������, ����������� � ����?</h3><br>
	<form action='prihod0.php'>
	<input type=hidden name='postid' value='$postid'>
	<input class='submit' onmouseover='id=className' onmouseout=id='0' type=Submit value='��' name=go1 style='width: 100'>
	<input class='submit' onmouseover='id=className' onmouseout=id='0' type=Submit value='���' name=go2 style='width: 100'>
	</form>";
}
if(isset($go2)) {header ("Location: prihod0.php");}
if(isset($go1)) {

$query3 = "delete from postavsh where id=$postid";
$result3 = mysql_query($query3);
if(!$result) {print "<font color='#ff0000'>�� ������� ������� ����������. ���������� � ������������.</font>"; exit;}
$query4 = "delete from naimen where post=$postid";
$result4 = mysql_query($query3);
if(!$result3) {print "<font color='#ff0000'>�� ������� ������� ����������. ���������� � ������������.</font>"; exit;}
header ("Location: prihod0.php");
}
?>
<?php mysql_close($mysql); ?>
</body>
</html>

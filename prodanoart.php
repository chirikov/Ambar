<?php
include ("head.php");
include ($mconf['dir']['inc']."/functions.php");
if($pass != $pass0 or !$pass or !$pass0) {print "<h1>�������� ������! ��������� ����.</h1>
<meta http-equiv='Refresh' content='2; url=index.php'>";
exit;
}
$mysql = @mysql_connect($mconf['mysql']['host'], $mconf['mysql']['login'], $mconf['mysql']['password']) or die ("<font color='#ff0000'>�� ���������� ������������ � ������� MySQL. ���������� � ������������.");
@mysql_select_db($mconf['mysql']['db']) or die("<font color='#ff0000'>�� ���������� ������� ���� ������. ���������� � ������������.");
?>
<h1>���������� ���������� ������ �� ��������</h1>
<h3>��� ����� ���� ������ ������ ������� ������ � ������� �������.</h3>
<table class="hp"><form action="prodanoart.php">
<tr><td align="right">������� : </td><td><input type="Text" maxlength='50' size='30' class=name onfocus='id=className' onblur='id=1' name="article" value="<?php @print "$article" ?>"></td></tr>
<tr><td align="right">������� ������� : </td><td><input type="Text" size="4" maxlength="4" class=name onfocus='id=className' onblur='id=1' name="prodano" value="<?php @print "$prodano" ?>"></td></tr>
</table><br>
<input type="Submit" class='submit' onmouseover='id=className' onmouseout=id='0' name="go" value="������">
</form>
<?php
if(isset($go)) {
if(!$article) {print "<b>������� ������ �������.</b>";
?>
<br><br><br>
<form action="prodano.php">
<input type="Submit" value="��������� �����" class='submit' onmouseover='id=className' onmouseout=id='0' accesskey=','>
</form>
<?php
exit;}
if(!$prodano) {print "<b>������� ������ ������� �������.</b>";
?>
<br><br><br>
<form action="prodano.php">
<input type="Submit" value="��������� �����" class='submit' onmouseover='id=className' onmouseout=id='0' accesskey=','>
</form>
<?php
exit;}
$tid = mysql_rus_search("naimen", "article", $article, "id");
if($tid == false) {print "
<b>������ � ����� ��������� �� �������.</b>
<form action=prodano.php>
<input type=Submit value='��������� �����' class='submit' onmouseover='id=className' onmouseout=id='0' accesskey=','>
</form>"; exit;}
$query = "select * from naimen where id=$tid";
$result = mysql_query($query);
$nn = mysql_num_rows($result);

$x = 0;
$name = mysql_result($result, $x, 'name');
$ed = mysql_result($result, $x, 'ed');
$count = mysql_result($result, $x, 'count');
$price = mysql_result($result, $x, 'price');
$post = mysql_result($result, $x, 'post');
$gruppa = mysql_result($result, $x, 'gruppa');
$chang = mysql_result($result, $x, 'chang');
$article = mysql_result($result, $x, 'article');

$query2 = "select * from gruppy where id=$gruppa";
$result2 = mysql_query($query2);
$grupp = mysql_result($result2, $x, 'name');

$query3 = "select * from postavsh where id=$post";
$result3 = mysql_query($query3);
$pos = mysql_result($result3, $x, 'name');

$newcount = $count-$prodano;
?>
<table class="hp">
<tr><td align="right">������������ : </td><td><?php print "$name"; ?></td></tr>
<tr><td align="right">������� : </td><td><?php print "$article"; ?></td></tr>
<tr><td align="right">������� ��������� : </td><td><?php print "$ed"; ?></td></tr>
<tr><td align="right">���� �� ������ : </td><td><?php print "$count"; ?></td></tr>
<tr><td align="right">����� : </td><td><?php print "$newcount"; ?></td></tr>
<tr><td align="right">���� : </td><td><?php print "$price"; ?></td></tr>
<tr><td align="right">��������� : </td><td><?php print "$pos"; ?></td></tr>
<tr><td align="right">������ : </td><td><?php print "$grupp"; ?></td></tr>
<tr><td align="right">��������� ��������� : </td><td><?php print date("d.m.Y, H:i", $chang); ?></td></tr>
</table>
<form action="prodanoart.php">
<input type="Hidden" name="tid" value="<?php print "$tid"; ?>">
<input type="Hidden" name="article" value="<?php print "$article"; ?>">
<input type="Hidden" name="name" value="<?php print "$name"; ?>">
<input type="Hidden" name="ed" value="<?php print "$ed"; ?>">
<input type="Hidden" name="newcount" value="<?php print "$newcount"; ?>">
<input type="Hidden" name="post" value="<?php print "$post"; ?>">
<input type="Hidden" name="gruppa" value="<?php print "$gruppa"; ?>">
<input type="Hidden" name="price" value="<?php print "$price"; ?>">
<input type="Hidden" name="prodano" value="<?php print "$prodano"; ?>">
<input class='submit' onmouseover='id=className' onmouseout=id='0' type=Submit value="��" name="go2">
</form>
<?php
}
if(isset($go2)) {
if($newcount < 0) {print "<font color='#ff0000'><h3>�� ������� ������, ��� ���� �� ������. �������� �� ���������.</h3></font><form action='prodano.php'>
	<input type=Submit value='��������� �����' class='submit' onmouseover='id=className' onmouseout=id='0' accesskey=','>
	</form>"; exit;}
$query4 = "delete from naimen where id=$tid";
$result4 = mysql_query($query4);
if(!$result4) {print "<font color='#ff0000'>�� ������� ������� ������ ������. ���������� � ������������.</font>"; exit;}
$time = date("U");
$query5 = "insert into naimen values($tid, \"$article\", \"$name\", \"$ed\", $newcount, $price, $post, $gruppa, $time)";
$result5 = mysql_query($query5);
$query6 = "insert into prodaja values(\"$article\", $prodano, $time)";
$result6 = mysql_query($query6);
if(!$result5 || !$result6) {print "<font color='#ff0000'>�� ������� �������� ����� ������. ���������� � ������������.</font><br><form action=main.php>
<input type=Submit value='��������� �� ��������� ��������' class='submit' onmouseover='id=className' onmouseout=id='0'>
</form>"; exit;}
else {
print "
<h3>����������! ���������� ������� ���������.<br><br>
��� ������?<br><br>
<form action=prodanoart.php>
<input class='submit' onmouseover='id=className' onmouseout=id='0' type=Submit value='���������� ��������� �����'>
</form>";
}
}
?>

<?php mysql_close($mysql); ?>
<br>
<form action="prodano.php">
<input type="Submit" value="��������� �����" class='submit' onmouseover='id=className' onmouseout=id='0' accesskey=','>
</form>
</body>
</html>
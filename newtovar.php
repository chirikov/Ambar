<?php include ("head.php");
include ($mconf['dir']['inc']."/functions.php");
if($pass != $pass0 or !$pass or !$pass0) {print "<h1>�������� ������! ��������� ����.</h1>
<meta http-equiv='Refresh' content='2; url=index.php'>";
exit;
}
$mysql = @mysql_connect($mconf['mysql']['host'], $mconf['mysql']['login'], $mconf['mysql']['password']) or die ("<font color='#ff0000'>�� ���������� ������������ � ������� MySQL. ���������� � ������������.</font>");
@mysql_select_db($mconf['mysql']['db']) or die("<font color='#ff0000'>�� ���������� ������� ���� ������. ���������� � ������������.</font>");
$gruppa = mysql_fetch_assoc(mysql_query("select * from gruppy where id=$grupid"));
$gruppa = $gruppa["name"];
$post = mysql_fetch_assoc(mysql_query("select * from postavsh where id=$postid"));
$post = $post["name"];
?>
<h1>�������� ������ ������������ ������</h1>
<br>
<h3>����, �������� ����� ������������ ������. ��� ����� ������� � ��������������� ���� ����������� ����������.
<br>��� ���� ������������ ��� ����������.</h3><br>
<form action="newtovar.php">
<input type="Hidden" name="postid" value="<?php print "$postid"; ?>">
<input type="Hidden" name="grupid" value="<?php print "$grupid"; ?>">
<table class="hp">
<tr><td align="right">������� ������ : </td><td><input maxlength="50" size="50" type="Text" class=name onfocus='id=className' onblur='id=1' name="article" value="<?php print "$article"; ?>"></td></tr>
<tr><td align="right">������������ ������ : </td><td><input maxlength="50" size="50" type="Text" class=name onfocus='id=className' onblur='id=1' name="name" value="<?php print "$name"; ?>"></td></tr>
<tr><td align="right">������� ��������� : </td><td><select name="ed" class=name onfocus='id=className' onblur='id=1'>
<?php
$fp = $mconf['dir']['inc']."/ed.txt";
$eda = file($fp);
foreach ($eda as $edan) {
print "<option value='$edan'>$edan";
}
?>
</select></td></tr>
<tr><td align="right">���� : </td><td><input type="Text" size="9" maxlength="9" class=name onfocus='id=className' onblur='id=1' name="price" value="<?php print "$price"; ?>"></td></tr>
<tr><td align="right">������� ������ : </td><td><input type="Text" size="4" maxlength="4" class=name onfocus='id=className' onblur='id=1' name="newcount" value="<?php print "$newcount"; ?>"></td></tr>
<tr><td align="right">��������� : </td><td><select name="post" class=name onfocus='id=className' onblur='id=1'>
<?php
print "<option value='$post'>$post";
$query = "select name from postavsh";
$result = mysql_query($query);
for($posi=0;$posi<mysql_num_rows($result);$posi++){
	$postn = mysql_result($result, $posi, 'name');
	if ($postn == $post) {continue;}
	else {print "<option value='$postn'>$postn";}
}
?>
</select>
</td></tr>
<tr><td align="right">������ : </td><td><select name="gruppa" class=name onfocus='id=className' onblur='id=1'>
<?php
print "<option value='$gruppa'>$gruppa";
$query2 = "select name from gruppy";
$result2 = mysql_query($query2);
for($gri=0;$gri<mysql_num_rows($result2);$gri++){
	$grupp = mysql_result($result2, $gri, 'name');
	if ($grupp == $gruppa) {continue;}
	print "<option value='$grupp'>$grupp";
}
?>
</select>
</td></tr>
</table><br>
<input class="submit" onmouseover="id=className" onmouseout="id=''" type="Submit" value="�� ���������. ������." name="go">
</form><br>
<?php
if (isset($go)) {
	if(!$article) {print "�������-��, ������, ������ ����.
	<br><br>
<form action='prihod.php'>
<input type='Hidden' name='postid' value='$postid'>
<input type='Hidden' name='grupid' value='$grupid'>
<input type='Hidden' name='str' value='9999'>
<input type='Submit' value='��������� �����' class='submit' onmouseover='id=className' onmouseout='0' accesskey=','>
</form>"; exit;}
	if($name == "") {print "������������-��, ������, ������ ����.<br><br>
<form action='prihod.php'>
<input type='Hidden' name='postid' value='$postid'>
<input type='Hidden' name='grupid' value='$grupid'>
<input type='Hidden' name='str' value='9999'>
<input type='Submit' value='��������� �����' class='submit' onmouseover='id=className' onmouseout='0' accesskey=','>
</form>"; exit;}
	if(!$price or !is_numeric($price)) {
		if(!strstr($price, ",")) {print "����-��, ������, ������ ����.<br><br>
<form action='prihod.php'>
<input type='Hidden' name='postid' value='$postid'>
<input type='Hidden' name='grupid' value='$grupid'>
<input type='Hidden' name='str' value='9999'>
<input type='Submit' value='��������� �����' class='submit' onmouseover='id=className' onmouseout='0' accesskey=','>
</form>"; exit;}
		else {
			$zz = explode(",", $price);
			if(!is_numeric($zz[0]) or !is_numeric($zz[1])) {print "����-��, ������, ������ ����.<br><br>
<form action='prihod.php'>
<input type='Hidden' name='postid' value='$postid'>
<input type='Hidden' name='grupid' value='$grupid'>
<input type='Hidden' name='str' value='9999'>
<input type='Submit' value='��������� �����' class='submit' onmouseover='id=className' onmouseout='0' accesskey=','>
</form>"; exit;}
		}
	}
	if(!is_int($newcount)) {print "������� ������ ������ �� �����.<br><br>
<form action='prihod.php'>
<input type='Hidden' name='postid' value='$postid'>
<input type='Hidden' name='grupid' value='$grupid'>
<input type='Hidden' name='str' value='9999'>
<input type='Submit' value='��������� �����' class='submit' onmouseover='id=className' onmouseout='0' accesskey=','>
</form>"; exit;}
	if(strstr($price, ".") || strstr($price, ",")) {
		$price = ereg_replace(",", ".", $price);
		$aaa = explode(".", $price);
		while (strlen($aaa[1])<2){$aaa[1] .= "0";}
		$price = implode(".", $aaa);
	}
	else {$price = $price.".00";}

print "<h3>����:</h3>
<table class='hp'>
<tr><td align=right>������� : </td><td><b>$article</b></td></tr>
<tr><td align=right>������������ : </td><td><b>$name</b></td></tr>
<tr><td align=right>������� ��������� : </td><td><b>$ed</b></td></tr>
<tr><td align=right>���� : </td><td><b>$price</b></td></tr>
<tr><td align=right>������ : </td><td><b>$newcount</b></td></tr>
<tr><td align=right>��������� : </td><td><b>$post</b></td></tr>
<tr><td align=right>������ : </td><td><b>$gruppa</b></td></tr>
</table><br>
<h3>�� ���������?</h3>";?>
<form action="newtovar.php">
<input type="Hidden" name="article" value="<?php print "$article"; ?>">
<input type="Hidden" name="name" value="<?php print "$name"; ?>">
<input type="Hidden" name="ed" value="<?php print "$ed"; ?>">
<input type="Hidden" name="price" value="<?php print "$price"; ?>">
<input type="Hidden" name="newcount" value="<?php print "$newcount"; ?>">
<input type="Hidden" name="postid" value="<?php print "$postid"; ?>">
<input type="Hidden" name="grupid" value="<?php print "$grupid"; ?>">
<input class="submit" onmouseover="id=className" onmouseout="id=''" type="Submit" value="��" name="go2" accesskey="."></form>
<h4>���� �� �� ���������, ������ ������ ���������� � ����� ������� � ����� "�� ���������. ������.".</h4>
<?php
}
if (isset($go2)) {
	$res33 = mysql_query("select article from naimen");
	for($iii=0;$iii<mysql_num_rows($res33);$iii++) {
		$nname = mysql_result($res33, $iii, 'article');
		if($nname == $article) {print "<font color='#ff0000'>����� � ����� ��������� ��� ����������. �������� ������ �������.</font>"; exit;}
	}
	$time = date("U");
	
	$query4 = "select id from naimen";
	$result4 = mysql_query($query4);
	if(mysql_num_rows($result4) < 1) {
		$nt = 1;
	}
	else {
		$ids2 = array();
		for($nnm=0;$nnm<mysql_num_rows($result4);$nnm++){
			$ids2[] = mysql_result($result4, $nnm, 'id');
		}
		$nt = max($ids2);
		$nt++;
	}
	
	$query3 = "insert into naimen values('$nt', '$article', \"$name\", \"$ed\", '$newcount', '$price', '$postid', '$grupid', '$time')";
	$result3 = mysql_query($query3);
	if (!$result3) {print "<font color='#ff0000'>�� ������� ������� ����� ������. ���������� � ������������.</font>"; exit;}
	else {
		print "<h3>����������! ���������� ������� ���������.</h3>
		<meta http-equiv='Refresh' content='1; url=prihod.php?postid=$postid&grupid=$grupid'>";
	}
}
mysql_close($mysql); ?>
<br><br>
<form action="prihod.php">
<input type="Hidden" name="postid" value="<?php print "$postid" ?>">
<input type="Hidden" name="grupid" value="<?php print "$grupid" ?>">
<input type='Hidden' name='str' value='9999'>
<input type="Submit" value="��������� �����" class="submit" onmouseover="id=className" onmouseout="id=''" accesskey=','>
</form>
</body>
</html>

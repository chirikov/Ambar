<?php
include ("head.php");
if($pass != $pass0 or !$pass or !$pass0) {print "<h1>�������� ������! ��������� ����.</h1>
<meta http-equiv='Refresh' content='2; url=index.php'>";
exit;
}
?>
<h1>��������� ������</h1>
<h3>��������� ���� ��������� ���������� � ����� Caps Lock!</h3>
<table border="0">
<form action="changepass.php">
<tr><td align="right">������� ������ : </td><td><input type="password" name="nowpass" class=name onfocus='id=className' onblur='id=1'></td></tr>
<tr><td align="right">����� ������ : </td><td><input type="password" name="newpass" class=name onfocus='id=className' onblur='id=1'></td></tr>
<tr><td align="right">��� ��� ����� ������ : </td><td><input type="password" name="newpass2" class=name onfocus='id=className' onblur='id=1'></td></tr>
</table>
<input type="Submit" value="��������" name="go" class="submit" onmouseover="id=className" onmouseout="id=''">
</form>
<?php
if(isset($go)){
	if(!$nowpass or !$newpass or !$newpass2) {print "�� ��� ���� ���������. ��������� ��� ����."; exit;}
	if(md5($nowpass) != $pass0) {print "�� ����� �������� ������� ������."; exit;}
	if($newpass != $newpass2) {print "�������� ������ �� ���������."; exit;}
	$newpass1 = md5($newpass);
	$fp = $mconf['dir']['inc']."/pass.txt";
	$fp = fopen($fp, "w");
	fputs($fp, $newpass1);
	fclose($fp);
	setcookie($cname, $newpass1, time()+7200);
	print "<h2>������ ������.<br><br>���������...</h2>
	<script language=javascript>
	opener.location = 'main.php?restart=1';
	setTimeout('self.close()', 500);
	</script>";
}
?>
</body>
</html>

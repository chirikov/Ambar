<?php include ("head.php");
if($pass != $pass0 or !$pass or !$pass0) {print "<h1>�������� ������! ��������� ����.</h1>
<meta http-equiv='Refresh' content='2; url=index.php'>";
exit;
}
?>
<h1>���������</h1>
<br><h3>��� �� ������ ���������� � ���� ���������?</h3><br><br>
<form action="namingr.php">
<input type="Submit" value="������������� ������� �� �������" class='submit' onmouseover='id=className' onmouseout=id='0'>
</form>
<br>
<form action="naminpos.php">
<input type="Submit" value="������������� ������� �� �����������" style="width: 400" class='submit' onmouseover='id=className' onmouseout=id='0'>
</form>
<br><br>
<form action="dop.php">
<input type="Submit" value="��������� �����" class='submit' onmouseover='id=className' onmouseout=id='0' accesskey=",">
</form>
</body>
</html>

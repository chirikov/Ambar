<?php
include ("head.php");
if($pass != $pass0 or !$pass or !$pass0) {print "<h1>�������� ������! ��������� ����.</h1>
<meta http-equiv='Refresh' content='2; url=index.php'>";
exit;
}
?>
<h1>�������������� �������</h1><br>
<br>
<form action="mytotxt.php">
<input style="width: 400" class="submit" onmouseover="id=className" onmouseout="id=''" type="Submit" value="������� ���������� � ��������� ����" title="���������� ���������� � �������, �������, ����������� � ��������� �����."></form>
<form action="txttomy.php">
<input style="width: 400" class="submit" onmouseover="id=className" onmouseout="id=''" type="Submit" value="������ ���������� �� ���������� �����" title="���������� ���������� � �������, �������, ����������� �� ��������� ������."></form>
<form action="edit.php">
<input style="width: 400" class="submit" onmouseover="id=className" onmouseout="id=''" type="Submit" value="�������������� ����������" title="�������������� ���������� � ����������� � �������."></form>
<form action="graph.php">
<input style="width: 400" class="submit" onmouseover="id=className" onmouseout="id=''" type="Submit" value="���������" title="������������� ���������� � ���� ��������."></form>

<br><br><br>
<form action="main.php">
<input class="submit" onmouseover="id=className" onmouseout="id=''" type="Submit" value="��������� �� ��������� ��������" accesskey=','>
</form>
</body>
</html>

<?php
include ("head.php");
if($pass != $pass0 or !$pass or !$pass0) {print "<h1>�������� ������! ��������� ����.</h1>
<meta http-equiv='Refresh' content='2; url=index.php'>";
exit;
}
?>
<h1>������������� ����������</h1><br>
<br>
<h3>����� ���������� �� ������ �� �����������������?</h3><br><br>
<form action="editpost.php">
<input class="submit" onmouseover="id=className" onmouseout="id=''" type="Submit" value="� �����������">
</form>
<form action="editgrup.php">
<input class="submit" onmouseover="id=className" onmouseout="id=''" type="Submit" value="� �������">
</form>
<br>
<input type="button" name="h1" style="width: 30;" title="���������" value=" ? " class="submit" onmouseover="id=className" onmouseout="id=''" onclick="
javascript:
alert('���������: ����� �������������� ���������� � �������, ����������� �������� ������� ������, ������ �������� ���� `������� ������` ������.');
">
<br><br><br>
<form action="dop.php">
<input class="submit" onmouseover="id=className" onmouseout="id=''" type="Submit" value="��������� �����" accesskey=','>
</form>
</body>
</html>

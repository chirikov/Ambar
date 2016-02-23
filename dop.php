<?php
include ("head.php");
if($pass != $pass0 or !$pass or !$pass0) {print "<h1>Неверный пароль! Повторите ввод.</h1>
<meta http-equiv='Refresh' content='2; url=index.php'>";
exit;
}
?>
<h1>Дополнительные функции</h1><br>
<br>
<form action="mytotxt.php">
<input style="width: 400" class="submit" onmouseover="id=className" onmouseout="id=''" type="Submit" value="Вывести информацию в текстовый файл" title="Копировать информацию о товарах, группах, поставщиках в текстовые файлы."></form>
<form action="txttomy.php">
<input style="width: 400" class="submit" onmouseover="id=className" onmouseout="id=''" type="Submit" value="Внести информацию из текстового файла" title="Копировать информацию о товарах, группах, поставщиках из текстовых файлов."></form>
<form action="edit.php">
<input style="width: 400" class="submit" onmouseover="id=className" onmouseout="id=''" type="Submit" value="Корректировать информацию" title="Корректировать информацию о поставщиках и группах."></form>
<form action="graph.php">
<input style="width: 400" class="submit" onmouseover="id=className" onmouseout="id=''" type="Submit" value="Диаграммы" title="Представление информации в виде диаграмм."></form>

<br><br><br>
<form action="main.php">
<input class="submit" onmouseover="id=className" onmouseout="id=''" type="Submit" value="Вернуться на стартовую страницу" accesskey=','>
</form>
</body>
</html>

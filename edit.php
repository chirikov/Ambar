<?php
include ("head.php");
if($pass != $pass0 or !$pass or !$pass0) {print "<h1>Неверный пароль! Повторите ввод.</h1>
<meta http-equiv='Refresh' content='2; url=index.php'>";
exit;
}
?>
<h1>Корректировка информации</h1><br>
<br>
<h3>Какую информацию Вы хотели бы подкорректировать?</h3><br><br>
<form action="editpost.php">
<input class="submit" onmouseover="id=className" onmouseout="id=''" type="Submit" value="О поставщиках">
</form>
<form action="editgrup.php">
<input class="submit" onmouseover="id=className" onmouseout="id=''" type="Submit" value="О группах">
</form>
<br>
<input type="button" name="h1" style="width: 30;" title="Подсказка" value=" ? " class="submit" onmouseover="id=className" onmouseout="id=''" onclick="
javascript:
alert('Подсказка: Чтобы корректировать информацию о товарах, используйте механизм прихода товара, просто оставьте поле `Сколько пришло` пустым.');
">
<br><br><br>
<form action="dop.php">
<input class="submit" onmouseover="id=className" onmouseout="id=''" type="Submit" value="Вернуться назад" accesskey=','>
</form>
</body>
</html>

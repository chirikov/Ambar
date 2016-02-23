<?php
include ("head.php");
if($pass != $pass0 or !$pass or !$pass0) {print "<h1>Неверный пароль! Повторите ввод.</h1>
<meta http-equiv='Refresh' content='2; url=index.php'>";
exit;
}
?>
<h1>Вывод информации в текстовые файлы</h1>
<br>
<h3>Выберите, какую информацию Вы хотели бы копировать в текстовые файлы и укажите их расположение.</h3>
<script language="JavaScript">
function changef1(){
if(f1.naimen.checked == true) {f1.nfile.disabled = false; f1.s1.disabled = false}
if(f1.naimen.checked == false){f1.nfile.disabled = true;
if(f1.gruppy.checked == false && f1.postavsh.checked == false) {f1.s1.disabled = true}
}
}
function changef2(){
if(f1.gruppy.checked == true) {f1.gfile.disabled = false; f1.s1.disabled = false}
if(f1.gruppy.checked == false){f1.gfile.disabled = true;
if(f1.naimen.checked == false && f1.postavsh.checked == false) {f1.s1.disabled = true}
}
}
function changef3(){
if(f1.postavsh.checked == true) {f1.pfile.disabled = false; f1.s1.disabled = false}
if(f1.postavsh.checked == false){f1.pfile.disabled = true;
if(f1.gruppy.checked == false && f1.naimen.checked == false) {f1.s1.disabled = true}
}
}
</script>
<?php
if(!isset($notf)) {
$arr = explode("/", $DOCUMENT_ROOT);
$disk = $arr[0];
$nfile = "$disk/Амбар/Товары.txt";
$pfile = "$disk/Амбар/Поставщики.txt";
$gfile = "$disk/Амбар/Группы.txt";
}
?>
<form action="mytotxt.php" name="f1">
<input type="Hidden" value="1" name="notf">
<table>
<tr><td><input type="Checkbox" name="naimen" class=name onfocus='id=className' onblur='id=1' onclick="javascript: changef1();"></td><td>О товарах</td></tr>
<tr><td></td><td>Файл : <input size="30" disabled type="text" name="nfile" value="<?php print "$nfile" ?>" class=name onfocus='id=className' onblur='id=1'> &nbsp;<input type="button" name="h1" style="width: 30;" title="Подсказка" value=" ? " class="submit" onmouseover="id=className" onmouseout="id=''" onclick="
javascript:
alert('Подсказка: Вы можете указать как существующий файл, так и не существующий, но все указанные папки должны уже существовать. Если Вы указываете существующий файл, убедитесь, что он не скрыт и не `только для чтения`.');
"><br><br></td></tr>
<tr><td><input type="Checkbox" name="gruppy" class=name onfocus='id=className' onblur='id=1' onclick="javascript: changef2();"></td><td>О группах товаров</td></tr>
<tr><td></td><td>Файл : <input size="30" disabled type="text" name="gfile" value="<?php print "$gfile" ?>" class=name onfocus='id=className' onblur='id=1'><br><Br></td></tr>
<tr><td><input type="Checkbox" name="postavsh" class=name onfocus='id=className' onblur='id=1' onclick="javascript: changef3();"></td><td>О поставщиках</td></tr>
<tr><td></td><td>Файл : <input size="30" disabled type="text" name="pfile" value="<?php print "$pfile" ?>" class=name onfocus='id=className' onblur='id=1'></td></tr>
</table>
<br><br>
<input type="Submit" name="s1" value="Дальше" class="submit" onmouseover="id=className" onmouseout="id=''" disabled>
</form>
<center id=dirs><h3>Внимание! Вся прежняя информация в выбраных файлах будет утеряна.</h3></center>
<?php
if(isset($s1)) {
if($naimen && !$nfile) {print "Вы не ввели имя файла для сохранения информации о товарах.<br><br>
<form action='dop.php'>
<input class='submit' onmouseover='id=className' onmouseout='id=0' type='Submit' value='Вернуться назад'>
</form>"; exit;}
if($gruppy && !$gfile) {print "Вы не ввели имя файла для сохранения информации о группах товаров.<br><br>
<form action='dop.php'>
<input class='submit' onmouseover='id=className' onmouseout='id=0' type='Submit' value='Вернуться назад'>
</form>"; exit;}
if($postavsh && !$pfile) {print "Вы не ввели имя файла для сохранения информации о поставщиках.<br><br>
<form action='dop.php'>
<input class='submit' onmouseover='id=className' onmouseout='id=0' type='Submit' value='Вернуться назад'>
</form>"; exit;}
$mysql = @mysql_connect($mconf['mysql']['host'], $mconf['mysql']['login'], $mconf['mysql']['password']) or die ("<font color='#ff0000'>Не получилось подключиться к серверу MySQL. Обратитесь к разработчику.</font>");
@mysql_select_db($mconf['mysql']['db']) or die("<font color='#ff0000'>Не получилось выбрать базу данных. Обратитесь к разработчику.</font>");
if(isset($naimen)) {
	$q1 = "select * from naimen";
	$r1 = mysql_query($q1);
	$artlen = array();
	$namelen = array();
	$prilen = array();
	$coulen = array();
	$stolen = array();
	$edlen = array();
	for ($i=0; $i<mysql_num_rows($r1); $i++) {
		$artlen[] = strlen(mysql_result($r1, $i, 'article'));
		$namelen[] = strlen(mysql_result($r1, $i, 'name'));
		$prilen[] = strlen(mysql_result($r1, $i, 'price'));
		$coulen[] = strlen(mysql_result($r1, $i, 'count'));
	}
	$eds = file($mconf['dir']['inc']."/ed.txt");
	foreach($eds as $ed) {$ed2 = rtrim($ed); $edlen[] = strlen($ed2);}
	$maxartlen = max($artlen);
	$maxnamelen = max($namelen);
	$maxprilen = max($prilen);
	$maxcoulen = max($coulen);
	$maxstolen = $maxprilen+$maxcoulen;
	$maxedlen = max($edlen);
	$q12 = "select name, id from postavsh";
	$r12 = mysql_query($q12);
	$postlen = array();
	for ($i=0; $i<mysql_num_rows($r12); $i++) {
		$postlen[] = strlen(mysql_result($r12, $i, 'name'));
	}
	$maxposlen = max($postlen);
	$q13 = "select name, id from gruppy";
	$r13 = mysql_query($q13);
	$grulen = array();
	for ($i=0; $i<mysql_num_rows($r13); $i++) {
		$grulen[] = strlen(mysql_result($r13, $i, 'name'));
	}
	$maxgrulen = max($grulen);

	$strtop = "+";
	for($i=0;$i<$maxartlen;$i++) {$strtop = $strtop."-";}
	$strtop = $strtop."+";
	for($i=0;$i<$maxnamelen;$i++) {$strtop = $strtop."-";}
	$strtop = $strtop."+";
	for($i=0;$i<$maxedlen;$i++) {$strtop = $strtop."-";}
	$strtop = $strtop."+";
	for($i=0;$i<$maxprilen;$i++) {$strtop = $strtop."-";}
	$strtop = $strtop."+";
	for($i=0;$i<$maxcoulen;$i++) {$strtop = $strtop."-";}
	$strtop = $strtop."+";
	for($i=0;$i<$maxstolen;$i++) {$strtop = $strtop."-";}
	$strtop = $strtop."+";
	for($i=0;$i<$maxgrulen;$i++) {$strtop = $strtop."-";}
	$strtop = $strtop."+";
	for($i=0;$i<$maxposlen;$i++) {$strtop = $strtop."-";}
	$strtop = $strtop."+-----------------+";
	
	
	$fp = @fopen($nfile, "w") or die("<h3><font color='#ff0000'>Вы указали одну или несколько несуществующих папок в пути к файлу с товарами, либо, если такой файл уже существует, он скрыт или защищён от записи. Попробуйте заново.</font></h3><form action='dop.php'>
<input class='submit' onmouseover='id=className' onmouseout='id=0' type='Submit' value='Вернуться назад' accesskey=','>
</form>");
	fputs($fp, "     Товары          Файл создан: ".date("d.m.Y, H:i")."\r\n");
	fputs($fp, "\r\n");
	fputs($fp, "Столбцы: (| Артикул | Наименование| Един. измер. | Цена | Количество | Стоимость | Группа | Поставщик | Последнее изменение |)\r\n");
	fputs($fp, "\r\n");
	fputs($fp, $strtop."\r\n");
	$ostoim = 0;
	for($i=0;$i<mysql_num_rows($r1);$i++) {
		$stoim = mysql_result($r1, $i, 'price')*mysql_result($r1, $i, 'count');
		$aaa = explode(".", $stoim);
		while (strlen($aaa[1])<2){
			$aaa[1] = $aaa[1]."0";
		}
		$stoim = implode(".", $aaa);
		$ostoim+=$stoim;
		$chang = mysql_result($r1, $i, 'chang');
		$grupid = mysql_result($r1, $i, 'gruppa');
		$postid = mysql_result($r1, $i, 'post');
		$r14 = mysql_query("select * from postavsh where id=$postid");
		$r15 = mysql_query("select * from gruppy where id=$grupid");
		$gruppa = mysql_result($r15, 0, 'name');
		$post = mysql_result($r14, 0, 'name');
		$str = "|".mysql_result($r1, $i, 'article')."";
		for($ii=0;$ii<$maxartlen-strlen(mysql_result($r1, $i, 'article'));$ii++) {$str = $str." ";}
		$str = $str."|".mysql_result($r1, $i, 'name')."";
		for($ii=0;$ii<$maxnamelen-strlen(mysql_result($r1, $i, 'name'));$ii++) {$str = $str." ";}
		$str = $str."|".rtrim(mysql_result($r1, $i, 'ed'))."";
		for($ii=0;$ii<$maxedlen-strlen(rtrim(mysql_result($r1, $i, 'ed')));$ii++) {$str = $str." ";}
		$str = $str."|".mysql_result($r1, $i, 'price')."";
		for($ii=0;$ii<$maxprilen-strlen(mysql_result($r1, $i, 'price'));$ii++) {$str = $str." ";}
		$str = $str."|".mysql_result($r1, $i, 'count')."";
		for($ii=0;$ii<$maxcoulen-strlen(mysql_result($r1, $i, 'count'));$ii++) {$str = $str." ";}
		$str = $str."|".$stoim."";
		for($ii=0;$ii<$maxstolen-strlen($stoim);$ii++) {$str = $str." ";}
		$str = $str."|".$gruppa."";
		for($ii=0;$ii<$maxgrulen-strlen($gruppa);$ii++) {$str = $str." ";}
		$str = $str."|".$post."";
		for($ii=0;$ii<$maxposlen-strlen($post);$ii++) {$str = $str." ";}
		$str = $str."|".date("d.m.Y, H:i", $chang)."";
		for($ii=0;$ii<17-strlen(date("d.m.Y, H:i", $chang));$ii++) {$str = $str." ";}
		$str = $str."|";
		fputs($fp, $str."\r\n");
		fputs($fp, $strtop."\r\n");
	}
	fputs($fp, "\r\n");
	fputs($fp, "Всего товаров:   ".mysql_num_rows($r1)."\r\n");
	$aaa = explode(".", $ostoim);
	while (strlen($aaa[1])<2){
		$aaa[1] = $aaa[1]."0";
	}
	$ostoim = implode(".", $aaa);
	fputs($fp, "Общая стоимость: ".$ostoim."\r\n");
	fputs($fp, "Поставщиков:     ".mysql_num_rows($r12)."\r\n");
	fputs($fp, "Групп:           ".mysql_num_rows($r13)."\r\n");
	fputs($fp, "\r\n");
	fputs($fp, "\r\n");
	fputs($fp, "Программа \"".$mconf['program']['name']."\", версия ".$mconf['program']['version']."");
	fclose($fp);
	if(strstr($nfile, "\\")) {
	$dira = explode("\\", $nfile);
	}
	elseif(strstr($nfile, "/")) {
	$dira = explode("/", $nfile);
	}
	$dir = substr($nfile, 0, strlen($nfile)-strlen($dira[count($dira)-1]));
	print "
	<script language='JavaScript'>
	b = window.open('$dir', 'none');
	</script>
	";
}


if(isset($gruppy)) {
	$q2 = "select * from gruppy";
	$r2 = mysql_query($q2);
	$namelen = array();
	for ($i=0; $i<mysql_num_rows($r2); $i++) {
		$namelen[] = strlen(mysql_result($r2, $i, 'name'));
	}
	$maxnamelen = max($namelen);
	
	$strtop = "+";
	for($i=0;$i<$maxnamelen;$i++) {$strtop = $strtop."-";}
	$strtop = $strtop."+---+----------+-----------------+";
	$fp = @fopen($gfile, "w") or die("<h3><font color='#ff0000'>Вы указали одну или несколько несуществующих папок в пути к файлу с группами, либо, если такой файл уже существует, он скрыт или защищён от записи. Попробуйте заново.</font></h3><form action='dop.php'>
	<input class='submit' onmouseover='id=className' onmouseout='id=0' type='Submit' value='Вернуться назад' accesskey=','>
	</form>");
	fputs($fp, "     Группы          Файл создан: ".date("d.m.Y, H:i")."\r\n");
	fputs($fp, "\r\n");
	fputs($fp, "Столбцы: (| Название | Наименований товаров | Общая стоимость | Последние изменения |)\r\n");
	fputs($fp, "\r\n");
	fputs($fp, $strtop."\r\n");
	$ostoim = 0;
	$allnaimen = 0;
	for($i=0;$i<mysql_num_rows($r2);$i++) {
		
		$id = mysql_result($r2, $i, 'id');
		$q21 = "select price, count, chang from naimen where gruppa=$id";
		$r21 = mysql_query($q21);
		$naimen2 = mysql_num_rows($r21);
		$stoim = 0;
		for($d=0;$d < $naimen2;$d++) {
			$count = mysql_result($r21, $d, 'count');
			$price = mysql_result($r21, $d, 'price');
			$s = $count*$price;
			$stoim += $s;
		}
		$aaa = explode(".", $stoim);
		while (strlen($aaa[1])<2){
		$aaa[1] = $aaa[1]."0";
		}
		$stoim = implode(".", $aaa);
		$ostoim+=$stoim;
		$changes = array();
		for($y=0;$y < $naimen2;$y++) {
			$chang = mysql_result($r21, $y, 'chang');
			$changes[] = $chang;
		}
		rsort($changes);
		$chang = $changes[0];
		
		$str = "|".mysql_result($r2, $i, 'name')."";
		for($ii=0;$ii<$maxnamelen-strlen(mysql_result($r2, $i, 'name'));$ii++) {$str = $str." ";}
		$str = $str."|".$naimen2."";
		for($ii=0;$ii<3-strlen($naimen2);$ii++) {$str = $str." ";}
		$str = $str."|";
		$str = $str.$stoim;
		for($ii=0;$ii<10-strlen($stoim);$ii++) {$str = $str." ";}
		$str = $str."|";
		$str = $str.date("d.m.Y, H:i", $chang);
		$str = $str."|";
		fputs($fp, $str."\r\n");
		fputs($fp, $strtop."\r\n");
		$allnaimen+=$naimen2;
	}
	$aaa = explode(".", $ostoim);
	while (strlen($aaa[1])<2){
		$aaa[1] = $aaa[1]."0";
	}
	$ostoim = implode(".", $aaa);
	$q22 = "select id from postavsh";
	$r22 = mysql_query($q22);
	fputs($fp, "\r\n");
	fputs($fp, "Всего групп:     ".mysql_num_rows($r2)."\r\n");
	fputs($fp, "Всего товаров:   ".$allnaimen."\r\n");
	fputs($fp, "Общая стоимость: ".$ostoim."\r\n");
	fputs($fp, "Поставщиков:     ".mysql_num_rows($r22)."\r\n");
	fputs($fp, "\r\n");
	fputs($fp, "\r\n");
	fputs($fp, "Программа \"".$mconf['program']['name']."\", версия ".$mconf['program']['version']."");
	fclose($fp);
	if(!isset($naimen)) {
		if(strstr($gfile, "\\")) {$dira = explode("\\", $gfile);}
		elseif(strstr($gfile, "/")) {$dira = explode("/", $gfile);}
		$dir = substr($gfile, 0, strlen($gfile)-strlen($dira[count($dira)-1]));
		print "
		<script language='JavaScript'>
		a = window.open('$dir', 'none');
		</script>
		";
	}
}


if(isset($postavsh)) {
	$q3 = "select * from postavsh";
	$r3 = mysql_query($q3);
	$namelen = array();
	$tellen = array();
	$maillen = array();
	$wwwlen = array();
	$conlen = array();
	for ($i=0; $i<mysql_num_rows($r3); $i++) {
		$namelen[] = strlen(mysql_result($r3, $i, 'name'));
		$tellen[] = strlen(mysql_result($r3, $i, 'phone'));
		$maillen[] = strlen(mysql_result($r3, $i, 'mail'));
		$wwwlen[] = strlen(mysql_result($r3, $i, 'www'));
		$conlen[] = strlen(mysql_result($r3, $i, 'contact'));
	}
	$maxnamelen = max($namelen);
	$maxtellen = max($tellen);
	$maxmaillen = max($maillen);
	$maxwwwlen = max($wwwlen);
	$maxconlen = max($conlen);
	$q32 = "select * from gruppy";
	$r32 = mysql_query($q32);
	$q33 = "select price, count from naimen";
	$r33 = mysql_query($q33);
	$allstoim=0;
	for($i=0;$i<mysql_num_rows($r33);$i++) {
		$price = mysql_result($r33, $i, 'price');
		$count = mysql_result($r33, $i, 'count');
		$stoim = $count*$price;
		$allstoim+=$stoim;
	}
	$strtop = "+";
	for($i=0;$i<$maxnamelen;$i++) {$strtop = $strtop."-";}
	$strtop = $strtop."+";
	for($i=0;$i<$maxtellen;$i++) {$strtop = $strtop."-";}
	$strtop = $strtop."+";
	for($i=0;$i<$maxmaillen;$i++) {$strtop = $strtop."-";}
	$strtop = $strtop."+";
	for($i=0;$i<$maxwwwlen;$i++) {$strtop = $strtop."-";}
	$strtop = $strtop."+";
	for($i=0;$i<$maxconlen;$i++) {$strtop = $strtop."-";}
	$strtop = $strtop."+";
	$fp = @fopen($pfile, "w") or die("<h3><font color='#ff0000'>Вы указали одну или несколько несуществующих папок в пути к файлу с поставщиками, либо, если такой файл уже существует, он скрыт или защищён от записи. Попробуйте заново.</font></h3><form action='dop.php'>
	<input class='submit' onmouseover='id=className' onmouseout='id=0' type='Submit' value='Вернуться назад' accesskey=','>
	</form>");
	fputs($fp, "     Поставщики          Файл создан: ".date("d.m.Y, H:i")."\r\n");
	fputs($fp, "\r\n");
	fputs($fp, "Столбцы: (| Имя | Телефон | E-mail | Сайт | Контактное лицо |)\r\n");
	fputs($fp, "\r\n");
	fputs($fp, $strtop."\r\n");
	for($i=0;$i<mysql_num_rows($r3);$i++) {
		$str = "|".mysql_result($r3, $i, 'name')."";
		for($ii=0;$ii<$maxnamelen-strlen(mysql_result($r3, $i, 'name'));$ii++) {$str = $str." ";}
		
		$str = $str."|".mysql_result($r3, $i, 'phone')."";
		for($ii=0;$ii<$maxtellen-strlen(mysql_result($r3, $i, 'phone'));$ii++) {$str = $str." ";}
		
		$str = $str."|".mysql_result($r3, $i, 'mail')."";
		for($ii=0;$ii<$maxmaillen-strlen(mysql_result($r3, $i, 'mail'));$ii++) {$str = $str." ";}
		
		$str = $str."|".mysql_result($r3, $i, 'www')."";
		for($ii=0;$ii<$maxwwwlen-strlen(mysql_result($r3, $i, 'www'));$ii++) {$str = $str." ";}
		
		$str = $str."|".mysql_result($r3, $i, 'contact')."";
		for($ii=0;$ii<$maxconlen-strlen(mysql_result($r3, $i, 'contact'));$ii++) {$str = $str." ";}
		
		$str = $str."|";
		fputs($fp, $str."\r\n");
		fputs($fp, $strtop."\r\n");
	}
	$aaa = explode(".", $allstoim);
	while (strlen($aaa[1])<2){
		$aaa[1] = $aaa[1]."0";
	}
	$allstoim = implode(".", $aaa);
	fputs($fp, "\r\n");;
	fputs($fp, "Поставщиков:     ".mysql_num_rows($r3)."\r\n");
	fputs($fp, "Всего групп:     ".mysql_num_rows($r32)."\r\n");
	fputs($fp, "Всего товаров:   ".mysql_num_rows($r33)."\r\n");
	fputs($fp, "Общая стоимость: ".$allstoim."\r\n");
	fputs($fp, "\r\n");
	fputs($fp, "\r\n");
	fputs($fp, "Программа \"".$mconf['program']['name']."\", версия ".$mconf['program']['version']."");
	fclose($fp);
	if(!isset($naimen) && !isset($gruppy)) {
		if(strstr($pfile, "\\")) {$dira = explode("\\", $pfile);}
		elseif(strstr($pfile, "/")) {$dira = explode("/", $pfile);}
		$dir = substr($pfile, 0, strlen($pfile)-strlen($dira[count($dira)-1]));
		print "
		<script language='JavaScript'>
		c = window.open('$dir', 'none');
		</script>
		";
	}
}
print "<h3>Операция завершена успешно.<br>Подождите.</h3>
<script language='JavaScript'>
document.getElementById('dirs').style.display='none';
</script>
<meta http-equiv='Refresh' content='1; url=dop.php'>";
mysql_close($mysql);
}
?>
<br><br>
<form action="dop.php">
<input class="submit" onmouseover="id=className" onmouseout="id=''" type="Submit" value="Вернуться назад" accesskey=','>
</form>
</body>
</html>
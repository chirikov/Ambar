<?php
include ("head.php");
if($pass != $pass0 or !$pass or !$pass0) {print "<h1>Неверный пароль! Повторите ввод.</h1>
<meta http-equiv='Refresh' content='2; url=index.php'>";
exit;
}
session_start();
session_destroy();
?>
<h1>Настройки</h1><br>
<h3>Здесь можно внести изменения в настройки программы</h3><br><br>
<?php

?>
<form action="config.php" name="f11">
Тема оформления : <select name="theme12" class=name onfocus='id=className' onblur='id=1'>
<?php
$tdir = $mconf['dir']['themes'];
$tdir = opendir($tdir);
$ar0 = file($mconf['dir']['themes']."/nowtheme.dat");
$nowt = trim($ar0[count($ar0)-1]);
session_start();
$themerealnow = $nowt;
session_register("themerealnow");
while (false !== ($tfile = readdir($tdir))) {
	if($tfile != "." && $tfile != ".." && $tfile != "nowtheme.dat") {
		$tfiles[] = $tfile;
	}
}
print "<option value='$nowt'>$nowt";
foreach ($tfiles as $tfile) {
	$tnfile0 = basename($tfile);
	$theme = substr($tnfile0, 0, (strlen($tnfile0) - 4));
	if (trim($theme) == trim($nowt)) {continue;}
	else {
		print "<option value='$theme'>$theme";
	}
}
?>
</select>
<br><br>
<input class="submit" onmouseover="id=className" onmouseout="id=''" type="Submit" value="Выбрать" name="go3" style="width: 100">
<input class="submit" onmouseover="id=className" onmouseout="id=''" type="submit" value="Удалить" name="godel" style="width: 100"
onclick="javascript: if (f11.theme12.value == 'первоначальная') {alert('Нельзя удалять первоначальную тему оформления.'); return false;}">
</form><br><br>
<?php
if (isset($go3)) {
$fp = $mconf['dir']['themes']."/".$theme12.".dat";
$e = copy($fp, $mconf['dir']['themes']."/nowtheme.dat");
$ffpp = fopen($mconf['dir']['themes']."/nowtheme.dat", "a");
fputs($ffpp, chr(13).chr(10).$theme12);
fclose($ffpp);
print "<meta http-equiv='refresh' content='0; url=config.php'>";
}
if(isset($godel)) {
if($theme12 != 'первоначальная'){
unlink($mconf['dir']['themes']."/".$theme12.".dat");
$fp = $mconf['dir']['themes']."/первоначальная.dat";
$e = copy($fp, $mconf['dir']['themes']."/nowtheme.dat");
$ffpp = fopen($mconf['dir']['themes']."/nowtheme.dat", "a");
fputs($ffpp, chr(13).chr(10)."первоначальная");
fclose($ffpp);
print "<meta http-equiv='refresh' content='0; url=config.php'>";
}
}
?>
<form action="config.php" name="fconf">
<input type="hidden" name="theme" value="<?php print "$theme"; ?>">
<table class="hp">
<tr><td align="right">Шрифт текста : </td><td><select class=name onfocus='id=className' onblur='id=1' name="font">
<?php
print "<option value=\"".$conf['font']['font']."\">".$conf['font']['font'];
$fpf = $mconf['dir']['inc']."/fonts.txt";
$fonts = file($fpf);
sort($fonts, SORT_STRING);
foreach($fonts as $font2) {
print "<option value='$font2'>$font2";
}
?>
</select>

<script language="JavaScript">
function changef(){
if(fconf.sav.checked == true){fconf.newtheme.disabled = false;}
if(fconf.sav.checked == false){fconf.newtheme.disabled = true;}}
</script>
</td></tr>
<tr><td align="right">Цвет текста : </td><td><input type="Text" class=name onfocus='id=className' onblur='id=1' name="textcol" value="<?php print $conf['colors']['text']; ?>"> <input type="button" class='submit' style="font-size: 15; height: 16; width: 60;" onmouseover='id=className' onmouseout='id=1' value="Выбрать" onclick="javascript:
window.open('selcol.php?what=textcol', '0', 'toolbar=0, location=0, directories=0, status=0, menubar=1, scrollbars=1, resizable=1');
"></td></tr>
<tr><td align="right">Цвет фона : </td><td><input type="Text" class=name onfocus='id=className' onblur='id=1' name="bgcol" value="<?php print $conf['colors']['fon']; ?>"> <input type="button" class='submit' style="font-size: 15; height: 16; width: 60;" onmouseover='id=className' onmouseout='id=1' value="Выбрать" onclick="javascript:
window.open('selcol.php?what=bgcol', '0', 'toolbar=0, location=0, directories=0, status=0, menubar=1, scrollbars=1, resizable=1');
"></td></tr>
<tr><td align="right">Цвет фона кнопок&nbsp;&nbsp;<br>без обращений к ним : </td><td><input type="Text" class=name onfocus='id=className' onblur='id=1' name="boutcol" value="<?php print $conf['colors']['b_out']; ?>"> <input type="button" class='submit' style="font-size: 15; height: 16; width: 60;" onmouseover='id=className' onmouseout='id=1' value="Выбрать" onclick="javascript:
window.open('selcol.php?what=boutcol', '0', 'toolbar=0, location=0, directories=0, status=0, menubar=1, scrollbars=1, resizable=1');
"></td></tr>
<tr><td align="right">Цвет фона кнопок&nbsp;&nbsp;<br>при обращении к ним : </td><td><input type="Text" class=name onfocus='id=className' onblur='id=1' name="bovcol" value="<?php print $conf['colors']['b_over']; ?>"> <input type="button" class='submit' style="font-size: 15; height: 16; width: 60;" onmouseover='id=className' onmouseout='id=1' value="Выбрать" onclick="javascript:
window.open('selcol.php?what=bovcol', '0', 'toolbar=0, location=0, directories=0, status=0, menubar=1, scrollbars=1, resizable=1');
"></td></tr>
<tr><td align="right">Цвет фона полей&nbsp;&nbsp;<br>без обращений к ним : </td><td><input type="Text" class=name onfocus='id=className' onblur='id=1' name="tblurcol" value="<?php print $conf['colors']['t_blur']; ?>"> <input type="button" class='submit' style="font-size: 15; height: 16; width: 60;" onmouseover='id=className' onmouseout='id=1' value="Выбрать" onclick="javascript:
window.open('selcol.php?what=tblurcol', '0', 'toolbar=0, location=0, directories=0, status=0, menubar=1, scrollbars=1, resizable=1');
"></td></tr>
<tr><td align="right">Цвет фона полей&nbsp;&nbsp;<br>при обращении к ним : </td><td><input type="Text" class=name onfocus='id=className' onblur='id=1' name="tfoccol" value="<?php print $conf['colors']['t_focus']; ?>"> <input type="button" class='submit' style="font-size: 15; height: 16; width: 60;" onmouseover='id=className' onmouseout='id=1' value="Выбрать" onclick="javascript:
window.open('selcol.php?what=tfoccol', '0', 'toolbar=0, location=0, directories=0, status=0, menubar=1, scrollbars=1, resizable=1');
"></td></tr>
<tr><td align="right">Цвет рамки таблиц : </td><td><input type="Text" class=name onfocus='id=className' onblur='id=1' name="tbcol" value="<?php print $conf['colors']['tb_border']; ?>"> <input type="button" class='submit' style="font-size: 15; height: 16; width: 60;" onmouseover='id=className' onmouseout='id=1' value="Выбрать" onclick="javascript:
window.open('selcol.php?what=tbcol', '0', 'toolbar=0, location=0, directories=0, status=0, menubar=1, scrollbars=1, resizable=1');
"></td></tr>
<tr><td align="right">Цвет рамки полей : </td><td><input type="Text" class=name onfocus='id=className' onblur='id=1' name="nbcol" value="<?php print $conf['colors']['t_border']; ?>"> <input type="button" class='submit' style="font-size: 15; height: 16; width: 60;" onmouseover='id=className' onmouseout='id=1' value="Выбрать" onclick="javascript:
window.open('selcol.php?what=nbcol', '0', 'toolbar=0, location=0, directories=0, status=0, menubar=1, scrollbars=1, resizable=1');
"></td></tr>
<tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
<tr><td align="right">Сохранить настройки<br>как новую тему? </td><td>&nbsp;&nbsp;<input type="checkbox" class=name onfocus='id=className' onblur='id=1' name="sav" onclick="javascript: changef();"></td><td></tr>
<tr><td align="right">Имя темы : </td><td><input type="text" class=name onfocus='id=className' onblur='id=1' name="newtheme" disabled></td></tr>
</table>
<br>
<input class="submit" onmouseover="id=className" onmouseout="id=''" type="Submit" value="Изменения внесены" name="go" onclick="javascript: if (f11.theme12.value == 'первоначальная' && fconf.sav.checked == false) {alert('Нельзя изменять первоначальную тему оформления. Сохраните изменения в отдельной теме.'); return false;}
if ((fconf.newtheme.value == '' || fconf.newtheme.value == ' ' || fconf.newtheme.value == '-') && fconf.sav.checked == true) {alert('Вы не ввели имя новой темы оформления.'); return false;}
">
<br><br>
<input class="submit" onmouseover="id=className" onmouseout="id=''" type="button" value="Изменить пароль" onclick="newwin = window.open('changepass.php', '', 'resizable=1')">
</form>

<?php
if(isset($go)) {

if(isset($sav)) {
	if(!$newtheme or $newtheme == " " or $newtheme == "-") {exit;}
	$font = rtrim($font);
	$fps = $mconf['dir']['themes']."/".$newtheme.".dat";
	$fps = fopen($fps, "w");
	fwrite($fps, "[font]".chr(13).chr(10));
	fwrite($fps, "font=\"".$font."\";".chr(13).chr(10));
	
	fwrite($fps, chr(13).chr(10)."[colors]".chr(13).chr(10));
	fwrite($fps, "text=\"".$textcol."\";".chr(13).chr(10));
	fwrite($fps, "fon=\"".$bgcol."\";".chr(13).chr(10));
	fwrite($fps, "b_out=\"".$boutcol."\";".chr(13).chr(10));
	fwrite($fps, "b_over=\"".$bovcol."\";".chr(13).chr(10));
	fwrite($fps, "t_focus=\"".$tfoccol."\";".chr(13).chr(10));
	fwrite($fps, "t_blur=\"".$tblurcol."\";".chr(13).chr(10));
	fwrite($fps, "tb_border=\"".$tbcol."\";".chr(13).chr(10));
	fwrite($fps, "t_border=\"".$nbcol."\";".chr(13).chr(10));
	fwrite($fps, "link=\"".$conf['colors']['link']."\";".chr(13).chr(10));
	fwrite($fps, "alink=\"".$conf['colors']['alink']."\";".chr(13).chr(10));
	fwrite($fps, "vlink=\"".$conf['colors']['vlink']."\";".chr(13).chr(10));
	fwrite($fps, "dateline=\"".$conf['colors']['dateline']."\";".chr(13).chr(10));

	fwrite($fps, chr(13).chr(10)."[font_size]".chr(13).chr(10));
	fwrite($fps,"form=\"".$conf['font_size']['form']."\";".chr(13).chr(10));
	
	fwrite($fps, chr(13).chr(10)."[decor]".chr(13).chr(10));
	fwrite($fps,"link=\"".$conf['decor']['link']."\";".chr(13).chr(10));
	fwrite($fps,"vlink=\"".$conf['decor']['vlink']."\";".chr(13).chr(10));
	fwrite($fps,"alink=\"".$conf['decor']['alink']."\";".chr(13).chr(10));
	
	fwrite($fps, chr(13).chr(10)."[cursor]".chr(13).chr(10));
	fwrite($fps,"button=\"".$conf['cursor']['button']."\";".chr(13).chr(10));
	
	fwrite($fps, chr(13).chr(10)."[height]".chr(13).chr(10));
	fwrite($fps,"button=\"".$conf['height']['button']."\";".chr(13).chr(10));
	
	fwrite($fps, chr(13).chr(10)."[width]".chr(13).chr(10));
	fwrite($fps,"button=\"".$conf['width']['button']."\";".chr(13).chr(10));
	fwrite($fps,"dateline=\"".$conf['width']['dateline']."\";".chr(13).chr(10));
	
	fwrite($fps, chr(13).chr(10)."[border-style]".chr(13).chr(10));
	fwrite($fps,"table=\"".$conf['border-style']['table']."\";".chr(13).chr(10));
	fwrite($fps,"text=\"".$conf['border-style']['text']."\";".chr(13).chr(10));
	
	fwrite($fps, chr(13).chr(10)."[border]".chr(13).chr(10));
	fwrite($fps,"table=\"".$conf['border']['table']."\";".chr(13).chr(10));
	fwrite($fps,"text=\"".$conf['border']['text']."\";".chr(13).chr(10));
	fwrite($fps,"button=\"".$conf['border']['button']."\";".chr(13).chr(10));
	
	fclose($fps);
	
	$fp = $mconf['dir']['themes']."/".$newtheme.".dat";
	$e = copy($fp, $mconf['dir']['themes']."/nowtheme.dat");
	$ffpp = fopen($mconf['dir']['themes']."/nowtheme.dat", "a");
	fputs($ffpp, chr(13).chr(10).$newtheme);
	fclose($ffpp);
	print "<meta http-equiv='refresh' content='0; url=config.php'>";
}

else {
	$fps = $mconf['dir']['themes']."/".$themerealnow.".dat";
	$fps = fopen($fps, "w");
	$font = rtrim($font);
	fwrite($fps, "[font]".chr(13).chr(10));
	fwrite($fps, "font=\"".$font."\";".chr(13).chr(10));
	
	fwrite($fps, chr(13).chr(10)."[colors]".chr(13).chr(10));
	fwrite($fps, "text=\"".$textcol."\";".chr(13).chr(10));
	fwrite($fps, "fon=\"".$bgcol."\";".chr(13).chr(10));
	fwrite($fps, "b_out=\"".$boutcol."\";".chr(13).chr(10));
	fwrite($fps, "b_over=\"".$bovcol."\";".chr(13).chr(10));
	fwrite($fps, "t_focus=\"".$tfoccol."\";".chr(13).chr(10));
	fwrite($fps, "t_blur=\"".$tblurcol."\";".chr(13).chr(10));
	fwrite($fps, "tb_border=\"".$tbcol."\";".chr(13).chr(10));
	fwrite($fps, "t_border=\"".$nbcol."\";".chr(13).chr(10));
	fwrite($fps, "link=\"".$conf['colors']['link']."\";".chr(13).chr(10));
	fwrite($fps, "alink=\"".$conf['colors']['alink']."\";".chr(13).chr(10));
	fwrite($fps, "vlink=\"".$conf['colors']['vlink']."\";".chr(13).chr(10));
	fwrite($fps, "dateline=\"".$conf['colors']['dateline']."\";".chr(13).chr(10));

	fwrite($fps, chr(13).chr(10)."[font_size]".chr(13).chr(10));
	fwrite($fps,"form=\"".$conf['font_size']['form']."\";".chr(13).chr(10));
	
	fwrite($fps, chr(13).chr(10)."[decor]".chr(13).chr(10));
	fwrite($fps,"link=\"".$conf['decor']['link']."\";".chr(13).chr(10));
	fwrite($fps,"vlink=\"".$conf['decor']['vlink']."\";".chr(13).chr(10));
	fwrite($fps,"alink=\"".$conf['decor']['alink']."\";".chr(13).chr(10));
	
	fwrite($fps, chr(13).chr(10)."[cursor]".chr(13).chr(10));
	fwrite($fps,"button=\"".$conf['cursor']['button']."\";".chr(13).chr(10));
	
	fwrite($fps, chr(13).chr(10)."[height]".chr(13).chr(10));
	fwrite($fps,"button=\"".$conf['height']['button']."\";".chr(13).chr(10));
	
	fwrite($fps, chr(13).chr(10)."[width]".chr(13).chr(10));
	fwrite($fps,"button=\"".$conf['width']['button']."\";".chr(13).chr(10));
	fwrite($fps,"dateline=\"".$conf['width']['dateline']."\";".chr(13).chr(10));
	
	fwrite($fps, chr(13).chr(10)."[border-style]".chr(13).chr(10));
	fwrite($fps,"table=\"".$conf['border-style']['table']."\";".chr(13).chr(10));
	fwrite($fps,"text=\"".$conf['border-style']['text']."\";".chr(13).chr(10));
	
	fwrite($fps, chr(13).chr(10)."[border]".chr(13).chr(10));
	fwrite($fps,"table=\"".$conf['border']['table']."\";".chr(13).chr(10));
	fwrite($fps,"text=\"".$conf['border']['text']."\";".chr(13).chr(10));
	fwrite($fps,"button=\"".$conf['border']['button']."\";".chr(13).chr(10));
	
	fclose($fps);
	
	$fp = $mconf['dir']['themes']."/".$themerealnow.".dat";
	$e = copy($fp, $mconf['dir']['themes']."/nowtheme.dat");
	$ffpp = fopen($mconf['dir']['themes']."/nowtheme.dat", "a");
	fputs($ffpp, chr(13).chr(10).$themerealnow);
	fclose($ffpp);
	@session_destroy();
	print "<meta http-equiv='refresh' content='0; url=config.php'>";
}

}
?>

<form action="main.php">
<input class="submit" onmouseover="id=className" onmouseout="id=''" type="Submit" value="Вернуться на стартовую страницу" accesskey=','>
</form>
</body>
</html>

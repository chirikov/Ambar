<?php
include ("head.php");
?>
<h1>������������.</h1><br>
<h3>������ ����� ������� ���� ������, ������� � �����, ����������� ��� ������ ���������.</h3><br><br>
<h3>��� ������ �������� ��������� ���� �  ������� "������".</h3><br><br>
<form action="install.php">
<table class="hp">
<tr><td align="right">URL � ����� ��������� : </td><td><input type="Text" size='30' class=name onfocus='id=className' onblur='id=1' name="url" value="<?php print "http://"."$SERVER_NAME".SUBSTR($PHP_SELF, 0, strlen($PHP_SELF)-12) ?>"></td></tr>
<tr><td align="right">��� ������� ���� ������ MySQL : </td><td><input type="Text" size='20' class=name onfocus='id=className' onblur='id=1' name="myhost" value="localhost"></td></tr>
<tr><td align="right">��� ������������ ��� ������� � ���� ������ MySQL : </td><td><input type="Text" size='20' class=name onfocus='id=className' onblur='id=1' name="mylogin" value="root"></td></tr>
<tr><td align="right">������ ��� ������� � ���� ������ MySQL : </td><td><input size='20' type="password" class=name onfocus='id=className' onblur='id=1' name="mypass1"></td></tr>
<tr><td align="right">����������� ������ ��� ������� � ���� ������ MySQL : </td><td><input size='20' type="password" class=name onfocus='id=className' onblur='id=1' name="mypass2"></td></tr>

</table>
<br><br>
<input type="Submit" value="������" class="submit" onmouseover="id=className" onmouseout="id=''" name="go">
</form>
<?php
if(isset($go)) {
if(!$url)			{print "�� �� ����� URL � ����� ���������."; exit;}
elseif(!$myhost)	{print "�� �� ����� ��� ������� ���� ������ MySQL."; exit;}
elseif(!$mylogin)	{print "�� �� ����� ��� ������������ ��� ������� � ���� ������ MySQL."; exit;}
elseif(!$mypass1)	{print "�� �� ����� ������ ��� ������� � ���� ������ MySQL."; exit;}
elseif(!$mypass2)	{print "�� �� ����������� ������ ��� ������� � ���� ������ MySQL."; exit;}
elseif($mypass1 != $mypass2) {print "�� ����� ������ ������."; exit;}
elseif(!strstr($url, "http://")) {print "�� ����� �������� URL � ����� ���������."; exit;}
else {

$my = @mysql_connect($myhost, $mylogin, $mypass1) or die ("<font color='#ff0000'>�� ���������� ������������ � ������� MySQL. ���������� � ������������.</font>");
$r1 = mysql_query("create database IF NOT EXISTS ".$mconf['mysql']['db']."");
if(!$r1) {print "<h1><font color='#ff0000'>������1 : ".convert_cyr_string(mysql_error(), "k", "w")."</font></h1>"; exit;}
$db = @mysql_select_db($mconf['mysql']['db'], $my) or die("<font color='#ff0000'>�� ���������� ������� ���� ������. ���������� � ������������.</font>");
$res = mysql_query("create table IF NOT EXISTS postavsh(
`id` int,
`name` varchar(50),
`phone` varchar(20),
`mail` varchar(50),
`www` varchar(50),
`contact` varchar(50),
`chang` int
)");
if(!$res) {print "<h1><font color='#ff0000'>������2 : ".convert_cyr_string(mysql_error(), "k", "w")."</font></h1>"; exit;}

$res2 = mysql_query("create table IF NOT EXISTS naimen(
id int,
article varchar(50),
name varchar(50),
ed varchar(50),
count int,
price double(16,2),
post int,
gruppa int,
chang int
)");
if(!$res2) {print "<h1><font color='#ff0000'>������3 : ".convert_cyr_string(mysql_error(), "k", "w")."</font></h1>"; exit;}

$res3 = mysql_query("create table IF NOT EXISTS gruppy(
id int,
name varchar(50)
)");
if(!$res3) {print "<h1><font color='#ff0000'>������4 : ".convert_cyr_string(mysql_error(), "k", "w")."</font></h1>"; exit;}

$res4 = mysql_query("create table IF NOT EXISTS prodaja(
article varchar(50),
count int,
date int
)");
if(!$res4) {print "<h1><font color='#ff0000'>������5 : ".convert_cyr_string(mysql_error(), "k", "w")."</font></h1>"; exit;}

$res5 = mysql_query("create table IF NOT EXISTS prihod(
article varchar(50),
count int,
date int
)");
if(!$res5) {print "<h1><font color='#ff0000'>������6 : ".convert_cyr_string(mysql_error(), "k", "w")."</font></h1>"; exit;}

mysql_close($my);

$fp1 = $mconf['dir']['themes']."/nowtheme.dat";
$fnow = file($fp1);
$fp2 = $mconf['dir']['themes']."/��������������.dat";
$fp2 = fopen($fp2, "w");
foreach($fnow as $fstr) {fputs($fp2, $fstr);}
fclose($fp2);

$fp3 = $mconf['dir']['inc']."/config.dat";
$fconf = file($fp3);
$fp4 = $mconf['dir']['inc']."/config.dat";
$fp4 = fopen($fp4, "w");
foreach($fconf as $cstr) {fputs($fp4, $cstr);}
fwrite($fp4, "login=\"".$mylogin."\";".chr(13).chr(10));
fwrite($fp4, "host=\"".$myhost."\";".chr(13).chr(10));
fwrite($fp4, "password=\"".$mypass1."\";".chr(13).chr(10));
fclose($fp4);

if(substr($url, strlen($url)-1, strlen($url)) == "/") $url = substr($url, 0, strlen($url)-1);
if(substr($url, strlen($url)-1, strlen($url)) == "\\") $url = substr($url, 0, strlen($url)-1);


$fp5 = "�����.url";
$fp5 = fopen($fp5, "w");
if(!fputs($fp5, "[InternetShortcut]".chr(13).chr(10))) {print "<font color='#ff0000'>��������� ������! ���������� � ������������.</font>"; exit;}
fputs($fp5, "URL=".$url."/start.php".chr(13).chr(10));
fputs($fp5, "IconIndex=47".chr(13).chr(10));
fputs($fp5, "IconFile=".$SystemRoot."\system32\SHELL32.dll".chr(13).chr(10));
fclose($fp5);

print "<h2>����������!<br>�������� ��������� �������.<br>
������ � ����� ��������� ���� ����� ��� ������� ���������.</h2><br>
<h3>�� ����������� ������ ���� ������!</h3>";

}
}
?>
</body>
</html>

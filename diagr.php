<?php
$mconf = parse_ini_file("./inc/config.dat", 1);
$conf = parse_ini_file($mconf['dir']['themes']."/nowtheme.dat", 1);
function getcolor($color) {
	$res = array();
	$res[0] = hexdec(substr($color, 1, 2));
	$res[1] = hexdec(substr($color, 3, 2));
	$res[2] = hexdec(substr($color, 5, 2));
	return $res;
}

if(isset($namingr)) {
header("Content-type: image/jpg");
$image = imagecreate(900, 500);
$foncol = getcolor($conf['colors']['fon']);
$colorBackgr=ImageColorAllocate($image, $foncol[0], $foncol[1], $foncol[2]);
$textcol = getcolor($conf['colors']['text']);
$color1=ImageColorAllocate($image, $textcol[0], $textcol[1], $textcol[2]);
$color2=ImageColorAllocate($image, 235, 111, 0);
$color3=ImageColorAllocate($image, 3, 166, 208);
$color4=ImageColorAllocate($image, 200, 0, 200);
$color5=ImageColorAllocate($image, 0, 0, 200);
$colors = array($color2, $color3, $color4, $color5);
#imagecolortransparent($image, $colorBackgr);
imagearc($image, 450, 250, 250, 250, 0, 360, $color1);

$mysql = @mysql_connect($mconf['mysql']['host'], $mconf['mysql']['login'], $mconf['mysql']['password']) or die ("<font color='#ff0000'>Не получилось подключиться к серверу MySQL. Обратитесь к разработчику.</font>");
@mysql_select_db($mconf['mysql']['db']) or die("<font color='#ff0000'>Не получилось выбрать базу данных. Обратитесь к разработчику.</font>");
$query1 = "SELECT * FROM gruppy";
$result1 = mysql_query($query1);
$n1 = mysql_num_rows($result1);
$gids = array();
for($i=0;$i<$n1;$i++) {$gids[] = mysql_result($result1, $i, 'id');}
if ($n1 % 4 == 1) $ncend = 1;
$r0 = mysql_query("select id from naimen");
$num = mysql_num_rows($r0);
$fang=0;
$nc = -1;
$offs = 80;
foreach($gids as $gid) {
	$nc++;
	$r = mysql_query("select id from naimen where gruppa=$gid");
	$n = mysql_num_rows($r);
	if($n == 0) continue;
	if($nc >= count($colors)) $nc=0;
	$p = round($n/$num*100, 1);
	$ang = 3.6*$p+$fang;
	$ang2 = deg2rad($ang);
	$ang20 = deg2rad($ang-2);
	$kx = cos($ang2)*125+450;
	$ky = sin($ang2)*125+250;
	$kx0 = cos($ang20)*121+450;
	$ky0 = sin($ang20)*121+250;
	imageline($image, 450, 250, $kx, $ky, $color1);
	imagefilltoborder($image, $kx0, $ky0, $color1, $colors[$nc]);
	$gn = mysql_result(mysql_query("select name from gruppy where id=$gid"), 0, 'name');
	if($ang>90 && $ang <= 270) {
		imageline($image, $kx0, $ky0, $kx0-50, $ky0+($offs*sin($ang2)), $color1);
		imagefilledrectangle($image, $kx0-70, $ky0-5+($offs*sin($ang2)), $kx0-60, $ky0+5+($offs*sin($ang2)), $colors[$nc]);
		imagettftext($image, 14, 0, ($kx0-70-130)-strlen($gn)*9, $ky0-8+15+($offs*sin($ang2)), $color1, "mnc.ttf", $gn." : $n ($p %)");
	}
	if($ang<=90 || $ang > 270) {
		imageline($image, $kx0, $ky0, $kx0+50, $ky0+($offs*sin($ang2)), $color1);
		imagefilledrectangle($image, $kx0+60, $ky0-5+($offs*sin($ang2)), $kx0+70, $ky0+5+($offs*sin($ang2)), $colors[$nc]);
		imagettftext($image, 14, 0, $kx0+80, $ky0-8+15+($offs*sin($ang2)), $color1, "mnc.ttf", $gn." : $n ($p %)");
	}
	$fang=$ang;
}
imageinterlace($image, 1);
imagejpeg($image, '', 100);
}
############################################################################################################

if(isset($naminpos)) {
header("Content-type: image/jpg");
$image=ImageCreate(900, 500);
$foncol = getcolor($conf['colors']['fon']);
$colorBackgr=ImageColorAllocate($image, $foncol[0], $foncol[1], $foncol[2]);
$textcol = getcolor($conf['colors']['text']);
$color1=ImageColorAllocate($image, $textcol[0], $textcol[1], $textcol[2]);
$color2=ImageColorAllocate($image, 235, 111, 0);
$color3=ImageColorAllocate($image, 3, 166, 208);
$color4=ImageColorAllocate($image, 200, 0, 200);
$color5=ImageColorAllocate($image, 0, 0, 200);
$colors = array($color2, $color3, $color4, $color5);
#imagecolortransparent($image, $colorBackgr);
imagearc($image, 450, 250, 250, 250, 0, 360, $color1);

$mysql = @mysql_connect($mconf['mysql']['host'], $mconf['mysql']['login'], $mconf['mysql']['password']) or die ("<font color='#ff0000'>Не получилось подключиться к серверу MySQL. Обратитесь к разработчику.</font>");
@mysql_select_db($mconf['mysql']['db']) or die("<font color='#ff0000'>Не получилось выбрать базу данных. Обратитесь к разработчику.</font>");
$query1 = "SELECT * FROM postavsh";
$result1 = mysql_query($query1);
$n1 = mysql_num_rows($result1);
$gids = array();
for($i=0;$i<$n1;$i++) {
	$gids[] = mysql_result($result1, $i, 'id');
}
if ($n1 % 4 == 1) $ncend = 1;
$r0 = mysql_query("select id from naimen");
$num = mysql_num_rows($r0);
$fang=0;
$nc = -1;
$offs = 80;
foreach($gids as $gid) {
	$nc++;
	$r = mysql_query("select id from naimen where post=$gid");
	$n = mysql_num_rows($r);
	if($n == 0) continue;
	if($nc >= count($colors)) $nc=0;
	$p = round($n/$num*100, 1);
	$ang = 3.6*$p+$fang;
	$ang2 = deg2rad($ang);
	$ang20 = deg2rad($ang-2);
	$kx = cos($ang2)*125+450;
	$ky = sin($ang2)*125+250;
	$kx0 = cos($ang20)*121+450;
	$ky0 = sin($ang20)*121+250;
	imageline($image, 450, 250, $kx, $ky, $color1);
	imagefilltoborder($image, $kx0, $ky0, $color1, $colors[$nc]);
	$gn = mysql_result(mysql_query("select name from postavsh where id=$gid"), 0, 'name');
	if($ang>90 && $ang <= 270) {
		imageline($image, $kx0, $ky0, $kx0-50, $ky0+($offs*sin($ang2)), $color1);
		imagefilledrectangle($image, $kx0-70, $ky0-5+($offs*sin($ang2)), $kx0-60, $ky0+5+($offs*sin($ang2)), $colors[$nc]);
		imagettftext($image, 14, 0, ($kx0-70-130)-strlen($gn)*9, $ky0-8+15+($offs*sin($ang2)), $color1, "mnc.ttf", $gn." : $n ($p %)");
	}
	if($ang<=90 || $ang > 270) {
		imageline($image, $kx0, $ky0, $kx0+50, $ky0+($offs*sin($ang2)), $color1);
		imagefilledrectangle($image, $kx0+60, $ky0-5+($offs*sin($ang2)), $kx0+70, $ky0+5+($offs*sin($ang2)), $colors[$nc]);
		imagettftext($image, 14, 0, $kx0+80, $ky0-8+15+($offs*sin($ang2)), $color1, "mnc.ttf", $gn." : $n ($p %)");
	}
	$fang=$ang;
}
imageinterlace($image, 1);
imagejpeg($image, '', 100);
}
?>

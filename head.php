<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
error_reporting(E_ALL ^ E_NOTICE);
$mconf = parse_ini_file("./inc/config.dat", 1);
$conf = parse_ini_file($mconf['dir']['themes']."/nowtheme.dat", 1);
ignore_user_abort();
$cname = $_COOKIE['ambarcookie'];
$passa = file($mconf['dir']['inc']."/pass.txt");
$pass0 = trim($passa[0]);
$pass = trim($_COOKIE[$cname]);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title><?php print $mconf['window']['title'].", &nbsp;версия ".$mconf['program']['version']; ?></title>
<?php
print "
<style type='text/css'>
a:link  	{text-decoration: ".$conf['decor']['link']."; color: ".$conf['colors']['link'].";}
a:active	{text-decoration: ".$conf['decor']['link']."; color: ".$conf['colors']['alink'].";}
a:visited	{text-decoration: ".$conf['decor']['link']."; color: ".$conf['colors']['vlink'].";}
.submit 	{border: ".$conf['border']['button']."; FONT-SIZE: ".$conf['font_size']['form']."; COLOR: ".$conf['colors']['text']."; cursor: ".$conf['cursor']['button']."; FONT-FAMILY: ".$conf['font']['font']."; HEIGHT: ".$conf['height']['button']."; BACKGROUND-COLOR: ".$conf['colors']['b_out']."; width: ".$conf['width']['button'].";}
#submit 	{border: ".$conf['border']['button']."; FONT-SIZE: ".$conf['font_size']['form']."; COLOR: ".$conf['colors']['text']."; cursor: ".$conf['cursor']['button']."; FONT-FAMILY: ".$conf['font']['font']."; HEIGHT: ".$conf['height']['button']."; BACKGROUND-COLOR: ".$conf['colors']['b_over']."; width: ".$conf['width']['button'].";}
.submit2 	{border: ".$conf['border']['button']."; FONT-SIZE: ".$conf['font_size']['form']."; COLOR: ".$conf['colors']['text']."; cursor: ".$conf['cursor']['button']."; FONT-FAMILY: ".$conf['font']['font']."; HEIGHT: ".$conf['height']['button']."; BACKGROUND-COLOR: ".$conf['colors']['fon']."; text-align: left;}
.submit3 	{border: ".$conf['border']['button']."; FONT-SIZE: ".$conf['font_size']['form']."; COLOR: ".$conf['colors']['text']."; cursor: ".$conf['cursor']['button']."; FONT-FAMILY: ".$conf['font']['font']."; HEIGHT: ".$conf['height']['button']."; BACKGROUND-COLOR: ".$conf['colors']['fon'].";}
.table  	{border: ".$conf['border']['table']."; border-style: ".$conf['border-style']['table']."; border-color: ".$conf['colors']['tb_border']."; color: ".$conf['colors']['text'].";}
.name		{border: ".$conf['border']['text']."; border-style: ".$conf['border-style']['text']."; border-color: ".$conf['colors']['t_border']."; background-color: ".$conf['colors']['t_blur']."; color: ".$conf['colors']['text'].";}
#name		{border: ".$conf['border']['text']."; border-style: ".$conf['border-style']['text']."; border-color: ".$conf['colors']['t_border']."; background-color: ".$conf['colors']['t_focus']."; color: ".$conf['colors']['text'].";}
.hp			{font-family: ".$conf['font']['font']."; color: ".$conf['colors']['text'].";}
</style>
";
?>

<meta http-equiv="Content-type" content="text/html; charset=windows-1251">
<META content="<?php print $mconf['program']['copyright']; ?>" name=copyright>
<META content="<?php print $mconf['program']['author']; ?>" name=author>
<META content="<?php print $mconf['program']['name']; ?>" name=description>
<script language="JavaScript">
function hel() {
w = window.open("readme.php", "", "resizable=1, scrollbars=1");
}
</script>
</head>

<body oncontextmenu="javascript: if (event.srcElement.name != 'ambarimage') {return false;}" onhelp="javascript: hel(); return false;" class="hp" bgcolor=<?php print $conf['colors']['fon']; ?> vlink=<?php print $conf['colors']['vlink']; ?> alink=<?php print $conf['colors']['alink']; ?>>
<center><b>
<?php include($mconf['dir']['inc']."/date.php"); ?></b>
<hr width=<?php print $conf['width']['dateline']; ?> color=<?php print $conf['colors']['dateline']; ?>>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<HTA:APPLICATION ID="oHTA"
     APPLICATIONNAME="myApp"
     BORDER="thin"
     BORDERSTYLE="normal"
     CAPTION="yes"
     ICON=""
     MAXIMIZEBUTTON="yes"
     MINIMIZEBUTTON="yes"
     SHOWINTASKBAR="no"
     SINGLEINSTANCE="no"
     SYSMENU="yes"
     VERSION="1.0"
     WINDOWSTATE="maximize"
    >
<?php
$adr = "http://"."$SERVER_NAME"."$PHP_SELF";
$adr = str_replace("start.php", "index.php", $adr);
?>
	<title>Закройте это окно</title>
<script language="JavaScript">
function choose() {
var wid = screen.availwidth;
var heig = screen.availheight;
wid = wid-10;
heig = heig - 80;
window.open('<?php print "$adr"; ?>', 'null', 'toolbar=0, left=0, top=0, height=' + heig + ', width=' + wid + ', location=0, directories=0, status=0, menubar=1, scrollbars=1, resizable=1');
}
</script>
</head>
<body onload="choose()">
<h1>Пожалуйста, закройте это окно.</h1>
<script language="JavaScript">
setTimeout("self.close()", 1000);
</script>
</body>
</html>

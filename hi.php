<?php
$hour = date("H");
if($hour>=12 && $hour<19) {$pr = "������ ����.";}
if($hour>=19 && $hour<=23) {$pr = "������ �����.";}
if($hour<12 && $hour>=6) {$pr = "������ ����.";}
if($hour>=0 && $hour<6) {$pr = "������ ����.";}
print "$pr";
?>
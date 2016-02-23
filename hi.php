<?php
$hour = date("H");
if($hour>=12 && $hour<19) {$pr = "Добрый день.";}
if($hour>=19 && $hour<=23) {$pr = "Добрый вечер.";}
if($hour<12 && $hour>=6) {$pr = "Доброе утро.";}
if($hour>=0 && $hour<6) {$pr = "Добрая ночь.";}
print "$pr";
?>
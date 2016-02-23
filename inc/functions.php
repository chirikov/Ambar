<?php

function mysql_rus_search ($table, $cols, $sub, $colr)
{
	$table = trim($table);
	$cols = trim($cols);
	$sub = trim($sub);
	$colr = trim($colr);
	$res99 = array();
	$result99 = mysql_query("select * from $table");
	for($vv=0;$vv<mysql_num_rows($result99);$vv++) {
		$res992 = trim(mysql_result($result99, $vv, $cols));
		$res99[] = $res992;
	}
	if(in_array($sub, $res99)) {
		$str = array_search($sub, $res99);
		$result = trim(mysql_result($result99, $str, $colr));
	}
	else {$result = false;}
	return $result;
}

?>
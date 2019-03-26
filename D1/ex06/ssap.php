#!/usr/bin/php
<?php
if ($argc > 1) {
unset($argv[0]);
foreach ($argv as $arg){
	$arg = array_filter(explode(' ', $arg));
	foreach ($arg as $v)
		$arr[] = $v;
}
if ($arr) {
sort($arr);
foreach ($arr as $elem)
	echo $elem."\n";
}
}
?>

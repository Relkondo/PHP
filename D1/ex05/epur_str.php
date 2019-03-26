#!/usr/bin/php
<?php
if ($argc == 2) {$arr = array_filter(explode(' ', $argv[1]));
foreach($arr as $elem)
	$res .= $elem." ";
echo trim($res)."\n";}
?>

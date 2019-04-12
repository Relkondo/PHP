#!/usr/bin/php
<?php
if ($argc < 3) {
	exit();
}
$key = $argv[1];
unset($argv[0], $argv[1]);
$argv = array_reverse($argv);
foreach ($argv as $arg){
	$div = explode(":", $arg);
	if ($div[1] && $key === $div[0] && !$div[2]) {
		echo $div[1]."\n";
		exit();
	}
}
?>

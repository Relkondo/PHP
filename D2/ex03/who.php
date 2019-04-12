#!/usr/bin/php
<?php
date_default_timezone_set('Europe/Paris');
if (($fp = fopen("/var/run/utmpx", 'r')) === false)
	exit ;
while ($utmpx = fread($fp, 628)){
	$unpacked = unpack("A256name/A4tty/A32tty_complete/iPID/iProcess/Iconnection_date", $utmpx);
	if ($unpacked['Process'] == 7)
		$arr[] = $unpacked;
}
fclose($fp);
ksort($arr);
foreach ($arr as $ele){
		echo str_pad(substr($ele['name'], 0, 8), 9, " ");
		echo str_pad(substr($ele['tty_complete'], 0, 8), 9, " ");
		echo date("M j H:i ", $ele['connection_date']);
		echo "\n";
}

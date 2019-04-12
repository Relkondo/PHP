#!/usr/bin/php
<?php

function ft_do_op ($nb1, $op, $nb2) {
	switch ($op) {
	case ("*") :
		echo $nb1 * $nb2;
		break;
	case ("+") :
		echo $nb1 + $nb2;
		break;
	case ("-") :
		echo $nb1 - $nb2;
		break;
	case ("/") :
		echo $nb1 / $nb2;
		break;
	case ("%") :
		echo $nb1 % $nb2;
		break;
	default:
		echo "Syntax Error";
	}
}

if ($argc != 2) {
	echo "Incorrect Parameters\n";
	exit();
}
$arr = str_replace(" ", "", $argv[1]);
$i = 0;
while (is_numeric($arr[$i]))
	$i++;
$nb1 = substr($arr, 0, $i);
if ($i + 1 < strlen($arr)){
	$op= $arr[$i];
	$nb2 = substr($arr, $i + 1);
}
if (!is_numeric($nb2) || !is_numeric($nb1))
	echo "Syntax Error";
else ft_do_op($nb1, $op, $nb2);
echo "\n";

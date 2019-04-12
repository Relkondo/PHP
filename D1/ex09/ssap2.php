#!/usr/bin/php
<?php
function ft_split($arr)
{
	$arr = array_filter(explode(" ", $arr));
	$arr = array_merge($arr);
	return ($arr);
}

function ft_convert($ord)
{
	if ($ord >= 65 && $ord <= 90)
		return ($ord - 65);
	else if ($ord >= 97 && $ord <= 122)
		return ($ord - 97);
	else if ($ord >= 48 && $ord <= 57)
		return ($ord - 22);
	else if ($ord >= 33 && $ord <= 47)
		return ($ord + 3);
	else if ($ord >= 58 && $ord <= 64)
		return ($ord - 7);
	else if ($ord >= 91 && $ord <= 96)
		return ($ord - 33);
	else if ($ord >= 123)
		return ($ord - 59);
}

function ft_sort_special($a, $b)
{
	$i = 0;
	while (ft_convert(ord($a[$i])) == ft_convert(ord($b[$i])) && $i < strlen($a) && $i < strlen($b))
		$i++;
	$a_o = ft_convert(ord($a[$i]));
	$b_o= ft_convert(ord($b[$i]));
	if ($a_o > $b_o)
		return (1);
	else if ($a_o < $b_o)
		return (-1);
	return (0);
}

if ($argc > 1)
{
	$mrged = array();
	unset ($argv[0]);
	foreach ($argv as $ar)
		$mrged = array_merge($mrged, ft_split($ar));
	uasort($mrged, "ft_sort_special");
	foreach ($mrged as $el)
		echo ($el."\n");
}

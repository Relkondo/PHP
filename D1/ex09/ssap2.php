#!/usr/bin/php
<?php

function	ft_tri($a, $b)
{
	$a = strtolower($a);
	$b = strtolower($b);
	$sort = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
	$len = strlen($a) < strlen($b) ? strlen($a) : strlen($b);
	for ($i = 0; $i < $len; $i++)
	{
		$aa = substr($a, $i, 1);
		$bb = substr($b, $i, 1);
		$ia = array_search($aa, $sort);
		$ib = array_search($bb, $sort);
		$ia = $ia === false ? ord($aa): $ia ;
		$ib = $ib === false ? ord($bb): $ib ;
		if ($ib < $ia)
			return (false);
		if ($ib > $ia)
			return (true);
	}
	return strlen($a) <= strlen($b) ? true : false;
}

function	ft_null($val)
{
	if ($val === "0")
		return (true);
	return !($val === null || empty($val));
}

$tab = array();
unset($argv[0]);
foreach($argv as $elem)
{
	$tmp = array_filter(explode(" ", $elem), 'ft_null');
	foreach ($tmp as $elem2)
		$tab[] = $elem2;
}
for ($i = 0; $i < count($tab) - 1;)
{
	if (ft_tri($tab[$i], $tab[$i + 1]))
		$i++;
	else
	{
		$tmp = $tab[$i];
		$tab[$i] = $tab[$i + 1];
		$tab[$i + 1] = $tmp;
		$i = 0;
	}
}
foreach ($tab as $elem)
	echo $elem."\n";

#!/usr/bin/php
<?php

if ($argc < 3)
	return ;
$tab = [];
foreach ($argv as $elem)
	array_push($tab, $elem);
array_splice($tab, 0, 1);
$arg = array_shift($tab);
foreach ($tab as $elem)
{
	$res = explode(":", $elem);
	if ($res[0] == $arg)
	{
		if ($res[1] != "")
			$resultat = $res[1];
	}
}
if ($resultat != NULL)
	echo $resultat."\n";
?>

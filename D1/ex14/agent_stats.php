#!/usr/bin/php
<?php
if ($argc != 2)
	return ;
$tab = file('php://stdin');
unset ($tab[0]);
if ($argv[1] === "moyenne")
{
	$i = 0;
	foreach ($tab as $elem)
	{
		$res = explode(";", $elem);
		if (is_numeric($res[1]) && $res[2] !== "moulinette")
		{
			$moy += $res[1];
			$i++;
		}
	}
	echo $moy / $i."\n";
}
?>

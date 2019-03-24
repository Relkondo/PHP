#!/usr/bin/php
<?php
if ($argc < 2)
	echo "Incorrect Parameters\n";
else
{
	$arg1 = trim($argv[1]);
	$arg2 = trim($argv[2]);
	$arg3 = trim($argv[3]);

	if ($arg2 == "+")
	{
		$res = $arg1 + $arg3;
		echo $res."\n";
	}

	if ($arg2 == "-")
	{
		$res = $arg1 - $arg3;
		echo $res."\n";
	}

	if ($arg2 == "/")
	{
		$res = $arg1 / $arg3;
		echo $res."\n";
	}

	if ($arg2 == "*")
	{
		$res = $arg1 * $arg3;
		echo $res."\n";
	}

	if ($arg2 == "%")
	{
		$res = $arg1 % $arg3;
		echo $res."\n";
	}
}
?>

#!/usr/bin/php
<?php
if ($argc != 2)
	echo "Incorrect Parameters\n";
else
{
	$i = 0;
	if (strpos($argv[1], "+") !== FALSE)
	{
		$tab = explode("+", $argv[1]);
		$i = 1;
	}
	else if (strpos($argv[1], "-") !== FALSE)
	{
		$tab = explode("-", $argv[1]);
		$i = 2;
	}
	else if (strpos($argv[1], "/") !== FALSE)
	{
		$tab = explode("/", $argv[1]);
		$i = 3;
	}
	else if (strpos($argv[1], "*") !== FALSE)
	{
		$tab = explode("*", $argv[1]);
		$i = 4;
	}
	else if (strpos($argv[1], "%") !== FALSE)
	{
		$tab = explode("%", $argv[1]);
		$i = 5;
	}
	else
	{
		echo "Syntax Error\n";
		exit();
	}
	if (count($tab) != 2)
		echo "Syntax Error\n";
	else
	{
		foreach ($tab as $elem)
			$res[] = trim($elem);
		if (!is_numeric($res[0]) || !is_numeric($res[1]))
		{
			echo "Syntax Error\n";
			return ;
		}
		if ($i == 1)
			echo ($res[0] + $res[1])."\n";
		else if ($i == 2)
			echo ($res[0] - $res[1])."\n";
		else if ($i == 3 && $res[1] != 0)
			echo ($res[0] / $res[1])."\n";
		else if ($i == 4)
			echo ($res[0] * $res[1])."\n";
		else if ($i == 5)
			echo ($res[0] % $res[1])."\n";
		else
			echo "Syntax Error\n";
	}
}
?>

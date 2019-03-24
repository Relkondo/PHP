#!/usr/bin/php
<?php

while (1)
{	
	echo "Entrez un nombre: ";
	if (($num = fgets(STDIN)) == False)
	{
		echo "\n";
		exit(0);
	}
	$num = trim($num);
	if (!is_numeric($num))
	{
		echo "'" . $num . "' n'est pas un chiffre\n";
	}
	else
	{
		if ($num % 2 == 0)
			echo "Le chiffre $num est Pair\n";
		else
			echo "Le chiffre $num est Impair\n";
	}
}
?>

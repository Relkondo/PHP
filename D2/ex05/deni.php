#!/usr/bin/php
<?php

if ($argc < 3 || !file_exists($argv[1]))
	exit ("Incorrect param\n");
if (($fd = fopen($argv[1], 'r')) === false)
	exit ("Couldn't open file\n");
while (!feof($fd))
	$data[] = explode(";", fgets($fd));
$title = $data[0];
foreach ($title as $tkey => $tval)
	$title[$tkey] = trim($tval);
unset($data[0]);
if (($nb = array_search($argv[2], $title)) === false)
	exit("Category doesn't exist\n");

foreach ($title as $tkey => $tval){
	foreach ($data as $dval) {
		if (isset($dval[$nb]))
			$tmp[trim($dval[$nb])] = trim($dval[$tkey]);
	}
	$$tval = $tmp;
}

$stdin = fopen("php://stdin", "r");
if (!$stdin)
	exit ();
while (!feof($stdin)) {
	echo "Entrez votre commande: ";
	$command = fgets($stdin);
	if ($command)
		eval($command);
}
fclose($stdin);
echo "\n";

#!/usr/bin/php
<?php
date_default_timezone_set("Europe/Paris");
if ($argc > 1) {
	$str = trim($argv[1]);
	$frenchy =	['/Janvier/', '/Février/', '/Mars/', '/Avril/', '/Mai/', '/Juin/', '/Juillet/', '/Août/', '/Septembre/', '/Octobre/', '/Novembre/', '/Décembre/', '/Lundi/', '/Mardi/', '/Mercredi/', '/Jeudi/', '/Vendredi/', '/Samedi/', '/Dimanche/'];
	$english =	['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
	$str= preg_replace($frenchy, $english, $str);
	$frenchy =	['/janvier/', '/février/', '/mars/', '/avril/', '/mai/', '/juin/', '/juillet/', '/août/', '/septembre/', '/octobre/', '/novembre/', '/décembre/', '/lundi/', '/mardi/', '/mercredi/', '/jeudi/', '/vendredi/', '/samedi/', '/dimanche/'];
	$str= preg_replace($frenchy, $english, $str);
	$str = preg_replace("/\s\s/", "EinGrossError", $str);

	$format = "D d M Y H:i:s";
	if (($date = DateTime::createFromFormat($format, $str)) === false) {
		exit("Wrong Format\n");
	}
	$res = date_timestamp_get($date);
	echo $res."\n";
}
?>

<?php
if ($_GET['action'] == 'set' && isset($_GET['name']))
	setcookie($_GET['name'], $_GET['value']);
else if ($_GET['action'] == 'get' && isset($_COOKIE[$_GET["name"]]))
		echo $_COOKIE[$_GET["name"]]."\n";
else if ($_GET['action'] == 'del')
	setcookie($_GET['name'], "", time(0));

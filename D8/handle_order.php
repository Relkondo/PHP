<?php

session_start();

if (isset($_SESSION['map']))
	$map = unserialize($_SESSION['map']);

$ship = $map->findShip($_POST['name']);

if (!$ship) {
	echo "ERROR";
	exit ;
}

if ($_SESSION['phase_id'] == 0) {
}

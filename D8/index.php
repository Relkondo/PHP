<?php

require_once("class/Map.class.php");

session_start();

if (!(isset($_SESSION['phase_id'])))
	$_SESSION['phase_id'] = 0;

if (!(isset($_SESSION['order_given'])))
	$_SESSION['order_given'] = 0;

if (!(isset($_SESSION['player'])))
	$_SESSION['player'] = 1;

$_SESSION['errors'] = "";

require_once("class/Dice.class.php");
require_once("class/Map.class.php");
require_once("class/HeavyShip.class.php");

$dice = new Dice();

if (!(isset($_SESSION['map']))) {
	$_SESSION['map'] = serialize (new Map());
}

$map = unserialize($_SESSION['map']);

$map->refreshMap();

if ($_POST['Dice_code_sub'] == 'Roll !') {
	$dice->roll($_POST['Dice_code']);
	unset($_POST['Dice_code_sub']);
} else {
}

if ($_POST['submit_order'] == "finish") {
	unset($_POST['submit_order']);
	$_SESSION['order_given']++;
	if ($_SESSION['order_given'] >= count($map->getVessels()))
	{
		$_SESSION['order_given'] = 0;
		$_SESSION['phase_id']++;
	}
	if ($_SESSION['phase_id'] >= 3)
	{
		$_SESSION['phase_id'] = 0;
		$_SESSION['order_given'] = 0;
		$_SESSION['player'] = ($_SESSION['player'] == 1 ? 2 : 1);
	}
}

if ($_POST['o_phase_submit'] == "OK") {
	$id = 0;
	foreach ($map->getVessels() as $ship) {
		if ($id == $_SESSION['order_given']) {
			if ($ship->getFaction() == $_SESSION['player']) {
				$map->orderPhase($ship, $_POST['shield'], $_POST['speed'], $_POST['shoot']);
				break ;
			}
		}
		if ($ship->getFaction() == $_SESSION['player'])
			$id++;
	}
}

if ($_POST['m_phase_submit'] == "OK") {
	$id = 0;
	foreach ($map->getVessels() as $ship) {
		if ($id == $_SESSION['order_given']) {
			if ($ship->getFaction() == $_SESSION['player']) {
				$map->mouvPhase($ship, $_POST['shield'], $_POST['speed'], $_POST['shoot']);
				print_r($ship);
				break ;
			}
		}
		if ($ship->getFaction() == $_SESSION['player'])
			$id++;
	}
}

include ("views/head.html");
include ("views/order_form.html");

if ($_SESSION['phase_id'] == 0) {
	include ("views/o_phase_form.html");
} else if ($_SESSION['phase_id'] == 1) {
	include ("views/m_phase_form.html");
} else if ($_SESSION['phase_id'] == 2) {
	include ("views/s_phase_form.html");
}

echo $shiplasexit ;

$map->renderMap();

include ("views/foot.html");

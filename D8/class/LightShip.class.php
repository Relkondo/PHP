<?php

include_once('Ship.class.php');
include_once('LightWeapon.class.php');

class LightShip extends SpaceShip {

	public function __construct($x, $y, $name, $faction) {
		parent::__construct( array ( 'name' => $name
			, 'x' => $x
			, 'y' => $y
			, 'faction' => $faction
			, 'width' => 1
			, 'height' => 3
			, 'max_hull' => 10
			, 'shield' => 5
			, 'pp' => 5
			, 'speed' => 15
			, 'inertia' => 4
			, 'weapon' => New LightWeapon()));
	}
/*
	public function fight(array $params) {
		$ship = $this->type($params['dice_roll'], $params['width'],
			$params['position_x'], $params['position_y'], $params['map'],
			$params['direction']);
		if ($ship === NULL)
			error_log("ship that was shot was null (fight function, LightShip.class.php)");
		else {
			$ship->shipIsShot($params['map']);
		}
	}
 */
	public function __toString() {
		return "Light" . parent::__toString();
	}
}

public function getImg() {	
	if ($this->faction === 1) {
		if ($this->direction === 0)
			return "img/Light1d0.jpg";
		else if ($this->direction === 1)
			return "img/Light1d1.jpg";
		else if ($this->direction === 2)
			return "img/Light1d2.jpg";
		else if ($this->direction === 3)
			return "img/Light1d3.jpg";
	}
	else if ($this->faction === 2) {
		if ($this->direction === 0)
			return "img/Light2d0.jpg";
		else if ($this->direction === 1)
			return "img/Light2d1.jpg";
		else if ($this->direction === 2)
			return "img/Light2d2.jpg";
		else if ($this->direction === 3)
			return "img/Light2d3.jpg";
	}
	exit (1);
}

public function doc()
{
	if (file_exists('LightShip.doc.txt'))
		return file_get_contents('LightShip.doc.txt');
}

?>


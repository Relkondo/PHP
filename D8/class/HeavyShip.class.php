<?php

include_once('SpaceShip.class.php');
require_once('HeavyWeapon.class.php');

class HeavyShip extends SpaceShip {

	public function __construct($x, $y, $name, $faction) {
		parent::__construct( array ( 'name' => $name
			, 'x' => $x
			, 'y' => $y
			, 'faction' => $faction
			, 'width' => 7
			, 'height' => 2
			, 'max_hull' => 30
			, 'shield' => 15
			, 'pp' => 20
			, 'speed' => 15
			, 'weapon' => New HeavyWeapon()
			, 'inertia' => 8));
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

	public function doc()
	{
		if (file_exists('HeavyShip.doc.txt'))
			return file_get_contents('HeavyShip.doc.txt');
	}

	public function getImg() {	
		if ($this->faction === 1) {
			if ($this->direction === 0)
				return "img/Heavy1d0.jpg";
			else if ($this->direction === 1)
				return "img/Heavy1d1.jpg";
			else if ($this->direction === 2)
				return "img/Heavy1d2.jpg";
			else if ($this->direction === 3)
				return "img/Heavy1d3.jpg";
		}
		else if ($this->faction === 2) {
			if ($this->direction === 0)
				return "img/Heavy2d0.jpg";
			else if ($this->direction === 1)
				return "img/Heavy2d1.jpg";
			else if ($this->direction === 2)
				return "img/Heavy2d2.jpg";
			else if ($this->direction === 3)
				return "img/Heavy2d3.jpg";
		}
		exit(1);
	}
}

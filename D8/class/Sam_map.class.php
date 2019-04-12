<?php

require_once("class/MapObject.class.php");
require_once("class/SpaceShip.class.php");

class Map {
	private $_map;
	private $_obstacles;
	private $_vessels;

	public function __construct(array $args = []) {
		$this->_obstacles = array();
		$ship = new HeavyShip(12, 12, "Iron Storm" , 1);
		$ship2 = new HeavyShip(12, 20, "Iron Storm2" , 1);
		$this->_vessels = array(clone($ship), clone($ship2));
		if ($args['max_obstacle'])
			$this->generateObstacles($args['max_obstacle']);
		$this->refreshMap();
	}

	public function getObstacles() {
		return ($this->_obstacles);
	}

	public function getVessels() {
		return ($this->_vessels);
	}

	public function addVessel(SpaceShip $vessel) {
		$this->_vessels[] = $vessel;
	}

	public function emptyMap() {
		$h = 0;
		while ($h < 100) {
			$w = 0;
			while ($w < 150) {
				$this->_map[$h][$w] = " ";
				$w++;
			}
			$h++;
		}
	}

	public function refreshMap() {
		$this->emptyMap();
		if (!(empty($this->_obstacles))) {
			foreach($this->_obstacles as $obj)
				$this->includeMapObject($obj);
		}
		if (!(empty($this->_vessels))) {
			foreach ($this->_vessels as $obj)
				$this->includeMapObject($obj);
		}
	}

	public function includeMapObject(MapObject $obj) {
		$h = 0;
		while ($h < $obj->getHeight()) {
			$w = 0;
			while ($w < $obj->getWidth()) {
				$this->_map[$obj->getPosY() + $h][$obj->getPosX() + $w] = $obj;
				$w++;
			}
			$h++;
		}
	}

	private function generateObstacles($nb_max = 30) {
		while ($nb_max-- > 0) {
			$obstacle = new Obstacle();
			if ($this->isFree($obstacle->getPosX(), $obstacle->getPosY(), $obstacle->getWidth(), $obstacle->getWeight())) {
				$this->includeMapObjects($obstacle);
				$this->_obstacles[] = $obstacle;
			}
			else {
				$nb_max++;
			}
		}
	}

	public function renderMap() {
		$this->refreshMap();
		$displayed = array();
		echo "<table id='map_frame'>" . PHP_EOL;
		foreach ($this->_map as $line) {
			echo "<tr class='map_line'>\n";
			foreach ($line as $item) {
				echo "<td class='map_square'>";
				if (!(in_array($item, $displayed)))
					echo $item;
				if ($item instanceof MapObject)
					$displayed[] = $item;
				echo "</td>\n";
			}
			echo "</tr>\n";
		}
		echo "</table>" . PHP_EOL;
	}

	private function isFree($x, $y, $width = 1, $height = 1) {
		$w = 0;
		$h = 0;
		while ($w < $width) {
			$h = 0;
			while ($h < $height) {
				if (isset($this->_map[$y + $h][$x +$w])
					&& $this->map[$y + $h][$x + $w] !== " ")
					return FALSE;
				$h++;
			}
			$w++;
		}
		return TRUE;
	}

	public function destroyShip($ship) {
		$x = $ship->getPosX();
		$y = $ship->getPosY();
		$w = $ship->getWidth();
		$h = $ship->getHeight();
		$n = $ship->getName();
		while ($w < $width) {
			$h = 0;
			while ($h < $height) {
				$this->_map[$y - $h][$x +$w]) && $this->[$y - $h][$x + $w] = " ")
					$h--;
			}
			$w++;
		}
		unset($this->_vessels[$n]);
	}


	public function orderPhase(Spaceship $ship, $speed, $shield, $shoot)
	{
		if ($speed + $shield + $shoot > $ship->getPp()) {
			error_log("Error : excessive spending of PP");
			exit (1);
		}
		$ship->orderPhase($speed, $shield, $shoot);
	}

	public function mouvPhase(Spaceship $ship, $turn, $mouv) {
		if (!$ship || $turn !== 0 && $turn !== 1 && $turn !== -1)) {
			error_log("Turn error or no ship");
			exit (1);
		}
		if ($mouv > $ship->getSpeed()) {
			error_log("excessive speed");
			exit (1);
		}
		$x = $ship->getPosX();
		$y = $ship->getPosY();
		$w = $ship->getWidth();
		$h = $ship->getHeight();
		if ($turn === 1 || $turn === -1) {
			$axis_x = $x + floor($w / 2);
			$axis_y = $y - floor($h / 2);
			$tmp = $w;
			$w = $h;
			$h = $tmp;
			$x = $axis_x - floor($w / 2);
			$y = $axis_y + floor($h / 2);
		}
		$d = $ship->getDirection();
		if ($d === 0)
			$x += $mouv;
		else if ($d === 1)
			$y += $mouv;
		else if ($d === 2)
			$x -= $mouv;
		else if ($d === 3)
			$y -= $mouv;
		if ($this->isFree($x, $y, $w, $h) === FALSE) {
			$ship->destroyShip($ship);
			return ("Ship destroyed ! Collision or got out\n"); }
			$ship->mouvPhase($turn, $x, $y);
		return ("OK");
	}

/*	private function checkShot($shooter, $target) {
		$sx = $shooter->getPosX();
		$sy = $shooter->getPosY();
		$sw = $shooter->getWidth();
		$sh = $shooter->getHeight();
		$sd = $shooter->getDirection();
		$sr = $shooter->weapon->getRange();
		$tx = $target->getPosX();
		$ty = $target->getPosY();
		$tw = $target->getWidth();
		$th = $target->getHeight();

		if (($sd === 0 || $sd === 2) && (($sy <= $ty && $sy >= $ty - $th) || ($ty <= $sy && $ty >= $sy - $sh))
			if (($sd === 0 && $sx
			return TRUE;
		else if ($sd === 1 && (($sx <= $tx + $tw && $sx >= $tx) || ($tx <= $sx + $sw && $tx >= $sx))
		else if ($sd === 1)
			$y += $mouv;
		else if ($sd === 2)
			$x -= $mouv;
		else if ($sd === 3)
			$y -= $mouv;
} */

	public function shotPhase(Spaceship $shooter, Spaceship $target)
	{
		$damages = $shooter->weapon->getShoot();
		$target->isShot($damages);
		if ($target->getHull() <= 0)
			$this->destroyShip($target);
	}

	public function findShip($name) {	return ($this->_vessels[$name]); }

	/*
	public function mouvPhase(Spaceship $ship, $x_mouv, $y_mouv)
	public function targetPhase(Spaceship $ship, $x_target, $y_target) */
}

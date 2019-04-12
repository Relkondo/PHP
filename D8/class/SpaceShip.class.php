<?php

include_once('MapObject.class.php');

abstract class SpaceShip extends MapObject {

	protected $faction;
	protected $max_hull;
	protected $hull;
	protected $init_shield;
	protected $shield;
	protected $init_speed;
	protected $speed;
	protected $inertia;
	protected $pp;
	protected $direction;
	protected $weapon;

	public function __construct( array $params ) {
		parent::__construct( $params );

		if ( !isset( $params['max_hull'] )
			|| !isset( $params['shield'] )
			|| !isset( $params['faction'] )
			|| !isset( $params['pp'] ) 
			|| !isset( $params['speed'])
			|| !isset( $params['weapon'])
			|| !isset( $params['inertia'])) {
			error_log("Ship error: incorrect parameters to constructor"
				. PHP_EOL );
			exit(1);
		}
		$this->faction = $params['faction'];
		$this->max_hull = $params['max_hull'];
		$this->init_shield = $params['shield'];
		$this->shield = $this->init_shield;
		$this->init_speed = $params['speed'];
		$this->speed = $this->init_speed;
		$this->pp = $params['pp'];
		$this->hull = $this->max_hull;
		$this->weapon = $params['weapon'];
		$this->inertia = $params['inertia'];
		$this->direction = 0;
	}

	public function __toString() {
		$str = "<a href='handle_order.php?name=";
		$str .= $this->getName();
		$str = "'><img class='vessel' src='" . $this->getImg();
		$str .= "' height='" . 15 * $this->getHeight();
		$str .= "' width='" . 15 * $this->getWidth();
		$str .= "' posX='" . (1 + 15 * $this->getPosX());
		$str .= "' posY='" . (1 + 15 * $this->getPosY());
		$str .=	"' alt='" . $this->getName() . "' />";
		$str .= "</a>";
		return ($str);
	}

	public function orderPhase($speed, $shield, $shoot) {
		$this->shield = $this->init_shield + $shield;
		$this->speed = $this->init_speed + $speed;
		$this->weapon->orderPhase($shoot);
		$_SESSION['phase_ship'][] = $this;
	}

	public function mouvPhase($turn, $x, $y) {
		$this->direction += $turn;
		$this->direction %= 4;
		$this->pos_x = $x;
		$this->pos_y = $y;
	}

/*
	public abstract function fight(array $params);

	public function isInLimits($map)
	{
		if($this->position_x < 0 || $this->position_x >= $map->getWidth()
			|| $this->position_y < 0 || $this->position_y >= $map->getHeight())
		{
			$map->destroyShip($this);
			return FALSE;
		}
		return TRUE;
	}
 */

	public function doc()
	{
		if (file_exists('SpaceShip.doc.txt'))
			return file_get_contents('SpaceShip.doc.txt');
	}

	public function isShot($damages) {
		if ($this->shield == 0)
			$this->hull = $this->hull - $damages;
		else
			$this->shield = $this->shield - $damages;
	}


	public function getHull() {		return $this->hull; }
	public function getShield() {		return $this->shield; }
	public function getSpeed() {		return $this->speed; }
	public function getPp() {		return $this->Pp; }
	public function getInertia() {		return $this->inertia; }
	public function getDirection() {		return $this->direction; }
	public function getFaction() {		return $this->faction; }
} 

?>

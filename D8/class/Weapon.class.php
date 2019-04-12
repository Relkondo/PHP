<?php

abstract class Weapon {

	protected $init_shoot;
	protected $shoot;
	protected $range;

	public function __construct( array $params ) {
		if ( !isset( $params['shoot'] )
			|| !isset( $params['range'] )) {
			error_log("Weapon error: incorrect parameters to constructor"
				. PHP_EOL );
			exit(1);
		}
		$this->init_shoot = $params['shoot'];
		$this->range = $params['range'];
		$this->shoot = $this->init_shoot;
	}

	public function orderPhase($shoot) {
		$this->shoot = $this->init_shoot + $shoot;
	}

	public function doc()
 	{
 		if (file_exists('Weapon.doc.txt'))
 			return file_get_contents('Weapon.doc.txt');
 	}

	public function getShoot() {			return $this->shoot; }
	public function getShip() {				return $this->ship; }
	public function getRange() {			return $this->range; }
} 

<?php

include_once('Weapon.class.php');

class HeavyWeapon extends Weapon {

	public function __construct() {
		parent::__construct( array ('shoot' => 20
			, 'range' => 30));
	}

	public function doc()
	{
		if (file_exists('HeavyWeapon.doc.txt'))
			return file_get_contents('HeavyWeapon.doc.txt');
	}
} 

?>

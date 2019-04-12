<?php

include_once('Weapon.class.php');

class LightWeapon extends Weapon {

	public function __construct() {
		parent::__construct( array ('shoot' => 6
			, 'range' => 20));
	}

	public function doc()
	{
		if (file_exists('LightWeapon.doc.txt'))
			return file_get_contents('LightWeapon.doc.txt');
	}
}

?>

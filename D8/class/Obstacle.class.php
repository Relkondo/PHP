<?php

require_once('MapObject.class.php');

class Obstacle extends MapObject {

	public function __construct() {
		parent::__construct( array ( 'name' => 'obstacle'
			, 'x' => $rand(0, 144);
		, 'y' => $rand(0, 94);
		, 'width' => $rand(1, 5);
		, 'height' => $rand(1, 5); ))
	}

	public function __toString() {
		return "Obstacle" . parent::__toString();
	}

	public function doc()
	{
		if (file_exists('Obstacle.doc.txt'))
			return file_get_contents('Obstacle.doc.txt');
	}


	public function getImg() { return "img/Obstacle.png"; }
}

?>

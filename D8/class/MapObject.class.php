<?php

abstract class MapObject {
	protected $name;
	protected $pos_x;
	protected $pos_y;
	protected $width;
	protected $height;

	public function __construct( array $params ) {
		if ( !isset( $params['name'] ) 
			|| !isset( $params['x'] )
			|| !isset( $params['y'] )
			|| !isset( $params['width'] )
			|| !isset( $params['height'] ) ) {
			error_log("MapObject error: incorrect parameters to constructor"
				. PHP_EOL );
			exit(1);
		}
		$this->name = $params['name'];
		$this->pos_x = $params['x'];
		$this->pos_y = $params['y'];
		$this->width = $params['width'];
		$this->height = $params['height'];
	}

	public function __toString() {
		$str = "<img src='" . $this->getImg() . "' alt='" . $this->getName() . "' />";
		return ($str);
	}

	public function occupy($x, $y) {
		return ( $x >= $this->pos_x
			&& $x < $this->pos_x + $this->width
			&& $y <= $this->pos_y
			&& $y > $this->pos_y - $this->height);
	}

	public function doc()
	{
		if (file_exists('MapObject.doc.txt'))
			return file_get_contents('MapObject.doc.txt');
	}

	public function getName() {			return $this->name; 		}
	public function getPosX() {			return $this->pos_x;		}
	public function getPosY() {			return $this->pos_y;		}
	public function getWidth() {		return $this->width;		}
	public function getHeight() {		return $this->height;		}
	abstract function getImg();
}

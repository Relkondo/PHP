<?php
require_once('Color.class.php');

class Vertex
{
	static public $verbose = false;

	private $_x;
	private $_y;
	private $_z;
	private $_w = 1.0;
	private $_color = false;

	public function __construct(array $vert)
	{
		if (array_key_exists('x', $vert) && array_key_exists('y', $vert) && array_key_exists('z', $vert)){
			$this->_x = floatval($vert['x']);
			$this->_y = floatval($vert['y']);
			$this->_z = floatval($vert['z']); }
		else {
			return FALSE; }

		if (array_key_exists('w', $vert))
			$this->_w = floatval($vert['w']);

		if (!(array_key_exists('color', $vert)))
			$this->_color = new Color(array('red' => 255, 'green' => 255, 'blue' => 255));
		else if ($vert['color'] instanceof Color)
			$this->_color = $vert['color'];
		else
			return FALSE;

		if (self::$verbose)
			echo $this->__toString() . ' constructed' . PHP_EOL;

		return TRUE;
	}

	public function __destruct()
	{
		if (self::$verbose)
			echo $this->__toString() . ' destructed' . PHP_EOL;
	}

	public function __toString()
	{
		return "Vertex( x: " . number_format($this->_x, 2, ".", "") .
", y: " . number_format($this->_y, 2, ".", "") .
", z:" . number_format($this->_z, 2, ".", "") .
", w:" . number_format($this->_w, 2, ".", "") .
(self::$verbose ? ", $this->_color" : '') . " )";
	}

	public static function doc()
	{
		if (file_exists('Vertex.doc.txt'))
			return file_get_contents('Vertex.doc.txt');
	}

	public function getX()
	{
		return $this->_x;
	}

	public function setX($x)
	{
		$this->_x = $x;
	}

	public function getY()
	{
		return $this->_y;
	}

	public function setY($y)
	{
		$this->_y = $y;
	}

	public function getZ()
	{
		return $this->_z;
	}

	public function setZ($z)
	{
		$this->_z = $z;
	}

	public function getW()
	{
		return $this->_w;
	}

	public function setW($w)
	{
		$this->_w = $w;
	}

	public function getColor()
	{
		return $this->_color;
	}

	public function setColor($color)
	{
		$this->_color = $color;
	}

	public function __get($name)
	{
		return false;
	}

	public function __set($name, $value)
	{
		return false;
	}

}

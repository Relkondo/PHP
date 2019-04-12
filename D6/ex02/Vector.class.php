<?php

require_once 'Vertex.class.php';

class Vector
{
	static public $verbose = false;

	private $_x;
	private $_y;
	private $_z;
	private $_w = 0.0;

	public function __construct(array $vect)
	{

		if (!array_key_exists('dest', $vect) || !($vect['dest'] instanceof Vertex))
			return FALSE;
		else if (array_key_exists('orig', $vect) && !($vect['orig'] instanceof Vertex))
			return FALSE;
		else if (!array_key_exists('orig', $vect))
			$vect['orig'] = new Vertex(['x' => 0, 'y' => 0, 'z' => 0]);
		$this->_x = floatval($vect['dest']->getX() - $vect['orig']->getX());
		$this->_y = floatval($vect['dest']->getY() - $vect['orig']->getY());
		$this->_z = floatval($vect['dest']->getZ() - $vect['orig']->getZ());
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
		return 'Vector( x:' . number_format($this->_x, 2, ".", "") .
', y:' . number_format($this->_y, 2, ".", "") .
', z:' . number_format($this->_z, 2, ".", "") .
', w:' . number_format($this->_w, 2, ".", "") . ' )';
	}

	static public function doc()
	{
		if (file_exists('Vector.doc.txt'))
			return file_get_contents('Vector.doc.txt');
	}

	public function getX()
	{
		return $this->_x;
	}

	public function getY()
	{
		return $this->_y;
	}

	public function getZ()
	{
		return $this->_z;
	}

	public function getW()
	{
		return $this->_w;
	}

	public function magnitude()
	{
		return sqrt($this->_x * $this->_x + $this->_y * $this->_y + $this->_z * $this->_z);
	}

	private function div($nb)
	{
		$nb = ($nb > 0 ? $nb : 1);
		$x = $this->_x / $nb;
		$y = $this->_y / $nb;
		$z = $this->_z / $nb;
		return new Vector(['dest' => new Vertex(compact('x', 'y', 'z'))]);
	}

	public function normalize()
	{
		return $this->div($this->magnitude());
	}

	public function add(Vector $rhs)
	{
		$x = $this->_x + $rhs->getX();
		$y = $this->_y + $rhs->getY();
		$z = $this->_z + $rhs->getZ();
		return new Vector(['dest' => new Vertex(compact('x', 'y', 'z'))]);
	}

	public function sub(Vector $rhs)
	{
		$x = $this->_x - $rhs->getX();
		$y = $this->_y - $rhs->getY();
		$z = $this->_z - $rhs->getZ();
		return new Vector(['dest' => new Vertex(compact('x', 'y', 'z'))]);
	}

	public function opposite()
	{
		$x = $this->_x * -1;
		$y = $this->_y * -1;
		$z = $this->_z * -1;
		return new Vector(['dest' => new Vertex(compact('x', 'y', 'z'))]);
	}

	public function scalarProduct($k)
	{
		$x = $this->_x * $k;
		$y = $this->_y * $k;
		$z = $this->_z * $k;
		return new Vector(['dest' => new Vertex(compact('x', 'y', 'z'))]);
	}

	public function dotProduct(Vector $rhs)
	{
		return (float)($this->_x * $rhs->getX() + $this->_y * $rhs->getY() + $this->_z * $rhs->getZ());
	}

	public function cos(Vector $rhs)
	{
		return (float)($this->dotProduct($rhs) / ($this->magnitude() * $rhs->magnitude()));
	}

	public function crossProduct(Vector $rhs)
	{
		$x = $this->_y * $rhs->getZ() - $rhs->getY() * $this->_z;
		$y = $this->_z * $rhs->getX() - $this->_x * $rhs->getZ();
		$z = $this->_x * $rhs->getY() - $this->_y * $rhs->getX();
		return new Vector(['dest' => new Vertex(compact('x', 'y', 'z'))]);
	}
}

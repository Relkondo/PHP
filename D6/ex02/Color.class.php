<?php

class Color
{
	static public $verbose = false;
	public $red;
	public $green;
	public $blue;

	function __construct(array $color)
	{
		if (array_key_exists('rgb', $color))
		{
			$rgb = intval($color['rgb']);
			$this->red = ($rgb >> 16) & 255;
			$this->green = ($rgb >> 8) & 255;
			$this->blue = $rgb & 255;
		}
		else if (array_key_exists('red', $color) && array_key_exists('green', $color) &&
			array_key_exists('blue', $color))
		{
			$this->red = intval($color['red']);
			$this->green = intval($color['green']);
			$this->blue = intval($color['blue']);
		}
		else {
			return FALSE; }
		if (self::$verbose)
			echo $this->__toString() . " constructed." . PHP_EOL;

		return TRUE;
	}

	public function __toString()
	{
		return "Color( red: " . str_pad($this->red, 3, " ", STR_PAD_LEFT) .", green: " . str_pad($this->green, 3, " ", STR_PAD_LEFT) .", blue: " . str_pad($this->blue, 3, " ", STR_PAD_LEFT) ." )";
	}

	public function __destruct()
	{
		if (self::$verbose)
			echo $this->__toString() . " destructed." . PHP_EOL;
	}

	static public function doc()
	{
		if (file_exists('Color.doc.txt'))
			return file_get_contents('Color.doc.txt');
	}

	public function add(Color $color)
	{
		return new Color([
			'red' => $this->red + $color->red,
			'green' => $this->green + $color->green,
			'blue' => $this->blue + $color->blue
		]);
	}

	public function sub(Color $color)
	{
		return new Color([
			'red' => $this->red - $color->red,
			'green' => $this->green - $color->green,
			'blue' => $this->blue - $color->blue
		]);
	}

	public function mult($multip)
	{
		return new Color([
			'red' => $this->red * $multip,
			'green' => $this->green * $multip,
			'blue' => $this->blue * $multip
		]);
	}
}
?>

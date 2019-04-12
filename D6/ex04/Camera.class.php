<?php

class Camera
{
	static $verbose = false;
	private $_origin;
	private $_tT;
	private $_tR;
	private $_view_mtrx;
	private $_proj;

	function __construct(array $input)
	{
		if (isset($input['ratio']) && (isset($input['width']) || isset($input['height'])))
			return FALSE;
		if (!isset($input['ratio']) && (!isset($input['width']) || !isset($input['height'])))
			return FALSE;
		if (!isset($input['origin']) || !isset($input['orientation']) || !isset($input['fov']) || !isset($input['near']) || !isset($input['far']))
			return FALSE;
		$this->_origin = $input['origin'];
		$v = new Vector (array('dest' => $input['origin']));
		$oppv = $v->opposite();
		$this->_tT = new Matrix (array('preset' => Matrix::TRANSLATION, 'vtc' => $oppv));
		$this->_tR = $input['orientation']->transpose();
		$this->_view_mtrx = $this->_tR->mult($this->_tT);
		$width = (float)$input['width'];
		$height = (float)$input['height'];
		if (isset($input['ratio']))
			$ratio = $input['ratio'];
		else
			$ratio = $width / $height;
		$this->_proj = new Matrix(array('preset' => Matrix::PROJECTION, 'fov' => $input['fov'], 'ratio' => $ratio, 'near' => $input['near'], 'far' => $input['far']));
		if (Self::$verbose) {
			echo "Camera instance constructed\n";
		}
		return TRUE;
	}

	function __destruct()
	{
		if (self::$verbose)
			echo "Camera instance destructed\n";
	}

	function __toString()
	{
		$tmp = "Camera( \n+ Origine: ".$this->_origin."\n+ tT:\n".$this->_tT."\n+ tR:\n".$this->_tR."\n+ tR->mult( tT ):\n".$this->_view_mtrx."\n+ Proj:\n".$this->_proj."\n)";
		return ($tmp);
	}

	public static function doc()
	{
		if (file_exists('Camera.doc.txt'))
			return file_get_contents('Camera.doc.txt');
	}

	public function watchVertex(Vertex $worldVertex)
	{
		$wvtx = $this->_proj->transformVertex($this->_view_mtrx->transformVertex($worldVertex));
	}
}

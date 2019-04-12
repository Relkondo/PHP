<?php

require_once 'Vector.class.php';

class Matrix
{

	const IDENTITY = 'IDENTITY';
	const SCALE = 'SCALE';
	const RX = 'Ox ROTATION';
	const RY = 'Oy ROTATION';
	const RZ = 'Oz ROTATION';
	const TRANSLATION = 'TRANSLATION';
	const PROJECTION = 'PROJECTION';

	private $_transform = [
		[0.00, 0.00, 0.00, 0.00],
		[0.00, 0.00, 0.00, 0.00],
		[0.00, 0.00, 0.00, 0.00],
		[0.00, 0.00, 0.00, 0.00],
	];
	private $_matr = array();
	private $_coo = ['x', 'y', 'z', 'w'];
	static public $verbose = false;

	public function __construct(array $matr, $new = true)
	{
		if (!isset($matr['preset']) || !in_array($matr['preset'], [
			self::IDENTITY, self::SCALE, self::RX, self::RY, self::RZ, self::TRANSLATION, self::PROJECTION
		]))
		return FALSE;
		if (!isset($matr['scale']) && $matr['preset'] === self::SCALE)
			return FALSE;
		if (!isset($matr['angle']) && in_array($matr['preset'], [self::RY, self::RX, self::RZ]))
			return FALSE;
		if ((!isset($matr['vtc']) || !($matr['vtc'] instanceof Vector)) && $matr['preset'] === self::TRANSLATION)
			return FALSE;
		if ((!isset($matr['fov']) || !isset($matr['ratio']) || !isset($matr['near']) || !isset($matr['far'])) && $matr['preset'] === self::PROJECTION)
			return FALSE;
		if (self::$verbose && $new)
			echo "Matrix {$matr['preset']} " . ($matr['preset'] !== self::IDENTITY ? 'preset ' : '') . "instance constructed\n";
		$func_name = str_replace(' ', '_', strtolower($matr['preset']));
		$this->{$func_name}($matr);
		$this->_matr = $matr;
		return TRUE;
	}

	public function __destruct()
	{
		if (self::$verbose)
			echo "Matrix instance destructed\n";
	}

	public function __toString()
	{
		$line = "M | vtcX | vtcY | vtcZ | vtxO\n";
		$line .= "-----------------------------";
		for ($i = 0; $i < count($this->_transform); $i++)
		{
			$line .= "\n{$this->_coo[$i]}";
			for ($j = 0; $j < count($this->_transform[$i]); $j++)
				$line .= ' | ' . number_format($this->_transform[$i][$j], 2, '.', '');
		}
		return $line;
	}

	public static function doc()
	{
		if (file_exists('Matrix.doc.txt'))
			return file_get_contents('Matrix.doc.txt');
	}

	private function scale($matr)
	{
		$this->_transform[0][0] = $matr['scale'];
		$this->_transform[1][1] = $matr['scale'];
		$this->_transform[2][2] = $matr['scale'];
		$this->_transform[3][3] = 1;
	}

	private function identity($matr)
	{
		$matr['scale'] = 1;
		$this->scale($matr);
	}

	private function translation($matr)
	{
		$this->identity($matr);
		$this->_transform[0][3] = $matr['vtc']->getX();
		$this->_transform[1][3] = $matr['vtc']->getY();
		$this->_transform[2][3] = $matr['vtc']->getZ();
	}

	private function ox_rotation($matr)
	{
		$this->identity($matr);
		$this->_transform[0][0] = 1;
		$this->_transform[1][1] = cos($matr['angle']);
		$this->_transform[1][2] = -sin($matr['angle']);
		$this->_transform[2][1] = sin($matr['angle']);
		$this->_transform[2][2] = cos($matr['angle']);
	}

	private function oy_rotation($matr)
	{
		$this->identity($matr);
		$this->_transform[0][0] = cos($matr['angle']);
		$this->_transform[0][2] = sin($matr['angle']);
		$this->_transform[1][1] = 1;
		$this->_transform[2][0] = -sin($matr['angle']);
		$this->_transform[2][2] = cos($matr['angle']);
	}

	private function oz_rotation($matr)
	{
		$this->identity($matr);
		$this->_transform[0][0] = cos($matr['angle']);
		$this->_transform[0][1] = -sin($matr['angle']);
		$this->_transform[1][0] = sin($matr['angle']);
		$this->_transform[1][1] = cos($matr['angle']);
		$this->_transform[2][2] = 1;
	}

	private function projection($matr)
	{
		if ($matr['ratio'] === 0 || ($matr['near'] - $matr['far']) === 0) {
			echo "Error : division by zero. Check values of 'ratio', 'near', 'far'.\n";
			return; }
		$this->identity($matr);
		$this->_transform[1][1] = 1 / tan(0.5 * deg2rad($matr['fov']));
		$this->_transform[0][0] = $this->_transform[1][1] / $matr['ratio'];
		$this->_transform[2][2] = -1 * (-$matr['near'] - $matr['far']) / ($matr['near'] - $matr['far']);
		$this->_transform[2][3] = (2 * $matr['near'] * $matr['far']) / ($matr['near'] - $matr['far']);
		$this->_transform[3][2] = -1;
		$this->_transform[3][3] = 0;
	}

	public function mult(Matrix $rhs)
	{
		$tmp = array();
		for ($i = 0; $i < 4; $i++) {
			$tmp[$i] = array();
			for ($j = 0; $j < 4; $j++) {
				$tmp[$i][$j] = 0;
				for ($k = 0; $k < 4; $k++)
					$tmp[$i][$j] += $this->_transform[$i][$k] * $rhs->_transform[$k][$j];
			}
		}
		$result = new Matrix($this->_matr, false);
		$result->_transform = $tmp;
		return $result;
	}

	public function transformVertex(Vertex $vtx)
	{
		$tmp = array();
		$trans = $this->_transform;
		$tmp['x'] = ($vtx->getX() * $trans[0][0]) + ($vtx->getY() * $trans[0][1]) + ($vtx->getZ() * $trans[0][2]) + ($vtx->getW() * $trans[0][3]);
		$tmp['y'] = ($vtx->getX() * $trans[1][0]) + ($vtx->getY() * $trans[1][1]) + ($vtx->getZ() * $trans[1][2]) + ($vtx->getW() * $trans[1][3]);
		$tmp['z'] = ($vtx->getX() * $trans[2][0]) + ($vtx->getY() * $trans[2][1]) + ($vtx->getZ() * $trans[2][2]) + ($vtx->getW() * $trans[2][3]);
		$tmp['w'] = ($vtx->getX() * $trans[3][0]) + ($vtx->getY() * $trans[3][1]) + ($vtx->getZ() * $trans[3][2]) + ($vtx->getW() * $trans[3][3]);
		$color = $vtx->getColor();
		$vertex = new Vertex($tmp);
		return $vertex;
	}
}

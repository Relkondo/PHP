<?php
class Dice {
	private $_res;
	const ERR_CODE = 1;

	public function __construct()
	{
		$this->_res = 0;
	}

	public function roll($dice_code)
	{
		$_SESSION['errors']['Dice::roll'] = "";
		$attr = explode("D", $dice_code);
		if (count($attr) != 2) {
			$_SESSION['errors']['Dice::roll'] = 'Wrong format !' . PHP_EOL;
			return ;
		}
		if ($attr[1] != 6) {
			$_SESSION['errors']['Dice::roll'] = "This dice is not supportted" . PHP_EOL;
			return ;
		}
		$this->_res = 0;
		while ((int)$attr[0] > 0) {
			$attr[0]--;
			$this->_res += rand(1, 6);
		}
	}

	public function checkCondition($condition)
	{
		if ($condition == "")
			return ;
		$arr = explode("+", $condition);
		$min = $arr[0];
		if (!is_numeric($min))
		{
			$_SESSION['errors']['Dice::checkCondition'] = "Wrong Format !" . PHP_EOL;
		}
		return ($this->_res >= $min);
	}

	public function getResult() {
		return ($this->_res);
	}

	public static function doc() {
		if (file_exists('Dice.doc.txt'))
			return file_get_contents('Dice.doc.txt');
	}

}

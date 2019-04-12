<?php

abstract Class Fighter {
	public function __construct($name){
		$this->name = $name;
	}
	abstract public function fight($op);
}
?>

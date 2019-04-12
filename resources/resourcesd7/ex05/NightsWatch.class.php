<?php
Class NightsWatch {
	private $_members =  array();

	public function recruit ($fighter) {
		if ($fighter instanceof Ifighter)
			array_push($this->_members, $fighter);
	}

	public function fight() {
	foreach ($this->_members as $fighter)
		$fighter->fight();
	}
}
?>

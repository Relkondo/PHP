<?php
Class UnholyFactory {
	private $_shop = array();

	public function absorb($fighter) {
		$type = $fighter->name;
		if (is_subclass_of($fighter, Fighter)) {
			if (!(array_key_exists($type, $this->_shop))) {
				$this->_shop[$type] = get_class($fighter);
				print ("(Factory absorbed a fighter of type ".$type.")" . PHP_EOL);
				 }
			else {
				print ("(Factory already absorbed a fighter of type ".$type.")" . PHP_EOL);
			}
		}
		else {
			print ("(Factory can't absorb this, it's not a fighter)" . PHP_EOL);
		}
	}

	public function fabricate($type) {
		if (array_key_exists($type, $this->_shop)) {
			print ("(Factory fabricates a fighter of type ".$type.")" . PHP_EOL);
			return (New $this->_shop[$type]);
		}
		else {
			print ("(Factory hasn't absorbed any fighter of type ".$type.")" . PHP_EOL);
			return NULL;
		}
	}
}

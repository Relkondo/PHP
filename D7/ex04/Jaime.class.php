<?php

Class Jaime extends Lannister {
	public function sleepWith($o)
	{
		if (!($o instanceof Cersei))
			parent::sleepWith($o);
		else
			print ("With pleasure, but only in a tower in Winterfell, then." . PHP_EOL);
	}
}
?>

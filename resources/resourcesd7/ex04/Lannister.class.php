<?php

Class Lannister {
	public function sleepWith($o)
	{
		if (is_subclass_of($o, 'Lannister'))
			print ("Not even if I'm drunk !" . PHP_EOL);
		else
			print ("Let's do this." . PHP_EOL);
	}
}
?>

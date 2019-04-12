#!/usr/bin/php
<?php
if ($argc > 1) {
		$str = preg_replace("/[ \t\r]+/", " ", $argv[1]);
			echo trim($str) . "\n";
}

?>

<?php

foreach ($_GET as $k => $v) {
	$fd = file_get_contents('list.csv');
	$split = explode("\n", $fd);
	echo $split;
	foreach ($split as $ele) {
		$arr = explode(";", $ele);
		if ($arr[1] == $v) {
			$data = $arr[1].';'.$arr[1]."\n";
			$fd = str_replace($data, '', $fd);
			file_put_contents('list.csv', $fd);
		}
	}
}

?>

<?php

foreach ($_GET as $k => $v) {
	file_put_contents('list.csv', $_GET[$k].';'.$_GET[$k]."\n", FILE_APPEND);
}

?>

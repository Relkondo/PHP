<?php

if ($POST['login'] === "" || $_POST['oldpw'] === "" || $_POST['newpw'] === "" || $_POST['submit'] !== "OK")
	echo "ERROR\n";

else if ($_POST['login'] && $_POST['oldpw'] && $_POST['newpw'] && $_POST['submit'] && $_POST['submit'] === "OK") {
	$accounts = unserialize(file_get_contents('../private/passwd'));
	$login = $_POST['login'];
	$oldpw = hash("whirlpool", $_POST['oldpw']);
	$newpw = hash("whirlpool", $_POST['newpw']);
	if ($accounts) {
		$check = 0;
		foreach ($accounts as $key => $val) {
			if ($val['login'] === $login && $val['passwd'] === $oldpw) {
				$check = 1;
				$accounts[$key]['passwd'] =  $newpw;
			}
		}
		if ($check) {
			file_put_contents('../private/passwd', serialize($accounts));
			echo "OK\n";
		} else {
			echo "ERROR\n";
		}
	} else {
		echo "ERROR\n";
	}
}

else {
	echo "ERROR\n";
}

?>

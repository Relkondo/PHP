<?php
function check_login($login, $file)
{
	foreach($file as $ele)
	{
		if($ele['login'] === $login)
			return (-1);
	}
	return (1);
}

if (trim($_POST['login']) === "" || trim($_POST['passwd']) === "" || $_POST['submit'] !== "OK") {
	echo "ERROR\n";
	exit (); }

if ($_POST['submit'] && $_POST['login'] && $_POST['passwd']) {
	if (!file_exists('../private'))
		mkdir("../private");
	if (!file_exists('../private/passwd'))
		file_put_contents('../private/passwd', null);
	else
		$accounts = unserialize(file_get_contents('../private/passwd'));
	$login = trim($_POST['login']);
	$passwd = trim($_POST['passwd']);
	$passwd = hash("whirlpool", $passwd);
	if (check_login($login, $accounts) == 1) {
		$accounts[] = array("login" => $login, "passwd" => $passwd);
		file_put_contents('../private/passwd', serialize($accounts));
		echo "OK\n";
	}
	else {
		echo "ERROR\n";
   		exit ();	}
}
else {
	echo "ERROR\n"; }
?>
